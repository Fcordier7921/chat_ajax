<?php
session_start();//damarage d'un session pour utiliser les variable de session
//la page indes.php et le rooteur du sit on y trouve le chemin pour 

define("DS", DIRECTORY_SEPARATOR);//permet de remplacer le /
define("ROOT", dirname(__FILE__));//permet de  ne pas avoir a récrire la redirection ex ../user/model/index.php cela donne ROOT. index.php
define("ROOTVIEW", ROOT . DS . "views" . DS);//permet de rediriger ver la views

//recuperation des scripts standard
require_once('core/Model.php');//rajoute les fonction du fichier model , cest le model qui comporte les modeles les plus utiliser partout
require_once('core/Controller.php');//rajoute le controleur avec fonction les plus utiliser

//recuperation des parametres pour router vers le bon controller
$controller = isset($_GET['controller']) && !empty($_GET['controller']) ?  ucfirst($_GET['controller']) : 'Pages';//ma variable controleur verifi qu'ell est défini et qu'elle ne soit pas null et l'on mait un majuscule a la premier lettre
$action = isset($_GET['action']) && !empty($_GET['action']) ? $_GET['action'] : 'index';//dans action je vrérifi qu'il y un action de fait et qu'elle ne soit pas vide et ?->et qu'il a bien été transmit a l'url de mon index
$args = isset($_GET['args']) ? $_GET['args'] : [];//agrs je lui deffinie qu'il y ai une action et qu'elle ne soit pas vide et cela donne un tableau

require_once(ROOT . DS . 'controllers' . DS . $controller . 'Controller.php');//rajoute les fonction de tous le fichier dans le dossier controleurs
$classe = $controller . 'Controller';//je met dans une variable les info de la seconde
$ctrl = new $classe();//je cré lobjet $classe

if (method_exists($ctrl, $action)) {//si ma métode existe dans ctrl et action  je passe a al suit 
  $ctrl->$action($args);
} else {//si c'est pas le cas je le renvoi sur la page erreur 404
  http_response_code(404);
  header('location: /404.html');
}
