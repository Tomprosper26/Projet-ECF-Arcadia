<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="/assets/CSS/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

<div class="row bg-body-white">
    <div class="col-md-3 col-sm-12">
        <div class="d-flex justify-content-center">
            <h1 class="text-center font-rounded mt-3"><div class="fs-4 text-green">ARCADIA</div><div class="fs-5 text-olive">Parc Zoologique</div></h1>
        </div>
    </div>
    <div class="col-md-9 col-sm-12">
        <div class="d-flex justify-content-sm-center justify-content-md-end">
            <nav class="navbar navbar-expand-lg bg-body-white">
                <div class="mt-md-3">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                        <div class="collapse navbar-collapse" id="navbarNavDropdown">
                            <ul class="navbar-nav">
                                <li class="nav-item fs-6 mx-xxl-4 mx-xl-3">
                                    <a class="nav-link font-rounded" href="/"><p class="<?php echo ($_SERVER['REQUEST_URI'] == '/') ? 'text-olive' : 'text-brown';?>">Accueil<p></a>
                                </li>
                                <li class="nav-item fs-6 mx-xxl-4 mx-xl-3">
                                    <a class="nav-link font-rounded" href="/habitats"><p class="<?php echo ($_SERVER['REQUEST_URI'] == '/habitats') ? 'text-olive' : 'text-brown';?>">Habitats<p></a>
                                </li>
                                <li class="nav-item fs-6 mx-xxl-4 mx-xl-3">
                                    <a class="nav-link font-rounded" href="/services"><p class="<?php echo ($_SERVER['REQUEST_URI'] == '/services') ? 'text-olive' : 'text-brown';?>">Services<p></a>
                                </li>
                                <li class="nav-item fs-6 mx-xxl-4 mx-xl-3">
                                    <a class="nav-link font-rounded" href="/contact"><p class="<?php echo ($_SERVER['REQUEST_URI'] == '/contact') ? 'text-olive' : 'text-brown';?>">Contact<p></a>
                                </li>
                                <li class="nav-item fs-6 mx-xxl-4 mx-xl-3">
                                    <a class="nav-link font-rounded" href="/connexion"><p class="<?php echo ($_SERVER['REQUEST_URI'] == '/connexion') ? 'text-olive' : 'text-brown';?>">Connexion<p></a>
                                </li>
                            </ul>
                        </div>
                    </div>
            </nav>
        </div>
    </div>
</div>