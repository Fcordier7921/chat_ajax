<?php
class PagesController extends Controller //controleur de redirection vers la page d'affichage des intervention ou de connection
{
    function index($args)//si j'ai un variable de ssaision de page home contenent le résulta final
    {

        if ($this->isLogin()) {
            $this->redirect("tasks", "home");
        }

        return $this->render("home", ["titrepage" => "Connection"]);
    }

    function login()//si je n'ai pas de mot de passe je retoure sur la page de connection
    {
        $formDatas = $_POST;//je récupére les info passer dans l'url
        $this->loadModel("UserModel");
        $isLogin = $this->user->is_login($formDatas["username"], $formDatas["password"]);

        if ($isLogin) {
            $this->redirect("tasks", "homeAdmin");
        }
        $this->redirect();
        exit();
    }

    function logout()//del lasession
    {
        $this->delSession("user");
        $this->redirect();
        exit();
    }
}