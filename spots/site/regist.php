<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/divstruct.css" rel="stylesheet" type="text/css">
    <link href="../css/login.css" rel="stylesheet" type="text/css">
    <link href="../css/regist.css" rel="stylesheet" type="text/css">    
    <title>Registar</title>
</head>
<body>
<?php include("../other/header.html");?>
<div id="main">
<section class="vh-100">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-6 text-black">

        <div class="px-5 ms-xl-4">
          <i class="fas fa-crow fa-2x me-3 pt-5 mt-xl-4" style="color: #709085;"></i>
          <span class="h1 fw-bold mb-0">Logo</span>
        </div>

        <div class="d-flex align-items-center h-custom-2 px-5 ms-xl-4 mt-5 pt-5 pt-xl-0 mt-xl-n5">

          <form style="width: 23rem;">

            <h3 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Registar</h3>

            <div class="form-outline mb-4">
              <label for="inputEmail" class="form-label text-capitalize">Email</label>
              <input type="email" class="form-control" id="inputEmail" placeholder="Email" required>
            </div>

            <div class="form-outline mb-4">
              <label for="inputNome" class="form-label text-capitalize">Nome de Utilizador</label>
              <input type="text" class="form-control" id="inputNome" placeholder="Utilizador" required>
            </div>

            <div class="form-outline mb-4">
            <label for="inputPassword" class="form-label text-capitalize">Palavra Pass</label>
            <input type="password" class="form-control" id="inputPassword" placeholder="Palavra Pass" 
            pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,25}" 
            title="Deverá conter pelo menos um número, uma letra maiuscula, uma letra minuscula e deve conter entre 8 a 25 characteres" 
            required>
            </div>
            <div class="form-label text-capitalize">Mostrar Palavra Pass</div>
          <div class="col-sm-0">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" onclick="checkPass()">
            </div>
          </div>

            <div class="pt-1 mb-4">
              <button class="btn btn-info btn-lg btn-block text-capitalize" type="button">Entrar</button>
            </div>

          </form>
        </div>

      </div>
      <div class="col-sm-6 px-0 d-none d-sm-block bg-image-vertical">
        <img src="../imgs/regbg.jpg"
          alt="Login image" class="w-100 vh-100" style="object-fit: cover; object-position: left;">
      </div>
    </div>
    <div id="message" class="col-sm-6">
        <h3>A palavra pass deverá conter o seguinte:</h3>
        <p id="letter" class="invalid">Uma letra <b>minuscula</b></p>
        <p id="capital" class="invalid">Uma letra <b>maiuscula</b></p>
        <p id="number" class="invalid">Um <b>número</b></p>
        <p id="length" class="invalid">Pelo menos <b>8 caracteres</b> e no máximo <b>25 caracteres</b></p>
      </div>
  </div>
</section>
<script src="../jscript/password.js"></script>
</div>
</body>
</html>