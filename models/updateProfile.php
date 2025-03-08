<?php
session_start();
header("Content-Type: application/json");
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    try {
        include "../connection/conn.php";
        include "functions.php";

        $userID = $_SESSION['user']->id_user;
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $phone = $_POST['phone'];
        $cityID = $_POST['city'];
        $address = $_POST['address'];

        $errors = 0;
        $regName = "/^[A-ZŠĐČĆŽ]{1}[A-zŠĐČĆŽšđčćž]{2,20}$/";
        $regPhone = "/^\+1-[0-9]{3}-[0-9]{3}-[0-9]{4}$/";
        


        if (isset($_FILES['file'])) {
            $fileName = $_FILES['file']['name'];
            $fileTmpName = $_FILES['file']['tmp_name'];
            $fileSize = $_FILES['file']['size'];
            $fileError = $_FILES['file']['error'];
            $fileType = $_FILES['file']['type'];

            $fileExt = explode('.', $fileName);
            $fileActualExt = strtolower(end($fileExt));

            $allowed = array('jpg', 'jpeg', 'png', 'svg');

            if (in_array($fileActualExt, $allowed)) {
                if ($fileError === 0) {
                    if ($fileSize < 5000000) {
                        $movePath = "../assets/images/profile/" . $fileName;
                        $nameImage = $fileExt[0];

                        $res = updateInsertProfileProductImage("profile", $userID, $nameImage, "assets/images/profile/" . $fileName, $fileTmpName);

                        if ($res) {
                            move_uploaded_file($fileTmpName, $movePath);    
                        } else {
                            echo json_encode(['error' => 'An image with this name already exists. Please choose a different image.']);
                            http_response_code(422);
                            exit();
                        }
                    } else {
                        echo json_encode(['error' => "Your file is too big!"]);
                        http_response_code(422);
                    }
                } else {
                    echo json_encode(['error' => "There was an error uploading your file!"]);
                    http_response_code(422);
                }
            } else {
                echo json_encode(['error' => "You cannot upload files of this type!"]);
                http_response_code(422);
            }
        }


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


        if ($regPhone == "") {
            $errors++;
        } else if (!preg_match($regPhone, $phone)) {
            $errors++;
        }


        if ($cityID == "0") {
            $errors++;
        }


        if ($address == "") {
            $errors++;
        } else if (strlen($address) <= 3) {
            $errors++;
        }

        if ($errors == 0) {
            $result = updateUser($userID, $firstName, $lastName, $phone, $cityID, $address);

            if ($result) {
                $_SESSION['user']->fn_user = $firstName;
                $_SESSION['user']->ln_user = $lastName;
                $_SESSION['user']->phone_user = $phone;
                $_SESSION['user']->id_city = $cityID;
                $_SESSION['user']->address_user = $address;

                echo json_encode(["msg" => "Successfuly updated profile!"]);
                http_response_code(201);
            } else {
                echo json_encode(["error" => "Can't update profile."]);
                http_response_code(422);
            }
        }
    } catch (PDOException $ex) {
        echo json_encode(["error" => "Error: " . $ex->getMessage()]);
        http_response_code(500);
    }
} else {
    header("location: ../404.php");
}
