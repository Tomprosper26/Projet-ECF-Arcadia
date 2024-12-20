<?php

if (!isset($_SESSION['user']) || $_SESSION['user']['role_id'] != 1) {
    echo "Il semblerait que vous n'ayez pas le droit d'être ici, merci de retourné sur la page d'accueil => <a href='/'>HomePage<a>";
    exit;
};

require "components/employeHead.php";

$user = $_SESSION['user'];
?>

<div class="col-md-8 col-sm-12">
    <div class="d-flex justify-content-end">
        <h1 class="text-center fs-4 text-green mt-3">Bienvenue, <?= $user['nom'] . " " . $user['prenom'] ?> (Admin)</h1>
    </div>
</div>
</div>

<div class="row bg-body-white">
    <div class="col-md-12 col-sm-12">
        <div class="d-flex justify-content-center">
            <nav class="navbar navbar-expand-lg bg-body-white">
                <div class="mt-md-3">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                        <div class="collapse navbar-collapse" id="navbarNavDropdown">
                            <ul class="navbar-nav">
                                <li class="nav-item fs-6 mx-xxl-4 mx-xl-3">
                                    <a class="nav-link font-rounded pt-4 mx-5" href="/"><p class="text-green">Retour Accueil<p></a>
                                </li>
                                <li class="nav-item fs-6 mx-xxl-4 mx-xl-3">
                                    <a class="nav-link font-rounded pt-4 mx-5" href="/connexion-1"><p class="text-green">Gestion zoo<p></a>
                                </li>
                                <li class="nav-item fs-6 mx-xxl-4 mx-xl-3">
                                    <a class="nav-link font-rounded pt-4 mx-5" href="/connexion-rapport"><p class="text-green">Rapport Veterinaire<p></a>
                                </li>
                                <li class="nav-item fs-6 mx-xxl-4 mx-xl-3">
                                    <a class="nav-link font-rounded pt-4 mx-5" href="/connexion-dashboard"><p class="text-green">Dashboard<p></a>
                                </li>
                            </ul>
                        </div>
                    </div>
            </nav>
        </div>
    </div>
</div>

<script id="rapportDetailsJson" type="application/json"><?php echo $rapportDetailsJson; ?></script>

<div class="container my-5">
    <h2 class="text-center mb-4">Rapports Vétérinaires</h2>
    <form id="filterForm" class="mb-4">
        <div class="row g-3">
            <div class="col-md-4">
                <label for="prenom" class="form-label">Prénom:</label>
                <input type="text" class="form-control" id="prenom" name="prenom">
            </div>
            <div class="col-md-4">
                <label for="startDate" class="form-label">Date de début:</label>
                <input type="datetime-local" class="form-control" id="startDate" name="startDate">
            </div>
            <div class="col-md-4">
                <label for="endDate" class="form-label">Date de fin:</label>
                <input type="datetime-local" class="form-control" id="endDate" name="endDate">
            </div>
        </div>
        <div class="row g-3 mt-3">
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary">Filtrer</button>
            </div>
        </div>
    </form>

    <div id="results" class="table-responsive">

    </div>
</div>

<?php require "components/employeFoot.php"; ?>
