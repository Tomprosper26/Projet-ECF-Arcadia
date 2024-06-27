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

        $message = "Votre identifiant de connection au site est : " . $_POST['email'] . " pour votre mot De passe merci de vous rapprocher de José";
        $subject = "Arcadia Compte Employe";

        $mail = new PHPMailer(true);
	  
		$username = $_POST['email'];
		$testemail = $userDAO->getUserByEmail($username);
		$password = password_hash($_POST['password'], PASSWORD_BCRYPT);
		$role_id = $_POST['role_id'];
		$nom = $_POST['nom'];
		$prenom = $_POST['prenom'];
		  
		if(!empty($testemail)){
	
			echo
			"<div class=\" container \">
				<div class=\"row justify-content-center mt-5\">   
					<div class=\"alert alert-danger text-center col-xl-6 col-md-8 col-sm-10\" role=\"alert\">
						cette adresse mail est déja utilisé.
					</div>
				</div>
			</div>";
	
		} else {
	
			$userDAO->createUser($username, $password, $nom, $prenom, $role_id);
				
			try {
				// Paramètres du serveur
				$mail->isSMTP();
				$mail->Host = 'mail.infomaniak.com';
				$mail->SMTPAuth = true;
				$mail->Username = "";
				$mail->Password = "";
				$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
				$mail->Port = 465;
	
				// Destinataires
				$mail->setFrom('arcadiazoo@mayto.fr', 'ArcadiaZoo');
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
	
	
			$url = "/connexion-" . $user['role_id'];
			header("Location: $url");
			exit();
	
		}


    }
}
?>
