<?php class ViewProduits extends View{
    private array $liste = [];
    private array $types = [];
    private array $unites = [];

    public function setListe(array $liste):self{
        $this->liste = $liste;
        return $this;
    }   
    public function setTypes(array $types):self{
        $this->types = $types;
        return $this;
    }   
    public function setUnites(array $unites):self{
        $this->unites = $unites;
        return $this;
    }   

    public function display(){ ?>
        <main id="produits">
            <div id="zoneTitre">
                <div class="iconTitre"><svg xmlns="http://www.w3.org/2000/svg" width="85" height="85" viewBox="0 0 24 24" fill="none" stroke="var(--cSecond)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-package-icon lucide-package"><path d="M11 21.73a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73z"/><path d="M12 22V12"/><polyline points="3.29 7 12 12 20.71 7"/><path d="m7.5 4.27 9 5.15"/></svg></div>                 
                <div>
                    <h2>Produits</h2>
                    <p>Gérez votre catalogue de produits, catégories et prix d’achat.</p>
                </div>
            </div>

            <!-- --------------------Section supérieure avec recherche de produits + bouton Ajouter un produit------------------- -->
            <section>
                <div id="search">
                    <h3>Liste des produits</h3>
                    <form method="GET" action="#" id="searchForm">
                        <select class="secondaryButton" name="filterProductTypeSearch" id="filterProductTypeSearch" onchange="this.form.submit()">
                            <option value="alphabetique">Alphabétique</option>
                            <option value="catégorie">Catégorie</option>
                            <option value="prix">Prix</option>
                            <option value="unite">Unités</option>
                        </select>
                    </form>
                </div>
                <button class="primaryButton" id="boutonAjoutProduit">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="var(--cBackground)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus-icon lucide-plus"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
                    Ajouter un produit
                </button>
            </section>

            <!-- ----------------------------------------------------Overlay ------------------------------------------------------>

            <article class="new">
                <form id="créationDeProduit" method="post" action="#">
                    <div class="nomProduit"><label for="nomProduitText">Nom du produit</label><a class="aMini" href="<?php $_ENV['produits']?>">Annuler</a></div>
                    <input type="text" name="nomProduit" id="nomProduitText" placeholder="Ex. Carotte, Huile d'olive...">
                    <div class="row"><div class="col"><label for="categorie">Catégorie</label><select name="categorie" id="categorie"><?php
                        foreach($this->types as $categorie) echo('<option value="'.$categorie['id_type_produit'].'">'.$categorie['nom_type_produit'].'</option>');
                    ?></select></div>
                    <div class="col"><label for="unite">Unité</label><select name="unite" id="unite"><?php
                        foreach($this->unites as $unite) echo('<option value="'.$unite['id_unite_produit'].'">'.$unite['nom_unite_produit'].'</option>');
                    ?></select></div></div>
                    <div class="row"><div class="col"><label for="prixU">Prix unitaire</label><input type="number" step="0.01" id="prixU" name="prixU"></div>
                    <button class="primaryButton" type="submit" name="submitNewProduct">Confirmer</button></div>
                </form>
            </article>
            <!-- ----------------------------------------------------Overlay modif------------------------------------------------------>

            <article class="modif">
                <form id="modifProduit" method="post" data-url="<?= $_ENV['produits'] ?>" action="#">
                    <div class="nomProduit"><label for="nomProduitText">Nom du produit</label><a class="aMini" href="<?php $_ENV['produits']?>">Annuler</a></div>
                    <input type="text" name="nomProduit" id="nomProduitText" placeholder="Ex. Carotte, Huile d'olive...">
                    <div class="row"><div class="col"><label for="categorie">Catégorie</label><select name="categorie" id="categorie"><?php
                        foreach($this->types as $categorie) echo('<option value="'.$categorie['id_type_produit'].'">'.$categorie['nom_type_produit'].'</option>');
                    ?></select></div>
                    <div class="col"><label for="unite">Unité</label><select name="unite" id="unite"><?php
                        foreach($this->unites as $unite) echo('<option value="'.$unite['id_unite_produit'].'">'.$unite['nom_unite_produit'].'</option>');
                    ?></select></div></div>
                    <div class="row"><div class="col"><label for="prixU">Prix unitaire</label><input type="number" step="0.01" id="prixU" name="prixU"></div>
                    <button class="primaryButton" type="submit" name="submitModifProduct">Confirmer</button></div>
                </form>
            </article>
            <!-- ----------------------------------------------------Overlay de suppression ---------------------------------------->

            <div class="overlaySuppr">
                <form id="supprimerProduit" method="post" data-url="<?= $_ENV['produits'] ?>" action="">
                    <h3>Voulez vous vraiment supprimer ce produit ?</h3>
                    <div><button type="submit" name="supprimerProduit">Oui</button>
                    <button type="submit">Non</button></div>
                </form>
            </div>

            <!-- ----------------------------------------------Tableau de produits---------------------------------------------- -->

            <form id="tableau" method="post"><div id="tableContainer"><table>
                <tr> <!-- Ligne de titres des éléments du tableau -->
                    <th>Ingrédients</th>
                    <th>Catégorie</th>
                    <th>Unité</th>
                    <th>Prix unitaire (€)</th>
                    <th></th>
                </tr>
            
                <?php
                foreach($this->liste as $produit){
                    echo('<tr>');
                        echo('<td>'.$produit['nom_produit'].'</td>');
                        echo('<td>'.$produit['nom_type_produit'].'</td>');
                        echo('<td>'.$produit['nom_unite_produit'].'</td>');
                        echo('<td>'.$produit['prix_produit'].'</td>');
                        $idProduit = $produit['id_produit'];
                        echo("<td><svg class='pen' data-id='$idProduit' xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' 
                        stroke='var(--cButton)' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='lucide lucide-pen'>
                        <path d='M21.174 6.812a1 1 0 0 0-3.986-3.987L3.842 16.174a2 2 0 0 0-.5.83l-1.321 4.352a.5.5 0 0 0 .623.622l4.353-1.32a2 2 0 0 0 .83-.497z'/></svg>
                        <svg class='trash' data-id='$idProduit' xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='var(--red1)' stroke-width='2' 
                        stroke-linecap='round' stroke-linejoin='round' class='lucide lucide-trash'><path d='M10 11v6'/><path d='M14 11v6'/><path d='M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6'/>
                        <path d='M3 6h18'/><path d='M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2'/></svg></td>");
                    echo('</tr>');
                }
                ?>
            </table></div></form>
        </main>
        <script src="public/assets/js/produits.js"></script>
    <?php }
}?>