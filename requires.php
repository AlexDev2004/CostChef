<?php
require_once __DIR__.'/env.php';
require_once __DIR__.'/env-routes.php';

require_once __DIR__.'/app/core/Model.php';
require_once __DIR__.'/app/core/View.php';
require_once __DIR__.'/app/core/Controller.php';

require_once __DIR__.'/app/model/ModelProduits.php';
require_once __DIR__.'/app/model/ModelRestaurant.php';
require_once __DIR__.'/app/model/ModelFiltres.php';

require_once __DIR__.'/app/view/includes/Header.php';
require_once __DIR__.'/app/view/includes/Footer.php';

require_once __DIR__.'/app/view/ViewAccueil.php';
require_once __DIR__.'/app/view/ViewCompte.php';
require_once __DIR__.'/app/view/ViewProduits.php';

require_once __DIR__.'/app/utils/deconnection.php';

require_once __DIR__.'/app/controller/ControllerHeader.php';
require_once __DIR__.'/app/controller/ControllerAccueil.php';
require_once __DIR__.'/app/controller/ControllerCompte.php';
require_once __DIR__.'/app/controller/ControllerProduits.php';

?>