<?php class Header extends View{
    private array $restaurant = [];

    public function setRestaurant(array $restaurant):self{
        $this->restaurant[] = $restaurant;
        return $this;
    }

    public function display():void{ ?>
        <!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <link rel="icon" type="images/png" href="public/assets/img/logo-noir.png" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="assets/css/var.css">
            <link rel="stylesheet" href="assets/css/style.css">
            <link rel="stylesheet" href="assets/css/produits.css">
            <link rel="stylesheet" href="assets/css/accueil.css">
            <title>CostChef</title>
        </head>
        <body>  
        <header>
            <a class="logoCostChef" href="<?= $_ENV['accueil']?>"><img class="logoCostChef" src="public/assets/img/logo-blanc-2.png" alt="Logo CostChef"></a>
            <a class="logoRond" href="<?= $_ENV['compte']?>"><img class="logoResto" src="<?= $this->restaurant[0]['logo_restaurant'] ?>" alt="Logo restaurant"></a>
            <h2><?= $this->restaurant[0]['nom_restaurant'] ?></h2>
            <svg xmlns="http://www.w3.org/2000/svg" width="52" height="52" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-lock-icon lucide-lock"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
        </header>
    <?php }
}?>
