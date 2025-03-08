<?php
define("OFFSET", 8);

function getAnyTable($tableName)
{
    global $conn;
    $query = "SELECT * FROM $tableName";

    $res = $conn->query($query)->fetchAll();
    return $res;
}

function getCategoryWithImages()
{
    global $conn;
    $query = "SELECT * FROM image i JOIN cat_img ci ON i.id_image = ci.id_image JOIN category c ON ci.id_cat = c.id_cat";

    $res = $conn->query($query)->fetchAll();
    return $res;
}

function getNavWithRoles($roleName)
{
    global $conn;
    $query = "SELECT * FROM role_nav rn JOIN user_role ur ON rn.id_role = ur.id_role JOIN nav n ON rn.id_nav = n.id_nav WHERE ur.name_role = ?";

    $ps = $conn->prepare($query);
    $ps->bindValue(1, $roleName, PDO::PARAM_STR);
    $ps->execute();

    $res = $ps->fetchAll();
    return $res;
}

function getProductFromCategory()
{
    global $conn;
    $query = "SELECT * FROM product p JOIN category c ON p.id_cat=c.id_cat JOIN prod_img pi ON p.id_product=pi.id_product JOIN image i ON pi.id_image=i.id_image";

    $res = $conn->query($query)->fetchAll();
    return $res;
}

function getProductFromCategoryTop3()
{
    global $conn;
    $query = "SELECT * FROM product p JOIN category c ON p.id_cat=c.id_cat JOIN prod_img pi ON p.id_product=pi.id_product JOIN image i ON pi.id_image=i.id_image LIMIT 3";

    $res = $conn->query($query)->fetchAll();
    return $res;
}

function getProductFromSameCategoryTop3($catID)
{
    global $conn;
    $query = "SELECT * FROM product p JOIN category c ON p.id_cat=c.id_cat JOIN prod_img pi ON p.id_product=pi.id_product JOIN image i ON pi.id_image=i.id_image WHERE p.id_cat = ? ORDER BY RAND() LIMIT 3";

    $ps = $conn->prepare($query);
    $ps->bindValue(1, $catID, PDO::PARAM_INT);

    $ps->execute();
    $res = $ps->fetchAll();

    return $res;
}

function getProduct($id)
{
    global $conn;
    $query = "SELECT * FROM product p JOIN category c ON p.id_cat=c.id_cat
                                          JOIN prod_img pi ON p.id_product=pi.id_product 
                                          JOIN image i ON pi.id_image=i.id_image 
                                          JOIN color clr ON p.id_color = clr.id_color 
                                          WHERE p.id_product=:id";

    $ps = $conn->prepare($query);
    $ps->bindParam(":id", $id);
    $ps->execute();

    $res = $ps->fetchAll();
    return $res;
}

function getUser($userID)
{
    global $conn;
    $query = "SELECT * FROM user u JOIN user_role ur ON u.id_role=ur.id_role
                                   JOIN city c ON u.id_city=c.id_city
                                   WHERE u.id_role=:id";

    $ps = $conn->prepare($query);
    $ps->bindParam(":id", $userID);
    $ps->execute();

    $res = $ps->fetchAll();
    return $res;
}

function getOrder($userID, $status = "pending")
{
    global $conn;
    $query = "SELECT * FROM user u JOIN orders o ON u.id_user=o.id_user WHERE u.id_user=:id AND o.status_order=:st";

    $ps = $conn->prepare($query);
    $ps->bindParam(":id", $userID);
    $ps->bindParam(":st", $status);
    $ps->execute();

    return $ps->fetch();
}

function addOrder($userID)
{
    global $conn;
    $res = 1;
    $orderExist = getOrder($userID);

    if (!$orderExist) {
        $query = "INSERT INTO orders(id_user) VALUES (:id)";

        $ps = $conn->prepare($query);
        $ps->bindParam(":id", $userID);
        $res = $ps->execute();
    }

    return $res;
}

function getOrderItem($orderID, $productID)
{
    global $conn;

    $query = "SELECT * FROM orders_item oi WHERE id_order = :orderID AND id_product = :productID";

    $ps = $conn->prepare($query);
    $ps->bindParam(":orderID", $orderID);
    $ps->bindParam(":productID", $productID);
    $ps->execute();

    $res = $ps->fetchAll();
    return $res;
}

