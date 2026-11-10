<?php session_start();
$_SESSION['id'] = 1;

require_once __DIR__.'/../requires.php';

$pdo = new PDO("mysql:host={$_ENV['host']};dbname={$_ENV['dbname']}",$_ENV['user'],$_ENV['password']);

$url = $_SERVER["REQUEST_URI"];
$path = parse_url($url)["path"];

$restaurant = new ModelRestaurant($pdo);
$produits = new ModelProduits($pdo);
$filtres = new ModelFiltres($pdo);
$header = new Header();
$footer = new Footer();
$controllerHeader = new ControllerHeader($restaurant , $header);


switch($path){
    case $_ENV['accueil']:
        $view = new ViewAccueil();
        $controllerHeader->render();
        $controller = new ControllerAccueil($view , $footer);
        $controller->render();
        break;
    case  $_ENV['compte']:
        break;
    case  $_ENV['deconnection']:
        break;
    case  $_ENV['produits']:
        $view = new ViewProduits();
        $controllerHeader->render();
        $controller = new ControllerProduits($produits , $filtres , $view , $footer);
        $controller->render();
        break;
    default:
        http_response_code(404);
        echo ("<h1>Erreur 404 - Page introuvable</h1>");
}?>