<?php
include "template/head.php";
include "template/nav.php";

if (isset($_SESSION['user']) && $_SESSION['user']->name_role == "user") {
    header("Location: profile.php");
} else {
?>

    <div class="container d-flex flex-column justify-content-center vh-100 " id="login-div">
        <div class="mb-5">
            <button id="homeButton" class="btn mb-5"><i id="backArrow" class="fa-solid fa-chevron-left me-2"></i>Home</button>
            <h1>Login</h1>
        </div>

        <form class="" id="login-form">
            <!-- EMAIL -->
            <div class="form-group mb-3">
                <label class="mb-1" for="inputEmail">Email</label>
                <input class="form-control p-2" type="text" name="inputEmail" id="inputEmail" />
                <span id="errorEmail" class="mb-0 text-danger"></span>
            </div>
            <!-- PASSWORD -->
            <div class="form-group mb-5">
                <label class="mb-1" for="inputPassword">Password</label>
                <input class="form-control p-2" type="password" name="inputPassword" id="inputPassword" />
                <span id="errorPassword" class="mb-0 text-danger"></span>
            </div>
            <!-- LOGIN BUTTON -->
            <div class="form-group mb-2">
                <input class="btn form-control col-6" type="button" value="Login" name="loginButton" id="loginButton" />
            </div>
        </form>
        <p id="response-text" class="text-center fs-5 border-10"></p>
        <p class="mx-auto">Don't have an account? <a href="register.php">Register here!</a></p>
    </div>
<?php
}

include "template/footer.php";
?>