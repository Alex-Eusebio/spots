<?php
class Tags{
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

    public function showAll(){
        $sql="SELECT * FROM categorias";

        $con = $this->conexao;
        $resultado=$con->query($sql);
        $dados=$resultado->fetchAll();
        return $dados;
    }

    public function showOne($id){
        $sql="SELECT * FROM categorias WHERE id = $id";

        $con = $this->conexao;
        $resultado=$con->query($sql);
        $dados=$resultado->fetchAll();
        return $dados;
    }

    public function infoTags($dados, $estabId){
        foreach($dados as $row){
            $id = $row["id"];
            $name = $row["nome"];

            ?>
            
            <a href="#" class="badge badge-secondary text-capitalize" name="<?=$estabId?>" id="<?=$id?>"><?=$name?></a><?php
        }
    }

    public function searchTags($dados){
        foreach($dados as $row){
            $id = $row["id"];
            $name = $row["nome"];

            ?>
            
            <label class="badge badge-secondary text-capitalize active">
                <input type="checkbox" name="tags" id="<?=$id?>" onclick="searchTags()"> <?=$name?>
            </label><?php
        
        }
    }

    public function add($Pname){
        $name = $_POST[$Pname."Name"];

        /* definir uma instrucao SQL */
        $sql="INSERT INTO categotias (name) VALUES ('$name')";

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