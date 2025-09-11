<?php session_start(); ?>

<?php
include_once("includes/config.php");
include_once("auth_functions.php");

// Initilisation des messages d’erreurs
$login_message = "";
$error_message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $regis_data = $_POST; // récupération des données d’inscription

    // clé sécurisée pour l’inscription des admins
    $admin_secure_key = "MOt4cl5eSeu7Rep03oura40DmIn";

    //-------============================================================================================================================================
    // A revoir car il faut vérifier que les champs existent avant de les assigner aux variables et en plus il faut vérifier si elles ne sont pas vides (C’est réglé avec la fonction areAvalaible dans auth_functions.php)
    //-------============================================================================================================================================
    if(!areAvalaible($regis_data['name'] ?? '', $regis_data['first_name'] ?? '', $regis_data['email'] ?? '', $regis_data['password1'] ?? '', $regis_data['password2'] ?? '')){
        $error_message = "Vous devez remplir tous les champs";
    }
    elseif($regis_data['password1'] !== $regis_data['password2']){
        $error_message = "Les mots de passe ne correspondent pas";
    }
    // validité du mail
    elseif(!filter_var($regis_data['email'], FILTER_VALIDATE_EMAIL)){
        $error_message = "L’adresse email n’est pas valide";
    }
    else{

        $user_name = $regis_data['name'] ?? '';
        $user_first = $regis_data['first_name'] ?? '';
        $user_email = $regis_data['email'] ?? '';
        $user_password = $regis_data['password1'] ?? '';
        $admin_key = $regis_data['admin_key'] ?? '';

        //sécuriasation du mot de passe, avec la methode password_hash
        $user_password = password_hash($user_password, PASSWORD_BCRYPT);

        // vérification des informations de l’utilisateur au cas où il existe déjà dans la de données
        $stmt = $pdo->prepare("SELECT email FROM users WHERE email = ?");
        $stmt->execute([$user_email]);
        $existing_user = $stmt->fetch(PDO::FETCH_ASSOC);
        if($existing_user){
            $error_message = "Un utilisateur avec cet email existe déjà";
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
            $login_message = "Inscription réussie ! Vous pouvez maintenant vous connecter.";
            header("Location: login.php");
            // Quand la personne s’inscrit on ouvre pas encore de session, mais on le renvoie vers la page de connexion
        }
    }
}


?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
      <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .page-section {
            padding: 100px 0;
        }
        
        .section-title {
            text-align: center;
            margin-bottom: 2rem;
        }
        
        .section-title h2 {
            color: #3b5998;
            font-weight: 700;
        }
        
        .section-title p {
            color: #6c757d;
            font-size: 1.1rem;
        }
        
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }
        
        .form-container {
            padding: 2rem;
        }
        
        .form-control:focus {
            border-color: #3b5998ff;
            box-shadow: 0 0 0 0.25rem rgba(59, 89, 152, 0.25);
        }
        
        .btn-primary {
            background-color: #3b5998;
            border-color: #3b5998;
            padding: 0.75rem;
            font-weight: 600;
            transition: all 0.3s;
        }
        
        .btn-primary:hover {
            background-color: #2d4373;
            border-color: #2d4373;
            transform: translateY(-2px);
        }
        
        .animate-in {
            animation: fadeIn 0.5s ease-in-out;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .form-check-input:checked {
            background-color: #3b5998;
            border-color: #3b5998;
        }
    </style>
</head>
<body>
    <!-- Page Inscription -->
    <section class="page-section" id="register">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6">
                    <div class="section-title">
                        <h2><i class="fas fa-user-plus me-2"></i> Inscription</h2>
                        <p>Créez un compte pour accéder à toutes les fonctionnalités</p>
                    </div>

                    <div class="card animate-in">
                        <div class="form-container">

                            <!-- Affichage des messages -->
                            <?php if($login_message): ?>
                                <p class="text-success text-center fw-bold"><?= $login_message ?></p>
                            <?php endif; ?>
                            <?php if($error_message): ?>
                                <p class="text-danger text-center fw-bold"><?= $error_message ?></p>
                            <?php endif; ?>

                            <form id="register-form" method="POST" action="">
                                <div class="mb-3">
                                    <label for="register-name" class="form-label">Nom</label>
                                    <input type="text" name = "name" id="register-name" class="form-control" placeholder="Entez votre Nom"  required>
                                </div>
                                <div class="mb-3">
                                    <label for="register-first" class="form-label">Prenom</label>
                                    <input type="text" name = "first_name" id="register-first" class="form-control" placeholder="Entez votre Prénom" required>
                                </div>
                                <div class="mb-3">
                                    <label for="register-email" class="form-label">Email</label>
                                    <input type="email" name = "email" id="register-email" class="form-control" placeholder="Entez votre Email "required>
                                </div>
                                <div class="mb-3">
                                    <label for="rolekey" class="form-label">Clé d'accès</label>
                                    <input type="text" name = "admin_key" id="rolekey" class="form-control"placeholder="Entez la clé d'accès pour déterminer votre role">
                                </div>
                                <div class="mb-3">
                                    <label for="register-password" class="form-label">Mot de passe</label>
                                    <input type="password" name = "password1" id="register-password" class="form-control" placeholder="choississez un mot de passe "required>
                                </div>
                                <div class="mb-3">
                                    <label for="register-confirm" class="form-label">Confirmer le mot de passe</label>
                                    <input type="password" name = "password2" id="register-confirm" class="form-control"  placeholder="Confirmez votre mot de passe "required>
                                </div>
                                <div class="mb-3 form-check">
                                    <input type="checkbox" class="form-check-input" id="terms-check" required>
                                    <label class="form-check-label" for="terms-check">J'accepte les conditions d'utilisation</label>
                                </div>
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="fas fa-user-plus me-2"></i> S'inscrire
                                </button>
                                <p class="text-center mt-3">
                                    Déjà un compte ? <a href="login.php" data-page="login" class="text-decoration-none">Se connecter</a>
                                </p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>