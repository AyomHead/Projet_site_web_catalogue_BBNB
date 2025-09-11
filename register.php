<?php session_start(); ?>

<?php
include_once("includes/config.php");
include_once("auth_functions.php");

$regis_data = $_POST; // récupération des données d’inscription

// clé sécurisée pour l’inscription des admins
$admin_secure_key = "MOt4cl5eSeu7Rep03oura40DmIn";

//-------============================================================================================================================================
// A revoir car il faut vérifier que les champs existent avant de les assigner aux variables et en plus il faut vérifier si elles ne sont pas vides (C’est réglé avec la fonction areAvalaible dans auth_functions.php)
//-------============================================================================================================================================
if(!areAvalaible($regis_data['name'], $regis_data['first_name'], $regis_data['email'], $regis_data['password1'], $regis_data['password2'])){
    echo("Vous devez remplir tous les champs");
    return;
}
elseif($regis_data['password1'] !== $regis_data['password2']){
    echo('Les mots de passe ne correspondent pas');
    return;
}
// validité du mail
elseif(!filter_var($regis_data['email'], FILTER_VALIDATE_EMAIL)){
    echo('L’adresse email entrer n’est pas valide');
    return;
}
else{

    $user_name = $regis_data['name'];
    $user_first = $regis_data['first_name'];
    $user_email = $regis_data['email'];
    $user_password = $regis_data['password'];
    $admin_key = $regis_data['admin_key'] ?? '';

    //sécuriasation du mot de passe, avec la methode password_hash
    $user_password = password_hash($user_password, PASSWORD_BCRYPT);

    // vérification des informations de l’utilisateur au cas où il existe déjà dans la de données
    $stmt = $pdo->prepare("SELECT email FROM users WHERE email = ?");
    $stmt->execute([$user_email]);
    $existiing_user = $stmt->fetch(PDO::FETCH_ASSOC);
    if($existiing_user){
        echo("Cette adresse email est déjà utilisée");
        return;
    }
    else{
        $inscription = $pdo->prepare("INSERT INTO users (name, first_name, email, pass_word) VALUES (?, ?, ?, ?)");
        $inscription->execute([
            $user_name,
            $user_first,
            $user_email,
            $user_password
        ]);
        if($admin_key && $admin_key === $admin_secure_key){
            $make_admin = $pdo -> prepare("UPDATE users SET role = 'admin' WHERE email = ?");
            $make_admin -> execute([$user_email]);
        }
        echo("Inscription réussie ! Vous pouvez maintenant vous connecter.");
        // Quand la personne s’inscrit on ouvre pas encore de session, mais on le renvoie vers la page de connexion
        header("Location: login.php");
        exit();
    }
}
?>