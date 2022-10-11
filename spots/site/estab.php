<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/divstruct.css" rel="stylesheet" type="text/css">
    <link href="../css/styles.css" rel="stylesheet" type="text/css">
    <title class="notranslate">Estabelecimento</title>
</head>
<body>
<?php include("../other/header.html");?>
<div id="main">
    <p class="h1 text-center text-capitalize notranslate">Estabelecimento Exemplo</p>
    <div class="card mb-3">
        <img class="card-img-top" src="../imgs/1.jpg" alt="Card image cap">
        <div class="card-body">
        <li class="media">
            <img class="mr-3 estabLogo" src="../imgs/cavalo.jpg" alt="Generic placeholder image">
            <div class="media-body">
            Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
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
                    <span class="input-group-text" id="basic-addon1">&#127968; Morada</span>
                </div>
                <input readonly type="text" class="form-control notranslate" aria-describedby="basic-addon1" value="Rua do Tóze nº1 8700-123">
            </div>
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
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">&#9742; Telefone</span>
                </div>
                <input readonly type="number" class="form-control notranslate" aria-describedby="basic-addon1" value="9888888">
            </div> 
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">&#128224; Fax</span>
                </div>
                <input readonly type="number" class="form-control notranslate" aria-describedby="basic-addon1" value="9888888">
            </div>
        </li>
        </ul>
    </div>
</body>
</html>