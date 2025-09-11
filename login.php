<?php session_start(); ?>

<?php
include_once("includes/config.php");
include_once("auth_functions.php");

// Initilisation des messages d’erreurs
$login_message = "";
$error_message = "";

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $get_coordonnees = $_POST; //là pour récupérer l’email et la mot de passe de l’utilisateur pour la connexion sans afficher les données dans l’URL

    if(!areAvalaible($get_coordonnees['email'] ?? '', $get_coordonnees['password'] ?? '')){ 
        $error_message = "Vous devez remplir tous les champs";
    }
    elseif(!filter_var($get_coordonnees['email'], FILTER_VALIDATE_EMAIL)){
        $error_message = "L’adresse email n’est pas valide";
    }
    else{
        // récupération des données du formulaire de connexion
        $email = $get_coordonnees['email'];
        $password = $get_coordonnees['password'];

        // préparation de la requete pour vérifier les informations de l’utilisateur pour la connexion
        $stmt = $pdo->prepare("SELECT id, first_name, email, pass_word, role FROM users WHERE email = ?");
        $stmt->execute([$email]); // execution de la commande
        $user = $stmt->fetch(PDO::FETCH_ASSOC); // récupération des données dans la variable locale

        // vérification de l’existence de l’utilisateur et de la validité du mot de passe
        if($user && password_verify($password, $user['pass_word'])){
            // demarrage de la session
            logedInUser($user);
            $login_message = 'Content de vous revoir ' . $user['first_name'] . ' !';
        }
        else{
            $error_message = "Identifiants incorrects";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Connexion</title>
        <!-- Bootstrap 5 CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
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
        <section class="page-section" id="login">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6">
                        <div class="section-title">
                            <h2><i class="fas fa-sign-in-alt me-2"></i> Connexion</h2>
                            <p>Connectez-vous pour accéder à votre espace personnel</p>
                        </div>
                        <div class="card animate-in">
                            <div class="form-container">
                                <!-- Affichage des messages -->
                                <p class="text-center text-success fw-bold"><?php echo $login_message ?? ''; ?></p>
                                <p class="text-center text-danger fw-bold"><?php echo $error_message ?? ''; ?></p>
                                <form method="post" class="mx-auto mt-4" style="max-width: 400px;">
                                    <div class="mb-3">
                                        <label for="email" class="form-label fw-bold">Email</label>
                                        <input type="email" name="email" class="form-control bg-outline-secondary" id="email" placeholder="Entrez votre email" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="password" class="form-label fw-bold">Mot de passe</label>
                                        <input type="password" name="password" class="form-control" id="password" placeholder="Entrez votre mot de passe" required>
                                    </div>
                                    <a href="#" class="mt-2 mb-2 d-block text-center">Mot de passe oublié ?</a>
                                    <button type="submit" class="btn btn-primary w-100 d-flex justify-content-center align-items-center mt-2">
                                        <i class="fas fa-sign-in-alt me-2" style="color: white;"></i>Se connecter
                                    </button>
                                    <p class="text-center mt-3">
                                        Pas encore de compte ? <a href="register.php" class="text-decoration-none">S'inscrire</a>
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