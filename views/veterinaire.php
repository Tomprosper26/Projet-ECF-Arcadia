<?php

if (!isset($_SESSION['user']) || $_SESSION['user']['role_id'] != 3) {
    echo "Il semblerait que vous n'ayez pas le droit d'être ici, merci de retourné sur la page d'accueil => <a href='/'>HomePage<a>";
    exit;
};

require "components/employeHead.php";

$user = $_SESSION['user'];
?>
<div class="col-md-7 col-sm-12">
    <div class="d-flex justify-content-end mx-3">
        <h1 class="text-center fs-4 text-green mt-3">Bienvenue, <?= $user['nom'] . " " . $user['prenom'] ?>(Veterinaire)</h1>
    </div>
</div>
</div>



<?php require "components/employeFoot.php"; ?>