function addOrderItems($userID, $productID)
{
    global $conn;
    $quant = 1;
    $res = false;
    $currentOrder = getOrder($userID);
    $currentOrderID = $currentOrder->id_order;
    $orderItemsExist = getOrderItem($currentOrderID, $productID);

    if (!$orderItemsExist) {
        $product = getProduct($productID);
        $productPrice = $product[0]->price_product;

        $query = "INSERT INTO orders_item(id_order, id_product, quantity_o_item, subtotal_o_item) VALUES (:orderID, :productID, :quant, :subTotal)";

        $ps = $conn->prepare($query);
        $ps->bindParam(":orderID", $currentOrderID);
        $ps->bindParam(":productID", $productID);
        $ps->bindParam(":quant", $quant);
        $ps->bindParam(":subTotal", $productPrice);
        $res = $ps->execute();
    }

    return $res;
}

function updateOrderItems($userID, $productID, $quantity, $totalPrice)
{
    global $conn;
    $currentOrder = getOrder($userID);
    $currentOrderID = $currentOrder->id_order;

    $query = "UPDATE orders_item SET quantity_o_item = :quantity, subtotal_o_item = :totalPrice WHERE id_order = :orderID AND id_product = :productID";

    $ps = $conn->prepare($query);
    $ps->bindParam("quantity", $quantity);
    $ps->bindParam("totalPrice", $totalPrice);
    $ps->bindParam("orderID", $currentOrderID);
    $ps->bindParam("productID", $productID);
    $res = $ps->execute();

    return $res;
}

function getAllOrders($userID, $status = "pending")
{
    global $conn;
    if ($status == "completed" || $status == "processing" || $status == "approved" || $status == "rejected") {
        $query = "SELECT * FROM orders o
                            JOIN orders_item oi ON o.id_order = oi.id_order
                            JOIN product p ON oi.id_product = p.id_product
                            JOIN prod_img pi ON p.id_product = pi.id_product
                            JOIN image i ON pi.id_image = i.id_image
                            WHERE o.id_user = :userID AND o.status_order = :st";

        $ps = $conn->prepare($query);
        $ps->bindParam(":userID", $userID);
        $ps->bindParam(":st", $status);
        $ps->execute();

        $res = $ps->fetchAll(PDO::FETCH_ASSOC);

        $orders = [];
        foreach ($res as $row) {
            $orderID = $row['id_order'];
            if (!isset($orders[$orderID])) {
                $orders[$orderID] = [
                    'id_order' => $orderID,
                    'status_order' => $row['status_order'],
                    'total_price_customer' => $row['total_price_customer'],
                    'order_date' => $row['modified_at_customer'],
                    'items' => []
                ];
            }

            $orders[$orderID]['items'][] = [
                'id_product' => $row['id_product'],
                'name_product' => $row['name_product'],
                'quantity_o_item' => $row['quantity_o_item'],
                'subtotal_o_item' => $row['subtotal_o_item'],
                'price_product' => $row['price_product'],
                'path_image' => $row['path_image']
            ];
        }

        return $orders;
    }

    $order = getOrder($userID);
    $orderID = $order->id_order;

    $query = "SELECT * FROM orders_item oi JOIN product p ON oi.id_product = p.id_product JOIN prod_img pi ON p.id_product=pi.id_product JOIN image i ON pi.id_image=i.id_image WHERE oi.id_order = :orderID";
    $ps = $conn->prepare($query);
    $ps->bindParam(":orderID", $orderID);

    $ps->execute();

    $res = $ps->fetchAll();
    return $res;
}

function deleteOrderItems($userID, $productID)
{
    global $conn;
    $currentOrder = getOrder($userID);
    $currentOrderID = $currentOrder->id_order;

    $query = "DELETE FROM orders_item WHERE id_order=:orderID AND id_product=:productID";

    $ps = $conn->prepare($query);
    $ps->bindParam(":orderID", $currentOrderID);
    $ps->bindParam(":productID", $productID);
    $res = $ps->execute();

    return $res;
}

function finishOrder($orderID, $totalPrice)
{
    global $conn;
    $statusText = "processing";  

    $currTimestamp = date("Y-m-d H:i:s");

    $query = "UPDATE orders SET total_price_customer = :totalPrice, status_order = :statusText, modified_at_customer = :currTimestamp WHERE id_order = :orderID";

    $ps = $conn->prepare($query);
    $ps->bindParam(":totalPrice", $totalPrice);
    $ps->bindParam(":statusText", $statusText);
    $ps->bindParam(":currTimestamp", $currTimestamp);
    $ps->bindParam(":orderID", $orderID);
    $res = $ps->execute();

    return $res;
}


