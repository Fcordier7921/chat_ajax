<!--affichage de la barre de navigation et des champ de recherche-->
<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#home">Administration Immeuble</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse " id="navbarSupportedContent">
            <form class="form-inline my-2 my-lg-0 " name="reche_date" method="POST" action="/tasks/home">
                <div class="form-group">
                    <input class="form-control mr-sm-2" value="<?= isset($_SESSION["search"]["date"]) && !empty($_SESSION["search"]["date"]) ? $_SESSION["search"]["date"] : "" ?>" type="date" name="date" placeholder="Search" aria-label="Search">
                </div>
                <div class="form-group">
                    <?php $taskEtage = isset($_SESSION["search"]["etage"]) && !empty($_SESSION["search"]["etage"]) ? $_SESSION["search"]["etage"] : "" ?>
                    <?php include(ROOTVIEW . "includes/select_etages.php") ?>
                    <?php unset($taskEtage); ?>
                </div>
                <div class="form-group ml-5">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Chercher</button>
                </div>
            </form>
            <form class="form-inline my-2 ml-5 my-lg-0 " name="reche_mot" method="POST" action="/tasks/home">
                <div class="form-group">
                    <input class="form-control mr-sm-2" value="<?= isset($_SESSION["search"]) && !empty($_SESSION["search"]) ? $_SESSION["search"] : "" ?>" type="text" name="mot" placeholder="les inter " aria-label="Search">
                </div>
                <div class="form-group ml-5">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Chercher par inter</button>
                </div>
            </form>
        </div>
        <div class="d-flex justify-content-end">
            <a class="btn btn-secondary" href="/pages/logout">Déconnexion</a>
        </div>
    </nav>
</header>