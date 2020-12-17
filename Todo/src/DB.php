<?php
namespace App;
 class DB extends \PDO{
    static $instance;
    protected array $config;

    public function __construct(){
        $config=$this->loadConf();
        //var_dump($config);
        //determinar env pro o dev
        $strdbconf='dbconf_'.$this->env();
        $dbconf=(array)$config->$strdbconf;
        $dsn=$dbconf['driver'].':host='.$dbconf['dbhost'].';dbname='.$dbconf['dbname'];
        $usr=$dbconf['dbuser'];
        $pwd=$dbconf['dbpass'];
        parent::__construct($dsn,$usr,$pwd);
        
    }
    static function singleton(){
        if(!(self::$instance instanceof self)){
            self::$instance=new self();
        }
        return self::$instance;
    }

    private function loadConf(){
        $file="config.json";
        $jsonStr=file_get_contents($file);
        $arrayJson=json_decode($jsonStr);
        return $arrayJson;
    }

    protected function env(){
        $ipAddress = gethostbyname($_SERVER['SERVER_NAME']);
        if ($ipAddress=='127.0.0.1'){
            return 'dev';
        }else{
            return 'pro';
        }
    }
  

//Funció de inserción de datos
function insert($table, $data): bool
{

    if (is_array($data)) {
        $columns = '';
        $bindv = '';
        $values = null;

        foreach ($data as $column => $value) {
            $columns .= '`' . $column . '`,';
            $bindv .= '?,';
            $values[] = $value;
        }

        $columns = substr($columns, 0, -1);
        $bindv = substr($bindv, 0, -1);

        $sql = "INSERT INTO {$table}({$columns}) VALUES ({$bindv})";

        try {
            $stmt = self::$instance->prepare($sql);

            $stmt->execute($values);
        } catch (\PDOException $e) {
            echo $e->getMessage();
            return false;
        }

        return true;
    }
    return false;
}




//Función select
    function selecAll($table,array $fields=null):array{
        
        if (is_array($fields)){
            $columns=implode(',',$fields);
        }else{
            $columns="*";
        }
            $sql="SELECT {$columns} FROM {$table}";

            $stmt=self::$instance->prepare($sql);
            $stmt->execute();
            $rows=$stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $rows;
    }
    //Función select con join
    function selectAllWithJoin($table1,$table2,array $fields=null,string $join1,string $join2, array $conditions):array
    {
        if (is_array($fields)){
            $columns=implode(',',$fields);
            
        }else{
            $columns="*";
        }
       
        $inners="{$table1}.{$join1} = {$table2}.{$join2}";
        $cond = "{$conditions[0]}='{$conditions[1]}'";
        $sql="SELECT {$columns} FROM {$table1} INNER JOIN {$table2} ON {$inners} WHERE {$cond}";
        
        $stmt=self::$instance->prepare($sql);
        $stmt->execute();
        $rows=$stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $rows;
    }
  //Función select con una condición
  function selectTaskUser($table, array $fields = null, array $conditions): array
  {

      if (is_array($fields)) {
          $columns = implode(',', $fields);
      } else {
          $columns = "*";
      }
      $cond = "{$conditions[0]}='{$conditions[1]}'";
      $sql = "SELECT {$columns} FROM {$table} WHERE {$cond} ";
      $stmt = self::$instance->prepare($sql);
      $stmt->execute();
      $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
      return $rows;
  }

//Función eliminar 
function delete($tbl, $id)
{
    
$sql = "DELETE FROM {$tbl} WHERE titulo = '$id'";
    
    $stmt = self::$instance->prepare($sql);
    
    $res = $stmt->execute();
   
    if ($res) {
        return true;
    } else {
        return false;
    }
}
//Función actualizar 
function update(string $table, array $data, array $conditiona){
    if($data){
        $keys=array_keys($data);
        $values=array_values($data);
        $changes="";
        for($i=0;$i<count($keys);$i++){
            $changes.=$keys[$i].'='.$values[$i].',';
        }
        $changes=substr($changes,0,-1);
        $cond="{$conditiona[0]}='{$conditiona[1]}'";
        $sql="UPDATE {$table} SET {$changes} WHERE {$cond}";
        $stmt=self::$instance->prepare($sql);
        $res=$stmt->execute();
        if($res){
            return true; 
        }else{
            return false; 
    }
    }
   
}
}