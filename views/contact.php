<?php require "components/header.php"; ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-xl-8 col-md-8 col-sm-10">
            <h1 class="text-center font-rounded text-green">Une Question? <br> Contactez-nous sans attendre!</h1>
            <form action="" method="post" novalidate>
                <div class="form-group">
                    <label for="pseudo">Email:</label>
                    <input type="email" id="email" name="email" class="form-control" minlength="5" required>
                </div>
                <div class="form-group">
                    <label for="pseudo">Objet:</label>
                    <input type="text" id="objet" name="objet" class="form-control" minlength="5" required>
                </div>
                <div class="form-group">
                    <label for="commentaire">Description:</label>
                    <textarea id="commentaire" name="commentaire" class="form-control" rows="5" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary btn-block mt-3 border-0 shadow-lg" style="background-color: #3A5743;">Envoyer</button>
            </form>
        </div>
    </div>
</div>

<?php
require_once '../app/FormControl/contact.php';
?>

<script src="/assets/JS/main.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>