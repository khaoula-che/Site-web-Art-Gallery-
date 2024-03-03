async function getCards(){
    const res = await fetch("../get_oeuvre.php");
    const str = await res.text();
    const div = document.getElementById("card_list");
    div.innerHTML = str;
}
async function searchCards(){
    const input = document.getElementById('search_input');
    const nom = input.value;
    const res = await fetch("../galerie.php?nom=" + nom);
    const str = await res.text();
    const div = document.getElementById("card_list");
    div.innerHTML = str;
}