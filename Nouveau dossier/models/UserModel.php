<?php
class UserModel extends Model
{

    public function __construct()//on recupére la connection a la base de donné et on pren la table user
    {
        $this->table = "user";
        $this->getConnection();
    }

    public function is_login($username, $password)//on vérifie la connection avec les mot de passe et non d'utilisateur soi identique a ce qu'on a rentré
    {

        $sql = "SELECT * FROM " . $this->table . " WHERE name_user='" . $username . "' AND password_user= '" . $password . "'";
        $query = $this->_connexion->prepare($sql);
        $query->execute();
        $user = $query->fetch();

        if (isset($user) && !empty($user)) {
            $_SESSION["user"] = $user;
            unset($_SESSION["user"]["password_user"]);
            return true;
        }
        return false;
    }
    
}
