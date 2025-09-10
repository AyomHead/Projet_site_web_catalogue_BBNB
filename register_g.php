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
            border-color: #3b5998;
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
                            <form id="register-form">
                                <div class="mb-3">
                                    <label for="register-name" class="form-label">Nom</label>
                                    <input type="text" id="register-name" class="form-control" placeholder="Entez votre Nom"  required>
                                </div>
                                <div class="mb-3">
                                    <label for="register-name" class="form-label">Prenom</label>
                                    <input type="text" id="register-name" class="form-control" placeholder="Entez votre Prénom" required>
                                </div>
                                <div class="mb-3">
                                    <label for="register-email" class="form-label">Email</label>
                                    <input type="email" id="register-email" class="form-control" placeholder="Entez votre Email "required>
                                </div>
                                <div class="mb-3">
                                    <label for="rolekey" class="form-label">Clé d'accès</label>
                                    <input type="text" id="rolekey" class="form-control"placeholder="Entez la clé d'accès pour déterminer votre role" required >
                                </div>
                                <div class="mb-3">
                                    <label for="register-password" class="form-label">Mot de passe</label>
                                    <input type="password" id="register-password" class="form-control" placeholder="choississez un mot de passe "required>
                                </div>
                                <div class="mb-3">
                                    <label for="register-confirm" class="form-label">Confirmer le mot de passe</label>
                                    <input type="password" id="register-confirm" class="form-control"  placeholder="Confirmez votre mot de passe "required>
                                </div>
                                <div class="mb-3 form-check">
                                    <input type="checkbox" class="form-check-input" id="terms-check" required>
                                    <label class="form-check-label" for="terms-check">J'accepte les conditions d'utilisation</label>
                                </div>
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="fas fa-user-plus me-2"></i> S'inscrire
                                </button>
                                <p class="text-center mt-3">
                                    Déjà un compte ? <a href="#login" data-page="login" class="text-decoration-none">Se connecter</a>
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