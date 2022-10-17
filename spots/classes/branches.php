<?php
class Branches{
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

    public function getDropDown($id){
        $sql = "SELECT id, name FROM branch;";
    
        $con = $this->conexao;
        $resultado=$con->query($sql);
        $dados=$resultado->fetchAll();

        foreach($dados as $row){ 
            if ($id==0) {?>
            <option value="<?=$row["id"]?>"> <?=$row["name"]?> </option><?php 
            }else {
                ?><option value="<?=$row["id"]?>" <?=checkIfRight($id, $row["id"])?>> <?=$row["name"]?> </option><?php 
            }
        } 
        
        
    }
}
