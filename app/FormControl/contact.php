<?php


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require '../vendor/autoload.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $title = htmlentities($_POST['objet']);
    $description = $_POST['description'];

    $errors = [];
    if (empty($email) || strlen($pseudo) < 5) {
        $errors[] = "Vous devez renseigner un email";
    }
    if (empty($description)) {
        $errors[] = "La description ne peut pas être vide.";
    }

    if (empty($errors)) {

        $message = $description;
        $subject = $title;

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
            $mail->setFrom($_POST['email'], 'Expéditeur');
            $mail->addAddress('arcadiazoo@gmail.com', 'Destinataire');

            // Contenu de l'email
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $message;
            $mail->AltBody = $message;

            $mail->send();
            echo

            "<div class=\" container \">
                <div class=\"row justify-content-center mt-5\">   
                    <div class=\"alert alert-success text-center col-xl-6 col-md-8 col-sm-10\" role=\"alert\">
                        Merci pour votre message il sera très prochainement traité par notre équipe.
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
        } catch (Exception $e) {
            echo "Échec de l'envoi de l'email. Erreur: {$mail->ErrorInfo}";
        }
    }
     else {

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