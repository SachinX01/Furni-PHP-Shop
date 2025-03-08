<?php 
header("Content-Type: application/json");
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    try {
        include "../connection/conn.php";
        include "functions.php";

        $catID = $_POST['catID'];
        $colorID = $_POST['colorID'];
        $search = $_POST['search'];
        $sortBy = $_POST['sortBy'];
        $sendPage = isset($_POST['sendPage']) ? $_POST['sendPage'] : 0;

        if($catID == null) $catID = 0;

        $res = filterProductsAndSort($catID, $colorID, $search, $sortBy, $sendPage);
        
        if ($res) {
            echo json_encode($res);
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