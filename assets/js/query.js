//Définir les variables
let search = document.getElementById('search');
let button = document.getElementById('button');
let filter = document.getElementById('filter');

//Si la valeur de recherche a une modification on appel la fonction updateValue
search.addEventListener("input", updateValue);

//Si on appuie sur entrée on redirige vers la page avec la recherche
search.addEventListener("keydown", function(e) {
    if (e.key === "Enter") {
        let element = filter.options[filter.selectedIndex].value;
        window.location.href = "?search=" + e.target.value + "&filter=" + element;
    }
});

//Fonction updateValue
function updateValue(e) {
    button.href = "?search=" + e.target.value + "&filter=" + element;
};

//Fonction updateFilter qui change le filtre selon sa sélection en temps réel
function updateFilter() {
    let element = filter.options[filter.selectedIndex].value;
    button.href = "?search=" + search.value + "&filter=" + element;
}