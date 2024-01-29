//Définir les variables
let search = document.getElementById('search');
let button = document.getElementById('button');
let filter = document.getElementById('filter');
let element;

//Si la valeur de recherche a une modification on appel la fonction updateValue
search.addEventListener("input", updateValue);

//Si on appuie sur entrée on redirige vers la page avec la recherche
search.addEventListener("keydown", function(e) {
    if (e.key === "Enter") {
        //Définir la variable du filtre sélectionné
        element = filter.options[filter.selectedIndex].value;
        //Rediriger vers la page avec la recherche
        window.location.href = "?search=" + e.target.value + "&filter=" + element;
    }
});

//Fonction updateValue
function updateValue(e) {
    //Définir la variable du filtre sélectionné
    element = filter.options[filter.selectedIndex].value;
    //Remplacer l'attribut href du bouton par la nouvelle recherche
    button.href = "?search=" + e.target.value + "&filter=" + element;
};

//Fonction updateFilter qui change le filtre selon sa sélection en temps réel
function updateFilter() {
    //Définir la variable du filtre sélectionné
    element = filter.options[filter.selectedIndex].value;
    //Remplacer l'attribut href du bouton par la nouvelle recherche
    button.href = "?search=" + search.value + "&filter=" + element;
}