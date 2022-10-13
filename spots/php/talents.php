<?php
class Talents{
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

    public function showOne($id){
        $sql="SELECT * FROM talents WHERE id = $id";

        $con = $this->conexao;
        $resultado=$con->query($sql);
        $dados=$resultado->fetchAll();
        return $dados;
    }

    public function infoTalent($dados){
        foreach($dados as $row){

            $name = $row["name"];
            $description = $row["description"];

            ?>
            
            <div class="divvview">
                <p id="t1"><?=$name?></p>
                <label><?=$description?></label>
            </div><?php
        
        }
    }

    public function add($Pname){
        $name = $_POST[$Pname."Name"];
        $desc = $_POST[$Pname."Desc"];

        /* definir uma instrucao SQL */
        $sql="INSERT INTO talents (name, description)
        VALUES ('$name', '$desc')";

        $con = $this->conexao;
        $resultado=$con->query($sql);

        /* verificar o sucesso na inserçao dos dados na BD*/
        if($resultado === FALSE){
            header("location:index.php?alerta=0");
        }

        $db = new Bd();
        return $db->getLastId($con);
    }

    public function addGet($id, $what){
        $sql = "SELECT $what
        FROM operators WHERE id = $id;";

        $con = $this->conexao;
        $resultado=$con->query($sql);
        $dados=$resultado->fetchAll();
        if (count($dados)>0){
            foreach($dados as $row){
                if ($row[$what] == ""){
                    $talent = $this->add($what);
                } else {
                    $talent = $this->edit($what, $row[$what]);
                }
            }
            return $talent;
        }
    }

    public function delete($id){
        $con = $this->conexao;
        try{
            $sql = "DELETE FROM talents WHERE id=$id";
            $resultado=$con->query($sql);
        }  catch (Exception $e) {

        }

    }

    public function infoEdit($id, $Pname){
        if ($id != null){
            $dados = $this->showOne($id);

            foreach($dados as $row){
                ?><p id="text">Nome: <input type="text" name="<?=$Pname?>Name" value="<?=$row['name']?>"></p>
                <p id="textArea">Descrição: </p><textarea rows="6" cols="42" wrap="hard" name="<?=$Pname?>Desc"><?=$row['description']?></textarea><?php
            }
        } else {
            ?><p id="text">Nome: <input type="text" name="<?=$Pname?>Name"></p>
                <p id="textArea">Descrição: </p><textarea rows="6" cols="42" wrap="hard" name="<?=$Pname?>Desc"></textarea><?php
        }
    }

    public function edit($Pname, $id){
        $name = $_POST[$Pname."Name"];
        $desc = $_POST[$Pname."Desc"];

        /* definir uma instrucao SQL */
        $sql="UPDATE talents SET name = '$name', description = '$desc'
        WHERE id = $id";

        $con = $this->conexao;
        $resultado=$con->query($sql);

        /* verificar o sucesso na inserçao dos dados na BD*/
        if($resultado === FALSE){
            header("location:index.php?alerta=0");
        }

        $db = new Bd();
        return $db->getLastId($con);
    }
}