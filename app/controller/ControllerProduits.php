<?php class ControllerProduits extends Controller{
    public function __construct(ModelProduits $model , ModelFiltres $filtres , ViewProduits $produits , Footer $footer){
        $this->addModel('produits' , $model);
        $this->addModel('filtres' , $filtres);
        $this->addView('produits' , $produits);
        $this->addView('footer' , $footer);
    }

    public function render():void{
        $this->add();
        $this->delete();
        $this->modif();
        // ----------- Selectionner le filtre de recherche --------------------
        $filtre = $_GET['filterProductTypeSearch'] ?? 'alphabetique';
        switch($filtre){
            case 'alphabetique':
                $data = $this->models['produits']->selectAllByName();
                break;
            case 'catégorie':
                $data = $this->models['produits']->selectAllByType();
                break;
            case 'prix':
                $data = $this->models['produits']->selectAllByPrice();
                break;
            case 'unite':
                $data = $this->models['produits']->selectAllByUnite();
                break;
            default:
                $data = 'Filtre inconnu !';
        }
        if(gettype($data) !== 'array') return;

        $types = $this->models['filtres']->selectTypeProduit();
        $unites = $this->models['filtres']->selectUniteProduit();

        $this->views['footer']->setAriane(['accueil','produits']);
        $this->views['produits']->setListe($data);
        $this->views['produits']->setTypes($types);
        $this->views['produits']->setUnites($unites);


        $this->views['produits']->display();
        $this->views['footer']->display();
    }

    public function add(){
        if(isset($_POST['submitNewProduct'])){
            $this->models['produits']->add();
        }
    }

    public function delete(){
        if(isset($_POST['supprimerProduit'])){
            $id = $_GET['id'];
            $this->models['produits']->remove($id);
        }
    }

    public function modif(){
        if(isset($_POST['submitModifProduct'])){
            $id = $_GET['id'];
            $this->models['produits']->modify($id);
        }
    }
}?>