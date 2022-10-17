<?php

class Users{
    private $conexao;

    public function __construct(){
        $pdo=new Bd;
        $con=$pdo->getPDO();
        $this->conexao=$con;
        unset($pdo);
    }
    public function fechaConexao(){
        unset($this->conexao);
    }

    public function login1(){
        if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['sub'])){
            $user=$_POST['fuser'];
            $pass=$_POST['fpass'];
            if($_POST['sub'] == "Login"){
                $sql="SELECT * FROM users WHERE name='$user'";
                
                $con = $this->conexao;
                $resultado=$con->query($sql);
                $dados=$resultado->fetchAll();

                /* caso a BD tenha retornado algum registo... ou seja SE o utilizador foi reconhecido  */
                if(count($dados)>0){
                    foreach($dados as $row){
                        // guardar como var local a info retornada da BD: a password encriptada e o nivel de acesso
                    $passBd=$row['pass'];
                    $nivel =$row['nivel'];
                    
                    // Verificar se a pass preenchida corresponde à pass armazenada na BD
                    if(password_verify($pass,$passBd)){
                        $_SESSION['id']=$row['id'];
                        $_SESSION['user']=$user;
                        $_SESSION['nivel']=$nivel;
                    }else{
                        $msgLog= "<p class='warnError'>A password está incorreta</p>";
                    }    
                    }
                }else{
                    $msgLog= "<p class='warnError'>O utilizador $user não foi encontrado</p>";
                }
            } else if ($_POST['sub'] == "Registar"){
                $this->createUser($user, $pass);
                $msgLog = "<p class='warnSucc'>Conta criada com sucesso</p>";
            }
        }
    
        if(!isset($msgLog)){
            $msgLog="";
        }
        return $msgLog;
    }

    function login2($msgLog=""){
        // se já há dados do user na SESSION é pq já estamos logados (escondemos o formulário)
        if(isset($_SESSION['user'])){
            $user=$_SESSION['user'];
            $id=$_SESSION['id'];
            $msgLog = '<div class="login-container">
                <a class="btn btn-secondary text-capitalize" href="perfil.php" role="button">Perfil</a> 
                <a class="btn btn-secondary text-capitalize" href="regist.php" role="button">Sair</a>
            </div>';
            
            echo '
            <table id="logTab">
                <tr>
                    <td colspan="4">'.$msgLog.'</td>
                </tr>
            </table>';
        }else{  // se não há SESSION então temos de nos logar (mostramos o formulário e a linha do msgLog: q pode trazer um erro ou o vazio "") 
            echo 
            '<div class="login-container">
                <a class="btn btn-secondary text-capitalize" href="login.php" role="button">Login</a> 
                <a class="btn btn-secondary text-capitalize" href="regist.php" role="button">Registrar</a>
            </div>';
        }
    }
 
    public function createUser($name, $mail, $pass, $tele, $admLvl){
        $pass = password_hash($pass, PASSWORD_DEFAULT);
        $time = date('d-m-y h:i:s');
        $sql="INSERT INTO users (nome, mail, pass, dataJoin, nivel, telemovel) VALUES ('$name', '$mail', '$pass', '$time', $admLvl, '$tele')";
    
        $con = $this->conexao;
        $resultado=$con->query($sql);
    }

    public function showAllUsers(){

        $sql = "SELECT * FROM users ORDER BY name ASC";
        $con = $this->conexao;
        $resultado=$con->query($sql);
        $dados=$resultado->fetchAll();
        return $dados;
    }

    public function showOneUser($id){
        $sql = "SELECT *
        FROM users
        WHERE users.id = $id;";
        $con = $this->conexao;
        $resultado=$con->query($sql);
        $dados=$resultado->fetchAll();
        return $dados;
    }

    public function infoUserIndex($dados){
        foreach($dados as $row){
            $id=$row['id'];
            $name=$row['name'];
            $isadmin=$row['isadmin'];
            $pfp=$row['profilepic'];

            if ($pfp == "")
                $pfp="default.png";

            $color = "dbdbdb";

            if ($isadmin)
                $color = "eb0000";
            ?>
            <li><a href='profile.php?id=<?=$id?>'>
                <div class="cxzita" style="border-color: #<?=$color?>">
                    <img id="imgPfp"src="imgs/pfp/<?=$pfp?>"><p id='tIndex'><?=$name?></p>
                    <br>
                </div>
            </a></li>
            <?php ;
        }
    }

    public function inforUserProfile($dados){
        foreach($dados as $row){
            $name = $row["name"];
            $pfp = $row["profilepic"];
            $nivel = $row["nivel"];
            $mail = $row["mail"];
            $tele = $row["telemovel"];

            if ($pfp == "")
                $pfp="default.png";

            ?><p class="h1 text-center text-capitalize notranslate">User Exemplo</p>
            <div class="card mb-3">
                <div class="card-body">
                <li class="media">
                    <img class="mr-3 estabLogo" src="../pfp/<?=$pfp?>" alt="Generic placeholder image">
                    <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">&#128231; Email</span>
                        </div>
                        <input readonly type="text" class="form-control notranslate" aria-describedby="basic-addon1" value="<?=$mail?>">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">&#128241; Telemóvel</span>
                            </div>
                            <input readonly type="number" class="form-control notranslate" aria-describedby="basic-addon1" value="<?$tele?>">
                        </div>
                    </li>
                    </ul>
                </li><?php
        }
    }

    public function getUserNameDel($id){
        $sql = "SELECT name, profilepic FROM users WHERE id = $id";

        $con = $this->conexao;
        $resultado=$con->query($sql);
        $dados=$resultado->fetchAll();
        foreach($dados as $row){
            $pfp = "";

            if ($row["profilepic"] == "")
                $pfp="default.png";
            ?>
            <p id="t1"> Deseja eliminar a conta do Doutor </p> <p> <label id="text"><?=$row["name"]?></label> </p> <br>
            <img id="imgIcon"src="imgs/pfp/<?=$pfp?>"><br> <?php
        }
    }

    public function userLiked($id){
        $sql="INSERT INTO users_liked_operator VALUES ($_SESSION[id], $id)";
        $con = $this->conexao;
        $resultado=$con->query($sql);
    }
    
    public function userDesliked($id){
        $sql="DELETE FROM users_liked_operator WHERE users_id = $_SESSION[id] AND operators_id = $id";        
        $con = $this->conexao;
        $resultado=$con->query($sql);
    }

    function getLikes($user){
        $sql="SELECT *
        FROM operators 
        INNER JOIN users_liked_operator ON operators.id = users_liked_operator.operators_id 
        INNER JOIN users ON users.id = users_liked_operator.users_id 
        WHERE users.id=$user";
        $con = $this->conexao;
        $resultado=$con->query($sql);
        $dados=$resultado->fetchAll();
        return $dados;
    }

    public function delete($id){
        $con = $this->conexao;
        $sql = "DELETE FROM users_liked_operator WHERE users_id = $id";
        $resultado=$con->query($sql);

        $sql = "DELETE FROM users WHERE id = $id";
        $resultado=$con->query($sql);

        if ($_SESSION['id'] == $id)
            session_destroy();

        if($resultado == TRUE){
            header("location:index.php?alerta=6");
        }else{
            header("location:index.php?alerta=0");
        }
    }

    public function infoEdit($id){
        $sql = "SELECT * FROM users WHERE users.id = $_GET[id]";

        $con = $this->conexao;
        $resultado=$con->query($sql);
        $dados=$resultado->fetchAll();
        if (count($dados)>0){
            foreach($dados as $row){
                $pfp = $row["profilepic"];
                if ($pfp == "")
                    $pfp="default.png";
                ?>
                <section class="caixa2">
                <form action="" method="POST" enctype="multipart/form-data">
                <p id="text">Foto: </p>
                <img class="imgPfp"id="imgPfp"src="imgs/pfp/<?=$pfp?>"><br>
                <input type="file" id="pfp" name="pfp" accept="image/*"></p>
                <p id="text">Nome: <input type="text" name="name" value="<?=$row['name']?>"></p>
                <?php
                if ($_SESSION['id'] != $_GET['id'] && $_SESSION['isadmin'] == TRUE){
                    ?><label>Admin:</label><br>
                    <input type="checkbox" id="isadmin" name="isadmin" value="1" <?php if ($row['isadmin']==true) echo "checked";?>>
                    <?php
                }
                
            }
        }
    }

    public function edit($id){
        $nome = $_POST['name'];
        $isadmin = 0;
        if (isset($_POST['isadmin']))
            $isadmin = $_POST['isadmin'];

        $pfp = $_FILES['pfp']['tmp_name'];

        if ($pfp == ''){
            $sql = "UPDATE users
            SET name = '$nome', isadmin = $isadmin
            WHERE id = $id";
        } else {
            deleteImgPfp($_GET['id']);
            $pfp = uploadPhoto("pfp/", $nome, "pfp");//n da upload :madge: btw muda a bd pra q o branch n seja obrigatorio
            $sql = "UPDATE users
            SET name = '$nome', profilepic = '$pfp', isadmin = $isadmin
            WHERE id = $id";
        } 
        $con = $this->conexao;
        $resultado=$con->query($sql);
        if($resultado == TRUE){
            header("location:index.php?alerta=5");
        }else{
            header("location:index.php?alerta=0");
        }
    }

    public function getImg($id){
        $sql="SELECT profilepic FROM users WHERE id=$id";
        $con = $this->conexao;
        $resultado=$con->query($sql);
        $dados=$resultado->fetchAll();

        if(count($dados)>0){
            foreach($dados as $row)
                return $row['profilepic'];
        }
    }
}