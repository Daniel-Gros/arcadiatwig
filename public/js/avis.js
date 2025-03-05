document.addEventListener("DOMContentLoaded", function () {
    const loadAvisButton = document.getElementById("load-avis-form");
    
    if (loadAvisButton) {
        loadAvisButton.addEventListener("click", function () {
            fetch("/avis/form", {
                headers: { "X-Requested-With": "XMLHttpRequest" }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error("Erreur lors du chargement du formulaire.");
                }
                return response.text();
            })
            .then(html => {
                document.getElementById("avis-container").innerHTML = html;
            })
            .catch(error => console.error(error));
        });
    }
});
