<?php
// On vérifie la méthode utilisée
if($_SERVER['REQUEST_METHOD'] == 'GET'){
    // On est en GET
    // On vérifie si on a reçu un id
    if(isset($_GET['lastId'])){
        // On récupère l'id et on le nettoie
        $lastId = (int)strip_tags($_GET['lastId']);//strip_tags supprime les balise html et php

        // On initialise le filtre
        $filtre = ($lastId > 0) ? " WHERE `messages`.`id` > $lastId" : '';// requete sql active que quand laste et supérieur a 0 alors je fais le where si non je ne fais rien

        // On se connecte à la base
        require_once('../inc/bdd.php');

        // On écrit la requête
        $sql = 'SELECT `messages`.`id`, `messages`.`message`, `messages`.`created_at`, `users`.`pseudo`, `users`.`photo` FROM `messages` LEFT JOIN `users` ON `messages`.`users_id` = `users`.`id`'.$filtre.' ORDER BY `messages`.`id` DESC LIMIT 5;';

        // On exécute la requête
        $query = $db->query($sql);

        // On récupère les données
        $messages = $query->fetchAll();

        // On encode en JSON
        $messagesJson = json_encode($messages);

        // On envoie
        echo $messagesJson;
    }
}else{
    // Mauvaise méthode
    http_response_code(405);//Méthode de requête non autorisée.
    echo json_encode(['message' => 'Mauvaise méthode']);
}