function getProductCount()
{
    global $conn;
    $query = "SELECT COUNT(*) as count FROM product";

    $res = $conn->query($query)->fetch();
    return $res;
}

function getPageCount()
{
    $productCount = getProductCount();
    $numberOfPages = ceil($productCount->count / OFFSET);

    return $numberOfPages;
}

function filterProductsAndSort($catID = 0, $colorID = 0, $search = "", $sortBy = 0, $limit = 0)
{
    global $conn;
    $lim = ((int) $limit) * OFFSET;
    $offset = OFFSET;

    $query = "SELECT SQL_CALC_FOUND_ROWS * FROM product p JOIN category c ON p.id_cat = c.id_cat JOIN prod_img pi ON p.id_product = pi.id_product JOIN image i ON pi.id_image = i.id_image JOIN color clr ON p.id_color = clr.id_color";

    $conditions = [];

    if ($catID != 0) {
        $conditions[] = "p.id_cat = :catID";
    }

    if ($colorID != 0) {
        $conditions[] = "p.id_color = :colorID";
    }

    if ($search != "") {
        $conditions[] = "p.name_product LIKE :search";
    }

    if (!empty($conditions)) {
        $query .= " WHERE " . implode(" AND ", $conditions);
    }

    switch ($sortBy) {
        case '1':
            $query .= " ORDER BY p.price_product DESC";
            break;
        case '2':
            $query .= " ORDER BY p.price_product ASC";
            break;
        case '3':
            $query .= " ORDER BY p.name_product ASC";
            break;
        case '4':
            $query .= " ORDER BY p.name_product DESC";
            break;
        case '5':
            $query .= " ORDER BY p.id_product DESC";
            break;
        default:
            break;
    }

    $query .= " LIMIT :limit, :offset";

    $ps = $conn->prepare($query);

    if ($catID != 0) {
        $ps->bindParam(":catID", $catID);
    }

    if ($colorID != 0) {
        $ps->bindParam(":colorID", $colorID);
    }

    if ($search != "") {
        $searchParam = "%$search%";
        $ps->bindParam(":search", $searchParam);
    }

    $ps->bindParam(":limit", $lim, PDO::PARAM_INT);
    $ps->bindParam(":offset", $offset, PDO::PARAM_INT);

    $ps->execute();
    $res = $ps->fetchAll();

    if (empty($res)) {
        return true;
    }

    $totalRecordsCount = $conn->query("SELECT FOUND_ROWS() as total")->fetch(PDO::FETCH_ASSOC)['total'];
    return ["products" => $res, "totalRecordsCount" => $totalRecordsCount];
}

function doesUsernameExists($username)
{
    global $conn;
    $query = "SELECT * FROM user WHERE username_user = :username";

    $ps = $conn->prepare($query);
    $ps->bindParam(":username", $username);
    $ps->execute();
    $res = $ps->fetch();

    return $res;
}

function doesEmailExists($email)
{
    global $conn;
    $query = "SELECT * FROM user WHERE email_user = :email";

    $ps = $conn->prepare($query);
    $ps->bindParam(":email", $email);
    $ps->execute();
    $res = $ps->fetch();

    return $res;
}

function doesPhoneExists($phone)
{
    global $conn;
    $query = "SELECT * FROM user WHERE phone_user = :phone";

    $ps = $conn->prepare($query);
    $ps->bindParam(":phone", $phone);
    $ps->execute();
    $res = $ps->fetch();

    return $res;
}

function insertNewUser($firstName, $lastName, $username, $email, $city, $address, $password, $phone)
{
    global $conn;
    $idRole = 2;
    $query = "INSERT INTO user(fn_user, ln_user, username_user, email_user, pass_user, address_user, phone_user, id_city, id_role) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $ps = $conn->prepare($query);
    $ps->bindValue(1, $firstName, PDO::PARAM_STR);
    $ps->bindValue(2, $lastName, PDO::PARAM_STR);
    $ps->bindValue(3, $username, PDO::PARAM_STR);
    $ps->bindValue(4, $email, PDO::PARAM_STR);
    $ps->bindValue(5, $password, PDO::PARAM_STR);
    $ps->bindValue(6, $address, PDO::PARAM_STR);
    $ps->bindValue(7, $phone, PDO::PARAM_STR);
    $ps->bindValue(8, $city, PDO::PARAM_INT);
    $ps->bindValue(9, $idRole, PDO::PARAM_INT);
    $res = $ps->execute();

    return $res;
}

