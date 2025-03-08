<?php
include "template/head.php";
include "template/nav.php";

if (isset($_SESSION['user']) && $_SESSION['user']->name_role == "admin") {
    $welcomeBack = "Welcome back, " . $_SESSION['user']->fn_user;

    $prodArr = filterProductsAndSort();
    $catArr = getCategoryWithImages();
    $colorArr = getAnyTable("color");
    $numberOfPages = getPageCount();
?>

    <div class="container untree_co-section product-section before-footer-section" id="adminPanel-div">
        <div id="howdy" class="mb-5 d-flex justify-content-center align-items-center">
            <h1 class="mb-0 text-center"><?php echo $welcomeBack; ?>.</h1>
            <button id="goToInsertProduct" class="btn mx-3">Add new product<i id="forwardArrow" class="fa-solid fa-chevron-right ms-2"></i></button>
            <button id="goToOrders" class="btn mx-3">Manage Orders<i id="forwardArrow" class="fa-solid fa-chevron-right ms-2"></i></button>
            <button id="goToMessages" class="btn">Messages<i id="forwardArrow" class="fa-solid fa-chevron-right ms-2"></i></button>
        </div>

        <script>
            document.getElementById('goToInsertProduct').addEventListener('click', function() {
                window.location.href = 'adminInsertProduct.php';
            });
            
            document.getElementById('goToOrders').addEventListener('click', function() {
                window.location.href = 'adminOrders.php';
            });
            
            document.getElementById('goToMessages').addEventListener('click', function() {
                window.location.href = 'adminMessages.php';
            });
        </script>

        <div id="filter" class="d-flex justify-content-center align-items-center mb-5">
            <input type="text" placeholder="Search products" name="inputSearch" id="inputSearch" class="px-4 py-3 form-control rounded-pill" data-user="1" />

            <div class="dropdown ms-3">
                <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Filter
                </button>
                <ul class="dropdown-menu">
                    <li>
                        <h6 class="dropdown-header">Filter by color:</h6>
                    </li>
                    <li>
                        <select name="inputColor" id="inputColor" class="form-control dropdown-item" data-user="1">
                            <option value="0">None</option>
                            <?php foreach ($colorArr as $color) : ?>
                                <option value="<?= $color->id_color ?>"><?= $color->name_color ?></option>
                            <?php endforeach; ?>
                        </select>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <h6 class="dropdown-header">Sort by:</h6>
                    </li>
                    <li>
                        <select name="inputSort" id="inputSort" class="form-control dropdown-item" data-user="1">
                            <option value="0">Default</option>
                            <option value="1">Price Up</option>
                            <option value="2">Price Down</option>
                            <option value="3">Name A-Z</option>
                            <option value="4">Name Z-A</option>
                        </select>
                    </li>
                </ul>
            </div>
        </div>
        
        <!-- Categories desktop view -->
        <div id="categories" class="mb-5 p-4">
            <ul class="d-flex justify-content-between">
                <?php foreach ($catArr as $cat) : ?>
                    <li id="<?= $cat->name_cat ?>" class="selectCat" data-catid="<?= $cat->id_cat ?>" data-user="1">
                        <h5 class="categoryProduct-title text-center mb-3"><?= $cat->name_cat ?></h5>
                        <div class="categoryPorduct-container border-10 d-flex justify-content-center align-items-center">
                            <img src="<?= $cat->path_image ?>" alt="<?= $cat->name_image ?>" />
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>

        <!-- Categories mobile view -->
        <div id="categories-mobile" class="dropdown d-none">
            <button class="btn dropdown-toggle w-100" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                Browse By Category
            </button>
            <ul class="dropdown-menu w-100 p-0 ">
                <?php foreach ($catArr as $cat) : ?>
                    <li id="<?= $cat->name_cat ?>" class="selectCat py-3" data-catid="<?= $cat->id_cat ?>" data-user="1">
                        <h5 class="categoryProduct-title text-center"><?= $cat->name_cat ?></h5>
                    </li>
                    <hr class="dropdown-divider">
                <?php endforeach; ?>
            </ul>
        </div>

        <!-- If on resolution less than 776, disable admin panel -->
        
        
        <div id="products-shop" class="row pt-5">
            <?php foreach ($prodArr['products'] as $pod) : ?>
                <div class="col-12 col-md-4 col-lg-3 mb-5">
                    <a class="product-item" href="adminProduct.php?id=<?= $pod->id_product ?>">
                        <img src="<?= $pod->path_image ?>" alt="<?= $pod->name_image ?>" class="img-fluid product-thumbnail" />
                        <h3 class="product-title"><?= $pod->name_product ?></h3>
                        <strong class="product-price">&#8377;<?= $pod->price_product ?></strong>

                        <span class="icon-cross d-flex justify-content-center align-items-center">
                            <i class="text-white fa-solid fa-pen-to-square"></i>
                        </span>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>

        <nav id="pagination-shop">
            <ul class="pagination justify-content-center">
                <?php for ($i = 0; $i < $numberOfPages; $i++) : ?>
                    <li class="page-item">
                        <a class="page-link pagination-page-link" href="#" data-user="1" data-limit="<?= $i ?>"><?= $i + 1 ?></a>
                    </li>
                <?php endfor; ?>
            </ul>
        </nav>
    </div>

<?php
} else {
    header("Location: 404.php");
}
?>

<?php
include "template/footer.php";
?>