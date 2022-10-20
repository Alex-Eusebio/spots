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

    public function showOne($id){
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
            <?php 
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

    function getEstabUser($user){
        $sql="SELECT estabelecimentos.id
        FROM estabelecimentos 
        INNER JOIN estab_users ON estabelecimento_id = estabelecimentos.id 
        INNER JOIN users ON users.id = estab_users.user_id 
        WHERE users.id=$user";
        $con = $this->conexao;
        $resultado=$con->query($sql);
        $dados=$resultado->fetchAll();
        return $dados;
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