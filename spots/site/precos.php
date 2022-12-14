<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/divstruct.css" rel="stylesheet" type="text/css">
    <link href="../css/styles.css" rel="stylesheet" type="text/css">
    <title>Preços</title>
</head>
<body>
<?php include("../other/header.html");?>
<div id="main">
    <p class="h1 text-center">Preços</p>

    <div class="d-flex justify-content-around">
    <div class="card cartao" style="width: 18rem;">
    <img class="card-img-top precoImg" src="../imgs/cavalo.jpg" alt="Card image cap">
    <div class="card-body">
        <h5 class="card-title">Cavalo Marinho</h5>
        <p class="card-text">Pode criar um anuncio no nosso site.</p>
        <a href="add_estab.php?tier=1" class="btn btn-primary align-text-bottom">00.00€</a>
    </div>
    </div>

    <div class="card cartao" style="width: 18rem;">
    <img class="card-img-top precoImg" src="../imgs/camaleao.jpg" alt="Card image cap">
    <div class="card-body">
        <h5 class="card-title">Camaleão</h5>
        <p class="card-text">Pode criar um anuncio no nosso site, terá prioridade nas pesquisas e poderá aparecer nos destaques.</p>
        <a href="add_estab.php?tier=2" class="btn btn-primary align-text-bottom">00.00€</a>
    </div>
    </div>

    <div class="card cartao" style="width: 18rem;">
    <img class="card-img-top precoImg" src="../imgs/cegonha.jpg" alt="Card image cap">
    <div class="card-body">
        <h5 class="card-title">Cegonha</h5>
        <p class="card-text">Pode criar um anuncio no nosso site, terá mais prioridade nas pesquisas, poderá aparecer nos destaques e aparecerá na primeira página.</p>
        <a href="add_estab.php?tier=3" class="btn btn-primary align-text-middle">00.00€</a>
    </div>
    </div>
    </div>
</div>
</body>
</html>