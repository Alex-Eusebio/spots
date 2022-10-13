<?php
class Skills{
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
        $sql="SELECT * FROM skills WHERE id = $id";

        $con = $this->conexao;
        $resultado=$con->query($sql);
        $dados=$resultado->fetchAll();
        return $dados;
    }

    public function infoSkill($dados){
        foreach($dados as $row){
        $name = $row["name"];
        $cost = $row["cost"];
        $inicial = $row["inicial"];
        $chargetype = $row["chargetype"];
        $activationtype = $row["activationtype"];
        $duration = $row["duration"];
        $description = $row["description"];
        $icon = "default";
        
        if ($row["icon"] != "")
            $icon = $row["icon"];
        else
            $icon = "default";
        
        ?>
        <div class="divvview">
            <img src="imgs/skills/<?=$icon?>.png" alt="<?=$icon?>" id="imgicon">
            <p id="t1"><?=$name?></p>

            <?php if($cost > 0){ ?>
            <div class="divvvv"><label id="rlytinytext">SP Cost:</label><br><?=$cost?></div>
            <?php }

            if ($inicial > 0){?>
            <div class="divvvv"><label id="rlytinytext">Inicial Cost:</label><br><?=$inicial?></div>
            <?php }
            
                switch($chargetype){
                    case 1:
                        ?><div class="divvvv" style="background-color:YellowGreen"><label id="rlytinytext">Charge Type:</label><br>Per Second</div><?php
                        break;
                    case 2:
                        ?><div class="divvvv" style="background-color:orange"><label id="rlytinytext">Charge Type:</label><br>Attacking Enemy</div><?php
                        break;
                    case 3:
                        ?><div class="divvvv" style="background-color:gray"><label id="rlytinytext">Charge Type:</label><br>Passive</div><?php
                        break;
                    case 4:
                        ?><div class="divvvv" style="background-color:LightSlateGray"><label id="rlytinytext">Charge Type:</label><br>Getting Hit</div><?php
                        break;
                }
            ?>

                <?php
                    switch($activationtype){
                        case 1:
                            ?><div class="divvvv"><label id="rlytinytext">Activation Type:</label><br>Manual Trigger</div><?php
                            break;
                        case 2:
                            ?><div class="divvvv"><label id="rlytinytext">Activation Type:</label><br>Auto Trigger</div><?php
                            break;
                        case -1:
                            break;
                    }
                ?>

                <?php
                    ?><div class="divvvv"><label id="rlytinytext">Duration:</label><br><?php
                    if ($duration < 0){
                        ?>Infinite</div><?php
                    } else if ($duration == 0) {
                        ?>Instant Attack</div><?php
                    } else {
                        ?><?=$duration?> sec</div><?php
                    }
                ?>      
                
            <br>
            <label><?=$description?></label>
        </div>
        
        <?php
        }
    }

    public function add($Pname){
        $name = $_POST[$Pname.'name'];
        $cost = $_POST[$Pname.'cost'];
        $inicial = $_POST[$Pname.'inicial'];
        $charge = $_POST[$Pname.'charge'];
        $active = $_POST[$Pname.'active'];
        $duration = $_POST[$Pname.'duration'];
        $desc = $_POST[$Pname.'desc'];
        $icon = "";
        
        if ($cost == NULL)
            $cost = 'NULL';

        if ($inicial == NULL)
            $inicial = 'NULL';

        if ($charge == NULL)
            $charge = 'NULL';

        if ($active == NULL)
            $active = 'NULL';

        if ($duration == NULL)
            $duration = 0;
            
        if ($desc == NULL)
        $desc = '';

        if (isset($_FILES[$Pname.'icon']['name']) && $_FILES[$Pname.'icon']['name'] != "")
            $icon = uploadPhoto("skills/", $name, $Pname."icon");

        if($name != ""){
            /* definir uma instrucao SQL */
            $sql="INSERT INTO skills (name, cost, inicial, chargetype, activationtype, duration, description, icon)
            VALUES ('$name', $cost, $inicial, $charge, $active, $duration, '$desc', '$icon')";

            /* enviar SQL para BD */
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

    public function addGet($id, $what){
        $sql = "SELECT $what
        FROM operators WHERE id = $id;";

        $con = $this->conexao;
        $resultado=$con->query($sql);
        $dados=$resultado->fetchAll();
        if (count($dados)>0){
            foreach($dados as $row){
                if ($row[$what] == ""){
                    $skill = $this->add($what);
                } else {
                    $skill = $this->edit($what, $row[$what]);
                }
            }
            return $skill;
        }
    }

    public function delete($id){
        try{
            $con = $this->conexao;
            $sql = "SELECT icon FROM skills WHERE id=$id";
            $resultado=$con->query($sql);
            $dados=$resultado->fetchAll();
            foreach($dados as $row){
                if (file_exists("imgs/skills/$row[icon].png"))
                    unlink("imgs/skills/$row[icon].png");
            }

            $sql = "DELETE FROM skills WHERE id=$id";
            $resultado=$con->query($sql);
        }  catch (Exception $e) {

        }
    }

    public function edit($Pname, $id){
        $name = $_POST[$Pname.'name'];
        $cost = $_POST[$Pname.'cost'];
        $inicial = $_POST[$Pname.'inicial'];
        $charge = $_POST[$Pname.'charge'];
        $active = $_POST[$Pname.'active'];
        $duration = $_POST[$Pname.'duration'];
        $desc = $_POST[$Pname.'desc'];
        $icon = "";

        if ($cost == NULL)
            $cost = 'NULL';

        if ($inicial == NULL)
            $inicial = 'NULL';

        if ($charge == NULL)
            $charge = 'NULL';

        if ($active == NULL)
            $active = 'NULL';

        if ($duration == NULL)
            $duration = 0;
            
        if ($desc == NULL)
            $desc = '';

        if (isset($_FILES[$Pname.'icon']['name']) && $_FILES[$Pname.'icon']['name'] != "")
            $icon = uploadPhoto("skills/", $name, $Pname."icon");
        else {
            $sql = "SELECT icon FROM skills WHERE id=$id";
            $con = $this->conexao;
            $resultado=$con->query($sql);
            $dados=$resultado->fetchAll();
            foreach($dados as $row){
                $icon = $row['icon'];
            }
        }

        /* definir uma instrucao SQL */
        $sql="UPDATE skills SET name = '$name', cost = $cost, inicial = $inicial, chargetype = $charge, 
        activationtype = $active, duration = $duration, description = '$desc', icon = '$icon'
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

    public function infoEdit($id, $Pname){
        if ($id != null){
            $dados = $this->showOne($id);

            foreach($dados as $row){
                ?><p id="text">Nome: <input type="text" name="<?=$Pname?>name" value="<?=$row['name']?>"></p>
                <p id="text">Icon: <input type="file" id="<?=$Pname?>icon" name="<?=$Pname?>icon" accept="image/*"></p>
                <p id="text">Custo Inicial: <input type="number" name="<?=$Pname?>inicial" value="<?=$row['inicial']?>"></p>
                <p id="text">Custo Total: <input type="number" name="<?=$Pname?>cost" value="<?=$row['cost']?>"></p>
                <p id="text">Duração <label id="tinytext">(-1 = Infinito|0 = Instantanio|>0 = Segundos)</label>: <input type="number" name="<?=$Pname?>duration" value="<?=$row['duration']?>"></p>
                <p id="text">Tipo de Carga:                                 
                    <input type="radio" id="1" name="<?=$Pname?>charge" value="1" <?= checkIfChecked($row['chargetype'], 1)?>>
                    <label id="text">Por Segundo</label>
                    <input type="radio" id="1" name="<?=$Pname?>charge" value="2" <?= checkIfChecked($row['chargetype'], 2)?>>
                    <label id="text">Ataque</label>          
                    <input type="radio" id="1" name="<?=$Pname?>charge" value="3" <?= checkIfChecked($row['chargetype'], 3)?>>
                    <label id="text">Passiva</label>
                </p>
                <p id="text">Tipo de Ativação:                                 
                    <input type="radio" id="2" name="<?=$Pname?>active" value="1"  <?= checkIfChecked($row['activationtype'], 1)?>>
                    <label id="text">Manual</label>
                    <input type="radio" id="2" name="<?=$Pname?>active" value="2"  <?= checkIfChecked($row['activationtype'], 2)?>>
                    <label id="text">Automático</label>
                </p>
                <p id="textArea">Descrição: </p><textarea rows="12" cols="62" wrap="hard" name="<?=$Pname?>desc"><?=$row['description']?></textarea><?php
            }
        } else {
            ?><p id="text">Nome: <input type="text" name="<?=$Pname?>name"></p>
            <p id="text">Icon: <input type="file" id="<?=$Pname?>icon" name="<?=$Pname?>icon" accept="image/*"></p>
            <p id="text">Custo Inicial: <input type="number" name="<?=$Pname?>inicial"></p>
            <p id="text">Custo Total: <input type="number" name="<?=$Pname?>cost"></p>
            <p id="text">Duração <label id="tinytext">(-1 = Infinito|0 = Instantanio|>0 = Segundos)</label>: <input type="number" name="<?=$Pname?>duration"></p>
            <p id="text">Tipo de Carga:                                 
                <input type="radio" id="1" name="<?=$Pname?>charge" value="1" checked>
                <label id="text">Por Segundo</label>
                <input type="radio" id="1" name="<?=$Pname?>charge" value="2">
                <label id="text">Ataque</label>          
                <input type="radio" id="1" name="<?=$Pname?>charge" value="3">
                <label id="text">Passiva</label>
            </p>
            <p id="text">Tipo de Ativação:                                 
                <input type="radio" id="2" name="<?=$Pname?>active" value="1" checked>
                <label id="text">Manual</label>
                <input type="radio" id="2" name="<?=$Pname?>active" value="2">
                <label id="text">Automático</label>
            </p>
            <p id="textArea">Descrição: </p><textarea rows="12" cols="62" wrap="hard" name="<?=$Pname?>desc"></textarea><?php
        }
    }
}