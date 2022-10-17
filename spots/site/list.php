<?php
    session_start();
    require_once('../other/classes.php');

    $tags=new Tags;
    $resultTag = $tags->showAll();

    $estabs=new Estabs;
    $resultEstab = $estabs->showAll();
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/divstruct.css" rel="stylesheet" type="text/css">
    <link href="../css/styles.css" rel="stylesheet" type="text/css">
    <script src="../jscript/searchtags.js"></script>
    <title>Lista</title>
</head>
<body>
<?php include("../other/header.html");?>
<div id="main">
    <p class="h1 text-center text-capitalize">Anuncios</p>
    <div class="col-auto">
      <div class="input-group mb-2">
        <div class="input-group-prepend">
          <div class="input-group-text">&#x1F50D;</div>
        </div>
        <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="Pesquisar...">
      </div>

    <p>
        <a class="btn btn-secondary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
            Mais
        </a>
    </p>
    <div class="collapse" id="collapseExample">
        <div class="btn-group-toggle" data-toggle="badges" id="tagList">
            <?php $tags->searchTags($resultTag)?>
        </div>
    </div>
    </div>
    <div class="d-flex flex-column">
        <fieldset class="border border-warning destaques" style="margin-bottom: 1rem">
            <legend class="text-left text-capitalize">Destaques</legend>
            <div class="card mb-3 mx-auto" style="max-width: 55rem;" id="ud" name="estabCard">
            <div class="row g-0">
                <div class="col-md-5">
                    <img src="../imgs/1.jpg" class="img-fluid rounded estabImg" alt="...">
                </div>
                <div class="col-md-7">
                    <div class="card-body">
                        <h5 class="card-title" name="estab">Restaurante</h5>
                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum..</p>
                        <p class="card-text"><a href="#" class="badge badge-secondary text-capitalize" name="ud" id="1">Restaurante</a> <a href="#" class="badge badge-secondary text-capitalize" name="ud" id="agua">Água</a> <a href="#" class="badge badge-secondary text-capitalize">Portugues</a> <a href="#" class="badge badge-secondary text-capitalize" name="ud" id="4">Barato</a> <a href="#" class="badge badge-secondary text-capitalize">Frutos do Mar</a> <a href="#" class="badge badge-secondary text-capitalize">Carne</a> <a href="#" class="badge badge-secondary text-capitalize">Secundario</a></p>
                        <p class="card-text"><small class="text-muted notranslate">Manel Manel</small> <a class="btn btn-info float-md-right text-capitalize" href="estab.php" role="button">Ver</a></p>
                    </div>
                </div>
            </div>
        </div>
        </fieldset>
        <div class="card mb-3 mx-auto" style="max-width: 55rem;" id="id" name="estabCard">
            <div class="row g-0">
                <div class="col-md-5">
                    <img src="../imgs/1.jpg" class="img-fluid rounded estabImg" alt="...">
                </div>
                <div class="col-md-7">
                    <div class="card-body">
                        <h5 class="card-title" name="estab">Café</h5>
                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum..</p>
                        <p class="card-text"><a href="#" class="badge badge-secondary text-capitalize" name="id" id="2">Café</a><a href="#" class="badge badge-secondary text-capitalize" name="id" id="agua">Água</a></p>
                        <p class="card-text"><small class="text-muted notranslate">Cafe Bem Fixe</small> <a class="btn btn-info float-md-right text-capitalize" href="estab.php" role="button">Ver</a></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mb-3 mx-auto" style="max-width: 55rem;" id="pd" name="estabCard">
            <div class="row g-0">
                <div class="col-md-5">
                    <img src="../imgs/1.jpg" class="img-fluid rounded estabImg" alt="...">
                </div>
                <div class="col-md-7">
                    <div class="card-body">
                        <h5 class="card-title" name="estab">Cinema</h5>
                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum..</p>
                        <p class="card-text"><a href="#" class="badge badge-secondary text-capitalize" name="pd" id="3">Cinema</a></p>
                        <p class="card-text"><small class="text-muted notranslate">Cinemas Fixes</small> <a class="btn btn-info float-md-right text-capitalize" href="estab.php" role="button">Ver</a></p>
                    </div>
                </div>
            </div>
        </div>
        <?php $estabs->infoEstabView($resultEstab)?>
    </div>
</body>
</html>