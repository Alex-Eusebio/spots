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
        <input type="text" class="form-control" id="inlineFormInputGroup" onkeyup="searchText(this)" placeholder="Pesquisar...">
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
    <div class="d-flex flex-column content">
        <fieldset class="border border-warning destaques" style="margin-bottom: 1rem">
            <legend class="text-left text-capitalize">Destaques</legend>
        </fieldset>
        <?php $estabs->infoEstabList($resultEstab)?>
    </div>
</body>
</html>