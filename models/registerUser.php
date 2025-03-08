<?php
header("Content-Type: application/json");
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    try {
        include "../connection/conn.php";
        include "functions.php";

        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $city = $_POST['city'];
        $address = $_POST['address'];
        $password = $_POST['password'];
        $rPassword = $_POST['rPassword'];
        $phone = $_POST['phone'];

        $errors = 0;
        $regName = "/^[A-ZŠĐČĆŽ]{1}[A-zŠĐČĆŽšđčćž]{2,20}$/";
        $regUsername = "/^[A-zŠĐČĆŽšđčćž]{1}[\wŠĐČĆŽšđčćž\-\.]{6,20}[A-zŠĐČĆŽšđčćž0-9]{1}$/";
        $regEmail = "/^[a-zšđčćž]{1}[a-zšđčćž0-9\.]+[a-zšđčćž0-9]@[a-zšđčćž\.]+[\.]+[a-z]{2,}$/";
        $regPassword = "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[\\\!\@\#\$\%\^\&\*\(\)\_\+\{\}\:\"\|\<\>\?\[\]\;\'\,\.\/\`\§\±\~]).{8,}$/";
        $regPhone = "/^\+1-[0-9]{3}-[0-9]{3}-[0-9]{4}$/";

        // Checking if username, email and phone exists already
        $usernameExists = doesUsernameExists($username);
        $emailExists = doesEmailExists($email);
        $phoneExists = doesPhoneExists($phone);

        if ($usernameExists && $emailExists && $phoneExists) {
            echo json_encode(["msg" => "Same username, email and phone number already exists!"]);
            http_response_code(409);
        } else if ($usernameExists) {
            echo json_encode(["msg" => "Username already exists!"]);
            http_response_code(409);
        } else if ($emailExists) {
            echo json_encode(["msg" => "Email already exists!"]);
            http_response_code(409);
        } else if ($phoneExists){
            echo json_encode(["msg" => "Phone already exists!"]);
            http_response_code(409);
        } 
        else {
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


            if ($username == "") {
                $errors++;
            } else if (!preg_match($regUsername, $username)) {
                $errors++;
            }


            if ($email == "") {
                $errors++;
            } else if (!preg_match($regEmail, $email)) {
                $errors++;
            }


            if ($city == "0") {
                $errors++;
            }


            if ($address == "") {
                $errors++;
            } else if (strlen($address) <= 3) {
                $errors++;
            }


            if ($password == "") {
                $errors++;
            } else if (!preg_match($regPassword, $password)) {
                $errors++;
            }


            if ($rPassword == "") {
                $errors++;
            } else if ($rPassword != $password) {
                $errors++;
            }


            if ($regPhone == "") {
                $errors++;
            } else if (!preg_match($regPhone, $phone)) {
                $errors++;
            }

            if ($errors == 0) {
                $encryptPass = password_hash($password, PASSWORD_DEFAULT);
                $result = insertNewUser($firstName, $lastName, $username, $email, $city, $address, $encryptPass, $phone);
                
                if ($result) {
                    echo json_encode(["msg" => "Successfuly registered!"]);
                    http_response_code(201);
                } else {
                    echo json_encode(["msg" => "Error: syntax error."]);
                    http_response_code(422);
                }
            }
        }
    } catch (PDOException $ex) {
        echo json_encode(["msg" => "Error: " . $ex->getMessage()]);
        http_response_code(500);
    }
} else {
    header("location: ../404.php");
}