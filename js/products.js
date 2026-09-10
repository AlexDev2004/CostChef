// -------------------- Apparition du PopUp ---------------------------------------------
const popUp = document.querySelector("article");
const btnAjoutProduit = document.getElementById("boutonAjoutProduit");

btnAjoutProduit.addEventListener("click",()=>{
    popUp.classList.add("articleOn");
});

// ------------------- Récupération des données de création ---------------------------
class Produits {
    constructor(nom,categorie,unite,prix) {
        this.nom = nom;
        this.categorie = categorie;
        this.unite = unite;
        this.prix = prix;
    }
}


let produitsTab = [];
const result = JSON.parse(localStorage.getItem("productTab"));
if(result != null){
    produitsTab = result;
}

const ajoutProduit = document.getElementById("créationDeProduit");
ajoutProduit.addEventListener("submit",()=>{
    const nomProduit = document.getElementById("nomProduitText");
    const prixProduit = document.getElementById("prixU");
    const categorieProduit = document.getElementById("categorie");
    const uniteProduit = document.getElementById("unite");

    produitsTab.push(new Produits(nomProduit.value,categorieProduit.value,uniteProduit.value,Number(prixProduit.value)));

    popUp.classList.remove("articleOn");

    localStorage.setItem("productTab",JSON.stringify(produitsTab));
});

// ----------------------------------- Sélection du filtre de recherche ----------------------------

const filtreRecherche = document.getElementById("filterProductTypeSearch");
filtreRecherche.value = localStorage.getItem("filtreRecherche");

filtreRecherche.addEventListener("change",()=>{
    localStorage.setItem("filtreRecherche",filtreRecherche.value);
    location.reload();
});

// ------------------------- Insertion des lignes de produits dans le tableau ----------------------
const tableau = document.querySelector("table");
// --------------------------------- Tris du tableau ---------------------------
if(filtreRecherche.value == "alphabetique"){
    produitsTab.sort((a, b) =>
        a.nom.localeCompare(b.nom, undefined, {
            sensitivity: "base"
        })
    );
}
if(filtreRecherche.value == "catégorie"){
    produitsTab.sort((a, b) =>
        a.categorie.localeCompare(b.categorie, undefined, {
            sensitivity: "base"
        })
    );
}
if(filtreRecherche.value == "unite"){
    produitsTab.sort((a, b) =>
        a.unite.localeCompare(b.unite, undefined, {
            sensitivity: "base"
        })
    );
}
if(filtreRecherche.value == "prix"){
    produitsTab.sort((a, b) => b.prix - a.prix);
}
localStorage.setItem("productTab",JSON.stringify(produitsTab));
// ------------------------------------------------------------------------------
produitsTab.map((produit)=>{
    const ligneProduit = document.createElement("tr");

    const nomProduit = document.createElement("td");
    nomProduit.innerText = produit.nom;
    const categorieProduit = document.createElement("td");
    categorieProduit.innerText = produit.categorie;
    const uniteProduit = document.createElement("td");
    uniteProduit.innerText = produit.unite;
    const prixProduit = document.createElement("td");
    prixProduit.innerText = produit.prix;
    const colonneAction = document.createElement("td");
    colonneAction.innerHTML = `<svg class="pen" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" 
    stroke="var(--cButton)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-pen">
    <path d="M21.174 6.812a1 1 0 0 0-3.986-3.987L3.842 16.174a2 2 0 0 0-.5.83l-1.321 4.352a.5.5 0 0 0 .623.622l4.353-1.32a2 2 0 0 0 .83-.497z"/></svg>
    <svg class="trash" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="var(--red1)" stroke-width="2" 
    stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash"><path d="M10 11v6"/><path d="M14 11v6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/>
    <path d="M3 6h18"/><path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>`
    ligneProduit.append(nomProduit,categorieProduit,uniteProduit,prixProduit,colonneAction);
    tableau.appendChild(ligneProduit);
});

// ------------------------ Modification et suppession ---------------------------------

const pen = document.querySelectorAll(".pen");
const penTab = Array.from(pen);
penTab.map((pen,i)=>{
    pen.addEventListener("click",()=>{
        popUp.classList.add("articleOn");

        const ligneSelect = document.querySelectorAll("tr")[i+1];

        const colName = ligneSelect.querySelectorAll("td")[0];
        const colCategorie = ligneSelect.querySelectorAll("td")[1];
        const colUnite = ligneSelect.querySelectorAll("td")[2];
        const colPrice = ligneSelect.querySelectorAll("td")[3];

        const nomProduit = document.getElementById("nomProduitText");
        nomProduit.value = colName.innerText;
        const categorieProduit = document.getElementById("categorie");
        categorieProduit.value = colCategorie.innerText;
        const uniteProduit = document.getElementById("unite");
        uniteProduit.value = colUnite.innerText;
        const prixProduit = document.getElementById("prixU");
        prixProduit.value = colPrice.innerText;

        produitsTab.splice(i,1);
    });
});

const trash = document.querySelectorAll(".trash");
const trashTab = Array.from(trash);
const overlaySuppr = document.querySelector(".overlaySuppr");

let ligneSelectSuppr;

trashTab.map((trash,i)=>{
    trash.addEventListener("click",()=>{
    overlaySuppr.classList.add("overlaySupprClicked");
    ligneSelectSuppr = i;
    });
});

const boutonOui = overlaySuppr.querySelectorAll("button")[0];
const boutonNon = overlaySuppr.querySelectorAll("button")[1];

boutonOui.addEventListener("click",()=>{
    produitsTab.splice(ligneSelectSuppr,1);
    localStorage.setItem("productTab",JSON.stringify(produitsTab));
});

