<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require '../vendor/autoload.php';
require_once "../app/DAO/UsersDAO.php";
$user = $_SESSION['user'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'];

    $userDAO = new UsersDAO();

    if ($action == 'create_user') {

        $message = "Votre identifiant de connection au site est : " . $_POST['email'] . "pour votre mot De passe merci de vous rapprocher de José";
        $subject = "Mon Sujet";

        $mail = new PHPMailer(true);

        try {
            // Paramètres du serveur
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = "";
            $mail->Password = "";
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Destinataires
            $mail->setFrom('acradiazoo@gmail.com', 'Expéditeur');
            $mail->addAddress($_POST['email'], 'Destinataire');

            // Contenu de l'email
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $message;
            $mail->AltBody = $message;

            $mail->send();
            echo 'Email envoyé avec succès.';
        } catch (Exception $e) {
            echo "Échec de l'envoi de l'email. Erreur: {$mail->ErrorInfo}";
        }


        $username = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $role_id = $_POST['role_id'];
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];

        $userDAO->createUser($username, $password, $nom, $prenom, $role_id);

        $url = "/connexion-" . $user['role_id'];
        header("Location: $url");
        exit();

    }
}
?>