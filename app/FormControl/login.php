<?php

require_once "../app/DAO/UsersDAO.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $user = null;

    try {
        $usersDAO = new UsersDAO();
        $user = $usersDAO->getUserByEmail($email);

        if ($user && password_verify($password, $user['password'])) {

            session_start();
            $_SESSION['user'] = $user;
            $url = "/connexion-" . $user['role_id'];
            header("Location: $url");
            exit();

        } else {
            
            echo 

            "<div class=\" container \">
                <div class=\"row justify-content-center mt-5\">   
                    <div class=\"alert alert-danger text-center col-xl-6 col-md-8 col-sm-10\" role=\"alert\">
                        Email ou mot de passe incorrect.
                    </div>
                </div>
            </div>";
        }
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
}
?>