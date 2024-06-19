<?php
require "../app/FormControl/users.php";
require "../app/FormControl/horaires.php";


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
        <h1 class="text-center">Créer un compte employé</h1>
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
                <button type="submit" name="action" class="btn btn-primary btn-block mt-3 border-0 shadow-lg" value="create_user" style="background-color: #3A5743;">Créer</button>
            </form>
        </div>
    </div>
    <div class="col-md-6 col-sm-12">
        <h1 class="text-center">Modifier les horraires du parc</h1>
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
                <button type="submit" name="action" class="btn btn-primary my-2 border-0 shadow-lg" style="background-color: #3A5743;" value="update_horaires">Modifier</button>
            </form>
        </div>
    </div>

<?php require "components/employeFoot.php"; ?>