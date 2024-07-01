Ce fichier vous explique comment déployer cette application en local.

Cloner le projet avec la commande : "gh repo clone Tomprosper26/Projet-ECF-Arcadia".

Le projet à besoin pour fonctionner d'une DB que vous pouvez crée en exécutant les commandes suivantes : 

- "php create_database.php"
- "php insert_into_database.php"

Ou en executant directement les commandes SQL contenues dans le fichiers "Database/Base_De_Données.SQL".

n'oublié pas de modifier les informations de connexion dans chacun des fihciers php.

Par la suite pour la conexion a la DB il vous suffit de renseigner vos informations de connexion dans 
le fihcier "app/config.php".

Ce projet utilise aussi la DB MongoDB laquelle nécéssite l'utilisation du driver MongoDB que vous devrez installer selon votre version de php
voir : "https://www.mongodb.com/docs/drivers/php-drivers/"

puis installer avec composer (après l'avoir initialisé dans votre projet) : "composer require mongodb/mongodb" 

Ensuite pour la DB MongoDB il vous suffira d'aller modifier vos informations dans le fichiers "app/MongoDB/MDBConnection.php"
puis d'exécuter le fichier "CreateAnimals.php"

Enfin le projet utilise php Mailer pour l'envoei automatique de mail il vous faudrat donc installer avec composer :
"composer require phpmailer/phpmailer".

Et ne pas oublié de changer vos informations SMTPS dans les fichiers : "app/FormControl/users.php" et "app/FormControl/contact.php".

Une fois toutes ces étapes effectuées vous opuvez directement lancer votre serveur local avec la commande : 
"php -S localhost:8000 -t Public".
