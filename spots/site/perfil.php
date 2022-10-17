<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/divstruct.css" rel="stylesheet" type="text/css">
    <link href="../css/styles.css" rel="stylesheet" type="text/css">
    <title class="notranslate">Utilizador</title>
</head>
<body>
<?php include("../other/header.html");?>
<div id="main">
    <p class="h1 text-center text-capitalize notranslate">User Exemplo</p>
    <div class="card mb-3">
        <div class="card-body">
        <li class="media">
            <img class="mr-3 estabLogo" src="../imgs/cegonha.jpg" alt="Generic placeholder image">
            <ul class="list-group list-group-flush">
            <li class="list-group-item">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">&#128231; Email</span>
                </div>
                <input readonly type="text" class="form-control notranslate" aria-describedby="basic-addon1" value="mail@mail.com">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">&#128241; Telemóvel</span>
                    </div>
                    <input readonly type="number" class="form-control notranslate" aria-describedby="basic-addon1" value="9888888">
                </div>
            </li>
            </ul>
        </li>
    </div>
    
    <div class="card mb-3">
        <p class="h1 text-center text-capitalize">A tua empresa</p>
        <p class="h2 text-center text-capitalize notranslate">Empresa Exemplo</p>
        <div class="card-body">
        <li class="media">
            <img class="mr-3 estabLogo" src="../imgs/cavalo.jpg" alt="Generic placeholder image">
            <div class="media-body">
                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                <p class="card-text"><a class="btn btn-info float-md-right text-capitalize" href="estab.php" role="button">Página da Empresa</a> <a class="btn btn-info float-md-right text-capitalize" href="estab.php" role="button">Editar Empresa</a></p>
            </div>
        </li>
        </div>
        <ul class="list-group list-group-flush">
        <li class="list-group-item">
            <a href="#" class="badge badge-secondary text-capitalize">Restaurante</a> <a href="#" class="badge badge-secondary text-capitalize">Peixe</a> <a href="#" class="badge badge-secondary text-capitalize">Portugues</a> <a href="#" class="badge badge-secondary text-capitalize">Barato</a> <a href="#" class="badge badge-secondary text-capitalize">Frutos do Mar</a> <a href="#" class="badge badge-secondary text-capitalize">Carne</a> <a href="#" class="badge badge-secondary text-capitalize">Secundario</a></p>
        </li>
        <li class="list-group-item">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">&#128064; Visualizações</span>
                </div>
                <input readonly type="text" class="form-control notranslate" aria-describedby="basic-addon1" value="111 (+34)">
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">&#11088; Favoritos</span>
                </div>
                <input readonly type="text" class="form-control notranslate" aria-describedby="basic-addon1" value="7 (-2)">
            </div>
            <span id="basic-addon1">*(+/-) é a diferença desde o último mês</span>
        </li>
        </ul>
    </div>
</body>
</html>