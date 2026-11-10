<?php class ModelProduits extends Model{
    public function selectAllByName(){
        try{
            $idRestaurant = $_SESSION['id'];
            $request=$this->pdo->prepare("SELECT p.id_produit , p.nom_produit , p.prix_produit , p.stock_produit , u.id_unite_produit , u.nom_unite_produit , t.id_type_produit , t.nom_type_produit 
                FROM produit p JOIN unite_produit u ON u.id_unite_produit = p.id_unite_produit JOIN type_produit t ON t.id_type_produit = p.id_type_produit
                WHERE p.id_restaurant = ? ORDER BY p.nom_produit");
            $request->bindParam(1,$idRestaurant,PDO::PARAM_INT);
            $request->execute();
            return $request->fetchAll(PDO::FETCH_ASSOC);
        }catch(EXCEPTION $error){die($error->getMessage());}
    }
    public function selectAllByType(){
        try{
            $idRestaurant = $_SESSION['id'];
            $request=$this->pdo->prepare("SELECT p.id_produit , p.nom_produit , p.prix_produit , p.stock_produit , u.id_unite_produit , u.nom_unite_produit , t.id_type_produit , t.nom_type_produit 
                FROM produit p JOIN unite_produit u ON u.id_unite_produit = p.id_unite_produit JOIN type_produit t ON t.id_type_produit = p.id_type_produit
                WHERE p.id_restaurant = ? ORDER BY t.nom_type_produit");
            $request->bindParam(1,$idRestaurant,PDO::PARAM_INT);
            $request->execute();
            return $request->fetchAll(PDO::FETCH_ASSOC);
        }catch(EXCEPTION $error){die($error->getMessage());}
    }
    public function selectAllByUnite(){
        try{
            $idRestaurant = $_SESSION['id'];
            $request=$this->pdo->prepare("SELECT p.id_produit , p.nom_produit , p.prix_produit , p.stock_produit , u.id_unite_produit , u.nom_unite_produit , t.id_type_produit , t.nom_type_produit 
                FROM produit p JOIN unite_produit u ON u.id_unite_produit = p.id_unite_produit JOIN type_produit t ON t.id_type_produit = p.id_type_produit
                WHERE p.id_restaurant = ? ORDER BY u.nom_unite_produit");
            $request->bindParam(1,$idRestaurant,PDO::PARAM_INT);
            $request->execute();
            return $request->fetchAll(PDO::FETCH_ASSOC);
        }catch(EXCEPTION $error){die($error->getMessage());}
    }
    public function selectAllByPrice(){
        try{
            $idRestaurant = $_SESSION['id'];
            $request=$this->pdo->prepare("SELECT p.id_produit , p.nom_produit , p.prix_produit , p.stock_produit , u.id_unite_produit , u.nom_unite_produit , t.id_type_produit , t.nom_type_produit 
                FROM produit p JOIN unite_produit u ON u.id_unite_produit = p.id_unite_produit JOIN type_produit t ON t.id_type_produit = p.id_type_produit
                WHERE p.id_restaurant = ? ORDER BY p.prix_produit");
            $request->bindParam(1,$idRestaurant,PDO::PARAM_INT);
            $request->execute();
            return $request->fetchAll(PDO::FETCH_ASSOC);
        }catch(EXCEPTION $error){die($error->getMessage());}
    }

    public function selectOneById(int $idProduit){
        try{
            $idRestaurant = $_SESSION['id'];
            $request=$this->pdo->prepare("SELECT p.nom_produit , p.prix_produit , p.stock_produit , u.id_unite_produit , u.nom_unite_produit , t.id_type_produit , t.nom_type_produit 
                FROM produit p JOIN unite_produit u ON u.id_unite_produit = p.id_unite_produit JOIN type_produit t ON t.id_type_produit = p.id_type_produit
                WHERE p.id_produit = ? AND p.id_restaurant = ?");
            $request->bindParam(1,$idProduit,PDO::PARAM_INT);
            $request->bindParam(2,$idRestaurant,PDO::PARAM_INT);
            $request->execute();
            return $request->fetch(PDO::FETCH_ASSOC);
        }catch(EXCEPTION $error){die($error->getMessage());}
    }
    public function selectOneByName(string $name){
        try{
            $idRestaurant = $_SESSION['id'];
            $request=$this->pdo->prepare("SELECT p.nom_produit , p.prix_produit , p.stock_produit , u.id_unite_produit , u.nom_unite_produit , t.id_type_produit , t.nom_type_produit 
                FROM produit p JOIN unite_produit u ON u.id_unite_produit = p.id_unite_produit JOIN type_produit t ON t.id_type_produit = p.id_type_produit
                WHERE p.nom_produit = ? AND p.id_restaurant = ?");
            $request->bindParam(1,$name,PDO::PARAM_STR);
            $request->bindParam(2,$idRestaurant,PDO::PARAM_INT);
            $request->execute();
            return $request->fetch(PDO::FETCH_ASSOC);
        }catch(EXCEPTION $error){die($error->getMessage());}
    }

    public function add(){
        try{
            $idRestaurant = $_SESSION['id'];

            $nom = trim($_POST['nomProduit']);
            $type = trim($_POST['categorie']);
            $unite = trim($_POST['unite']);
            $prix = trim($_POST['prixU']);
            
            if(!empty($this->selectOneByName($nom))) return 'Ce produit exists déjà !';
            if($nom === '' || $type === '' || $unite === '' || $prix === '') return 'Veuillez remplir tous les champs !';

            if(!filter_var($type, FILTER_VALIDATE_INT) || !filter_var($unite, FILTER_VALIDATE_INT) || !is_numeric($prix) || ($prix <= 0)) return 'Champ(s) invalide(s) !';
            $request=$this->pdo->prepare("INSERT INTO produit (nom_produit , prix_produit , id_type_produit , id_unite_produit , id_restaurant) VALUE (?,?,?,?,?)");
            $request->bindParam(1,$nom,PDO::PARAM_STR);
            $request->bindParam(2,$prix,PDO::PARAM_STR);
            $request->bindParam(3,$type,PDO::PARAM_INT);
            $request->bindParam(4,$unite,PDO::PARAM_INT);
            $request->bindParam(5,$idRestaurant,PDO::PARAM_INT);
            $request->execute();

            $_POST['nomProduit'] = '';
            return "Nouveau produit ajouté : $nom !";
        }catch(EXCEPTION $error){die($error->getMessage());}
    }

    public function modify(int $id){
        try{
            if(empty($this->selectOneById($id))) return 'Produit introuvable !';

            $nom = trim($_POST['nomProduit']);
            $type = trim($_POST['categorie']);
            $unite = trim($_POST['unite']);
            $prix = trim($_POST['prixU']);

            if($nom === '' || $type === '' || $unite === '' || $prix === '') return 'Veuillez remplir tous les champs !';
            if(!filter_var($type, FILTER_VALIDATE_INT) || !filter_var($unite, FILTER_VALIDATE_INT) || !is_numeric($prix) || ($prix <= 0)) return 'Champ(s) invalide(s) !';

            $request=$this->pdo->prepare("UPDATE produit SET nom_produit = ? , prix_produit = ? , id_type_produit = ? , id_unite_produit = ? WHERE id_produit = ?");
            $request->bindParam(1,$nom,PDO::PARAM_STR);
            $request->bindParam(2,$prix,PDO::PARAM_STR);
            $request->bindParam(3,$type,PDO::PARAM_INT);
            $request->bindParam(4,$unite,PDO::PARAM_INT);
            $request->bindParam(5,$id,PDO::PARAM_INT);
            $request->execute();

            return "Produit modifié : $nom !";
        }catch(EXCEPTION $error){die($error->getMessage());}
    }

    public function remove(int $id){
        try{
            if(empty($this->selectOneById($id))) return 'Produit introuvable !';

            $request=$this->pdo->prepare("DELETE FROM produit WHERE id_produit = ?");
            $request->bindParam(1,$id,PDO::PARAM_INT);
            $request->execute();

            return "Produit supprimé !";
        }catch(EXCEPTION $error){die($error->getMessage());}
    }
}?>