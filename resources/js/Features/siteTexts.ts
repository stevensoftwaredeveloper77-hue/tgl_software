import { ref } from "vue";

interface ServiceCard {
    id: number;
    title: string;
    description: string;
    icon: string;
    features: string[];
    color: "blue" | "cyan" | "green" | "purple" | "orange" | "slate";
    popular?: boolean;
}

export const services = ref<ServiceCard[]>([
    {
        id: 1,
        title: "Desarrollo de Software a Medida",
        description:
            "Creamos soluciones digitales personalizadas que se adaptan perfectamente a las necesidades de tu negocio.",
        icon: "code",
        color: "blue",
        popular: true,
        features: [
            "Aplicaciones web escalables",
            "Sistemas de gestion empresarial",
            "E-commerce y marketplaces",
            "Integracion con APIs externas",
        ],
    },
    {
        id: 2,
        title: "Consultoría Tecnológica",
        description:
            "Te asesoramos en la toma de decisiones tecnológicas para optimizar tus procesos y maximizar resultados.",
        icon: "lightbulb",
        color: "slate",
        features: [
            "Analisis de requerimientos",
            "Arquitectura de software",
            "Optimización de procesos",
            "Estrategia digital",
        ],
    },
    {
        id: 3,
        title: "Soporte y Mantenimiento",
        description:
            "Mantemos tus sistemas funcionando de manera optima con soporte tecnico continuo y actualizaciones.",
        icon: "support",
        color: "green",
        features: [
            "Soporte tecnico 24/7",
            "Actualizaciones de seguridad",
            "Monitoreo de rendimiento",
            "Resolucion de incidencias",
        ],
    },
    {
        id: 4,
        title: "Agentes Virtuales con IA",
        description:
            "Desarrollamos asistentes inteligentes y chatbots que automatizan la atencion al cliente y procesos internos.",
        icon: "robot",
        color: "blue",
        popular: true,
        features: [
            "Chatbots personalizados",
            "Asistentes de voz",
            "Automatizacion de tareas",
            "Integracion con OpenAI/Claude",
        ],
    },
    {
        id: 5,
        title: "Aplicaciones Moviles",
        description:
            "Diseñamos y desarrollamos aplicaciones moviles nativas e hibridas para iOS y Android.",
        icon: "mobile",
        color: "green",
        features: [
            "Apps nativas iOS/Android",
            "Desarrollo hibrido",
            "UI/UX mobile-first",
            "Publicacion en stores",
        ],
    },
    {
        id: 6,
        title: "Integraciones y APIs",
        description:
            "Conectamos tus sistemas con servicios externos y creamos APIs robustas para tu ecosistema digital.",
        icon: "database",
        color: "slate",
        features: [
            "Desarrollo de APIs REST",
            "Integracion de pagos",
            "Conexion con ERPs/CRMs",
            "Migracion de datos",
        ],
    },
]);

export const stats = [
    { value: "25+", label: "Proyectos Completados" },
    { value: "100%", label: "Clientes Satisfechos" },
    { value: "7+", label: "Años de Experiencia" },
    { value: "24/7", label: "Soporte Disponible" },
];

