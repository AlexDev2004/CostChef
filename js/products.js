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

    produitsTab.push(new Produits(nomProduit.value,categorieProduit.value,uniteProduit.value,prixProduit.value));

    popUp.classList.remove("articleOn");

    localStorage.setItem("productTab",JSON.stringify(produitsTab));
});

// ------------------------- Insertion des lignes de produits dans le tableau ----------------------


const tableau = document.querySelector("table");

produitsTab.map((produit)=>{
    const ligneProduit = document.createElement("tr");

    const nomProduit = document.createElement("td");
    nomProduit.innerHTML = produit.nom;
    const categorieProduit = document.createElement("td");
    categorieProduit.innerHTML = produit.categorie;
    const uniteProduit = document.createElement("td");
    uniteProduit.innerHTML = produit.unite;
    const prixProduit = document.createElement("td");
    prixProduit.innerHTML = produit.prix;

    ligneProduit.append(nomProduit,categorieProduit,uniteProduit,prixProduit);
    tableau.appendChild(ligneProduit);

    console.log(produit);
});