<?php class ModelRestaurant extends Model{
    private int $id;

    public function __construct(PDO $pdo){
        parent::__construct($pdo);
        $this->id = $_SESSION['id'] ?? null;
    }

    public function getUser(){
        if(!isset($_SESSION['id'])) return 'Aucun compte connecté !';
        $id = $_SESSION['id'];

        try{
            $request=$this->pdo->prepare("SELECT r.nom_restaurant , r.logo_restaurant , r.email_restaurant , r.telephone_restaurant , r.code_restaurant , r.mdp_restaurant , a.rue_adresse , a.numero_adresse , a.code_postal_adresse , a.id_adresse , v.nom_ville , v.id_ville , p.nom_pays , p.id_pays 
                FROM restaurant r JOIN adresse a ON a.id_adresse = r.id_adresse JOIN ville v ON v.id_ville = a.id_ville JOIN pays p ON p.id_pays = v.id_pays
                WHERE r.id_restaurant = ?");
            $request->bindParam(1,$id,PDO::PARAM_INT);
            $request->execute();
            return $request->fetch(PDO::FETCH_ASSOC);
        }catch(EXCEPTION $error){die($error->getMessage());}
    }
}?> 