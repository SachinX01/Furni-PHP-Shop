<?php
session_start();
header("Content-Type: application/json");
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    try {
        include "../connection/conn.php";
        include "functions.php";



        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $email = $_POST['email'];
        $msg = $_POST['msg'];



        $errors = 0;
        $regName = "/^[A-ZŠĐČĆŽ]{1}[A-zŠĐČĆŽšđčćž]{2,20}$/";
        $regEmail = "/^[a-zšđčćž]{1}[a-zšđčćž0-9\.]+[a-zšđčćž0-9]@[a-zšđčćž\.]+[\.]+[a-z]{2,}$/";
        $regMsg = "/^[\wŠĐČĆŽšđčćž`\s\.,!?()'\"-]{1,230}$/";



        if ($firstName == "") {
            $errors++;
        } else if (!preg_match($regName, $firstName)) {
            $errors++;
        }



        if ($lastName == "") {
            $errors++;
        } else if (!preg_match($regName, $lastName)) {
            $errors++;
        }



        if ($email == "") {
            $errors++;
        } else if (!preg_match($regEmail, $email)) {
            $errors++;
        }



        if ($msg == "") {
            $errors++;
        } else if (!preg_match($regMsg, $msg)) {
            $errors++;
        }


        if ($errors == 0) {
            $result = sendMessage($firstName, $lastName, $email, $msg);
            
            if ($result) {
                echo json_encode(["msg" => "Message sent successfuly."]);
                http_response_code(201);
            } else {
                echo json_encode(["msg" => "There was an error while trying to send a message, try again later."]);
                http_response_code(422);
            }
        }
    } catch (PDOException $ex) {
        echo json_encode(["msg" => "Error: " . $ex->getMessage()]);
        http_response_code(500);
    }
} else {
    header("location: ../404.php");
}