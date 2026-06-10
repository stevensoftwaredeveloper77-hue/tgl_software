<?php

namespace App\Http\Controllers\AI;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class VirtualAgentController extends Controller
{
    public function chat(Request $request)
    {
        $request->validate([
            'message'       => 'required|string|max:1000',
            'system_prompt' => 'required|string',
            'history'       => 'required|array',
        ]);

        $apiKey = env('GEMINI_API_KEY');

        if (!$apiKey) {
            return response()->json(['error' => 'API Key no configurada en el servidor.'], 500);
        }

        try {
            $url = "https://generativelanguage.googleapis.com/v1/models/gemini-3.5-flash:generateContent?key=" . $apiKey;

            $payloadContents = $request->history;
            array_unshift($payloadContents, [
                'role' => 'user',
                'parts' => [
                    ['text' => "INSTRUCCIONES DEL SISTEMA (Actúa bajo este rol rigurosamente):\n" . $request->system_prompt]
                ]
            ]);
            array_unshift($payloadContents, [
                'role' => 'model',
                'parts' => [
                    ['text' => "Entendido. Adoptaré ese rol e instrucciones para toda la conversación."]
                ]
            ]);

            $intentos = 0;
            $maxIntentos = 3;
            $response = null;

            while ($intentos < $maxIntentos) {
                $response = Http::withHeaders([
                    'Content-Type' => 'application/json',
                ])->post($url, [
                    'contents' => $payloadContents,
                ]);

                if ($response->successful()) {
                    break;
                }

                if ($response->status() === 503 || $response->status() === 429) {
                    $intentos++;
                    sleep(2);
                    continue;
                }

                break;
            }

            if ($response && $response->successful()) {
                $data = $response->json();
                $botReply = $data['candidates'][0]['content']['parts'][0]['text'] ?? 'No pude procesar la solicitud.';
                return response()->json(['reply' => $botReply]);
            }

            return response()->json([
                'error' => 'Error en la respuesta del servicio de IA.',
                'details' => $response ? $response->json() : null
            ], $response ? $response->status() : 500);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Fallo crítico en la matriz de comunicación.'], 500);
        }
    }
}
