<?php
require_once("dbcontroller.php");
$db_handle = new DBController();
$edval=strip_tags($_POST["editval"], '<p><a>');
$result = $db_handle->executeUpdate("UPDATE water_supply_master set " . $_POST["column"] . " = '$edval' WHERE  water_supply_id=".$_POST["id"]);
?>