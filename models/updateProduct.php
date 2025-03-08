<?php
header("Content-Type: application/json");
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    try {
        include "../connection/conn.php";
        include "functions.php";

        $getCategoriesArr = getAnyTable("category");
        $getImagesArr = getAnyTable("image");
        $encode = [];
        $movePath = "../assets/images/";

        $productID = $_POST['productID'];
        $nameProduct = $_POST['nameProduct'];
        $currentNameProduct = $_POST['currentNameProduct'];
        $descProduct = $_POST['descProduct'];
        $priceProduct = $_POST['priceProduct'];
        $availabilityProduct = $_POST['availabilityProduct'];
        $catID = $_POST['catID'];
        $colorID = $_POST['colorID'];

        $errors = 0;
        $regName = "/^[A-zŠĐČĆŽšđčćž0-9\\\!\@\#\$\%\^\&\*\(\)\_\+\{\}\:\"\|\<\>\?\[\]\;\'\,\.\/\`\§\±\~\-\s]{3,250}$/";

        // // Checking if the same product name already exists!
        $sameProductCheck = doesProductExists($nameProduct);
        $isNameTheSame = $nameProduct == $currentNameProduct;
        if ($sameProductCheck && !$isNameTheSame) {
            echo json_encode(["error" => "Product already exists!"]);
            http_response_code(409);
        } else {
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
                            foreach ($getCategoriesArr as $cat) {
                                if ($cat->id_cat == $catID) {
                                    $path = strtolower($cat->name_cat) . "/1x/";
                                    $movePath .= $path; 
                                }
                            }

                            $movePathFS = $movePath . $fileName; 
                            $movePathDB = substr($movePathFS, 3);
                            $nameImage = $fileExt[0];

                            // Can't upload image if the same image name or image path exists already
                            if ($getImagesArr) {
                                $imageExists = false;
                                foreach ($getImagesArr as $img) {
                                    if ($img->name_image == $nameImage || $img->path_image == $movePathDB) {
                                        $imageExists = true;
                                        $encode['error'] = "Image already exists with the same name or path. Please choose a different image.";
                                        break;
                                    }
                                }

                                if ($imageExists) {
                                    echo json_encode($encode);
                                    http_response_code(422);
                                    exit();
                                }
                            }


                            $res = updateInsertProfileProductImage("product", $productID, $nameImage, $movePathDB, $fileTmpName);

                            if ($res) {
                                echo json_encode([
                                    "msg" => "Successfuly updated product!",
                                    "path" => $path, //  "armchair/1x/"
                                    "movePathFS" => $movePathFS, // "../assets/images/armchair/1x/file_name.png"
                                    "movePathDB" => $movePathDB, // "assets/images/armchair/1x/file_name.png"
                                ]);
                                http_response_code(200);
                            } else {
                                echo json_encode(['error' => 'An image with this name already exists. Please choose a different image.']);
                                http_response_code(422);
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

            if ($nameProduct == "") {
                $errors++;
            } else if (!preg_match($regName, $nameProduct)) {
                $errors++;
            }


            if ($descProduct == "") {
                $errors++;
            } else if (!preg_match($regName, $descProduct)) {
                $errors++;
            }


            if ($priceProduct <= 0) {
                $errors++;
            }


            if ($availabilityProduct < 0) {
                $errors++;
            }


            if ($catID == "0") {
                $errors++;
            }


            if ($colorID == "0") {
                $errors++;
            }


            if ($errors == 0) {
                $res = updateProduct($productID, $nameProduct, $descProduct, $priceProduct, $availabilityProduct, $catID, $colorID);

                if ($res) {
                    echo json_encode(["msg" => "Successfuly updated product!"]);
                    http_response_code(200);
                } else {
                    echo json_encode(["error" => "Error: server-side error."]);
                    http_response_code(422);
                }
            }
        }
    } catch (PDOException $ex) {
        echo json_encode(["error" => "Error: " . $ex->getMessage()]);
        http_response_code(500);
    }
} else {
    header("location: ../404.php");
}
