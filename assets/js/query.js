let search = document.getElementById('search');
let button = document.getElementById('button');
let filter = document.getElementById('filter');

search.addEventListener("input", updateValue);
search.addEventListener("keydown", function(e) {
    if (e.key === "Enter") {
        let element = filter.options[filter.selectedIndex].value;
        window.location.href = "?search=" + e.target.value + "&filter=" + element;
    }
});

function updateValue(e) {
    button.href = "?search=" + e.target.value + "&filter=" + element;
};

function updateFilter() {
    let element = filter.options[filter.selectedIndex].value;
    button.href = "?search=" + search.value + "&filter=" + element;
}