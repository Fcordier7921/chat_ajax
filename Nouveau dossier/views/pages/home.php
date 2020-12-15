<!--affichage de l'in terface de login-->
<div class="container">

    <form action="/pages/login" class="form-signin" method="POST">
        <h1 class="h3 mb-3 font-weight-normal">Connectez-vous</h1>
        <label for="inputUsername" class="sr-only">Nom de l'utilisateur</label>
        <input type="username" value="admin" name="username" id="inputUsername" class="form-control" placeholder="nom de l'utilisateur" required="" autofocus="">
        <label for="inputPassword" class="sr-only">Mot de passe</label>
        <input type="password"   name="password" id="inputPassword" class="form-control" placeholder="Mot de passe" required="">
        <button class="btn btn-lg btn-primary btn-block" type="submit">Connection</button>
    </form>

</div>