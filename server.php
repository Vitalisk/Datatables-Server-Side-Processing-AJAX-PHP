<?php  
class Auth {		
    
    public function __construct(){

        //This model calls a database PDO method get_data_sql_all
        $this->auth_model = $this->model('Auth_model');

    }
    
    public function getRoles($id=null){
			
			$draw = $_POST['draw'];
			$row = $_POST['start'];
			$rowperpage = $_POST['length']; // Rows display per page
			$columnIndex = $_POST['order'][0]['column']; // Column index
			$columnName = $_POST['columns'][$columnIndex]['data']; // Column name
			$columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
			$searchValue = $_POST['search']['value']; // Search value ;
			$searchArray = array();
			
			
			## Total number of records without filtering
			$array_column = array(' id '); 
			$totalRecords = $this->auth_model->get_data_count('tbl_role', $array_column);
			
			
			
			## Total number of records with filtering
			$q_one='';
			$q_one="SELECT id FROM tbl_role";
			if($searchValue != ''){
			   $q_one .= " WHERE (role LIKE '%$searchValue%' OR status LIKE '%$searchValue%') ";
			}
			$totalRecordwithFilter = $this->auth_model->get_data_where_count_sql($q_one);
			
			
			## Total number of records with filtering
			$sql='';				
			$sql.="SELECT 
					r.id, 
					r.role, 
					r.status, 
					CONCAT(u.first_name, ' ' ,u.last_name) AS names 
				   FROM tbl_role r INNER JOIN tbl_users u ON u.user_id = r.by_who 
				   ";
				   
			if($searchValue != ''){
			   $sql .= " AND (r.role LIKE '%$searchValue%' OR r.status LIKE '%$searchValue%' OR u.first_name LIKE '%$searchValue%' OR u.last_name LIKE '%$searchValue%') ";
			}
			
			if($rowperpage == -1)
			{
				$rowperpage = $totalRecords; 
			}
			
			$sql .= "LIMIT $row , $rowperpage ";
			
			$datas = $this->auth_model->get_data_sql_all($sql);
			
			$i = 1;
			$ar=array();
			if($datas){
			foreach($datas as $rec){
				$label = $rec['status'] =='active' ? ' label-success' : 'label-danger';
				$button_status='<span class="label '.$label.'">'.ucfirst($rec['status']).'</span>';
				$check_box = "<input type='checkbox' class='delete_check checkbox' id='delcheck_".$rec['id']."' value='".$rec['id']."'>";
				$id=$rec['id'];
				$table='tbl_role';
				$permission='<button id="'.$id.'" name="auth" href="permission" class="btn btn-primary btn-sm permission_button"><i class="icon ni ni-account-setting-alt"></i> &nbsp;Permisson </button>';
				$button_delete='<button id="'.$id.'" name="auth" href="tbl_role" target="id" title="Role"  class="btn btn-danger btn-sm delete_button"><i class="icon ni ni-cross-c"></i> </button>';
				$button_edit='<button name="auth" id="'.$id.'"href="roles" class="btn btn-info btn-sm edit_button"><i class="icon ni ni-edit"></i> </button>';
				
				$ar[]=array($i++, $check_box, $rec['role'], $rec['names'], $button_status, '<center>'.$permission.'&nbsp;'.$button_delete.'&nbsp;'.$button_edit.'</center>');
			}unset($rec);	
			}

			$dom['draw']= $draw;
			$dom['iTotalRecords']=$totalRecords;
			$dom['iTotalDisplayRecords']=$totalRecordwithFilter;
			$dom['aaData']=$ar;
			echo json_encode($dom);
		}
    
 }
?>