export const technologies = [
    {
        name: "JavaScript",
        icon: "javascript",
        category: "languages",
        color: "text-amber-500",
        border: "hover:border-amber-400/50",
        bg: "hover:bg-amber-50",
    },
    {
        name: "TypeScript",
        icon: "typescript",
        category: "languages",
        color: "text-blue-600",
        border: "hover:border-blue-500/50",
        bg: "hover:bg-blue-50",
    },
    {
        name: "PHP",
        icon: "php",
        category: "languages",
        color: "text-indigo-600",
        border: "hover:border-indigo-500/50",
        bg: "hover:bg-indigo-50",
    },
    {
        name: "Python",
        icon: "python",
        category: "languages",
        color: "text-sky-600",
        border: "hover:border-sky-500/50",
        bg: "hover:bg-sky-50",
    },
    {
        name: "Java",
        icon: "java",
        category: "languages",
        color: "text-orange-600",
        border: "hover:border-orange-500/50",
        bg: "hover:bg-orange-50",
    },

    {
        name: "Laravel",
        icon: "laravel",
        category: "frameworks",
        color: "text-red-600",
        border: "hover:border-red-500/50",
        bg: "hover:bg-red-50",
    },
    {
        name: "Vue.js",
        icon: "vue",
        category: "frameworks",
        color: "text-emerald-600",
        border: "hover:border-emerald-500/50",
        bg: "hover:bg-emerald-50",
    },
    {
        name: "React",
        icon: "react",
        category: "frameworks",
        color: "text-cyan-500",
        border: "hover:border-cyan-500/50",
        bg: "hover:bg-cyan-50",
    },
    {
        name: "Django",
        icon: "django",
        category: "frameworks",
        color: "text-emerald-800",
        border: "hover:border-emerald-700/50",
        bg: "hover:bg-emerald-50/30",
    },
    {
        name: "Node.js",
        icon: "node",
        category: "frameworks",
        color: "text-green-600",
        border: "hover:border-green-500/50",
        bg: "hover:bg-green-50",
    },
    {
        name: "Tailwind CSS",
        icon: "tailwind",
        category: "frameworks",
        color: "text-sky-400",
        border: "hover:border-sky-400/50",
        bg: "hover:bg-sky-50/50",
    },
    {
        name: "OpenAI",
        icon: "openai",
        category: "frameworks",
        color: "text-teal-600",
        border: "hover:border-teal-500/50",
        bg: "hover:bg-teal-50",
    },

    {
        name: "React Native",
        icon: "reactnative",
        category: "mobile",
        color: "text-cyan-500",
        border: "hover:border-cyan-400/50",
        bg: "hover:bg-cyan-50/40",
    },
    {
        name: "Ionic",
        icon: "ionic",
        category: "mobile",
        color: "text-blue-500",
        border: "hover:border-blue-400/50",
        bg: "hover:bg-blue-50/40",
    },

    {
        name: "MySQL",
        icon: "mysql",
        category: "databases-rel",
        color: "text-cyan-700",
        border: "hover:border-cyan-600/50",
        bg: "hover:bg-cyan-50",
    },
    {
        name: "PostgreSQL",
        icon: "postgresql",
        category: "databases-rel",
        color: "text-blue-700",
        border: "hover:border-blue-600/50",
        bg: "hover:bg-blue-50",
    },

    {
        name: "MongoDB",
        icon: "mongodb",
        category: "databases-norel",
        color: "text-green-700",
        border: "hover:border-green-600/50",
        bg: "hover:bg-green-50",
    },
    {
        name: "Redis",
        icon: "redis",
        category: "databases-norel",
        color: "text-red-700",
        border: "hover:border-red-600/50",
        bg: "hover:bg-red-50",
    },

    {
        name: "AWS",
        icon: "aws",
        category: "cloud-devops",
        color: "text-orange-500",
        border: "hover:border-orange-400/50",
        bg: "hover:bg-orange-50/40",
    },
    {
        name: "Cloud Computing",
        icon: "cloud",
        category: "cloud-devops",
        color: "text-blue-400",
        border: "hover:border-blue-400/50",
        bg: "hover:bg-blue-50/30",
    }
];

export const appointmentTypes = [
    {
        id: 1,
        name: "Videollamada",
        description: "Reunión virtual por Google Meet o Zoom",
        duration: "45 min",
        icon: "video",
    },
    {
        id: 2,
        name: "Llamada Telefónica",
        description: "Conversación directa por teléfono",
        duration: "30 min",
        icon: "phone",
    },
    {
        id: 3,
        name: "Chat en Vivo",
        description: "Mensajería instantánea en tiempo real",
        duration: "20 min",
        icon: "chat",
    },
    {
        id: 4,
        name: "Presencial",
        description: "Reunión cara a cara en oficina",
        duration: "60 min",
        icon: "building",
    },

];

export const navLinksTgl = [
    { id: "home", label: "Inicio" },
    { id: "services_section", label: "Servicios" },
    { id: "company_information", label: "Conocenos" },
    { id: "appointment_section", label: "Agendar Consulta" },
    { id: "agendly", label: "Agendly" },
];

