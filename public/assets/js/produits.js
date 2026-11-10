// -------------------- Apparition du PopUp ---------------------------------------------
 const popUp = document.querySelector(".new");
 const btnAjoutProduit = document.getElementById("boutonAjoutProduit");


 btnAjoutProduit.addEventListener("click",()=>{
     popUp.classList.add("articleOn");
 });

 // -------------------- Modification -------------------------
 const popUpModif = document.querySelector(".modif");
 const formModif = document.querySelector("#modifProduit");
 const pens = document.querySelectorAll(".pen");
 penTab = Array.from(pens),
 penTab.map((pen)=>{
     pen.addEventListener("click",()=>{
         popUpModif.classList.add("articleOn");
         const id = pen.dataset.id;
         const lien = formModif.dataset.url;

         formModif.setAttribute("action", `${lien}?id=${id}`);

     });
 });

 // -------------------- Suppression -------------------------
 const popUpSuppr = document.querySelector(".overlaySuppr");
 const formSuppr = document.querySelector("#supprimerProduit");
 const trashs = document.querySelectorAll(".trash");
 trashTab = Array.from(trashs),
 trashTab.map((trash)=>{
     trash.addEventListener("click",()=>{
         popUpSuppr.classList.add("overlaySupprClicked");
         const id = trash.dataset.id;
         const lien = formModif.dataset.url;

         formSuppr.setAttribute("action", `${lien}?id=${id}`);

     });
});