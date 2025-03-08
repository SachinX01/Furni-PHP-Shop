<?php
include_once dirname(__DIR__) . "/config/error_handler.php";
session_start();
include "connection/conn.php";
include "models/functions.php";
include "config/config.php";

$pageData = $metaData['home'];
$currentPage = basename($_SERVER['REQUEST_URI']);

switch ($currentPage) {
	case "index.php":
		$pageData = $metaData['home'];
		break;
	case "about.php":
		$pageData = $metaData['about'];
		break;
	case "shop.php":
		$pageData = $metaData['shop'];
		break;
	case "services.php":
		$pageData = $metaData['services'];
		break;
	case "contact.php":
		$pageData = $metaData['contact'];
		break;
	case "login.php":
		$pageData = $metaData['login'];
		break;
	case "register.php":
		$pageData = $metaData['register'];
		break;
	case "cart.php":
		$pageData = $metaData['cart'];
		break;
	case "profile.php":
		$pageData = $metaData['profile'];
		break;
	case "product.php":
		$pageData = $metaData['product'];
		break;
	case "author.php":
		$pageData = $metaData['author'];
		break;
}

if (str_contains($currentPage, "?id=")) {
	$questionMarkLoc = strpos($currentPage, "=");
	$id = substr($currentPage, $questionMarkLoc + 1);
	$product = getProduct($id);

	$pageData['title'] = "Furni - " . $product[0]->name_product;
	$pageData['description'] = $product[0]->desc_product;
}

?>
<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="author" content="Aleksa">
	<meta name="description" content="<?php echo $pageData['description']; ?>">
	<meta name="keywords" content="<?php echo $pageData['keywords']; ?>">

	<link rel="shortcut icon" href="assets/images/favicon.png" />


	<!-- Bootstrap CSS -->
	<link href="assets/css/bootstrap.min.css" rel="stylesheet" />
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
	<link href="assets/css/tiny-slider.css" rel="stylesheet" />
	<link href="assets/css/style.css" rel="stylesheet" />
	<title><?php echo $pageData['title']; ?></title>
</head>