export const navLinksProfile = [
    { id: "profile_information", label: "Sobre Mí" },
    { id: "services_section", label: "Portafolio de Servicios" },
    { id: "technologies_stack", label: "Stack Tecnológico" },
    { id: "projects", label: "Mis Proyectos" },
    { id: "appointment_section", label: "Agendar Consulta" },
];

import { ref } from 'vue';

interface Project {
    id: number;
    title: string;
    category: string;
    description: string;
    status: 'LIVE' | 'PROXIMAMENTE';
    url?: string;
    color: 'green' | 'blue' | 'purple' | 'orange' | 'cyan';
    tags: string[];
}

export const projects = ref<Project>([
    {
        id: 1,
        title: "Fundación Luz de Colombia",
        category: "Plataforma Institucional & Salud Mental",
        description: "Solución web a la medida enfocada en la transformación social y clínica. Integra módulos informativos optimizados para valoración psicológica profunda, diagnóstico integral y flujos de psicoterapia estratégica para la reintegración comunitaria.",
        status: "LIVE",
        url: "https://www.fundacionluzdecolombia.com.co/",
        color: "blue",
        tags: ["Vue.js", "Laravel", "Tailwind CSS", "HostGator", "SSL Setup"]
    },
    {
        id: 2,
        title: "Servicios Psicológicos Especializados",
        category: "Módulo de Gestión de Pacientes & Psicoterapia",
        description: "Subplataforma especializada para el equipo clínico de la fundación. Diseñada para estructurar entrevistas clínicas profundas, gestionar pruebas psicométricas validadas, emitir informes de diagnóstico automatizados y dar seguimiento continuo a programas de rehabilitación.",
        status: "LIVE",
        url: "https://www.fundacionluzdecolombia.com.co/servicios-psicologicos",
        color: "cyan",
        tags: ["React", "PHP API", "MySQL", "UI/UX Clinical", "Secure Data"]
    },
    {
        id: 3,
        title: "El Rancho de Hojaldras",
        category: "Plataforma de Feedback & Sistema de Calificaciones",
        description: "Aplicación web interactiva desarrollada para la captura de opiniones y analítica de satisfacción en tiempo real para el sector gastronómico. Cuenta con una arquitectura ligera de alta fidelidad optimizada para la interacción en dispositivos móviles.",
        status: "LIVE",
        url: "http://www.ranchodehojaldras.com.co",
        color: "green",
        tags: ["Vue.js", "Mobile-First", "Tailwind CSS", "Database Sync"]
    },
    {
        id: 4,
        title: "Agendly",
        category: "SaaS Enterprise - Gestión de Citas & Turnos",
        description: "Software as a Service enfocado en la automatización de agendas comerciales y reserva de servicios empresariales. Desarrollado con una arquitectura multi-inquilino altamente reactiva con paneles analíticos y pasarelas de control.",
        status: "PROXIMAMENTE",
        color: "purple",
        tags: ["Laravel SaaS", "Vue.js", "MySQL Relational", "AI Agents"]
    },
    {
        id: 5,
        title: "TGL - E-commerce Network",
        category: "Plataforma de Comercio Electrónico & Dropshipping",
        description: "Ecosistema digital avanzado de ventas online estructurado para modelos de distribución masiva y automatización de pasarelas de dropshipping. Cuenta con integraciones robustas de inventario asíncrono y optimización SEO.",
        status: "PROXIMAMENTE",
        color: "orange",
        tags: ["React Native Mobile", "Python Django", "MongoDB NoSQL", "APIs REST"]
    },
    {
        id: 6,
        title: "Electors App",
        category: "Plataforma Administrativa & Control Electoral",
        description: "Estructura de software de alta seguridad diseñada para la gestión, auditoría y control de bases de datos de votantes en procesos electorales masivos. Enfocada en la integridad del dato, reportes dinámicos y concurrencia crítica.",
        status: "PROXIMAMENTE",
        color: "cyan",
        tags: ["Python Django", "PostgreSQL", "Data Analytics", "Security Protocol"]
    }
]);
