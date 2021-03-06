<?php
  /*
   * PDO Database Class
   * Connect to database
   * Create prepared statements
   * Bind values
   * Return rows and results
   */
	class Database {
	
		protected $db_conn;
		protected $db_host = DB_HOST;
		protected $db_name = DB_NAME;
		protected $db_user = DB_USER;
		protected $db_pass = DB_PASS;
		 
		public function connect(){
			try{
			  $this->db_conn = new PDO("mysql:host=$this->db_host;dbname=$this->db_name",$this->db_user,$this->db_pass);
			  return $this->db_conn;
			}
			catch(PDOException $e){
				return $e->getMessage();
			}
		}
	}
