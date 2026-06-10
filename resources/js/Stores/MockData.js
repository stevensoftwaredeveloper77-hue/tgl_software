import { reactive, computed } from "vue";

const state = reactive({
    currentUser: null,

    businesses: [
        {
            id: 1,
            name: "Barberia El Clasico",
            owner: "Carlos Mendez",
            category: "Barberia",
            address: "Calle 45 #12-30, Centro",
            phone: "+57 300 123 4567",
            description: "Cortes clasicos y modernos con la mejor atencion.",
            rating: 4.8,
            reviewCount: 124,
            image: null,
            slotDuration: 30,
            availability: {
                lunes: { active: true, start: "08:00", end: "18:00" },
                martes: { active: true, start: "08:00", end: "18:00" },
                miercoles: { active: true, start: "08:00", end: "18:00" },
                jueves: { active: true, start: "08:00", end: "18:00" },
                viernes: { active: true, start: "08:00", end: "17:00" },
                sabado: { active: true, start: "09:00", end: "14:00" },
                domingo: { active: false, start: "09:00", end: "13:00" },
            },
            blockedDates: ["2026-02-15"],
        },
        {
            id: 2,
            name: "Clinica Dental Sonrisa",
            owner: "Dra. Laura Rios",
            category: "Salud",
            address: "Av. Principal #8-15, Norte",
            phone: "+57 301 987 6543",
            description: "Odontologia general, estetica y ortodoncia.",
            rating: 4.9,
            reviewCount: 89,
            image: null,
            slotDuration: 60,
            availability: {
                lunes: { active: true, start: "07:00", end: "17:00" },
                martes: { active: true, start: "07:00", end: "17:00" },
                miercoles: { active: true, start: "07:00", end: "17:00" },
                jueves: { active: true, start: "07:00", end: "17:00" },
                viernes: { active: true, start: "07:00", end: "16:00" },
                sabado: { active: false, start: "08:00", end: "12:00" },
                domingo: { active: false, start: "08:00", end: "12:00" },
            },
            blockedDates: [],
        },
        {
            id: 3,
            name: "Spa Relajarte",
            owner: "Ana Gutierrez",
            category: "Belleza",
            address: "Carrera 10 #25-40, Sur",
            phone: "+57 302 555 1234",
            description: "Masajes, tratamientos faciales y corporales.",
            rating: 4.7,
            reviewCount: 56,
            image: null,
            slotDuration: 60,
            availability: {
                lunes: { active: true, start: "09:00", end: "19:00" },
                martes: { active: true, start: "09:00", end: "19:00" },
                miercoles: { active: true, start: "09:00", end: "19:00" },
                jueves: { active: true, start: "09:00", end: "19:00" },
                viernes: { active: true, start: "09:00", end: "19:00" },
                sabado: { active: true, start: "10:00", end: "16:00" },
                domingo: { active: false, start: "10:00", end: "14:00" },
            },
            blockedDates: [],
        },
        {
            id: 4,
            name: "Taller Mecanico RapidAuto",
            owner: "Jorge Ramirez",
            category: "Automotriz",
            address: "Diagonal 15 #3-22, Industrial",
            phone: "+57 303 444 7890",
            description:
                "Servicio mecanico rapido y confiable para tu vehiculo.",
            rating: 4.5,
            reviewCount: 37,
            image: null,
            slotDuration: 60,
            availability: {
                lunes: { active: true, start: "07:00", end: "17:00" },
                martes: { active: true, start: "07:00", end: "17:00" },
                miercoles: { active: true, start: "07:00", end: "17:00" },
                jueves: { active: true, start: "07:00", end: "17:00" },
                viernes: { active: true, start: "07:00", end: "17:00" },
                sabado: { active: true, start: "08:00", end: "13:00" },
                domingo: { active: false, start: "08:00", end: "12:00" },
            },
            blockedDates: [],
        },
        {
            id: 5,
            name: "Consultorio Psicologico Mente Sana",
            owner: "Dr. Felipe Torres",
            category: "Salud",
            address: "Calle 72 #15-08, Chapinero",
            phone: "+57 304 222 3456",
            description: "Terapia individual, de pareja y familiar.",
            rating: 4.9,
            reviewCount: 63,
            image: null,
            slotDuration: 60,
            availability: {
                lunes: { active: true, start: "08:00", end: "18:00" },
                martes: { active: true, start: "08:00", end: "18:00" },
                miercoles: { active: true, start: "08:00", end: "18:00" },
                jueves: { active: true, start: "08:00", end: "18:00" },
                viernes: { active: true, start: "08:00", end: "16:00" },
                sabado: { active: false, start: "09:00", end: "13:00" },
                domingo: { active: false, start: "09:00", end: "13:00" },
            },
            blockedDates: [],
        },
    ],

    appointments: [
        {
            id: 1,
            businessId: 1,
            clientName: "Maria Lopez",
            clientEmail: "maria@correo.com",
            date: "2026-02-12",
            time: "10:00",
            status: "confirmada",
            service: "Corte de cabello",
        },
        {
            id: 2,
            businessId: 1,
            clientName: "Juan Perez",
            clientEmail: "juan@correo.com",
            date: "2026-02-12",
            time: "11:00",
            status: "pendiente",
            service: "Barba y corte",
        },
        {
            id: 3,
            businessId: 1,
            clientName: "Sofia Garcia",
            clientEmail: "sofia@correo.com",
            date: "2026-02-13",
            time: "09:00",
            status: "confirmada",
            service: "Corte de cabello",
        },
        {
            id: 4,
            businessId: 2,
            clientName: "Maria Lopez",
            clientEmail: "maria@correo.com",
            date: "2026-02-14",
            time: "10:00",
            status: "pendiente",
            service: "Limpieza dental",
        },
        {
            id: 5,
            businessId: 3,
            clientName: "Maria Lopez",
            clientEmail: "maria@correo.com",
            date: "2026-02-16",
            time: "15:00",
            status: "confirmada",
            service: "Masaje relajante",
        },
        {
            id: 6,
            businessId: 1,
            clientName: "Pedro Ruiz",
            clientEmail: "pedro@correo.com",
            date: "2026-02-11",
            time: "14:00",
            status: "completada",
            service: "Corte clasico",
        },
        {
            id: 7,
            businessId: 1,
            clientName: "Ana Torres",
            clientEmail: "ana@correo.com",
            date: "2026-02-10",
            time: "16:00",
            status: "cancelada",
            service: "Barba",
        },
    ],

    categories: ["Todas", "Barberia", "Salud", "Belleza", "Automotriz"],
});

