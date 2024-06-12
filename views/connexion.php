<?php require "components/header.php"; ?>

<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h1 class="text-center font-rounded text-green">Formulaire de Connexion</h1>
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <button type="submit" style="background-color: #3A5743;" class="btn btn-primary my-3 border border-0">Login</button>
                    </form>
                    <h2 class="text-center text-green mt-5">Cette Page est réservée aux employés du Zoo, Si vous n'êtes pas concerné merci de retourné sur la page d'acceuil</h2>
            </div>
        </div>
    </div>

<?php 

require_once "../app/DAO/UsersDAO.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $user = null;

    try {
        $usersDAO = new UsersDAO();
        $user = $this->usersDAO->getUserByEmail($email);
        var_dump($user['password']);
        if ($user && password_verify($password, $user['password'])) {
            
            $_SESSION['user'] = $user;
            echo          
            "<script>
                setTimeout(function(){
                    window.location.href = '/';
                }, 1000);
            </script>";
        } else {
            
            echo 

            "<div class=\" container \">
                <div class=\"row justify-content-center mt-5\">   
                    <div class=\"alert alert-danger text-center col-xl-6 col-md-8 col-sm-10\" role=\"alert\">
                        Nom de Compte ou Mot De Passe incorrect.
                    </div>
                </div>
            </div>";
        }
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
}

?>

<script src="/assets/JS/main.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>