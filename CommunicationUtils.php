<?php
    class CommunicationUtils{
        public static  $enablecrmdebug;
        public static  $php_debug_enable = true;
  var $dbConnection;
        public static function debugLog($message)
        {
            $enablecrmdebug =1;
            if(!$enablecrmdebug) return;
            $logfile='/Query.log'; //address here for file
            $now = "\n[".date("Y-M-d H:i:s")."] ";
            $message = $now. $message;
            error_log($message,3,$logfile);
            error_log($message);
            if($enablecrmdebug==2) echo  "<br>".$message;
        }
  public function __construct () {
   require('config.php');
                $dbIP = $defaultAmeyoIP;
                $dbName =$dataBaseName;
                 $dbUser =$dataBaseUser;
                $connection = pg_connect("host=$dbIP user=$dbUser dbname=$dbName ");
                    if(!$connection)
                    {
                      die("Database Connection Error");
                    } else {
                  $this->dbConnection = $connection;

              }
  }
  public function getConnection() {
          return $this->dbConnection;
  }

  public function save() {
     $msg="";
        $con=$this->getConnection();
        $keyValue= implode(',', $this->fields);
        $tmp ="";
        foreach ($this->values as $fvalue) {
                $tmp .= "'".$fvalue."'".',';
        }
        $data = trim($tmp,',');
        
  $sql = "INSERT INTO $this->table ($keyValue) values ($data)";
        self::debugLog("query=".$sql);
  $query  = pg_query($con,$sql);
        $response=array();
        if($query) {
                $last_inserted_id = pg_fetch_array($query);
                $response['result'] ='SUCCESS';
        }else {
                $response['result'] ='FAILURE';
        }
        $response['data'] =$data;
        echo json_encode($response);
        pg_close($this->dbConnection);
  }
  
  function retrieve(){
    $i=1;
    $con=$this->getConnection();
        $sql = "SELECT * FROM $this->table";
       $result = pg_query($con,$sql);
       $data =array();
       $cnt=0;
       while($row = pg_fetch_assoc($result)) {
               $data[$i] = $row;
               $i++;
         }
         $data['query']=$sql;
       echo json_encode($data);
       pg_close($con);
  }
  function delete(){
    $con=$this->getConnection();
       $sql = "DELETE FROM $this->table where phone = '".$this->id."'";
       $result = pg_query($con,$sql);
       $response=array();
       if($result)
       {
        $response['result'] ='SUCCESS';
       }
       else {
        $response['result'] = 'FAILURE';
       }
    echo json_encode($response);
        pg_close($this->dbConnection);
}
function update(){
    $con=$this->getConnection();
        $sql = "UPDATE $this->table set name = '".$this->values[1]."',email='".$this->values[2]."'where phone = '".$this->values[0]."'";
        $response=array();
       $result = pg_query($con,$sql);
       if($result)
       {
        $response['result'] ='SUCCESS';
       }
       else {
        $response['result'] = 'FAILURE';
       }
       $response['query']=$sql;
    echo json_encode($response);
    pg_close($this->dbConnection);
}

 } 
 
 
