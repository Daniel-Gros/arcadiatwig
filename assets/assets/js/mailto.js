export default class ContactFormHandler {
    constructor(formSelector, submitButtonSelector, recipientEmail) {
        this.form = document.querySelector(formSelector);
        this.submitButton = document.querySelector(submitButtonSelector);
        this.recipientEmail = recipientEmail;

        if (this.form && this.submitButton) {
            this.initialize();
        } else {
            console.error('formulaire ou bouton indisponible');
        }
    }

    initialize() {
        this.submitButton.addEventListener('click', (event) => this.handleSubmit(event));
    }

    handleSubmit(event) {
        event.preventDefault(); 

        const formData = new FormData(this.form);


        const nom = formData.get('nom');
        const email = formData.get('email');
        const message = formData.get('message');

        if (!nom || !email || !message) {
            alert('Tous les champs sont requis !');
            return;
        }

        const mailtoLink = `mailto:${this.recipientEmail}?subject=Contact%20Form&body=
            Nom: ${encodeURIComponent(nom)}%0A
            Email: ${encodeURIComponent(email)}%0A
            Message: ${encodeURIComponent(message)}`;


        window.location.href = mailtoLink;
    }
}