function updateUser($userID, $firstName, $lastName, $phone, $cityID, $adr)
{
    global $conn;
    $currTimestamp = date("Y-m-d H:i:s");

    $query = "UPDATE user SET fn_user=:firstName, ln_user=:lastName, address_user=:adr, phone_user=:phone, id_city=:cityID, modified_at_user=:currTimestamp WHERE id_user = :userID";

    $ps = $conn->prepare($query);
    $ps->bindParam(":firstName", $firstName, PDO::PARAM_STR);
    $ps->bindParam(":lastName", $lastName, PDO::PARAM_STR);
    $ps->bindParam(":adr", $adr, PDO::PARAM_STR);
    $ps->bindParam(":phone", $phone, PDO::PARAM_STR);
    $ps->bindParam(":cityID", $cityID, PDO::PARAM_INT);
    $ps->bindParam(":currTimestamp", $currTimestamp, PDO::PARAM_STR);
    $ps->bindParam(":userID", $userID, PDO::PARAM_INT);
    $res = $ps->execute();

    return $res;
}

function loginUser($email, $password)
{
    global $conn;
    $query = "SELECT * FROM user u JOIN city c ON u.id_city = c.id_city 
                                   JOIN user_role ur ON u.id_role = ur.id_role
                                   WHERE u.email_user = ?";

    $ps = $conn->prepare($query);
    $ps->bindValue(1, $email, PDO::PARAM_STR);
    // $ps->bindValue(2, $password, PDO::PARAM_STR);
    $ps->execute();
    $res = $ps->fetch();

    $hashPass = $res->pass_user;
    if (password_verify($password, $hashPass)) {
        return $res;
    }

    return false;
}

function sendMessage($firstName, $lastName, $email, $message)
{
    global $conn;
    $query = "INSERT INTO message(fn_msg, ln_msg, email_msg, msg) VALUES(?, ?, ?, ?)";

    $ps = $conn->prepare($query);
    $ps->bindValue(1, $firstName, PDO::PARAM_STR);
    $ps->bindValue(2, $lastName, PDO::PARAM_STR);
    $ps->bindValue(3, $email, PDO::PARAM_STR);
    $ps->bindValue(4, $message, PDO::PARAM_STR);
    $res = $ps->execute();

    return $res;
}

function insertNewProduct($name, $desc, $price, $availability, $catID, $colorID)
{
    global $conn;
    $query = "INSERT INTO product(name_product, desc_product, price_product, availability_product, id_cat, id_color) VALUES(?, ?, ?, ?, ?, ?)";

    $ps = $conn->prepare($query);
    $ps->bindValue(1, $name, PDO::PARAM_STR);
    $ps->bindValue(2, $desc, PDO::PARAM_STR);
    $ps->bindValue(3, $price);
    $ps->bindValue(4, $availability, PDO::PARAM_INT);
    $ps->bindValue(5, $catID, PDO::PARAM_INT);
    $ps->bindValue(6, $colorID, PDO::PARAM_INT);
    $ps->execute();

    $getLatestProduct = "SELECT id_product FROM product ORDER BY id_product DESC LIMIT 1";
    $productID = $conn->query($getLatestProduct)->fetch()->id_product;

    return $productID;
}

function doesProductExists($nameProduct)
{
    global $conn;
    $query = "SELECT * FROM product WHERE name_product = ?";

    $ps = $conn->prepare($query);
    $ps->bindValue(1, $nameProduct, PDO::PARAM_STR);
    $ps->execute();
    $res = $ps->fetch();

    return $res;
}

function updateProduct($productID, $name, $desc, $price, $availability, $catID, $colorID)
{
    global $conn;
    $currentTimestamp = date('Y-m-d H:i:s');
    $query = "UPDATE product SET name_product = ?, desc_product = ?, price_product = ?, availability_product = ?, id_cat = ?, id_color = ?, modified_at_p = ? WHERE id_product = ?";

    $ps = $conn->prepare($query);
    $ps->bindValue(1, $name, PDO::PARAM_STR);
    $ps->bindValue(2, $desc, PDO::PARAM_STR);
    $ps->bindValue(3, $price);
    $ps->bindValue(4, $availability, PDO::PARAM_INT);
    $ps->bindValue(5, $catID, PDO::PARAM_INT);
    $ps->bindValue(6, $colorID, PDO::PARAM_INT);
    $ps->bindValue(7, $currentTimestamp);
    $ps->bindValue(8, $productID, PDO::PARAM_INT);
    $res = $ps->execute();

    return $res;
}

