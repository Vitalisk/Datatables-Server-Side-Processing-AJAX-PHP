<?php

class Auth_model{

    protected $db;
   
    public function __construct(){
       $db_conn = new Database;
       $this->db = $db_conn->connect();
       return $this->db;
    } 

    public function get_data_sql_all($sql){

      $stmt = $this->db->query($sql);		
      $rows = $stmt->fetchAll();
      if ($stmt->rowCount() > 0) {
        return $rows;
      }
      return false;

    }	
    
    public function get_data_count($table,$array_column){
	
		$column = implode(", ", $array_column);
		
		$stmt_gets=$this->db->prepare(sprintf("SELECT $column FROM $table ORDER by id DESC"));
		$stmt_gets->execute();
		$count = $stmt_gets->rowCount();
		return $count;		
		
	}	

}
?>
