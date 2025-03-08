<?php
include "template/head.php";
include "template/nav.php";

$cityArr = getAnyTable("city");
?>

<div class="container" id="register-div">
    <div class="mb-5">
        <h1>Register</h1>
    </div>
    <form class="row" id="register-form">
        <!-- FIRST NAME -->
        <div class="form-group col-sm-6 col-12 mb-sm-0 mb-3">
            <label class="mb-1" for="inputFName">First Name</label>
            <input class="form-control p-2" type="text" name="inputFName" id="inputFName" placeholder="John" />
            <span id="errorFName" class="mb-0 text-danger"></span>
        </div>
        <!-- LAST NAME -->
        <div class="form-group col-sm-6 col-12 mb-3">
            <label class="mb-1" for="inputLName">Last Name</label>
            <input class="form-control p-2" type="text" name="inputLName" id="inputLName" placeholder="Doe" />
            <span id="errorLName" class="mb-0 text-danger"></span>
        </div>
        <!-- PHONE NUMBER -->
        <div class="form-group col-12 mb-3">
            <label class="mb-1" for="inputPhone">Phone number</label>
            <input class="form-control p-2" type="text" name="inputPhone" id="inputPhone" placeholder="+1-XXX-XXX-XXXX" />
            <span id="errorPhone" class="mb-0 text-danger"></span>
        </div>
        <!-- CITY -->
        <div class="form-group col-sm-6 col-12 mb-sm-0 mb-3">
            <label class="mb-1" for="selectCity">City</label>
            <select class="form-control p-2" name="selectCity" id="selectCity">
                <option value="0">Select</option>
                <!-- GET FROM DATABASE -->
                <?php foreach ($cityArr as $city) : ?>
                    <option value="<?= $city->id_city ?>"><?= $city->name_city ?></option>
                <?php endforeach; ?>
            </select>
            <span id="errorCity" class="mb-0 text-danger"></span>
        </div>
        <!-- ADDRESS -->
        <div class="form-group col-sm-6 col-12 mb-3">
            <label class="mb-1" for="inputAddress">Address</label>
            <input class="form-control p-2" type="text" name="inputAddress" id="inputAddress" placeholder="456 Park Avenue, New York" />
            <span id="errorAddress" class="mb-0 text-danger"></span>
        </div>
        <!-- EMAIL -->
        <div class="form-group col-12 mb-3">
            <label class="mb-1" for="inputEmail">Email</label>
            <input class="form-control p-2" type="text" name="inputEmail" id="inputEmail" placeholder="email@example.com" />
            <span id="errorEmail" class="mb-0 text-danger"></span>
        </div>
        <!-- USERNAME -->
        <div class="form-group col-12 mb-3">
            <label class="mb-1" for="inputUsername">Username</label>
            <input class="form-control p-2" type="text" name="inputUsername" id="inputUsername" placeholder="john.doe" />
            <span id="errorUsername" class="mb-0 text-danger"></span>
        </div>
        <!-- PASSWORD -->
        <div class="form-group col-12 mb-3">
            <label class="mb-1" for="inputPassword">Password</label>
            <input class="form-control p-2" type="password" name="inputPassword" id="inputPassword" />
            <span id="errorPassword" class="mb-0 text-danger"></span>
        </div>
        <!-- REPEAT PASSWORD -->
        <div class="form-group col-12 mb-5">
            <label class="mb-1" for="inputRPassword">Repeat Password</label>
            <input class="form-control p-2" type="password" name="inputRPassword" id="inputRPassword" />
            <span id="errorRPassword" class="mb-0 text-danger"></span>
        </div>
        <!-- REGISTER BUTTON -->
        <div class="form-group col-12 mb-4">
            <input class="btn form-control" type="button" value="Register" name="registerButton" id="registerButton" />
        </div>
    </form>

    <p id="response-text" class="text-center fs-5 border-10"></p>
    <p class=" text-center">Already have an account? <a href="login.php">Login here!</a></p>
</div>

<?php
include "template/footer.php";
?>