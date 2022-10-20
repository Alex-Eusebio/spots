<?php
    session_start();
    require_once('../other/classes.php');

    $estabs=new Estabs;
    $result = $estabs->showAll();
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/divstruct.css" rel="stylesheet" type="text/css">
    <link href="../css/slide.css" rel="stylesheet" type="text/css">
    <script src="../jscript/slide.js"></script>
    <title>Página Inicial</title>
</head>
<body>
<?php include("../other/header.html");?>
<div id="main">
    <!-- Image text -->
    <p class="h1 text-center" id="title"></p>

    <!-- Container for the image gallery -->
<div class="container">

<!-- Full-width images with number text -->
<?=$estabs->infoEstabIndexBanner($result);?>

<!-- Next and previous buttons -->
<a class="prev" onclick="plusSlides(-1)"><&#10094;</a>
<a class="next" onclick="plusSlides(1)">&#10095;></a>

<!-- Image text -->
<div class="caption-container">
  <p id="caption"></p>
</div>

<!-- Thumbnail images -->
<div class="row">
  <?=$estabs->infoEstabIndexLogo($result);?>
</div>
<script type="text/javascript">
    currentSlide(slideIndex);
    plusSlidesAuto(0);
</script>
</div>
</div>
</body>
</html>