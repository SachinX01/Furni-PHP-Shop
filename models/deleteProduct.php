<?php 
header("Content-Type: application/json");
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    try {
        include "../connection/conn.php";
        include "functions.php";

        $productID = $_POST['productID'];
        
        // Delete product!
        $res = deleteProduct($productID);
        
        if ($res) {
            echo json_encode(["msg" => "Successfuly deleted product! Refreshing."]);
            http_response_code(200);
        } else {            
            echo json_encode(["msg" => "Error: server-side error."]);
            http_response_code(422);
        }
    } catch (PDOException $ex) {
        echo json_encode(["msg" => "Error: " . $ex->getMessage()]);
        http_response_code(500);
    }
} else {
    header("location: ../404.php");
}
?>