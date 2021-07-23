<?php
session_start();

if(isset($_POST) && !empty($_POST)){
    // On vérifie que tous les champs sont existants et remplis
    if(isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['pseudo']) && !empty($_POST['pseudo']) && isset($_POST['pass']) && !empty($_POST['pass'])){
        // Ici le formulaire est complet
        // On récupère les valeurs des champs
        $pseudo = strip_tags($_POST['pseudo']);
        $email = strip_tags($_POST['email']);

        // On récupère le mot de passe et on le chiffre
        $pass = password_hash($_POST['pass'], PASSWORD_BCRYPT);
        $photo=strip_tags($_POST['photo']);
        // On se connecte à la base
        require_once('inc/bdd.php');

        // On écrit la requête
        $sql = 'INSERT INTO `users`(`email`, `password`, `pseudo`, `photo`) VALUES (:email, :password, :pseudo, :photo);';

        // On prépare la requête
        $query = $db->prepare($sql);

        // On injecte les valeurs
        $query->bindValue(':email', $email, PDO::PARAM_STR);
        $query->bindValue(':password', $pass, PDO::PARAM_STR);
        $query->bindValue(':pseudo', $pseudo, PDO::PARAM_STR);
        $query->bindValue(':photo', $photo, PDO::PARAM_STR);
        // On exécute la requête
        $query->execute();

        // On redirige vers la page d'accueil
        header('Location: chat.php');

    }else{
        echo 'Tous les champs sont obligatoires';
    }
}
if(isset($_POST['anul'])){//anulation de l'inscription
    header('Location: chat.php');
}
include_once('inc/header.php');
?>
<div class="col-12 my-1 "><!--afichage du dossier d'inscription-->
    <h1>Inscription</h1>
    <form method="post">
        <div class="form-group">
            <label for="email">E-mail :</label>
            <input class="form-control" type="email" id="email" name="email">
        </div>
        <div class="form-group">
            <label for="pseudo">Pseudo :</label>
            <input class="form-control" type="text" id="pseudo" name="pseudo">
        </div>
        <div class="form-group">
            <label for="pass">Mot de passe :</label>
            <input class="form-control" type="password" id="pass" name="pass">
        </div>
        <div>
        <label for="photo">photo Pseudo:</label>
        <select class="form-control" type="text" placeholder="Entrez le numéro de la photo" id="photo" name="photo">
            <option value="">--Veuillez choisir une option--</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
            <option value="9">9</option>
            <option value="10">10</option>
            <option value="11">11</option>
            <option value="12">12</option>
            <option value="13">13</option>
            <option value="14">14</option>
            <option value="15">15</option>
            <option value="16">16</option>
            <option value="17">17</option>
            <option value="18">18</option>
            <option value="19">19</option>
            <option value="20">20</option>
            <option value="21">21</option>            
        </select>
        </div>
        <button class="btn btn-primary my-5">M'inscrire</button>
        <button class="btn btn-primary my-5" name="anul" value="anul">Anulation</button>
    </form>
    <div class="container-fluid">
        <p>Pour choisir la photo de profil indiqué le numéro de la photo dans le champ photo </p>
        
            <div id="lulu" class="row"></div>        
    </div>
</div>
<?php
include_once('inc/footer.php');
