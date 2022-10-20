<?php
class Estabs{
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
        $sql="SELECT *
        FROM estabelecimentos";
        $con = $this->conexao;
        $resultado=$con->query($sql);
        $dados=$resultado->fetchAll();
        return $dados;
    }

    public function showOne($id){
        $sql = "SELECT *
        FROM estabelecimentos WHERE id = $id;";
        
        $con = $this->conexao;
        $resultado=$con->query($sql);
        $dados=$resultado->fetchAll();
        return $dados;
    }

    public function infoEstabUser($dados){
        foreach($dados as $row){
            $id = $row["id"];
            $name = $row["nome"];
            $msg = $row["msg"];
            $logo = $row["logo"];
            $views = $row["views"];
            $viewsLast = $row["views"] - $row["viewsLast"];
            $favLast = $this->getFav($id) - $row["favLast"];

            if ($viewsLast >= 0)
                $viewText = $views."(+".$viewsLast.")";
            else
                $viewText = $views."(".$viewsLast.")";

            if ($favLast >= 0)
                $favText =  $this->getFav($id)."(+".$favLast.")";
            else
                $favText =  $this->getFav($id)."(".$favLast.")";
        
            $tags = new Tags;
            $result = $this->getTags($id);
            ?>
            <p class="h2 text-center text-capitalize notranslate"><?=$name?></p>
            <div class="card-body">
            <li class="media">
                <img class="mr-3 estabLogo" src="../imgs/logo/<?=$logo?>" alt="Generic placeholder image">
                <div class="media-body">
                    <?=$msg?>
                    <p class="card-text"><a class="btn btn-info float-md-right text-capitalize" href="estab.php" role="button">Página da Empresa</a> <a class="btn btn-info float-md-right text-capitalize" href="estab.php" role="button">Editar Empresa</a></p>
                </div>
            </li>
            </div>
            <ul class="list-group list-group-flush">
            <li class="list-group-item">
                <?=$tags->infoTags($result, $id)?>
            </li>
            <li class="list-group-item">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">&#128064; Visualizações</span>
                    </div>
                    <input readonly type="text" class="form-control notranslate" aria-describedby="basic-addon1" value="<?=$viewText?>">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">&#11088; Favoritos</span>
                    </div>
                    <input readonly type="text" class="form-control notranslate" aria-describedby="basic-addon1" value="<?=$favText?>">
                </div>
                <span id="basic-addon1">*(+/-) é a diferença desde o último mês</span>
            </li>
            </ul>
            <?php
        
        }
    }

    public function infoEstabList($dados){
        foreach($dados as $row){
            $id = $row["id"];
            $name = $row["nome"];
            $msg = $row["msg"];
            $banner = $row["banner"];
        
            $tags = new Tags;
            $result = $this->getTags($id);
            ?>
            <div class="card mb-3 mx-auto" style="max-width: 55rem;" id="<?=$id."ID"?>" name="estabCard">
                <div class="row g-0">
                    <div class="col-md-5">
                        <img src="../imgs/banner/<?=$banner?>" class="img-fluid rounded estabImg" alt="...">
                    </div>
                    <div class="col-md-7">
                        <div class="card-body">
                            <h5 class="card-title notranslate" name="estab"><?=$name?></h5>
                            <p class="card-text"><?=$msg?></p>
                            <p class="card-text"><?=$tags->infoTags($result, $id)?></p>
                            <p class="card-text"><small class="text-muted notranslate">Manel Manel</small> <a class="btn btn-info float-md-right text-capitalize" href="estab.php?id=<?=$id?>" role="button">Ver</a></p>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        
        }
    }

    public function getTags($id){
        $sql="SELECT id, nome FROM categorias 
        INNER JOIN categorias_estab ON categorias.id = categorias_estab.categorias_id 
        WHERE estab_id=$id";
        $con = $this->conexao;
        $resultado=$con->query($sql);
        $dados=$resultado->fetchAll();
        return $dados;
    }

    public function getContactos($id){
        $sql="SELECT numero, contactos_tel.desc, categoria FROM contactos_tel 
        INNER JOIN estabelecimentos ON contactos_tel.estabelecimento_id = estabelecimentos.id 
        WHERE estabelecimento_id=$id";
        $con = $this->conexao;
        $resultado=$con->query($sql);
        $dados=$resultado->fetchAll();

        foreach($dados as $row){
            $numero = $row['numero'];
            $desc = $row['desc'];
            $categoria = $row['categoria'];

            switch($categoria){
                case 0:
                    $categoria = "&#128241; Telemóvel";
                    break;
                case 1:
                    $categoria = "&#9742; Telefone";
                    break;
                case 2:
                    $categoria = "&#128224; Fax";
                    break;
                default:
                    $categoria = "&#10068; ???";
                    break;
            }

            if ($desc != "")
                $categoria = $categoria . " (" . $desc . ")";

            ?><div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><?=$categoria?></span>
                </div>
                <input readonly type="text" class="form-control notranslate" aria-describedby="basic-addon1" value="<?=$numero?>">
            </div><?php
        }
    }

    public function infoOperatorDel($id){
        $dados = $this->showOne($id);
        
        foreach($dados as $row){
        ?>
        <label id="text"><?=$row["name"]?></label> </p> <br>
        <img id="imgIcon"src="imgs/characters/icon/<?=$row["icon"]?>.png"><br><?php
        }
    }

    function getFav($estab){
        $sql="SELECT COUNT(users.id) FROM users 
        INNER JOIN user_fav_estab ON users.id = user_fav_estab.user_id 
        INNER JOIN estabelecimentos ON user_fav_estab.estabelecimento_id = estabelecimentos.id
        WHERE estabelecimentos.id = $estab";
        $con = $this->conexao;
        $resultado=$con->query($sql);
        $dados=$resultado->fetchAll();
        foreach($dados as $row)
            return $row["COUNT(users.id)"];
    }

    function checkLike($op){
        $user = new Users;
        if (isset($_SESSION['id'])){
            if (isset($_GET['like'])){
                if ($_GET['like']==1){
                    $user->userLiked($op);
                } else if ($_GET['like']==0){
                    $user->userDesliked($op);
                }
            }
            ?><label id="text"><?=$this->numLikes($op)?></label><?php
    
            $sql="SELECT * FROM users_liked_operator WHERE users_id=$_SESSION[id] AND operators_id=$op";
            $con = $this->conexao;
            $resultado=$con->query($sql);
            $dados=$resultado->fetchAll();

            if ($dados){
                if (count($dados)>0){
                    likeButton(true, true);
                } else {
                    likeButton(false, true);
                }
            } else {
                likeButton(false, true);
            }
        } else {
            ?><label id="text"><?=$this->numLikes($op)?></label><?php
            likeButton(false, false);
        }
    }

    public function delete($id){
        $con = $this->conexao;
        $skills = new Skills;
        $talents = new Talents;

        $sqlOther = "SELECT skill1, skill2, skill3, talent1, talent2 FROM operators WHERE id=$id";
        $resultOther=$con->query($sqlOther);
        $dados=$resultOther->fetchAll();
        foreach($dados as $row){
            $skill1 = $row['skill1'];
            $skill2 = $row['skill2'];
            $skill3 = $row['skill3'];
            $talent1 = $row['talent1'];
            $talent2 = $row['talent2'];
        }

        $sql = "UPDATE operators
        SET branch = NULL, skill1 = NULL,  skill2 = NULL, skill3 = NULL,  talent1 = NULL, talent2 = NULL
        WHERE id = $id";
        $resultado=$con->query($sql);

        if ($skill1 != "")
            $skills->delete($skill1);
   
        if ($skill2 != "")
            $skills->delete($skill2);

        if ($skill3 != "")
            $skills->delete($skill3);

        if ($talent1 != "")
            $talents->delete($talent1);

        if ($talent2 != "")
            $talents->delete($talent2);

        $sql = "DELETE FROM users_liked_operator WHERE operators_id = $id";
        $resultado=$con->query($sql);

        $sql = "DELETE FROM operators WHERE id=$id";
        $resultado=$con->query($sql);

        return $resultado;
    }

    public function add(){
        $name= $_POST['name'];
        $gender= $_POST['gender'];
        $rarity= $_POST['stars'];
        $branch= $_POST['branch'];
        $color= $_POST['color'];
        $position= $_POST['pos'];
        $block= $_POST['block'];
        $atktime= $_POST['atktime'];
        $maxhp= $_POST['maxhp'];
        $atk= $_POST['atk'];
        $def= $_POST['def'];
        $magicresis= $_POST['magicresis'];
        
        $talents = new Talents;
        if ($_POST['talent1Name'] != "")
            $talent1= $talents->add("talent1");

        if ($_POST['talent2Name'] != "")
            $talent2= $talents->add("talent2");
        
        $skills = new Skills;

        if ($_POST['skill1name'] != "")
            $skill1 = $skills->add("skill1");

        if ($_POST['skill2name'] != "")
            $skill2 = $skills->add("skill2");

        if ($_POST['skill3name'] != "")
            $skill3 = $skills->add("skill3");

        $icon = '';
        $portrait='';
        $chibi='';

        if ($_FILES['icon']['name'] != '')
            $icon = uploadPhoto("characters/icon/", $name, "icon");

        if ($_FILES['portrait']['name'] != '')
            $portrait = uploadPhoto("characters/portrait/", $name, "portrait");

        if ($_FILES['chibi']['name'] != '')
            $chibi = uploadPhoto("characters/chibi/", $name, "chibi");

        $color = substr($color, 1);

        if (!isset($talent1))
            $talent1 = 'NULL';

        if (!isset($talent2))
            $talent2 = 'NULL';

        if (!isset($skill1))
            $skill1 = 'NULL';

        if (!isset($skill2))
            $skill2 = 'NULL';

        if (!isset($skill3))
            $skill3 = 'NULL';

        /* definir uma instrucao SQL */
        $sql="INSERT INTO operators (name, gender, rarity, color, position, branch, maxhp, attack, defence, magicresis, block, attacktime, skill1, skill2, skill3, talent1, talent2, icon, portrair, chibi)
        VALUES ('$name', $gender, $rarity, '$color', $position, $branch, $maxhp, $atk, $def, $magicresis, $block, $atktime, $skill1, $skill2, $skill3, $talent1, $talent2, '$icon', '$portrait', '$chibi')";

        $con = $this->conexao;
        $resultado=$con->query($sql);

        /* verificar o sucesso na inserçao dos dados na BD*/
        if($resultado != TRUE){
            header("location:index.php?alerta=1");
        }else{
            header("location:index.php?alerta=0");
        }
    }

    public function getTalentsInfo($id, $what){
        $con = $this->conexao;
        $sql = "SELECT $what
        FROM operators WHERE id = $id;";

        $resultado=$con->query($sql);
        $dados=$resultado->fetchAll();
        if (count($dados)>0){
            foreach($dados as $row){
                $talent = $row[$what];                
                $talents = new Talents;

                $talents->infoEdit($talent, $what);
            }
        }
    }

    public function getSkillsInfo($id, $what){
        $con = $this->conexao;
        $sql = "SELECT $what
        FROM operators WHERE id = $id;";

        $resultado=$con->query($sql);
        $dados=$resultado->fetchAll();
        if (count($dados)>0){
            foreach($dados as $row){
                $skill = $row[$what];                
                $skills = new Skills;

                $skills->infoEdit($skill, $what);
            }
        }
    }

    public function infoEdit($id){
        $con = $this->conexao;
        $sql = "SELECT operators.name AS name, operators.gender AS gender, operators.rarity AS rarity, operators.color AS color, operators.position AS pos, 
        branch.id AS branch, operators.maxhp AS maxhp, operators.attack AS attack, operators.defence AS defence, operators.magicresis AS magicresis, 
        operators.block AS block, operators.attacktime AS attacktime, operators.portrair AS portrait, operators.chibi AS chibi,
        operators.skill1 AS skill1, operators.skill2 AS skill2, operators.skill3 AS skill3, operators.talent1 AS talent1,
        operators.talent2 AS talent2
        FROM operators INNER JOIN branch ON operators.branch = branch.id
        INNER JOIN class ON branch.class = class.id WHERE operators.id = $id;";

        $resultado=$con->query($sql);
        $dados=$resultado->fetchAll();
        if (count($dados)>0){
            foreach($dados as $row){
                $name = $row["name"];
                $gender = $row["gender"];
                $rarity = $row["rarity"];
    
                if ($row['color'] != null){
                    $color = $row['color'];
                } else {
                    $color = "8a8888";
                }
    
                $pos = $row["pos"];
                $branch = $row["branch"];
    
                $maxhp = $row["maxhp"];
                $attack = $row["attack"];
                $defence = $row["defence"];
                $magicresis = $row["magicresis"];
                $block = $row["block"];
                $attacktime = $row["attacktime"];
    
                $skill1 = $row["skill1"];
                $skill2 = $row["skill2"];
                $skill3 = $row["skill3"];
    
                $talent1 = $row["talent1"];                
                $talent2 = $row["talent2"];
    
                $portrait = $row["portrait"];
                $chibi = $row["chibi"];
                ?>
                <p class="t1" id="text"> Editar <?=$name?> </p> <br>
                <div class="horizontalLine"></div>
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="divvv">
                        <p id="text">Nome: <input type="text" name="name" required value="<?=$name?>"></p>
                    </div>
                    <div class="divvv">
                        <p id="text">Género: 
                        <input type="radio" id="0" name="gender" value="0" required <?=checkIfChecked($gender, 0)?>>
                        <label id="text" style="color:LightSkyBlue">♂</label>
                        <input type="radio" id="1" name="gender" value="1" required <?=checkIfChecked($gender, 1)?>>
                        <label id="text" style="color:LightCoral">♀</label>
                        </p>
                    </div>
                    <div class="divvv">
                        <p id="text">Estrelas⭐: <input type="number" name="stars" min=1 max=6 required value="<?=$rarity?>"></p>
                    </div>
                    <div class="divvv">
                        <p id="text">Ramo da Classe:   
                        <select name="branch" id="branch" required>
                            <option hidden selected value=""> --- </option>
                            <?php
                            $branches = new Branches;
                            $branches->getDropDown($branch);?>    
                        </select> 
                        </p>
                    </div>
                    <div class="divvv">
                        <p id="text">Cor simbolico: <input type="color" name="color" value="#<?=$color?>"></p>
                    </div>
                    <div class="horizontalLine"></div>
                    <div class="divvv">
                        <p id="text">Posição: 
                        <input type="radio" id="0" name="pos" value="0" <?=checkIfChecked($pos, 0)?>>
                        <label id="text">Melee</label>
                        <input type="radio" id="1" name="pos" value="1" <?=checkIfChecked($pos, 1)?>>
                        <label id="text">Ranged</label>
                        </p>
                    </div>
                    <div class="divvv">
                        <p id="text">Bloqueio: <input type="number" name="block" min=0 max=5 required value="<?=$block?>"></p>
                    </div>
                    <div class="divvv">
                        <p id="text">Tempo de Ataque: <input type="number" name="atktime" step=0.01 min=0 max=100 required value="<?=$attacktime?>"></p>
                    </div>
                    <div class="horizontalLine"></div>
                    <div class="divvv">
                        <p id="text">Vida máxima: <input type="number" name="maxhp" min=0 required value="<?=$maxhp?>"></p>
                    </div>
                    <div class="divvv">
                        <p id="text">Ataque: <input type="number" name="atk" min=0 required value="<?=$attack?>"></p>
                    </div>
                    <div class="divvv">
                        <p id="text">Defesa: <input type="number" name="def" min=0 required value="<?=$defence?>"></p>
                    </div>
                    <div class="divvv">
                        <p id="text">Resistencia Mágica: <input type="number" name="magicresis" min=0 max=100 required value="<?=$magicresis?>"></p>
                    </div>
                    <div class="horizontalLine"></div>
                    <div class="div"> 
                </div>
                    <p><input type="submit" value="Editar">
                    <input type="reset" value="Refazer"></p>
                </div><?php
            }
        } else {
            header("location:view.php?id=$_GET[id]&error=2");
        }
    }

    public function editVals($id, $edit, $what){
        $con = $this->conexao;
        if ($edit == "NULL"){
            $sql="SELECT $what FROM operators
            WHERE id = $id;";
             $resultado=$con->query($sql);
             $dados=$resultado->fetchAll();
             
             foreach($dados as $row){
                $editedVal = $row[$what];
             }
        }
        try{
            $sql="UPDATE operators
            SET $what = $edit
            WHERE id = $id;";
            $resultado=$con->query($sql);
        } catch (Exception $a){

        }
        
        if (isset($editedVal))
            return $editedVal;
    }

    public function edit($id){
        // criar variaveis com os valores recebidos do formulario (array POST)
        $name= $_POST['name'];
        $gender= $_POST['gender'];
        $rarity= $_POST['stars'];
        $branch= $_POST['branch'];
        $color= $_POST['color'];
        $position= $_POST['pos'];
        $block= $_POST['block'];
        $atktime= $_POST['atktime'];
        $maxhp= $_POST['maxhp'];
        $atk= $_POST['atk'];
        $def= $_POST['def'];
        $magicresis= $_POST['magicresis'];

        $talent1= $_POST['talent1Name'];
        $talent2= $_POST['talent2Name'];
        $skill1= $_POST['skill1name'];
        $skill2= $_POST['skill2name'];
        $skill3= $_POST['skill3name'];

        $talents = new Talents;
        $skills = new Skills;
    
        if ($skill1 == ''){
            $skill1 = "NULL";
            $oldSkill = $this->editVals($id, $skill1, "skill1");
            $skills->delete($oldSkill);
        }else {
            $skill1=$skills->addGet($id, "skill1");
            $this->editVals($id, $skill1, "skill1");
        }

        if ($skill2 == ''){
            $skill2 = "NULL";
            $oldSkill = $this->editVals($id, $skill2, "skill2");
            $skills->delete($oldSkill);
        }else {
            $skill2=$skills->addGet($id, "skill2");
            $this->editVals($id, $skill2, "skill2");
        }

        if ($skill3 == ''){
            $skill3 = "NULL";
            $oldSkill = $this->editVals($id, $skill3, "skill3");
            $skills->delete($oldSkill);
        }else {
            $skill1=$skills->addGet($id, "skill3");
            $this->editVals($id, $skill1, "skill3");
        }

        if ($talent1 == ''){
            $talent1 = "NULL";
            $oldTalent = $this->editVals($id, $talent1, "talent1");
            $talents->delete($oldTalent);
        } else {
            $talent1=$talents->addGet($id, "talent1");
            $this->editVals($id, $talent1, "talent1");
        }
        
        if ($talent2 == ''){
            $talent2 = "NULL";
            $oldTalent = $this->editVals($id, $talent2, "talent2");
            $talents->delete($oldTalent);
        }else {
            $talent2=$talents->addGet($id, "talent2");
            $this->editVals($id, $talent2, "talent2");
        }
    
        $nameUncap = strtolower($name);
        $color = substr($color, 1);

        /* definir uma instrucao SQL */
        try{
        $sql="UPDATE operators
        SET name = '$name', gender = $gender,  rarity = $rarity, color = '$color',  position = $position, branch = $branch,  
        maxhp = $maxhp, attack = $atk,  defence = $def, magicresis = $magicresis,  block = $block, attacktime = $atktime, 
        skill1 = $skill1,  skill2 = $skill2, skill3 = $skill3
        WHERE id = $id;";

        /* enviar SQL para BD */
        $con = $this->conexao;
        $resultado=$con->query($sql);
        } catch (Exception $a){
            $sql="UPDATE operators
            SET name = '$name', gender = $gender,  rarity = $rarity, color = '$color',  position = $position, branch = $branch,  
            maxhp = $maxhp, attack = $atk, defence = $def, magicresis = $magicresis,  block = $block, attacktime = $atktime
            WHERE id = $id;";

            /* enviar SQL para BD */
            $con = $this->conexao;
            $resultado=$con->query($sql);
        }

        if($resultado != FALSE){
            header("location:index.php?alerta=2");
        }else{
            header("location:index.php?alerta=0");
        }
    }
}