import ContactFormHandler from "mailto.js";

document.addEventListener('DOMContentLoaded', () => {
    new ContactFormHandler('#contact-form', 'mailtoButton', 'employeearcadiafictif@outlook.fr');
});