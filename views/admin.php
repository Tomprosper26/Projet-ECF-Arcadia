<?php
require "../app/FormControl/users.php";
require "../app/FormControl/horaires.php";
require "../app/FormControl/servicesUpdate.php";
require "../app/FormControl/addservice.php";
require "../app/FormControl/habitatupdate.php";
require "../app/FormControl/addhabitat.php";


if (!isset($_SESSION['user']) || $_SESSION['user']['role_id'] != 1) {
    echo "Il semblerait que vous n'ayez pas le droit d'être ici, merci de retourné sur la page d'accueil => <a href='/'>HomePage<a>";
    exit;
};

require "components/employeHead.php";

$user = $_SESSION['user'];
?>

<div class="col-md-7 col-sm-12">
    <div class="d-flex justify-content-end mx-3">
        <h1 class="text-center fs-4 text-green mt-3">Bienvenue, <?= $user['nom'] . " " . $user['prenom'] ?> (Admin)</h1>
    </div>
</div>
</div>

<div class="row justify-content-center mt-5">
    <div class="col-md-6 col-sm-12">
        <h2 class="text-center fs-1">Créer un compte employé</h2>
        <div class="row justify-content-center mt-5">
            <form class="col-8" action="" method="post" novalidate>
                <div class="form-group">
                    <label for="nom">Nom:</label>
                    <input type="text" id="nom" name="nom" class="form-control" minlength="5" required>
                </div>
                <div class="form-group">
                    <label for="prénom">Prénom:</label>
                    <input type="text" id="prenom" name="prenom" class="form-control" minlength="5" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" class="form-control" minlength="5" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input id="password" name="password" class="form-control" rows="5" required>
                </div>
                <div class="form-group">
                    <label for="role">role:</label>
                    <select class="form-select" id="role_id" name="role_id" required>
                        <option value="2">Employé</option>
                        <option value="3">Veterinaire</option>
                    </select>
                </div>
                <button type="submit" name="action" class="btn btn-success btn-block mt-3 border-0 shadow-lg" value="create_user">Créer</button>
            </form>
        </div>
    </div>
    <div class="col-md-6 col-sm-12">
        <h2 class="text-center fs-1">Modifier les horraires du parc</h2>
        <div class="row justify-content-center mt-5">
            <form class="col-8" action="" method="post">
                <div class="form-group">
                    <label for="jour">Jour</label>
                    <select class="form-control" id="jour" name="jour" required>
                        <option value="Lundi">Lundi</option>
                        <option value="Mardi">Mardi</option>
                        <option value="Mercredi">Mercredi</option>
                        <option value="Jeudi">Jeudi</option>
                        <option value="Vendredi">Vendredi</option>
                        <option value="Samedi">Samedi</option>
                        <option value="Dimanche">Dimanche</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="ouverture">Heure d'ouverture</label>
                    <input type="time" class="form-control" id="ouverture" name="ouverture" required>
                </div>
                <div class="form-group">
                    <label for="fermeture">Heure de fermeture</label>
                    <input type="time" class="form-control" id="fermeture" name="fermeture" required>
                </div>
                <button type="submit" name="action" class="btn btn-success my-2 border-0 shadow-lg" value="update_horaires">Modifier</button>
            </form>
        </div>
    </div>
</div>

<div class="pt-3 row justify-content-center mt-5">
    <div class="row justify-content-center">
        <h2 class="text-center fs-1">Modifier un Service</h2>
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
                <div class="d-flex justify-content-left mt-2">
                    <button type="button" class="btn btn-danger border border-0" data-bs-toggle="modal" data-bs-target="#<?= str_replace(" ", "", $service['nom']) ?>">
                        Supprimer
                    </button>
                </div>
                <div class="modal fade" id="<?= str_replace(" ", "", $service['nom']) ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="row d-flex justify-content-center">
                                <div class="modal-body">
                                    <div class="card p-0 mt-2 mb-2 border border-0 shadow-lg">
                                        <div class="card-body">
                                            <div class="alert alert-danger text-center" role="alert">
                                                Attention! La suppression de ce service est définitive êtes-vous sur de vouloir continuer?
                                            </div>
                                            <form action="" method="post">
                                                <input type="hidden" name="id" value="<?= htmlspecialchars($service['id']) ?>">
                                                <div class="container row justify-content-center p-3">
                                                    <button type="submit" name="action" class="btn btn-danger col-6" value="delete_service">Supprimer</button>
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

