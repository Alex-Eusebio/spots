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
    <title>Registrar</title>
</head>
<body>
<?php include("../other/header.html");?>
<div id="main">
<form>
  <div class="form-group row">
    <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
    <div class="col-sm-10">
      <input type="email" class="form-control" id="inputEmail" placeholder="Email" required>
    </div>
  </div>
  <div class="form-group row">
    <label for="inputNome" class="col-sm-2 col-form-label">Nome de Utilizador</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="inputNome" placeholder="Utilizador" required>
    </div>
  </div>
  <div class="form-group row">
    <label for="inputPassword" class="col-sm-2 col-form-label">Palavra Pass</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" id="inputPassword" placeholder="Palavra Pass" 
      pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,25}" 
      title="Deverá conter pelo menos um número, uma letra maiuscula, uma letra minuscula e deve conter entre 8 a 25 characteres" 
      required>
    </div>
  </div>
  <div class="form-group row">
    <div class="col-sm-2">Mostrar Palavra Pass</div>
    <div class="col-sm-0">
      <div class="form-check">
        <input class="form-check-input" type="checkbox" onclick="checkPass()">
      </div>
    </div>
  </div>
    <div class="form-group row">
    <div class="col-sm-10">
      <button type="submit" class="btn btn-info">Sign in</button>
    </div>
  </div>
</form>

<div id="message">
  <h3>A palavra pass deverá conter o seguinte:</h3>
  <p id="letter" class="invalid">Uma letra <b>minuscula</b></p>
  <p id="capital" class="invalid">Uma letra <b>maiuscula</b></p>
  <p id="number" class="invalid">Um <b>número</b></p>
  <p id="length" class="invalid">Pelo menos <b>8 characteres</b> e no máximo <b>25 characteres</b></p>
</div>
<script src="../jscript/password.js"></script>
</div>
</body>
</html>