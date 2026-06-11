<script setup>
import axios from "axios";
import { ref, nextTick } from "vue";
import { generateTglAgentPrompt } from "@/Resource/VirtualAgent/tglAgentPrompt.js";

const isOpen = ref(false);
const chatContainer = ref(null);

const agentsConfig = {
    comercial: {
        title: "// TGL_AGENT",
        systemPrompt: generateTglAgentPrompt(),
        welcome:
            "¡Hola! Soy TGL Agent. ¿En qué te puedo ayudar hoy con tu negocio? Recuerda que nos especializamos en diseñar soluciones y software completamente a la medida.",
    },
};

const currentAgent = ref(agentsConfig.comercial);
const messages = ref([{ sender: "bot", text: currentAgent.value.welcome }]);
const userMessage = ref("");
const isSending = ref(false);

const scrollToBottom = async () => {
    await nextTick();
    if (chatContainer.value) {
        chatContainer.value.scrollTop = chatContainer.value.scrollHeight;
    }
};

const sendMessage = async () => {
    if (!userMessage.value.trim() || isSending.value) return;

    const messageToSend = userMessage.value;
    messages.value.push({ sender: "user", text: messageToSend });
    userMessage.value = "";
    isSending.value = true;

    scrollToBottom();

    try {
        const chatHistory = messages.value.map((msg) => ({
            role: msg.sender === "user" ? "user" : "model",
            parts: [{ text: msg.text }],
        }));

        const response = await axios.post("/agent/chat", {
            message: messageToSend,
            system_prompt: currentAgent.value.systemPrompt,
            history: chatHistory,
        });

        messages.value.push({ sender: "bot", text: response.data.reply });
    } catch (error) {
        messages.value.push({
            sender: "bot",
            text: "Nuestro agente se encuentra en mantenimiento en este momento.",
        });
    } finally {
        isSending.value = false;
        scrollToBottom();
    }
};
</script>

<template>
    <div class="fixed bottom-6 right-6 z-50 font-sans">
        <div
            v-if="!isOpen"
            @click="isOpen = true"
            class="flex items-center gap-2 bg-[#0d1527]/95 backdrop-blur-md hover:bg-[#121d36] border border-slate-800 hover:border-cyan-500/50 pl-4 pr-2 py-2 rounded-full shadow-2xl cursor-pointer transition-all duration-300 hover:scale-105 group select-none"
        >
            <span
                class="text-xs font-mono font-bold tracking-wider text-slate-300 group-hover:text-cyan-400 transition-colors uppercase"
            >
                Chatea conmigo
            </span>

            <div
                class="flex items-center justify-center w-10 h-10 bg-cyan-600 group-hover:bg-cyan-500 text-white rounded-full transition-colors relative"
            >
                <span
                    class="absolute inline-flex h-full w-full rounded-full bg-cyan-500 opacity-20 animate-ping"
                ></span>
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="2.5"
                    stroke="currentColor"
                    class="w-5 h-5"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 01.865-.501 48.172 48.172 0 003.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z"
                    />
                </svg>
            </div>
        </div>

        <div
            v-else
            class="m-10 w-auto sm:w-96 h-auto sm:h-[500px] bg-[#070b14]/90 backdrop-blur-md border border-slate-800 rounded-2xl shadow-2xl flex flex-col overflow-hidden animate-in fade-in zoom-in-95 duration-200"
        >
            <div
                class="p-4 bg-[#0d1527]/80 border-b border-slate-800 flex items-center justify-between"
            >
                <div class="flex items-center gap-2">
                    <span
                        class="w-2 h-2 bg-cyan-400 rounded-full animate-pulse"
                    ></span>
                    <h3
                        class="text-xs font-bold text-slate-200 font-mono tracking-wider"
                    >
                        {{ currentAgent.title }}
                    </h3>
                </div>

                <button
                    @click.stop="isOpen = false"
                    class="text-slate-400 hover:text-white p-1 rounded-lg hover:bg-slate-800/50 transition-colors"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="2.5"
                        stroke="currentColor"
                        class="w-5 h-5"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M19.5 12h-15"
                        />
                    </svg>
                </button>
            </div>

            <div
                ref="chatContainer"
                class="flex-1 p-4 overflow-y-auto space-y-4 text-sm scroll-smooth"
            >
                <div
                    v-for="(msg, index) in messages"
                    :key="index"
                    :class="
                        msg.sender === 'user'
                            ? 'flex justify-end'
                            : 'flex justify-start'
                    "
                >
                    <div
                        :class="
                            msg.sender === 'user'
                                ? 'bg-cyan-600 text-white rounded-br-none'
                                : 'bg-[#0d1527]/80 border border-slate-800 text-slate-300 rounded-bl-none'
                        "
                        class="max-w-[85%] p-3 rounded-2xl tracking-wide leading-relaxed shadow-sm whitespace-pre-line"
                    >
                        {{ msg.text }}
                    </div>
                </div>

                <div v-if="isSending" class="flex justify-start">
                    <div
                        class="bg-[#0d1527]/50 text-slate-500 font-mono text-xs px-3 py-2 rounded-xl border border-slate-800/40 animate-pulse"
                    >
                        Procesando respuesta...
                    </div>
                </div>
            </div>

            <form
                @submit.prevent="sendMessage"
                class="p-3 bg-[#0d1527]/60 border-t border-slate-800/80 flex gap-2"
            >
                <input
                    v-model="userMessage"
                    type="text"
                    placeholder="Escribe tu consulta empresarial..."
                    class="flex-1 bg-[#090f1c] border-slate-800 focus:border-cyan-500 focus:ring-cyan-500/10 text-slate-200 placeholder-slate-600 rounded-xl text-sm"
                />
                <button
                    type="submit"
                    :disabled="isSending"
                    class="bg-cyan-600 hover:bg-cyan-500 text-white font-mono px-4 rounded-xl text-xs uppercase tracking-wider transition-all duration-200 disabled:opacity-40"
                >
                    Enviar
                </button>
            </form>
        </div>
    </div>
</template>