<div class="pt-3 row justify-content-center mt-5 mb-5">
    <div class="d-flex justify-content-center mt-2">
        <button type="button" class="btn btn-success border border-0 fs-4" data-bs-toggle="modal" data-bs-target="#addservice">
            Ajouter un service
        </button>
    </div>
    <div class="modal fade" id="addservice" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="row d-flex justify-content-center">
                    <div class="modal-body">
                        <div class="card p-0 mt-2 mb-2 border border-0 shadow-lg">
                            <div class="card-body">
                                <form action="" method="post" enctype="multipart/form-data">
                                    <div class="mb-3">
                                        <label for="nom" class="form-label">Nom</label>
                                        <input type="text" class="form-control" id="nom" name="nom" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="prix" class="form-label">Prix</label>
                                        <input type="number" class="form-control" id="prix" name="prix">
                                    </div>
                                    <div class="form-group">
                                        <label for="image">Uploader une image</label>
                                        <input type="file" class="form-control-file" id="image" name="image" required>
                                    </div>
                                    <div class="container row justify-content-center p-3">
                                        <button type="submit" name="action" class="btn btn-success col-6" value="add_service">Enregistrer et créer</button>
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
</div>

<div class="bg-white py-3">
    <div class="row justify-content-center mb-5">
        <h2 class="text-center fs-1 font-rounded text-green pt-3">Gérer les Habitats et les animaux</h2>
    </div>
    <div class="p-0">
        <?php foreach ($habitats as $habitat) : ?>
            <a class="btn p-0 d-flex justify-content-center pb-0 mb-3" type="button" data-bs-toggle="collapse" data-bs-target="#<?= $habitat['id'] ?>" aria-expanded="true">
                <div class="card p-0 border-0 shadow-lg col-xl-6 col-md-8 col-sm-6 m-0" style="max-width: 100%;">
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
                <div class="collapse col-xl-6 col-md-8 col-sm-6 p-0" id="<?= $habitat['id'] ?>">
                    <div class="card card-body p-0 border border-0 rounded" style="background-color: #393424;">
                        <div class="d-flex justify-content-evenly row rounded py-3">
                            <?php foreach ($animaldetails as $animal) : ?>
                                <?php if ($habitat['id'] == $animal['habitat_id']) : ?>
                                    <div class="card p-0 col-md-3 col-sm-8 mt-2 mb-2 border border-0 shadow-lg mb-2">
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
                                                                            <input type="hidden" name="id" value="<?= $animal['id'] ?>">
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
            <div class="d-flex justify-content-center mt-2 mb-1">
                <button type="button" class="btn btn-success border border-0" data-bs-toggle="modal" data-bs-target="#<?= $habitat['nom'] ?>">
                    Modifier l'habitat
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
                                                    <label for="nom" class="form-label">nom</label>
                                                    <input type="text" class="form-control" id="nom" name="nom" value="<?= htmlspecialchars($habitat['nom']) ?>" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="nom" class="form-label">description</label>
                                                    <input type="text" class="form-control" id="description" name="description" value="<?= htmlspecialchars($habitat['description']) ?>" required>
                                                </div>
                                                <div class="container row justify-content-center p-3">
                                                    <button type="submit" name="action" class="btn btn-success col-6" value="update_habitat">Enregistrer les modifications</button>
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
            <div class="d-flex justify-content-center mb-3">
                    <button type="button" class="btn btn-danger border border-0" data-bs-toggle="modal" data-bs-target="#<?= str_replace([" ", "'"], "", $habitat['description']) ?>">
                        Supprimer l'habitat
                    </button>
                </div>
                <div class="modal fade" id="<?= str_replace([" ", "'"], "", $habitat['description']) ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="row d-flex justify-content-center">
                                <div class="modal-body">
                                    <div class="card p-0 mt-2 mb-2 border border-0 shadow-lg">
                                        <div class="card-body">
                                            <div class="alert alert-danger text-center" role="alert">
                                                Attention! La suppression de cet habitat est définitive êtes-vous sur de vouloir continuer?
                                            </div>
                                            <form action="" method="post">
                                                <input type="hidden" name="id" value="<?= $habitat['id'] ?>">
                                                <div class="container row justify-content-center p-3">
                                                    <button type="submit" name="action" class="btn btn-danger col-6" value="delete_habitat">Supprimer</button>
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
    </div>
</div>

<div class="pt-3 row justify-content-center mb-5">
    <div class="d-flex justify-content-center mt-2">
        <button type="button" class="btn btn-success border border-0 fs-4" data-bs-toggle="modal" data-bs-target="#addhabitat">
            Ajouter un habitat
        </button>
    </div>
    <div class="modal fade" id="addhabitat" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="row d-flex justify-content-center">
                    <div class="modal-body">
                        <div class="card p-0 mt-2 mb-2 border border-0 shadow-lg">
                            <div class="card-body">
                                <form action="" method="post" enctype="multipart/form-data">
                                    <div class="mb-3">
                                        <label for="nom" class="form-label">Nom</label>
                                        <input type="text" class="form-control" id="nom" name="nom" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Commentaire sur l'état de l'habitat</label>
                                        <textarea class="form-control" id="commentaire" name="commentaire" rows="3" required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="image">Uploader une image</label>
                                        <input type="file" class="form-control-file" id="image" name="image" required>
                                    </div>
                                    <div class="container row justify-content-center p-3">
                                        <button type="submit" name="action" class="btn btn-success col-6" value="add_habitat">Enregistrer et créer</button>
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
</div>


<?php require "components/employeFoot.php"; ?>