<?php
    session_start();
    require_once('../other/classes.php');

    $tier = $_GET['tier'];
    $id = 1;

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
    <div class="jumbotron">
    <p class="h1 text-center text-capitalize">Novo Estabelecimento</p>
    <form>
        <div class="form-group">
            <label for="exampleFormControlInput1">Nome</label>
            <input type="text" class="form-control" name="nome" placeholder="Empresa Exemplo">
        </div>
        <div class="form-group">
            <label for="exampleFormControlInput1">Morada</label>
            <input type="text" class="form-control" name="morada" placeholder="Rua dos Exemplos nº10">
        </div>
        <div class="form-group">
            <label for="exampleFormControlInput1">Código Postal</label>
            <input type="text" class="form-control" name="cod_post" placeholder="3700-000" pattern="^\d{4}-\d{3}$" title="4 números - 3 números">
        </div>
        <div class="form-group">
            <label for="exampleFormControlTextarea1">Descrição</label>
            <textarea class="form-control" name="msg" rows="4" placeholder="Descrição do seu estabelecimento para atrair clientes"></textarea>
        </div>
        <button type="submit" class="btn btn-primary mb-2">Confirm identity</button>
    </form>
    </div>
</div>
</body>
</html>