function deleteProduct($productID)
{
    global $conn;
    $query = "DELETE FROM product WHERE id_product = ?";

    $ps = $conn->prepare($query);
    $ps->bindValue(1, $productID, PDO::PARAM_INT);
    $res = $ps->execute();

    return $res;
}

function insertNewImage($nameImage, $pathImage)
{
    global $conn;

    $query = "INSERT INTO image (name_image, path_image) VALUES (:nameImage, :pathImage)";
    $ps = $conn->prepare($query);
    $ps->bindValue(':nameImage', $nameImage, PDO::PARAM_STR);
    $ps->bindValue(':pathImage', $pathImage, PDO::PARAM_STR);
    $ps->execute();

    $imageID = $conn->lastInsertId();

    return $imageID;
}

function getProfileProductImage($imageUploadType, $id)
{
    global $conn;

    if ($imageUploadType == "profile") {
        $query = "SELECT * FROM user_img ui JOIN image i ON ui.id_image = i.id_image WHERE id_user = :id";
    } else if ($imageUploadType == "product") {
        $query = "SELECT * FROM prod_img pi JOIN image i ON pi.id_image = i.id_image WHERE id_product = :id";
    }

    $ps = $conn->prepare($query);
    $ps->bindValue(":id", $id);
    $ps->execute();
    $res = $ps->fetch();

    return $res;
}

function updateInsertProfileProductImage($imageUploadType, $id, $nameImage, $pathImage, $fileTmpName)
{
    global $conn;
    $currTimestamp = date("Y-m-d H:i:s");

    if ($imageUploadType == "profile") {
        $currentProfileImage = getProfileProductImage("profile", $id);

        // UPDATE
        if ($currentProfileImage) {
            $currentProfileImageID = $currentProfileImage->id_image;

            $currentImageMovePath = "../" . $currentProfileImage->path_image;

            if (file_exists($currentImageMovePath)) {
                unlink($currentImageMovePath);
            }

            move_uploaded_file($fileTmpName, "../" . $pathImage);

            $query = "UPDATE image SET name_image = :nameImage, path_image = :pathImage, date_upload_image = :currTimestamp  WHERE id_image = :imageID";
            $ps = $conn->prepare($query);
            $ps->bindValue(':nameImage', $nameImage, PDO::PARAM_STR);
            $ps->bindValue(':pathImage', $pathImage, PDO::PARAM_STR);
            $ps->bindValue(':currTimestamp', $currTimestamp, PDO::PARAM_STR);
            $ps->bindValue(':imageID', $currentProfileImageID, PDO::PARAM_INT);
            $res = $ps->execute();

            return $res;
        }

        // INSERT
        $imageID = insertNewImage($nameImage, $pathImage);

        if ($imageID) {
            $query = "INSERT INTO user_img (id_user, id_image) VALUES (:userID, :imageID)";
            $ps = $conn->prepare($query);
            $ps->bindValue(':userID', $id, PDO::PARAM_INT);
            $ps->bindValue(':imageID', $imageID, PDO::PARAM_INT);
            $res = $ps->execute();

            return $res;
        } else {
            return false;
        }
    } else if ($imageUploadType == "product") {
        $imageID = insertNewImage($nameImage, $pathImage);

        if ($imageID) {
            move_uploaded_file($fileTmpName, "../" . $pathImage);
            $currentProductImage = getProfileProductImage("product", $id);

            // UPDATE
            if ($currentProductImage) {
                $query = "UPDATE prod_img SET id_image = :imageID WHERE id_product = :productID";
                $ps = $conn->prepare($query);
                $ps->bindValue(':imageID', $imageID, PDO::PARAM_INT);
                $ps->bindValue(':productID', $id, PDO::PARAM_INT);
                $res = $ps->execute();

                return $res;
            }

            // INSERT
            $query = "INSERT INTO prod_img (id_product, id_image) VALUES (:productID, :imageID)";
            $ps = $conn->prepare($query);
            $ps->bindValue(':productID', $id, PDO::PARAM_INT);
            $ps->bindValue(':imageID', $imageID, PDO::PARAM_INT);
            $res = $ps->execute();

            return $res;
        } else {
            return false;
        }
    }
}