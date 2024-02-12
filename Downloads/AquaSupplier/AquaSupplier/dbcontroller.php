<?php
error_reporting(E_PARSE);
class DBController {
	private $host = "localhost";
	private $user = "carrefre_unadmin";
	private $password = "121Google@@";
	private $database = "carrefre_universal";
	private $conn;
	
	function __construct() {
	
		$this->conn = $this->connectDB();
		$this->conn->set_charset("utf8");
	}
	
	function connectDB() {
	
		$conn = mysqli_connect($this->host,$this->user,$this->password,$this->database);
		return $conn;
	}
	
	function runQuery($query) {
		$result = mysqli_query($this->conn,$query);
		while($row=mysqli_fetch_assoc($result)) {
			$resultset[] = $row;
		}		
		if(!empty($resultset))
			return $resultset;
	}
	
	function numRows($query) {
		$result = mysqli_query($this->conn,$query);
		$rowcount = mysqli_num_rows($result);
		return $rowcount;	
	}
	function executeUpdate($query) {
        $result = mysqli_query($this->conn,$query);        
		return $result;		
    }
}
?>