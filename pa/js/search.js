async function getUser(){
    const res = await fetch("../get_user.php");
    const str = await res.text();
    const div = document.getElementById("user-list");
    div.innerHTML = str;
}
async function searchUser(){
    const input = document.getElementById('search-input');
    const recherche = input.value;
    const res = await fetch("../users.php?recherche=" + recherche);
    const str = await res.text();
    const div = document.getElementById("user-list");
    div.innerHTML = str;
}