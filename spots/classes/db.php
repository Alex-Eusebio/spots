<?php
class Bd
{
    protected $connect;
    protected $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false
    ];

    public function __construct(){
        if(file_exists('../connect.php')){
            $configs='../connect.php';
        }elseif(file_exists('../../connect.php')){
            $configs='../../connect.php';
        }elseif(file_exists('../../../connect.php')){
            $configs='../../../connect.php';
        }elseif(file_exists('../../../../connect.php')){
            $configs='../../../../connect.php';
        }else{
            $configs='../../../../../connect.php';
        }
        
        require($configs);

        $dsn="mysql:host=$server;dbname=$db;charset=utf8mb4";
        $options=$this->options;  
        try{
            $connect=new PDO($dsn,$user,$pass,$options);
            $this->connect= $connect;
        }catch(PDOException $e ){
            die("Die: ".$e->getMessage());
        }
    }
    
    public function getPDO(){
        return $this->connect;
    }

    public function getLastId($connect){
        $sql = "SELECT LAST_INSERT_ID() as id";
        foreach ($connect->query($sql) as $row) {
            return $row['id'];
        }
    }
}