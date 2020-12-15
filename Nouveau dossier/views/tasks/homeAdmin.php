<!--affichage de l'adminitration des interventions-->
<?php include(ROOTVIEW . "nav.php") ?>
<div>
    <h1 class="border border-dark p-4 rounded-pill bg-white mt-3">Gestion des intreventions immeuble 2 route de Montaigü à Lons le Saunier</h1>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ajout d'une intervention</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form name="ajoutcinter" method="POST" action="/tasks/add_task">
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="date" placeholder="date" name="date" class="form-control" /><br />
                            <input type="text my-5" placeholder="Type d'intervention" name="type" class="form-control" /><br />
                            <?php include(ROOTVIEW . "includes/select_etages.php") ?>
                            <br />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary">Ajouter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="container py-5" id="CRUD_cinter">

        <button type="button" class="mb-5 btn btn-primary" data-toggle="modal" data-target="#exampleModal">
            Ajouter une t&acirc;che
        </button>

        <table class="table table-hover table-sm">
            <thead class="bg_entete_tab text-center">
                <tr class="bg-primary">
                    <th scope="col" style="width:5%">numéro d'intervention</th>
                    <th scope="col" style="width:15%">date</th>
                    <th scope="col" style="width:40%">type d'intervention</th>
                    <th scope="col" style="width:20%">étage</th>
                    <th scope="col" style="width:20%">&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tasks as $keyTask => $task) : ?>
                    <tr class="bg-white">
                        <td><?= $task["id"] ?></td>
                        <td><?= $task["date_intervention"] ?></td>
                        <td><?= $task["type_intervention"] ?></td>
                        <td><?= (is_null($task["etage_intervention"]) ? "tous" : $task["etage_intervention"]) ?></td>
                        <td>
                            <div class="row">
                                <button type="button" class="col-6 btn btn-primary" data-toggle="modal" data-target="#modifTask<?= $task["id"] ?>">
                                    Modifier
                                </button>
                                <button type="button" class="col-6  btn btn-danger" data-toggle="modal" data-target="#delTasks<?= $task["id"] ?>">
                                    Supprimer
                                </button>
                            </div>

                            <div class="modal fade" id="modifTask<?= $task["id"] ?>" tabindex="-1" aria-labelledby="modifTask<?= $task["id"] ?>Label" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Modification de la tache <?= $task["type_intervention"] ?></h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form name="ajoutcinter" method="POST" action="/tasks/update_task">
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <input type="hidden" name="id" value="<?= $task["id"] ?>" />
                                                    <input type="date" placeholder="date" value="<?= $task["date_intervention"] ?>" name="date" class="form-control"></input><br />
                                                    <input type="text my-5" placeholder="Type d'intervention" value="<?= $task["type_intervention"] ?>" name="type" class="form-control"></input><br />
                                                    <?php
                                                    $taskEtage = $task["etage_intervention"];
                                                    ?>
                                                    <?php include(ROOTVIEW . "includes/select_etages.php") ?>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                                <button type="submit" class="btn btn-primary">Modifier</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>



                            <div class="modal fade" id="delTasks<?= $task["id"] ?>" tabindex="-1" aria-labelledby="delTasks<?= $task["id"] ?>Label" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">supprimer la tache "<?= $task["type_intervention"] ?>"</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form name="ajoutcinter" method="POST" action="/tasks/delete_task">
                                            <p>Voulez vous supprimer l'intervation</p>
                                            <div class="modal-footer">
                                                <input type="hidden" name="id" value="<?= $task["id"] ?>" />

                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Non</button>
                                                <button type="submit" class="btn btn-primary">Oui</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>



                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>