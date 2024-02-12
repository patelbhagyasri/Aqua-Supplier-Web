<?php 
session_start();
class db{
	private $host = "localhost";
	private $user = "root";
	private $password = "";
	private $database = "aquasupplier";
	private $conn = "";
	
	
	private $result; //recordset
	private $last_query; //last query
	private $error; // error message
	private $magic_quotes_active; //boolean variable
	private $real_escape_string; //boolean variable
	private $errormsg=array(
							'1440'=>'The record is in use somewhere else'
							);
// for database conectivity andselect data call every tyme when class is call 
	function __construct() {
		$this->connect();
		$this->magic_quotes_active=get_magic_quotes_gpc();
		$this->real_escape_string=function_exists("mysql_real_escape_string");
	}
	
	
	//destructor call dissconnect function
	function __destruct()
	{
		$this->disconnect();
	}
	
//funciton to close connection
	public function disconnect()
	{
		if(isset($this->conn) && $this->conn)
		{
			mysqli_close($this->conn);
			unset($this->conn);
		}
	}
	
// sever connection function
	function connect() {
		//check if any connection already exists, close that connection
		$this->disconnect();
		$this->conn = mysqli_connect($this->host,$this->user,$this->password,$this->database);	
		$this->conn->set_charset("utf8");
		if(!$this->conn)
		{
			die("Database Connection Failed : ".mysqli_error());
		}
        
	}

	

	
	
		//function to set Error Msg
	private function seterror($myerr,$myerrno=0)
	{
		if(isset($this->errormsg[$myerrno])) $myerr=$this->errormsg[$myerrno];
		
		$this->error="Query Exceution Failed :".$myerr;
		$this->error.="<br />Last Query : ".$this->last_query;
	}
	
	//public funtion to send error to user
	public function geterror()
	{
		return $this->error;
	}
	
	public function lastquery()
	{
		return $this->last_query;
	}
	
	
//method to prepare string for various sql operation
	public function prepdata($sqldata)
	{
		if($this->real_escape_string)
		{
			if($this->magic_quotes_active) { 
				$sqldata=stripslashes($sqldata); 
			}
			$sqldata=mysqli_real_escape_string($this->conn,$sqldata);
		}
		else
		{
			if(!$this->magic_quotes_active) { $sqldata=addslashes($sqldata); }
		}
		return $sqldata;
	}
	
	
	//function to execute query
	public function query($sql)
	{
		$this->last_query=$sql;
		$this->result=mysqli_query($this->conn,$sql);
		if($this->result)
		{
			return $this->result;
		}
		else
		{
			$this->seterror(mysqli_error(),mysqli_errno());
			return NULL;
		}
	}
	
	//method to get id of last inserted record
	public function getlastid()
	{
		return mysqli_insert_id($this->conn);
	}
   
    //method to get number of affected rows
	public function getaffectedrows()
	{
		return mysqli_affected_rows($this->conn);
	}
	

	
 //for data insertation  
    public function insert($table,$data){

	 if(count($data)>0)
		{
			$strField="";
			$strVal="";
			foreach($data as $field=>$val)
			{
				$strField.="`".$field."`".",";
				if(is_null($val)) { $strVal.='NULL,'; }
				else { $strVal.= "'".$this->prepdata($val)."',"; }
			}
			$strField=rtrim($strField,',');
			$strVal=rtrim($strVal,',');
			
			$sql="insert into `$table` ";
			$sql.="(".$strField.") values ";
			$sql.="(".$strVal.")";
			
			return $this->query($sql);
		}
		else
		{
			$this->seterror("No fields present in array");
			return NULL;
		}

    } 

	
//	for upadate data in data base
	function update($table,$data,$condition=""){
		
		$strval='';
		if(count($data)>0)
		{
			foreach($data as $field=>$val)
			{
				if(is_null($val)) { $strval.="`$field`=NULL,"; }
				else { $strval.="`$field`='".$this->prepdata($val)."',"; }
			}
			$strval=rtrim($strval,',');
			$sql="update `$table` set $strval";
			if(!is_null($condition)) { $sql.=" ".$condition; }
			
			$rs = $this->query($sql);
			if($rs)
			{
				return $this->getaffectedrows();
			}
			else
			{
				return NULL;
			}
		}
		else
		{
			$this->seterror("No fields present in array");
			return NULL;
		}
	 
    }
	
// for delete data from database table

	function delete($table,$condition=""){
		
	 	$sql="delete from `$table`";
		if(!is_null($condition)) { $sql.=" ".$condition; }
		$rs=$this->query($sql);
		if($rs)
		{
			return $this->getaffectedrows();
		}
		else
		{
			return NULL;
		}
		
	}
	
	
//select data from databse all row with one array

	function select($table,$condition="",$field="*"){

	  $sql="select $field from $table $condition";
	  
	  
	 $aryResult=array();
		
		$result=$this->query($sql);
		
		if(!is_null($result)) 
		{ 
			while($row=mysqli_fetch_array($result)) { $aryResult[]=$row; }
			return $aryResult;
		}
		else
		{
			return NULL;
		}
    }
		
//select data from databse one row	
function selectone($table,$condition="",$fields="*")
{
	
	$sql = "select $fields from $table $condition";
	$result=$this->query($sql);
		
		if(!is_null($result)) 
		{ 
			return $row=mysqli_fetch_array($result);
			 
		}
		else
		{
			return NULL;
		}
}	 
	
//count row 
function countdata($table,$condition="",$fields="*")
{
	$sql = "select count( $fields ) from $table $condition";
	$result=$this->query($sql);
	if(!is_null($result)) 
		{ 
			$count=mysqli_fetch_row($result);
			return $count[0]; 
		}
		else
		{
			return NULL;
		}

}


 
}
//end class db
?>