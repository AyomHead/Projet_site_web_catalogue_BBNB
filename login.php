<?php session_start(); ?>

<?php
include_once("includes/config.php");
include_once("auth_functions.php");

$get_coordonnees = $_POST; //là pour récupérer l’email et la mot de passe de l’utilisateur pour la connexion sans afficher les données dans l’URL

if(!areAvalaible($get_coordonnees['email'], $get_coordonnees['password'])){ 
    echo("Vous devez remplir tous les champs");
    return;
}
elseif(!filter_var($get_coordonnees['email'], FILTER_VALIDATE_EMAIL)){
    echo("L’adresse email n’est pas valide");
    return;
}
else{
    // récupération des données du formulaire de connexion
    $email = $get_coordonnees['email'];
    $password = $get_coordonnees['password'];

    // préparation de la requete pour vérifier les informations de l’utilisateur pour la connexion
    $stmt = $pdo->prepare("SELECT first_name, email, pass_word, role FROM users WHERE email = ?");
    $stmt->execute([$email]); // execution de la commande
    $user = $stmt->fetch(PDO::FETCH_ASSOC); // récupération des données dans la variable locale

    // vérification de l’existence de l’utilisateur et de la validité du mot de passe
    if($user && password_verify($password, $user['pass_word'])){
        // demarrage de la session
        logedInUser($user);
        echo('Content de vous revoir' . $user['first_name'] . ' !');

        header("Location : accueil.php");
        exit();
    }
    else{
        echo("Identifiants incorrects");
    }
}
?>