<?php
    session_start();
    require_once('../other/classes.php');

    $tier = $_GET['tier'];

    $estabs=new Estabs;
    $result = $estabs->showOne($id);
    foreach($result as $row){
        $nome = $row['nome'];
        $morada = $row['morada'];
        $codpost = $row['codigoPostal'];
        $mail = $row['mail'];
        $msg = $row['msg'];
        $logo = $row['logo'];
        $banner = $row['banner'];
    }

    $tags = new Tags;
    $resultTags = $estabs->getTags($id);
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
    <title class="notranslate"><?=$nome?></title>
</head>
<body>
<?php include("../other/header.html");?>
<div id="main">
    <p class="h1 text-center text-capitalize notranslate"><?=$nome?></p>
    <div class="card mb-3">
        <img class="card-img-top" src="../imgs/banner/<?=$banner?>" alt="Card image cap">
        <div class="card-body">
        <li class="media">
            <img class="mr-3 estabLogo" src="../imgs/logo/<?=$logo?>" alt="Generic placeholder image">
            <div class="media-body">
                <?=$msg?>
            </div>
        </li>
        </div>
        <ul class="list-group list-group-flush">
        <?php if (sizeof($resultTags) > 0) { ?>
        <li class="list-group-item">
            <?=$tags->infoTags($resultTags, $id)?>
        </li>
        <?php }  ?>
        <li class="list-group-item">
        <?php if ($morada != "" || $codpost != "") { ?>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">&#127968; Morada</span>
                </div>
                <input readonly type="text" class="form-control notranslate" aria-describedby="basic-addon1" value="<?=$morada." ".$codpost?>">
            </div>
            <?php } ?>
            <?php if ($mail != "") { ?>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">&#128231; Email</span>
                </div>
                <input readonly type="text" class="form-control notranslate" aria-describedby="basic-addon1" value="<?=$mail?>">
            </div>
            <?php } ?>
            <?=$estabs->getContactos($id)?>           
        </li>
        <?php $produtos = $estabs->getProdutos($id)?>
        <?php if (sizeof($produtos) > 0){ ?>
        <li class="list-group-item">
            <h4>Produtos</h4>
            <ul class="list-group">
                <?php 
                foreach($produtos as $row){
                    $nome = $row["nome"];
                    $preco = $row["preco"];
                    ?> <li class="list-group-item"><?=$nome?> - <?=$preco."€"?></li> <?php
                }?>
                <li class="list-group-item"></li>
            </ul>
        </li>
        <?php } ?>
        </ul>
    </div>
</body>
</html>