export function useStore() {
    const loginAsClient = () => {
        state.currentUser = {
            id: 100,
            name: "Maria Lopez",
            email: "maria@correo.com",
            role: "cliente",
        };
    };

    const loginAsBusiness = () => {
        state.currentUser = {
            id: 1,
            name: "Carlos Mendez",
            email: "carlos@barberia.com",
            role: "negocio",
            businessId: 1,
        };
    };

    const logout = () => {
        state.currentUser = null;
    };

    const getBusinessById = (id) => {
        return state.businesses.find((b) => b.id === Number(id));
    };

    const getAppointmentsForBusiness = (businessId) => {
        return state.appointments.filter(
            (a) => a.businessId === Number(businessId),
        );
    };

    const getAppointmentsForClient = (email) => {
        return state.appointments.filter((a) => a.clientEmail === email);
    };

    const updateAppointmentStatus = (appointmentId, newStatus) => {
        const apt = state.appointments.find((a) => a.id === appointmentId);
        if (apt) apt.status = newStatus;
    };

    const bookAppointment = (data) => {
        const newId = Math.max(...state.appointments.map((a) => a.id)) + 1;
        state.appointments.push({
            id: newId,
            ...data,
            status: "pendiente",
        });
        return newId;
    };

    const updateBusinessAvailability = (businessId, availability) => {
        const biz = state.businesses.find((b) => b.id === Number(businessId));
        if (biz) biz.availability = { ...availability };
    };

    const updateBusinessSlotDuration = (businessId, duration) => {
        const biz = state.businesses.find((b) => b.id === Number(businessId));
        if (biz) biz.slotDuration = duration;
    };

    // const getAvailableSlots = (businessId, dateStr) => {
    //   const biz = state.businesses.find((b) => b.id === Number(businessId))
    //   if (!biz) return []

    //   if (biz.blockedDates.includes(dateStr)) return []

    //   const date = new Date(dateStr + 'T12:00:00')
    //   const dayNames = ['domingo', 'lunes', 'martes', 'miercoles', 'jueves', 'viernes', 'sabado']
    //   const dayName = dayNames[date.getDay()]
    //   const dayConfig = biz.availability[dayName]

    //   if (!dayConfig || !dayConfig.active) return []

    //   const [startH, startM] = dayConfig.start.split(':').map(Number)
    //   const [endH, endM] = dayConfig.end.split(':').map(Number)
    //   const startMinutes = startH * 60 + startM
    //   const endMinutes = endH * 60 + endM
    //   const duration = biz.slotDuration

    //   const slots = []
    //   for (let m = startMinutes; m + duration <= endMinutes; m += duration) {
    //     const h = Math.floor(m / 60)
    //     const min = m % 60
    //     const timeStr = `${String(h).padStart(2, '0')}:${String(min).padStart(2, '0')}`
    //     slots.push(timeStr)
    //   }

    //   const bookedTimes = state.appointments
    //     .filter((a) => a.businessId === Number(businessId) && a.date === dateStr && (a.status === 'pendiente' || a.status === 'confirmada'))
    //     .map((a) => a.time)

    //   return slots.filter((s) => !bookedTimes.includes(s))
    // }

    const getAvailableSlots = (settings, dateStr, bookedAppointments = []) => {
        const defaultSettings = {
            duration: 30,
            availability: {
                lunes: { active: true, start: "08:00", end: "18:00" },
                martes: { active: true, start: "08:00", end: "18:00" },
                miercoles: { active: true, start: "08:00", end: "18:00" },
                jueves: { active: true, start: "08:00", end: "18:00" },
                viernes: { active: true, start: "08:00", end: "18:00" },
                sabado: { active: false, start: "09:00", end: "14:00" },
                domingo: { active: false, start: "09:00", end: "14:00" },
            },
        };

        const currentSettings = settings || defaultSettings;
        const duration =
            Number(currentSettings.duration) || defaultSettings.duration;
        const availability =
            currentSettings.availability || defaultSettings.availability;

        const date = new Date(dateStr + "T12:00:00");
        const dayNames = [
            "domingo",
            "lunes",
            "martes",
            "miercoles",
            "jueves",
            "viernes",
            "sabado",
        ];
        const dayName = dayNames[date.getDay()];

        const dayConfig = availability[dayName];

        if (!dayConfig || !dayConfig.active) return [];

        const [startH, startM] = dayConfig.start.split(":").map(Number);
        const [endH, endM] = dayConfig.end.split(":").map(Number);

        const startMinutes = startH * 60 + startM;
        const endMinutes = endH * 60 + endM;

        const slots = [];
        for (let m = startMinutes; m + duration <= endMinutes; m += duration) {
            const h = Math.floor(m / 60);
            const min = m % 60;
            const timeStr = `${String(h).padStart(2, "0")}:${String(min).padStart(2, "0")}`;
            slots.push(timeStr);
        }

        const bookedTimes = bookedAppointments
            .filter(
                (a) =>
                    a.date === dateStr &&
                    (a.status === "pendiente" || a.status === "confirmada"),
            )
            .map((a) => a.time);

        return slots.filter((s) => !bookedTimes.includes(s));
    };

    return {
        state,
        loginAsClient,
        loginAsBusiness,
        logout,
        getBusinessById,
        getAppointmentsForBusiness,
        getAppointmentsForClient,
        updateAppointmentStatus,
        bookAppointment,
        updateBusinessAvailability,
        updateBusinessSlotDuration,
        getAvailableSlots,
    };
}
