<?php 
header('Content-Type: application/json');
include "../connection/conn.php";
include "functions.php";
$phpNameArray = getAnyTable("user"); // Fetch names from database
echo json_encode($phpNameArray); // Output JSON data
?>