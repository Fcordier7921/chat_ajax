<?php
class InterventionModel extends Model
{

    public function __construct()//on ce connecte a la base de donné est l'on récupére la table intervention
    {
        $this->table = "intervention";
        $this->getConnection();
    }
}
