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

}
?>
