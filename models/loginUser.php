<?php
session_start();
header("Content-Type: application/json");
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    try {
        include "../connection/conn.php";
        include "functions.php";

        $email = $_POST['email'];
        $password = $_POST['password'];

        $errors = 0;
        $regEmail = "/^[a-zšđčćž]{1}[a-zšđčćž0-9\.]+[a-zšđčćž0-9]@[a-zšđčćž\.]+[\.]+[a-z]{2,}$/";
        $regPassword = "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[\\\!\@\#\$\%\^\&\*\(\)\_\+\{\}\:\"\|\<\>\?\[\]\;\'\,\.\/\`\§\±\~]).{8,}$/";

        if ($email == "") {
            $errors++;
        } else if (!preg_match($regEmail, $email)) {
            $errors++;
        }


        if ($password == "") {
            $errors++;
        } else if (!preg_match($regPassword, $password)) {
            $errors++;
        }

        
        if ($errors == 0) {
            $result = loginUser($email, $password);
            $_SESSION['user'] = $result;
            
            if ($result) {
                echo json_encode($result);
                http_response_code(200);
            } else {
                echo json_encode(["msg" => "Account doesn't exists."]);
                http_response_code(401);
            }
        }
    } catch (PDOException $ex) {
        echo json_encode(["msg" => "Error: " . $ex->getMessage()]);
        http_response_code(500);
    }
} else {
    header("location: ../404.php");
}