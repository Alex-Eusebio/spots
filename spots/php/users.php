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
                    $nivel =$row['isadmin'];
                    
                    // Verificar se a pass preenchida corresponde à pass armazenada na BD
                    if(password_verify($pass,$passBd)/*$pass==$passBd*/){
                        $_SESSION['id']=$row['id'];
                        $_SESSION['user']=$user;
                        $_SESSION['isadmin']=$nivel;
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
         $msgLog = "<p id='text'>Bem-vindo Doutor $user.<br><a href='profile.php?id=$id'>Perfil</a>|<a href='includes/logout.php'>Logout</a></p>";
         echo '
         <table id="logTab">
             <tr>
                 <td colspan="4">'.$msgLog.'</td>
             </tr>
         </table>';
     }else{  // se não há SESSION então temos de nos logar (mostramos o formulário e a linha do msgLog: q pode trazer um erro ou o vazio "") 
         echo 
         '<form method="POST" action="">
         <table id="logTab">
             <tr>
                 <td>
                     <input type="text" class="logInput" name="fuser" required  placeholder="Nome">
                 </td>
                 <td>
                     <input type="password" class="logInput" name="fpass" required  placeholder="Password">
                 </td>
                 <td>
                     <input type="submit" name="sub" value="Login">
                 </td>
                 <td>
                     <input type="submit" name="sub" value="Registar">
                 </td>
             </tr>
             <tr>
                 <td colspan="4">'.$msgLog.'</td>
             </tr>
         </table>
     </form>';
     }
 }
 
    public function createUser($name, $mail, $pass, $admLvl){
        $pass = password_hash($pass, PASSWORD_DEFAULT);
        $time = date('d-m-y h:i:s');
        $sql="INSERT INTO users (nome, mail, pass, dataJoin, isadmin) VALUES ('$name', '$mail', '$pass', '$time', $admLvl)";
    
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
            $isadmin = $row["isadmin"];

            if ($pfp == "")
                $pfp="default.png";

            if ($isadmin){
                $color = "eb0000";
            } else {
                $color = "dbdbdb";
            }

            ?><div class="diviewi">
            <div class="diiew">
                <div class="divview" style="border-color: #<?=$color?>">
                    <img id="imgPfpBig"src="imgs/pfp/<?=$pfp?>"><p id='tIndex'><?=$name?></p>
                </div>
                <?php if (isset($_SESSION["isadmin"])){
                    if ($_SESSION["isadmin"] == 1 || $_SESSION["id"] == $_GET["id"]){
                        ?><div class="divv">
                        <a href="edit_user.php?id=<?=$_GET["id"]?>" id="update">Update</a>
                        <a href="delete_user.php?id=<?=$_GET["id"]?>" id="delete">Delete</a>
                        </div><?php
                    }
                }?> 
            </div>
            <div class="nextImgDiv">
                <div class="divvview">
                    <label id="smallTitle">Favoritos</label><br>
                    <section class="cxsite">
                    <?php $likes = $this->getLikes($_GET['id']);

                    foreach($likes as $row){
                        $id=$row['op_id'];
                        $name=$row['op_name'];
                        $rarity=$row['op_rarity'];
                        $branch=$row['branch'];
                        $class=$row['class'];
                        $icon = $row['op_icon'];
                        $gender = $row['op_gender'];

                        if ($icon == ""){
                            switch ($gender) {
                                case 0:
                                    $icon="default_m";
                                    break;
                                case 1:
                                    $icon="default_f";
                                    break;
                            }
                        }

                        if ($row['op_color'] != null){
                            $color = $row['op_color'];
                        } else {
                            $color = "8a8888";
                        }
                        ?>
                        <a href='view.php?id=<?=$id?>'>
                            <div class="cxzita" style="border-color: #<?=$color?>">
                                <div class="verticalLine"><img src="imgs/classes/<?=$class?>.avif"></div>
                                <img src="imgs/branches/<?=$branch?>.avif"><br>
                                <img id="imgIcon"src="imgs/characters/icon/<?=$icon?>.png"><p id='tIndex'><?=$name?></p><?php
                                for($i=0; $i<$rarity; $i++){
                                    echo "⭐";
                                }?>
                                <br>
                            </div>
                        </a>
                        <?php ;
                    } 
                    ?>
                    </section>
                </div>
            </div>
        </div><?php
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