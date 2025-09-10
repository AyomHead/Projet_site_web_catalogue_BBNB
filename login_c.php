<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Bookman:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Connexion</title>
    <link rel="stylesheet" href="styles.css">
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/14273d579a.js" crossorigin="anonymous"></script>
</head>
<body>
    <main>
        <h2 class="text-center m-4 fw-bold"><i class="fas fa-sign-in-alt me-2" style="color: #0d6efd;"></i>Connexion</h2>
        <p class="text-center fw-normal">Connectez-vous pour accéder à votre espace personnel</p>
        <div class="container container-div px-4 bg-light rounded-3 py-2">
            <form method="post" class="mx-auto mt-4" style="max-width: 400px;">
                <div class="mb-3">
                    <label for="email" class="form-label fw-bold">Email</label>
                    <input type="email" class="form-control bg-outline-secondary" id="email" placeholder="Entrez votre email">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label fw-bold">Mot de passe</label>
                    <input type="password" class="form-control" id="password" placeholder="Entrez votre mot de passe">
                </div>
                <a href="#" class="mt-2 mb-2">Mot de passe oublié ?</a>
                <button type="submit" class="btn btn-primary w-30 rounded-pill d-flex justify-content-center align-items-center mt-2"><i class="fas fa-sign-in-alt me-2 " style="color: white;"></i>Se connecter</button>
                <div class="d-flex justify-content-center align-items-center mt-2">
                    <p class="me-1 d-inline text-center">Pas encore de compte ? <a href="#" class="text-center">S'inscrire</a></p>
                </div>
            </form>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>