var search = document.getElementById('search');
var button = document.getElementById('button');

search.addEventListener("input", updateValue);
search.addEventListener("keydown", function(e) {
    if (e.key === "Enter") {
        window.location.href = "?search=" + e.target.value;
    }
});

function updateValue(e) {
    button.href = "?search=" + e.target.value;
};