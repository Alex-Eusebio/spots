<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/divstruct.css" rel="stylesheet" type="text/css">
    <link href="../css/login.css" rel="stylesheet" type="text/css">
    <title>Entrar</title>
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

            <h3 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Entrar</h3>

            <div class="form-outline mb-4">
              <label class="form-label text-capitalize" for="form2Example18">Email</label>
              <input type="email" id="form2Example18" class="form-control form-control-lg" />
            </div>

            <div class="form-outline mb-4">
              <label class="form-label text-capitalize" for="form2Example28">Palavra Pass</label>
              <input type="password" id="form2Example28" class="form-control form-control-lg" />
            </div>

            <div class="pt-1 mb-4">
              <button class="btn btn-info btn-lg btn-block text-capitalize" type="button">Entrar</button>
            </div>

            <p class="small mb-5 pb-lg-2 text-capitalize"><a class="text-muted" href="#!">Esqueceu-se da palavra pass?</a></p>
            <p class="text-capitalize">Ainda não tem conta? <a href="regist.php" class="link-info text-capitalize">Registe-se aqui!</a></p>

          </form>

        </div>

      </div>
      <div class="col-sm-6 px-0 d-none d-sm-block bg-image-vertical">
        <img src="../imgs/logbg.jpg"
          alt="Login image" class="w-100 vh-100" style="object-fit: cover; object-position: left;">
      </div>
    </div>
  </div>
</section>
</div>
</body>
</html>