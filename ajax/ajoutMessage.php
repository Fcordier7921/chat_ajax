<?php
// Ce fichier reçoit les données en json et enregistre le message
session_start();

// On vérifie la méthode qu'on passe bien en post
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    // On vérifie si l'utilisateur est connecté
    if(isset($_SESSION['user']['id'])){
        // L'utilisateur est connecté
        // On récupère le message
        $donneesJson = file_get_contents('php://input');//le donne ne son pas comme les input mais dans le body, etdans le dossier cacher input

        // On convertit les données en objet PHP
        $donnees = json_decode($donneesJson);

        // On vérifie si on a un message
        if(isset($donnees->message) && !empty($donnees->message)){//si dans les donné on a un message et si il n'ai pas vide
            // On a un message
            // On le stocke
            // On se connecte a la base de donne
            require_once('../inc/bdd.php');

            // On écrit la requête pour envoyer a la base des donné
            $sql = 'INSERT INTO `messages`(`message`, `users_id`) VALUES (:message, :user);';

            // On prépare la requête
            $query = $db->prepare($sql);

            // On injecte les valeurs
            $query->bindValue(':message', strip_tags($donnees->message), PDO::PARAM_STR);//strip_tags suprime les balise html et php des donné
            $query->bindValue(':user', $_SESSION['user']['id'], PDO::PARAM_INT);//je les met les valeur de l'id de la seccion

            // On exécute en vérifiant si ça fonctionne
            if($query->execute()){
                http_response_code(201);//Requête traitée avec succès et création d’un document.
                echo json_encode(['message' => 'Enregistrement effectué']);
            }else{
                http_response_code(400);//La syntaxe de la requête est erronée.
                echo json_encode(['message' => 'Une erreur est survenue']);
            }
        }else{
            // Pas de message
            http_response_code(400);//La syntaxe de la requête est erronée.
            echo json_encode(['message' => 'Le message est vide']);
        }
    }else{
        // Non connecté
        http_response_code(400);//La syntaxe de la requête est erronée.
        echo json_encode(['message' => 'Vous devez vous connecter']);
    }
}else{
    // Mauvaise méthode si je ne suis pas sur la méthode post
    http_response_code(405);//405 est le méthode de requéte non autoriser
    echo json_encode(['message' => 'Mauvaise méthode']);//envoyer le message en json
}