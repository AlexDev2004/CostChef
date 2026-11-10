<?php class ModelFiltres extends Model{
    public function selectTypeProduit(){
        try{
            $request=$this->pdo->prepare("SELECT t.id_type_produit , t.nom_type_produit FROM type_produit t");
            $request->execute();
            return $request->fetchAll(PDO::FETCH_ASSOC);
        }catch(EXCEPTION $error){die($error->getMessage());}
    }
    public function selectUniteProduit(){
        try{
            $request=$this->pdo->prepare("SELECT t.id_unite_produit , t.nom_unite_produit FROM unite_produit t");
            $request->execute();
            return $request->fetchAll(PDO::FETCH_ASSOC);
        }catch(EXCEPTION $error){die($error->getMessage());}
    }
}?>