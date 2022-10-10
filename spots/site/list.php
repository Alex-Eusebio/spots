<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/divstruct.css" rel="stylesheet" type="text/css">
    <link href="../css/styles.css" rel="stylesheet" type="text/css">
    <title>Lista</title>
</head>
<body>
<?php include("../other/header.html");?>
<div id="main">
    <p class="h1 text-center text-capitalize">Anuncios</p>
    <div class="d-flex flex-column">
        <fieldset class="border border-warning destaques" style="margin-bottom: 1rem">
            <legend class="text-left text-capitalize">Destaques</legend>
            <div class="card mb-3 mx-auto" style="max-width: 680px;">
            <div class="row g-0">
                <div class="col-md-4">
                    <img src="../imgs/1.jpg" class="img-fluid rounded estabImg" alt="...">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">Restaurante</h5>
                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum..</p>
                        <p class="card-text"><a href="#" class="badge badge-secondary text-capitalize">Restaurante</a> <a href="#" class="badge badge-secondary text-capitalize">Peixe</a> <a href="#" class="badge badge-secondary text-capitalize">Portugues</a> <a href="#" class="badge badge-secondary text-capitalize">Barato</a> <a href="#" class="badge badge-secondary text-capitalize">Marisco</a> <a href="#" class="badge badge-secondary text-capitalize">Carne</a> <a href="#" class="badge badge-secondary text-capitalize">Secundario</a></p>
                        <p class="card-text"><small class="text-muted">3 mins atras</small></p>
                    </div>
                </div>
            </div>
        </div>
        </fieldset>
        <div class="card mb-3 mx-auto" style="max-width: 680px;">
            <div class="row g-0">
                <div class="col-md-4">
                    <img src="../imgs/1.jpg" class="img-fluid rounded estabImg" alt="...">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">Restaurante</h5>
                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum..</p>
                        <p class="card-text"><small class="text-muted">3 mins atras</small></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>