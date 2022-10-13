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
            <img class="mr-3 estabLogo" src="../imgs/cavalo.jpg" alt="Generic placeholder image">
            <div class="media-body">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">&#128231; Email</span><input readonly type="text" class="form-control notranslate" aria-describedby="basic-addon1" value="mail@mail.com">
                </div>
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">&#128197; Data de Entrada</span><input readonly type="text" class="form-control notranslate" aria-describedby="basic-addon1" value="00/00/0000">
                </div>
            </div>
        </li>
    </div>
</body>
</html>