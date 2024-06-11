<?php require "components/header.php"; ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-xl-6 col-md-8 col-sm-10">
            <h1 class="text-center font-rounded text-green">Votre avis compte pour nous</h1>
            <form action="" method="post" novalidate>
                <div class="form-group">
                    <label for="pseudo">Pseudo:</label>
                    <input type="text" id="pseudo" name="pseudo" class="form-control" minlength="5" required>
                </div>
                <div class="form-group">
                    <label for="commentaire">Commentaire:</label>
                    <textarea id="commentaire" name="commentaire" class="form-control" rows="5" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary btn-block mt-3 border-0 shadow-lg" style="background-color: #3A5743;">Envoyer</button>
            </form>
        </div>
    </div>
</div>

<?php
require_once '../app/DAO/AvisDAO.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $pseudo = htmlentities($_POST['pseudo']);
    $commentaire = htmlentities($_POST['commentaire']);

    $errors = [];
    if (empty($pseudo) || strlen($pseudo) < 5) {
        $errors[] = "Le pseudo doit contenir au moins 5 caractères.";
    }
    if (empty($commentaire)) {
        $errors[] = "Le commentaire ne peut pas être vide.";
    }

    if (empty($errors)) {

        $avisDAO = new AvisDAO();
        $avisDAO->addAvis($pseudo, $commentaire);

        echo 
        "<div class=\" container \">
            <div class=\"row justify-content-center mt-5\">   
                <div class=\"alert alert-success text-center col-xl-6 col-md-8 col-sm-10\" role=\"alert\">
                    Merci pour votre avis il sera très prochainement visible sur notre page d'acceuil.
                </div>
            </div>
        </div>

        <div class=\" container \">
            <div class=\"row justify-content-center\">   
                <div class=\"alert alert-success text-center col-xl-6 col-md-8 col-sm-10\" role=\"alert\">
                    Vous allez être redirigé vers la page d'acceuil.
                </div>
            </div>
        </div>
        <script>
            setTimeout(function(){
                window.location.href = '/';
            }, 3000);
        </script>";

        exit;
    } else {

        foreach ($errors as $error) {
            echo 

            "<div class=\" container \">
                <div class=\"row justify-content-center mt-5\">   
                    <div class=\"alert alert-danger text-center col-xl-6 col-md-8 col-sm-10\" role=\"alert\">
                        $error
                    </div>
                </div>
            </div>";
        }
    }
}
?>

<script src="/assets/JS/main.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>