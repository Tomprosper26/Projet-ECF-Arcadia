<?php
require "../app/FormControl/avisUpdate.php";
require "../app/FormControl/servicesUpdate.php";
require "../app/FormControl/nourriture.php";

if (!isset($_SESSION['user']) || $_SESSION['user']['role_id'] != 2) {
    echo "Il semblerait que vous n'ayez pas le droit d'être ici, merci de retourné sur la page d'accueil => <a href='/'>HomePage<a>";
    exit;
};

require "components/employeHead.php";

$user = $_SESSION['user'];
?>

<div class="col-md-5 col-sm-12">
    <div class="d-flex justify-content-center">
        <a class="nav-link font-rounded pt-4 mx-5" href="/"><p class="text-green">Retour Accueil<p></a>
    </div>
</div>

<div class="col-md-7 col-sm-12">
    <div class="d-flex justify-content-end mx-3">
        <h1 class="text-center fs-4 text-green mt-3">Bienvenue, <?= $user['nom'] . " " . $user['prenom'] ?> (Employé)</h1>
    </div>
</div>
</div>

<div class="bg-olive mt-3 pt-3 row justify-content-center">
    <div class="row justify-content-center">
        <h2 class="text-center fs-1 font-rounded text-green pt-3">Les Avis En attente de Validation</h2>
    </div>
    <div class="row col-md-6 col-sm-10 col-xl-4 d-flex justify-content-evenly py-3">
        <ol class="list-group mt-2">
            <?php foreach ($avis as $avi) : ?>
                <li class="list-group-item d-flex justify-content-between align-items-start rounded mt-2">
                    <div class="ms-2 me-auto">
                        <div class="fw-bold"><?= $avi['pseudo'] ?></div>
                        <?= $avi['commentaire'] ?>
                    </div>
                </li>
                <div class="mt-2">
                    <form action="" method="post" style="display:inline;">
                        <input type="hidden" name="id" value="<?= $avi['id'] ?>">
                        <button type="submit" name="action" value="toggle_visibility" class="btn btn-success">Rendre Visible</button>
                    </form>
                    <form action="" method="post" style="display:inline;">
                        <input type="hidden" name="id" value="<?= $avi['id'] ?>">
                        <button type="submit" name="action" value="delete" class="btn btn-danger">Supprimer</button>
                    </form>
                </div>
            <?php endforeach ?>
        </ol>
    </div>
</div>

<div class="bg-olive pt-3 row justify-content-center">
    <div class="row justify-content-center">
        <h2 class="text-center fs-1 font-rounded text-green pt-3">Modifier un Service</h2>
    </div>
    <div class="row col-md-6 col-sm-10 col-xl-4 d-flex justify-content-evenly py-3">
        <ol class="list-group mt-2">
            <?php foreach ($services as $service) : ?>
                <li class="list-group-item d-flex justify-content-between align-items-start rounded mt-2">
                    <div class="ms-2 me-auto">
                        <div class="fw-bold"><?= $service['nom'] ?></div>
                        <?= $service['description'] ?> <br>
                        prix : <?= $service['prix'] ?>
                    </div>
                </li>
                <div class="d-flex justify-content-left mt-2">
                    <button type="button" class="btn btn-success border border-0" data-bs-toggle="modal" data-bs-target="#<?= $service['id'] ?>">
                        Modifier
                    </button>
                </div>
                <div class="modal fade" id="<?= $service['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="row d-flex justify-content-center">
                                <div class="modal-body">
                                    <div class="card p-0 mt-2 mb-2 border border-0 shadow-lg">
                                        <div class="card-body">
                                            <form action="" method="post">
                                                <input type="hidden" name="id" value="<?= htmlspecialchars($service['id']) ?>">
                                                <div class="mb-3">
                                                    <label for="nom" class="form-label">Nom</label>
                                                    <input type="text" class="form-control" id="nom" name="nom" value="<?= htmlspecialchars($service['nom']) ?>" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="description" class="form-label">Description</label>
                                                    <textarea class="form-control" id="description" name="description" rows="3" required><?= htmlspecialchars($service['description']) ?></textarea>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="prix" class="form-label">Prix</label>
                                                    <input type="number" class="form-control" id="prix" name="prix" value="<?= htmlspecialchars($service['prix']) ?>">
                                                </div>
                                                <div class="container row justify-content-center p-3">
                                                    <button type="submit" name="action" class="btn btn-success col-6" value="update_service">Enregistrer les modifications</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="container row justify-content-center p-3">
                                    <button type="button" class="btn btn-secondary col-3" data-bs-dismiss="modal">Annulé</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </ol>
    </div>
</div>
<div class="bg-olive pt-3 row justify-content-center">
    <div class="row justify-content-center">
        <h2 class="text-center fs-1 font-rounded text-green pt-3">Nourriture des animaux</h2>
    </div>
    <div class="row col-md-6 col-sm-10 col-xl-4 d-flex justify-content-evenly py-3">
        <form action="" method="post">
            <label for="nourriture" class="form-label">Animal</label>
            <select class="form-select" id="animal" name="animal_id" required>
                <?php foreach ($animals as $animal) : ?>
                    <option value="<?= $animal['id'] ?>"><?= htmlspecialchars($animal['prenom']) ?></option>
                <?php endforeach ?>
            </select>
            <label for="nourriture" class="form-label mt-2">Nourriture</label>
            <input type="text" class="form-control" id="nourriture" name="nourriture" required>

            <label for="nom" class="form-label mt-2">Quantité (gramme)</label>
            <input type="number" class="form-control" id="quantité" name="quantité" required>

            <label for="date" class="form-label mt-2">Date du repas</label>
            <input type="datetime-local" class="form-control" id="date" name="date" required>

            <div class="container row justify-content-center p-3">
                <button type="submit" name="action" class="btn btn-success col-6" value="update_nourriture">Enregistrer les modifications</button>
            </div>
        </form>
    </div>
</div>

<?php require "components/employeFoot.php"; ?>