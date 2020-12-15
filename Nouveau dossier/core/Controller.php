<?php

abstract class Controller//class controleur principal
{
    public function loadModel(string $model)//redirection vers les models spécifique et instentiation
    {
        require_once(ROOT . DS . 'models' . DS . $model . '.php');
        $entity = strtolower(str_replace("Model", "", $model));//strtolower renvoi une chaine minuscure; str_replacerenplace tout les ocurence par une chaine
        $this->$entity = new $model();
    }

    public function isLogin()// fonction si il y a un login
    {
        return isset($_SESSION["user"]) && !empty($_SESSION["user"]);
    }

    public function delSession($index)//fonction pour suprimer la variable de séssion
    {
        unset($_SESSION[$index]);
    }

    public function redirect(string $nomCtrl = "", string $nomAction = "")//redirige vers un page
    {
        header("Location: /" . $nomCtrl . ($nomAction != "" ? "/" . $nomAction : ""));
        exit();
    }

    public function render(string $fichier, array $data = [])//fonction  redirection ver plusieur page
    {
        extract($data);
        $dossierView = strtolower(str_replace("Controller", "", get_class($this)));//get_class retourne un nom de la classe objet
        require_once(ROOT  . DS . 'views' . DS .  "header" . '.php');
        require_once(ROOT  . DS . 'views' . DS .  $dossierView  . DS . $fichier . '.php');
        require_once(ROOT  . DS . 'views' . DS .  "footer" . '.php');
    }
}
