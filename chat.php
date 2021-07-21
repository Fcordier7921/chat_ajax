<?php
session_start();
include_once('inc/header.php');
if(isset($_SESSION['user']) && !empty($_SESSION['user'])){
    // Ici, l'utilisateur est connecté
    ?>
    <div class="container-fluid">
    <h1 class="hello" >Bonjour <?= $_SESSION['user']['pseudo'] ?> </h1>
    <a class="btn btn-danger float-right shadow rounded deco" href="deconnexion.php">Déconnexion</a>
    <div id="registration"></div>
    
</div>
<?php
}else{
    // Ici l'utilisateur n'est pas connecté
    header('Location: index.php')
    ?>
<?php
}
?>
<div class="col-12 my-1">
    <div class="p-2" id="discussion">
    </div>
</div>
<div class="col-12 saisie">
    <div class="input-group">
        <input type="text" class="form-control" id="texte" placeholder="Entrez votre texte">
        <div class="input-group-append">
            <span class="input-group-text" id="valid"><i class="la la-check"></i></span>
        </div>
    </div>
</div>
<?php
include_once('inc/footer.php');
