export const scrollToServicesSection = () => {
    const element = document.getElementById("services_section");
    if (element) {
        element.scrollIntoView({ behavior: "smooth", block: "start" });
    }
};

export const scrollToAppointmentSection = () => {
    const element = document.getElementById("appointment_section");
    if (element) {
        element.scrollIntoView({ behavior: "smooth", block: "start" });
    }
};

export const navigateToSection = (section) => {
    const element = document.getElementById(section);
    if (element) {
        element.scrollIntoView({ behavior: "smooth", block: "start" });
    }
};
