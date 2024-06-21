<?php

if (!isset($_SESSION['user']) || $_SESSION['user']['role_id'] != 3) {
    echo "Il semblerait que vous n'ayez pas le droit d'être ici, merci de retourné sur la page d'accueil => <a href='/'>HomePage<a>";
    exit;
};

require "components/employeHead.php";
require "../app/FormControl/habitatCommentaire.php";
require "../app/FormControl/rapport.php";

$user = $_SESSION['user'];
?>

<div class="col-md-5 col-sm-12">
    <div class="d-flex justify-content-center">
        <a class="nav-link font-rounded pt-4 mx-5" href="/"><p class="text-green">Retour Accueil<p></a>
    </div>
</div>

<div class="col-md-7 col-sm-12">
    <div class="d-flex justify-content-end mx-3">
        <h1 class="text-center fs-4 text-green mt-3">Bienvenue, <?= $user['nom'] . " " . $user['prenom'] ?> (Veterinaire)</h1>
    </div>
</div>
</div>

<div class="bg-olive py-3">
    <div class="row justify-content-center mb-5">
        <h2 class="text-center fs-1 font-rounded text-green pt-3">Mettre un Rapport sur les animaux</h2>
    </div>
    <div class="p-0">
        <?php foreach ($habitats as $habitat) : ?>
            <a class="btn p-0 d-flex justify-content-center pb-0 mb-3" type="button" data-bs-toggle="collapse" data-bs-target="#<?= $habitat['id'] ?>" aria-expanded="true">
                <div class="card p-0 border-0 shadow-lg col-xxl-6 col-xl-8 col-lg-8 col-md-8 col-sm-8 m-0" style="max-width: 100%;">
                    <div class="row g-0">
                        <div class="col-md-4 p-0">
                            <img src="data:image/jpeg;base64,<?php echo base64_encode($habitatImages[$habitat['id']]) ?>" class="card-img-top img-fluid rounded" style="width: 100%; height:100%" alt="image représentant la <?= $habitat['nom'] ?>">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title font-rounded text-center pt-3 pb-3">
                                    <p class="text-green fs-3"><?= $habitat['nom'] ?></p>
                                </h5>
                                <p class="card-text font-roboto text-green fs-4 text-center mx-5">Principales Caractéristiques :<br><?= $habitat['description'] ?></p>
                                <div class="d-flex justify-content-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
            <div class="d-flex justify-content-center my-0 py-0 p-0 ">
                <div class="collapse col-xxl-6 col-xl-8 col-lg-8 col-md-8 col-sm-6 p-0" id="<?= $habitat['id'] ?>">
                    <div class="card card-body p-0 border border-0 rounded" style="background-color: #393424;">
                        <div class="d-flex justify-content-evenly row rounded py-3">
                            <?php foreach ($animaldetails as $animal) : ?>
                                <?php if ($habitat['id'] == $animal['habitat_id']) : ?>
                                    <div class="card p-0 col-md-3 col-sm-8 mt-2 mb-2 border border-0 shadow-lg mb-2 mx-1">
                                        <img src="data:image/jpeg;base64,<?php echo base64_encode($animal['image']) ?>" class="card-img-top" alt="image de <?= $animal['label'] ?>">
                                        <div class="card-body">
                                            <h5 class="card-title text-center"><?= $animal['prenom'] ?></h5>
                                            <p class="card-text text-center">santé : <?= $animal['etat'] ?></p>
                                            <div class="d-flex justify-content-center">
                                                <button type="button" class="btn btn-primary border border-0" style="background-color: #393424;" data-bs-toggle="modal" data-bs-target="#<?= $animal['prenom'] ?>">
                                                    Ecrire un rapport
                                                </button>
                                            </div>
                                            <div class="modal fade mb-3" id="<?= $animal['prenom'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="row d-flex justify-content-center">
                                                            <div class="modal-body">
                                                                <div class="card p-0 mt-2 mb-2 border border-0 shadow-lg">
                                                                    <div class="card-body">
                                                                        <h5 class="card-title text-center p-0"><?= $animal['prenom'] ?></h5>
                                                                        <p class="card-text text-center p-0">dernier repas : <?= $animal['nourriture'] ?></p>
                                                                        <p class="card-text text-center p-0">quantité : <?= $animal['quantity'] ?> gr</p>
                                                                        <form action="" method="post">
                                                                            <input type="hidden" name="prenom" value="<?= $animal['prenom'] ?>">
                                                                            <div class="mb-3">
                                                                                <label for="nom" class="form-label">état de l'animal</label>
                                                                                <input type="text" class="form-control" id="etat" name="etat" required>
                                                                            </div>
                                                                            <div class="mb-3">
                                                                                <label for="nom" class="form-label">nourriture recommandée</label>
                                                                                <input type="text" class="form-control" id="nourriture" name="nourriture" required>
                                                                            </div>
                                                                            <div class="mb-3">
                                                                                <label for="nom" class="form-label">quantité (gramme)</label>
                                                                                <input type="text" class="form-control" id="quantity" name="quantity" required>
                                                                            </div>
                                                                            <div class="mb-3">
                                                                                <label for="nom" class="form-label">commentaire sur l'animal</label>
                                                                                <input type="text" class="form-control" id="commentaire" name="commentaire" required>
                                                                            </div>
                                                                            <div class="container row justify-content-center p-3">
                                                                                <button type="submit" name="action" class="btn btn-success col-6" value="create_rapport">Enregistrer le rapport</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="container row justify-content-center p-3">
                                                                <button type="button" class="btn btn-secondary col-3" data-bs-dismiss="modal">fermé</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif ?>
                            <?php endforeach ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center mb-4 mt-2">
                <button type="button" class="btn btn-primary border border-0" style="background-color: #393424;" data-bs-toggle="modal" data-bs-target="#<?= $habitat['nom'] ?>">
                    Mettre un commentaire sur l'habitat
                </button>
                <div class="modal fade" id="<?= $habitat['nom'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="row d-flex justify-content-center">
                                <div class="modal-body">
                                    <div class="card p-0 mt-2 mb-2 border border-0 shadow-lg">
                                        <div class="card-body">
                                            <h5 class="card-title text-center p-0"><?= $habitat['nom'] ?></h5>
                                            <form action="" method="post">
                                                <input type="hidden" name="id" value="<?= htmlspecialchars($habitat['id']) ?>">
                                                <div class="mb-3">
                                                    <label for="nom" class="form-label">commentaire sur l'habitat</label>
                                                    <input type="text" class="form-control" id="commentaire" name="commentaire" value="<?= htmlspecialchars($habitat['commentaire_habitat']) ?>" required>
                                                </div>
                                                <div class="container row justify-content-center p-3">
                                                    <button type="submit" name="action" class="btn btn-success col-6" value="update_habitat_commentaire">Enregistrer les modifications</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="container row justify-content-center p-3">
                                    <button type="button" class="btn btn-secondary col-3" data-bs-dismiss="modal">fermé</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    </div>
</div>



<?php require "components/employeFoot.php"; ?>