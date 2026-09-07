const popUp = document.querySelector("article");
const btnAjoutProduit = document.getElementById("boutonAjoutProduit");

btnAjoutProduit.addEventListener("click",()=>{
    popUp.classList.add("articleOn");
});