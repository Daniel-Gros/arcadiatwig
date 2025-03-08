document.addEventListener("DOMContentLoaded", function () {
    const animalLinks = document.querySelectorAll("[data-animal-id]");

    animalLinks.forEach(link => {
        link.addEventListener("click", function (event) {
            const animalId = link.dataset.animalId;

            if (!animalId) {
                console.error("Animal ID manquant !");
                return;
            }
            fetch(`/animal/crud/${animalId}/register-click`, {
                method: "POST",
                headers: {
                    "X-Requested-With": "XMLHttpRequest",
                    "Content-Type": "application/json"
                }
            })
            .then(response => response.json())
            .then(data => {
                console.log("Clic enregistré :", data.message);
                window.location.href = link.href;
            })
            .catch(error => {
                console.error("Erreur lors de l'enregistrement du clic :", error);
                                window.location.href = link.href;
            });
            event.preventDefault();
        });
    });
});
