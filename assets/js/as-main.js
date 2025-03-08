$(document).ready(function () {

    // Active link on current tab
    let currentTab = window.location.pathname;
    let positionOfSlash = currentTab.lastIndexOf("/");
    let currentPath = currentTab.substring(positionOfSlash + 1);

    if (currentPath == "") {
        $('#navbarsFurniUl li:first').addClass('active');
    }

    $('#navbarsFurniUl li').each(function () {
        let linkPath = $(this).find('a').attr('href')
        if (linkPath == currentPath) {
            $(this).addClass('active');
        }
    });


    // Filter - category, color, sort and search
    let offset = 8;
    let selectedCategoryId = null;
    let previousSelectedCategoryId = null;

    $(document).on('click', '.selectCat', function () {
        let user = $(this).data('user');
        selectedCategoryId = $(this).data('catid');

        if ($(window).width() <= 996) {
            $('.selectCat').removeClass('categoryPorduct-mobile-active');
            $(this).addClass('categoryPorduct-mobile-active');
        }

        $('.selectCat .categoryPorduct-container').removeClass('categoryPorduct-container-active');
        $(this).find('.categoryPorduct-container').addClass('categoryPorduct-container-active');

        if (selectedCategoryId == previousSelectedCategoryId) {
            filterDetails(0, user, selectedCategoryId);
            window.location.reload();
        } else {
            filterDetails(0, user, selectedCategoryId);
        }

        previousSelectedCategoryId = selectedCategoryId;
    });

    $(document).on('change', '#inputColor, #inputSort', function () {
        let user = $(this).data('user');
        filterDetails(0, user, selectedCategoryId);
    });

    $(document).on('keyup', '#inputSearch', function () {
        let user = $(this).data('user');
        filterDetails(0, user, selectedCategoryId);
    });

    $(document).on('click', '#pagination-shop .page-link', function () {
        let user = $(this).data('user');
        let page = $(this).data('limit');
        filterDetails(page, user, selectedCategoryId);
    });

    // Function to insert details for filtering
    function filterDetails(page = 0, user, cat) {
        let catID = cat;
        let colorID = $('#inputColor').val();
        let search = $('#inputSearch').val();
        let sortBy = $('#inputSort').val();
        let sendPage = page;

        if (sendPage || sendPage == 0) {
            $.ajax({
                url: "models/filter.php",
                method: "post",
                data: { "catID": catID, "colorID": colorID, "search": search, "sortBy": sortBy, "sendPage": sendPage },
                dataType: "json",
                success: function (response) {
                    let totalRecordsCount = response.totalRecordsCount;
                    let pageCount = Math.ceil(totalRecordsCount / offset);
                    let products = response.products;

                    filterProducts(products, pageCount, user);
                },
                error: function (xhr) {
                    if (xhr.status == 422) {
                        console.log(xhr.msg);
                    }
                    else if (xhr.status == 500) {
                        console.log(xhr.msg);
                    }
                }
            });
        }
        else {
            $.ajax({
                url: "models/filter.php",
                method: "post",
                data: { "catID": catID, "colorID": colorID, "search": search, "sortBy": sortBy, "sendPage": sendPage },
                dataType: "json",
                success: function (response) {
                    let totalRecordsCount = response.totalRecordsCount;
                    let pageCount = Math.ceil(totalRecordsCount / offset);
                    let products = response.products;

                    filterProducts(products, pageCount, user);
                },
                error: function (xhr) {
                    if (xhr.status == 422) {
                        console.log(xhr.msg);
                    }
                    else if (xhr.status == 500) {
                        console.log(xhr.msg);
                    }
                }
            });
        }
    }

    // Function for displaying filtered products
    function filterProducts(productArr, pageCount = 0, user) {
        let html = ``;
        let updatePages = `<ul class="pagination justify-content-center">`;

        let userType = user == 1 ? "admin" : "user";
        if (productArr == undefined) {
            html += `<h2 class='alert'>There are no results.</h2>`;
            updatePages += `<li class="page-item"> <a class="page-link pagination-page-link" href="#" data-limit="0">1</a> </li>`;
        }
        else {
            // Product Array from query
            if (userType == "user") {
                for (let product of productArr) {
                    html += `
                    <div class="col-12 col-md-4 col-lg-3 mb-5" >
                        <a class="product-item" href="product.php?id=${product.id_product}">
                            <img src="${product.path_image}" alt="${product.name_image}" class="img-fluid product-thumbnail" />
                            <h3 class="product-title">${product.name_product}</h3>
                            <strong class="product-price">&#8377;${product.price_product}</strong>
    
                            <span class="icon-cross">
                                <img src="assets/images/cross.svg" class="img-fluid" />
                            </span>
                        </a>
                    </div> `;
                }
                // Update number of pages from query
                for (let i = 0; i < pageCount; i++) {
                    updatePages += `
                <li class="page-item" >
                    <a class="page-link pagination-page-link" href="#" data-user="2" data-limit="${i}">${i + 1}</a>
                </li > `;
                }
            }
            else {
                for (let product of productArr) {
                    html += `
                    <div class="col-12 col-md-4 col-lg-3 mb-5" >
                        <a class="product-item" href="adminProduct.php?id=${product.id_product}">
                            <img src="${product.path_image}" alt="${product.name_image}" class="img-fluid product-thumbnail" />
                            <h3 class="product-title">${product.name_product}</h3>
                            <strong class="product-price">&#8377;${product.price_product}</strong>

                            <span class="icon-cross d-flex justify-content-center align-items-center">
                                <i class="text-white fa-solid fa-pen-to-square"></i>
                            </span>
                        </a>
                    </div > `;
                }
                // Update number of pages from query
                for (let i = 0; i < pageCount; i++) {
                    updatePages += `
                <li class="page-item" >
                    <a class="page-link pagination-page-link" href="#" data-user="1" data-limit="${i}">${i + 1}</a>
                </li > `;
                }
            }
        }

        updatePages += `</ul>`;
        $('#products-shop').html(html);
        $('#pagination-shop').html(updatePages);
    }



    // Registration Form
    $(document).on('click', '#registerButton', function () {
        let firstName = $('#inputFName').val();
        let lastName = $('#inputLName').val();
        let city = $('#selectCity').val();
        let address = $('#inputAddress').val();
        let phone = $('#inputPhone').val();
        let email = $('#inputEmail').val();
        let username = $('#inputUsername').val();
        let password = $('#inputPassword').val();
        let rPassword = $('#inputRPassword').val();

        let errors = 0;
        let regName = /^[A-ZŠĐČĆŽ]{1}[A-zŠĐČĆŽšđčćž]{2,20}$/;
        let regUsername = /^[A-zŠĐČĆŽšđčćž]{1}[\wŠĐČĆŽšđčćž\-\.]{6,20}[A-zŠĐČĆŽšđčćž0-9]{1}$/;
        let regEmail = /^[a-zšđčćž]{1}[a-zšđčćž0-9\.]+[a-zšđčćž0-9]@[a-zšđčćž\.]+[\.]+[a-z]{2,}$/;
        let regPassword = /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[\\\!\@\#\$\%\^\&\*\(\)\_\+\{\}\:\"\|\<\>\?\[\]\;\'\,\.\/\`\§\±\~]).{8,}$/;
        let regPhone = /^\+1-[0-9]{3}-[0-9]{3}-[0-9]{4}$/;


        if (firstName == "") {
            errors++;
            $('#errorFName').removeClass("d-none");
            $('#inputFName').addClass("border border-2 border-danger");
            $('#errorFName').html("First is required!");
        }
        else if (!regName.test(firstName)) {
            errors++;
            $('#errorFName').removeClass("d-none");
            $('#inputFName').addClass("border border-2 border-danger");
            $('#errorFName').html("Uppercase and 3 characters min!");
        }
        else {
            $('#inputFName').removeClass("border-danger");
            $('#errorFName').addClass("d-none");
            $('#inputFName').addClass("border-2 border-success");
        }


        if (lastName == "") {
            errors++;
            $('#errorLName').removeClass("d-none");
            $('#inputLName').addClass("border border-2 border-danger");
            $('#errorLName').html("Last is required!");
        }
        else if (!regName.test(lastName)) {
            errors++;
            $('#errorLName').removeClass("d-none");
            $('#inputLName').addClass("border border-2 border-danger");
            $('#errorLName').html("Uppercase and 3 characters min!");
        }
        else {
            $('#inputLName').removeClass("border-danger");
            $('#errorLName').addClass("d-none");
            $('#inputLName').addClass("border-2 border-success");
        }


        if (username == "") {
            errors++;
            $('#errorUsername').removeClass("d-none");
            $('#inputUsername').addClass("border border-2 border-danger");
            $('#errorUsername').html("Username is required!");
        }
        else if (!regUsername.test(username)) {
            errors++;
            $('#errorUsername').removeClass("d-none");
            $('#inputUsername').addClass("border border-2 border-danger");
            $('#errorUsername').html("<ul> <li>Upper/lowercase letters, numbers, 8 characters min</li> <li>Can include: . - _</li> <li>Must end with letter or number</li> </ul>");
        }
        else {
            $('#inputUsername').removeClass("border-danger");
            $('#errorUsername').addClass("d-none");
            $('#inputUsername').addClass("border-2 border-success");
        }


        if (email == "") {
            errors++;
            $('#errorEmail').removeClass("d-none");
            $('#inputEmail').addClass("border border-2 border-danger");
            $('#errorEmail').html("Email is required!");
        }
        else if (!regEmail.test(email)) {
            errors++;
            $('#errorEmail').removeClass("d-none");
            $('#inputEmail').addClass("border border-2 border-danger");
            $('#errorEmail').html("Invalid email format!");
        }
        else {
            $('#inputEmail').removeClass("border-danger");
            $('#errorEmail').addClass("d-none");
            $('#inputEmail').addClass("border-2 border-success");
        }


        if (city == "0") {
            errors++;
            $('#errorCity').removeClass("d-none");
            $('#selectCity').addClass("border border-2 border-danger");
            $('#errorCity').html("City is required!");
        }
        else {
            $('#selectCity').removeClass("border-danger");
            $('#errorCity').addClass("d-none");
            $('#selectCity').addClass("border-2 border-success");
        }


        if (address == "") {
            errors++;
            $('#errorAddress').removeClass("d-none");
            $('#inputAddress').addClass("border border-2 border-danger");
            $('#errorAddress').html("Address is required!");
        }
        else if (address.length <= 3) {
            errors++;
            $('#errorAddress').removeClass("d-none");
            $('#inputAddress').addClass("border border-2 border-danger");
            $('#errorAddress').html("Address is too short!");
        }
        else {
            $('#inputAddress').removeClass("border-danger");
            $('#errorAddress').addClass("d-none");
            $('#inputAddress').addClass("border-2 border-success");
        }


        if (password == "") {
            errors++;
            $('#errorPassword').removeClass("d-none");
            $('#inputPassword').addClass("border border-2 border-danger");
            $('#errorPassword').html("Password is required!");
        }
        else if (!regPassword.test(password)) {
            errors++;
            $('#errorPassword').removeClass("d-none");
            $('#inputPassword').addClass("border border-2 border-danger");
            $('#errorPassword').html("Must have length of 8 characters and include at least one:<ul> <li>Uppercase and lowercase letter.</li> <li>Number.</li> <li>Special character.</li> </ul>");
        }
        else {
            $('#inputPassword').removeClass("border-danger");
            $('#errorPassword').addClass("d-none");
            $('#inputPassword').addClass("border-2 border-success");
        }


        if (rPassword == "") {
            errors++;
            $('#errorRPassword').removeClass("d-none");
            $('#inputRPassword').addClass("border border-2 border-danger");
            $('#errorRPassword').html("You must enter password again!");
        }
        else if (rPassword != password) {
            errors++;
            $('#errorRPassword').removeClass("d-none");
            $('#inputRPassword').addClass("border border-2 border-danger");
            $('#errorRPassword').html("Passwords are not matching");
        }
        else {
            $('#inputRPassword').removeClass("border-danger");
            $('#errorRPassword').addClass("d-none");
            $('#inputRPassword').addClass("border-2 border-success");
        }

        if (phone == "") {
            errors++;
            $('#errorPhone').removeClass("d-none");
            $('#inputPhone').addClass("border border-2 border-danger");
            $('#errorPhone').html("Phone is required!");
        }
        else if (!regPhone.test(phone)) {
            errors++;
            $('#errorPhone').removeClass("d-none");
            $('#inputPhone').addClass("border border-2 border-danger");
            $('#errorPhone').html("Example: +1-XXX-XXX-XXXX");
        }
        else {
            $('#inputPhone').removeClass("border-danger");
            $('#errorPhone').addClass("d-none");
            $('#inputPhone').addClass("border-2 border-success");
        }


        if (errors == 0) {

            let dataForPHP = {
                "firstName": firstName,
                "lastName": lastName,
                "username": username,
                "email": email,
                "city": city,
                "address": address,
                "password": password,
                "rPassword": rPassword,
                "phone": phone
            }

            $.ajax({
                url: "models/registerUser.php",
                method: "post",
                data: dataForPHP,
                dataType: "json",
                success: function (response) {
                    $('#response-text').removeClass("alert alert-danger");
                    $('#response-text').addClass("alert alert-success");
                    $('#response-text').html(response.msg);
                },
                error: function (xhr) {
                    if (xhr.status == 422 || xhr.status == 409) {
                        var errorMsg = xhr.responseJSON ? xhr.responseJSON.msg : "Unknown error.";

                        $('#response-text').removeClass("alert alert-success");
                        $('#response-text').addClass("alert alert-danger");
                        $('#response-text').html(errorMsg);
                    }
                    else if (xhr.status == 500) {
                        var errorMsg = xhr.responseJSON ? xhr.responseJSON.msg : "Unknown error.";
                        console.log(errorMsg);
                    }
                }
            });
        }
    });

    // Login Form function
    function LoginUser(e) {
        if (e.type === "click" || e.key === "Enter") {
            let email = $('#inputEmail').val();
            let password = $('#inputPassword').val();

            let errors = 0;
            let regEmail = /^[a-zšđčćž]{1}[a-zšđčćž0-9\.]+[a-zšđčćž0-9]@[a-zšđčćž\.]+[\.]+[a-z]{2,}$/;
            let regPassword = /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[\\\!\@\#\$\%\^\&\*\(\)\_\+\{\}\:\"\|\<\>\?\[\]\;\'\,\.\/\`\§\±\~]).{8,}$/;


            if (email == "") {
                errors++;
                $('#errorEmail').removeClass("d-none");
                $('#errorEmail').html("Email is required!");
            }
            else if (!regEmail.test(email)) {
                errors++;
                $('#errorEmail').removeClass("d-none");
                $('#errorEmail').html("Invalid email format!");
            }
            else {
                $('#errorEmail').addClass("d-none");
            }


            if (password == "") {
                errors++;
                $('#errorPassword').removeClass("d-none");
                $('#errorPassword').html("Password is required!");
            }
            else if (!regPassword.test(password)) {
                errors++;
                $('#errorPassword').removeClass("d-none");
                $('#errorPassword').html("Must have length of 8 characters and include at least one:<ul> <li>Uppercase and lowercase letter.</li> <li>Number.</li> <li>Special character.</li> </ul>");
            }
            else {
                $('#errorPassword').addClass("d-none");
            }


            if (errors == 0) {
                let dataForPHP = {
                    "email": email,
                    "password": password
                }

                $.ajax({
                    url: "models/loginUser.php",
                    method: "post",
                    data: dataForPHP,
                    dataType: "json",
                    success: function (response) {
                        // console.log(response);
                        // console.log("Uspesno ulogovan korisnik!");
                        $('#response-text').removeClass("alert alert-danger");
                        $('#response-text').addClass("alert alert-success");
                        $('#response-text').html("Success, redirecting.");

                        // Delay of 1.5 seconds
                        setTimeout(function () { window.location.href = "index.php"; }, 1500);
                    },
                    error: function (xhr) {
                        if (xhr.status == 401) {
                            var errorMsg = xhr.responseJSON ? xhr.responseJSON.msg : "Unknown error.";
                            console.log(errorMsg);
                            $('#response-text').removeClass("alert alert-success");
                            $('#response-text').addClass("alert alert-danger");
                            $('#response-text').html(errorMsg);
                        }
                        else if (xhr.status == 500) {
                            var errorMsg = xhr.responseJSON ? xhr.responseJSON.msg : "Unknown error.";
                            console.log(errorMsg);
                        }
                    }
                });
            }
        }
    }

    // Login by clicking
    $(document).on('click', '#loginButton', function (event) {
        LoginUser(event);
    });

    // Login by pressing key "enter"
    $(document).on('keydown', '#inputEmail, #inputPassword', function (event) {
        LoginUser(event);
    });

    // Contact Form
    $(document).on('click', '#contactButton', function () {
        let firstName = $('#inputFName').val();
        let lastName = $('#inputLName').val();
        let email = $('#inputEmail').val();
        let msg = $('#inputMsg').val();



        let errors = 0;
        let regName = /^[A-ZŠĐČĆŽ]{1}[A-zŠĐČĆŽšđčćž]{2,20}$/;
        let regEmail = /^[a-zšđčćž]{1}[a-zšđčćž0-9\.]+[a-zšđčćž0-9]@[a-zšđčćž\.]+[\.]+[a-z]{2,}$/;
        let regMsg = /^[\wŠĐČĆŽšđčćž`\s\.,!?()'\"-]{1,230}$/;



        if (firstName == "") {
            errors++;
            $('#errorFName').removeClass("d-none");
            $('#inputFName').addClass("border border-2 border-danger");
            $('#errorFName').html("First is required!");
        }
        else if (!regName.test(firstName)) {
            errors++;
            $('#errorFName').removeClass("d-none");
            $('#inputFName').addClass("border border-2 border-danger");
            $('#errorFName').html("Uppercase and 3 characters min!");
        }
        else {
            $('#inputFName').removeClass("border-danger");
            $('#errorFName').addClass("d-none");
            $('#inputFName').addClass("border-2 border-success");
        }



        if (lastName == "") {
            errors++;
            $('#errorLName').removeClass("d-none");
            $('#inputLName').addClass("border border-2 border-danger");
            $('#errorLName').html("Last is required!");
        }
        else if (!regName.test(lastName)) {
            errors++;
            $('#errorLName').removeClass("d-none");
            $('#inputLName').addClass("border border-2 border-danger");
            $('#errorLName').html("Uppercase and 3 characters min!");
        }
        else {
            $('#inputLName').removeClass("border-danger");
            $('#errorLName').addClass("d-none");
            $('#inputLName').addClass("border-2 border-success");
        }



        if (email == "") {
            errors++;
            $('#errorEmail').removeClass("d-none");
            $('#inputEmail').addClass("border border-2 border-danger");
            $('#errorEmail').html("Email is required!");
        }
        else if (!regEmail.test(email)) {
            errors++;
            $('#errorEmail').removeClass("d-none");
            $('#inputEmail').addClass("border border-2 border-danger");
            $('#errorEmail').html("Invalid email format!");
        }
        else {
            $('#inputEmail').removeClass("border-danger");
            $('#errorEmail').addClass("d-none");
            $('#inputEmail').addClass("border-2 border-success");
        }



        if (msg == "") {
            errors++;
            $('#errorMsg').removeClass("d-none");
            $('#inputMsg').addClass("border border-2 border-danger");
            $('#errorMsg').html("Text field is required!");
        }
        else if (!regMsg.test(msg)) {
            errors++;
            $('#errorMsg').removeClass("d-none");
            $('#inputMsg').addClass("border border-2 border-danger");
            $('#errorMsg').html("Maximum number of characters is 230!");
        }
        else {
            $('#inputMsg').removeClass("border-danger");
            $('#errorMsg').addClass("d-none");
            $('#inputMsg').addClass("border-2 border-success");
        }



        if (errors == 0) {

            let dataForPHP = {
                "firstName": firstName,
                "lastName": lastName,
                "email": email,
                "msg": msg
            }

            $.ajax({
                url: "models/contactAdmin.php",
                method: "post",
                data: dataForPHP,
                dataType: "json",
                success: function (response) {
                    // console.log(response.msg);
                    $('#response-text').removeClass("alert alert-danger");
                    $('#response-text').addClass("alert alert-success");
                    $('#response-text').html(response.msg);
                },
                error: function (xhr) {
                    if (xhr.status == 422 || xhr.status == 409) {
                        var errorMsg = xhr.responseJSON ? xhr.responseJSON.msg : "Unknown error.";

                        $('#response-text').removeClass("alert alert-success");
                        $('#response-text').addClass("alert alert-danger");
                        $('#response-text').html(errorMsg);
                    }
                    else if (xhr.status == 500) {
                        var errorMsg = xhr.responseJSON ? xhr.responseJSON.msg : "Unknown error.";
                        console.log(errorMsg);
                    }
                }
            });
        }
    });

    // Refresh image on change for insert product
    $(document).on('change', '#imageProductUpdateBtn', function (e) {
        const fileInput = e.target;
        const file = fileInput.files[0];
        const imagePreview = document.getElementById('productImagePreview');

        if (file) {
            const imageUrl = URL.createObjectURL(file);
            imagePreview.src = imageUrl;

            imagePreview.alt = file.name || 'Product Image Preview';
        }
    });

    // Insert new product Form
    $(document).on('click', '#insertNewProduct', function () {
        let profileImageInput = $('#imageProductUpdateBtn')[0];
        let profileImageFile = profileImageInput.files[0];
        let name = $('#inputNameProduct').val();
        let desc = $('#inputDescriptionProduct').val();
        let price = $('#inputPriceProduct').val();
        let availability = $('#inputAvailabilityProduct').val();
        let catID = $('#selectCategoryProduct').val();
        let colorID = $('#selectColorProduct').val();
        let formData = new FormData();

        let errors = 0;
        let regName = /^[A-zŠĐČĆŽšđčćž0-9\\\!\@\#\$\%\^\&\*\(\)\_\+\{\}\:\"\|\<\>\?\[\]\;\'\,\.\/\`\§\±\~\-\s]{3,250}$/;
        let allowedTypes = ["jpeg", "jpg", "png", "svg"];

        if (profileImageFile != undefined) {
            let profileImageFileName = profileImageFile.name;
            let profileImageFileExtArr = profileImageFileName.split('.');
            let profileImageFileExt = profileImageFileExtArr[profileImageFileExtArr.length - 1].toLowerCase();

            if (profileImageFile.size > 5000000) {
                errors++;
                $('#errorImageProduct').removeClass("d-none");
                $('#imageProductUpdateBtn').addClass("border border-2 border-danger");
                $('#errorImageProduct').html("Upload size should be less than 5mb!");
            }
            else if (!allowedTypes.includes(profileImageFileExt)) {
                errors++;
                $('#errorImageProduct').removeClass("d-none");
                $('#imageProductUpdateBtn').addClass("border border-2 border-danger");
                $('#errorImageProduct').html("Supported svg, jpg, jpeg and png!");
            }
            else {
                $('#imageProductUpdateBtn').removeClass("border-danger");
                $('#errorImageProduct').addClass("d-none");
                $('#imageProductUpdateBtn').addClass("border-2 border-success");

                formData.append('file', profileImageFile);
            }
        } else {
            errors++;
            $('#errorImageProduct').removeClass("d-none");
            $('#imageProductUpdateBtn').addClass("border border-2 border-danger");
            $('#errorImageProduct').html("Image is missing!");
        }

        if (name == "") {
            errors++;
            $('#errorNameProduct').removeClass("d-none");
            $('#inputNameProduct').addClass("border border-2 border-danger");
            $('#errorNameProduct').html("Name is required!");
        }
        else if (!regName.test(name)) {
            errors++;
            $('#errorNameProduct').removeClass("d-none");
            $('#inputNameProduct').addClass("border border-2 border-danger");
            $('#errorNameProduct').html("Length 3-200 max.");
        }
        else {
            $('#inputNameProduct').removeClass("border-danger");
            $('#errorNameProduct').addClass("d-none");
            $('#inputNameProduct').addClass("border-2 border-success");
        }


        if (desc == "") {
            errors++;
            $('#errorDescriptionProduct').removeClass("d-none");
            $('#inputDescriptionProduct').addClass("border border-2 border-danger");
            $('#errorDescriptionProduct').html("Description is required!");
        }
        else if (!regName.test(desc)) {
            errors++;
            $('#errorDescriptionProduct').removeClass("d-none");
            $('#inputDescriptionProduct').addClass("border border-2 border-danger");
            $('#errorDescriptionProduct').html("Length 3-200 max.");
        }
        else {
            $('#inputDescriptionProduct').removeClass("border-danger");
            $('#errorDescriptionProduct').addClass("d-none");
            $('#inputDescriptionProduct').addClass("border-2 border-success");
        }


        if (price <= 0) {
            errors++;
            $('#errorPriceProduct').removeClass("d-none");
            $('#inputPriceProduct').addClass("border border-2 border-danger");
            $('#errorPriceProduct').html("Price must be higher than 0(zero)!");
        }
        else {
            $('#inputPriceProduct').removeClass("border-danger");
            $('#errorPriceProduct').addClass("d-none");
            $('#inputPriceProduct').addClass("border-2 border-success");
        }


        if (availability < 0) {
            errors++;
            $('#errorAvailabilityProduct').removeClass("d-none");
            $('#inputAvailabilityProduct').addClass("border border-2 border-danger");
            $('#errorAvailabilityProduct').html("Availability can't be below 0(zero)!");
        }
        else {
            $('#inputAvailabilityProduct').removeClass("border-danger");
            $('#errorAvailabilityProduct').addClass("d-none");
            $('#inputAvailabilityProduct').addClass("border-2 border-success");
        }


        if (catID == "0") {
            errors++;
            $('#errorCategoryProduct').removeClass("d-none");
            $('#selectCategoryProduct').addClass("border border-2 border-danger");
            $('#errorCategoryProduct').html("Category is required!");
        }
        else {
            $('#selectCategoryProduct').removeClass("border-danger");
            $('#errorCategoryProduct').addClass("d-none");
            $('#selectCategoryProduct').addClass("border-2 border-success");
        }


        if (colorID == "0") {
            errors++;
            $('#errorColorProduct').removeClass("d-none");
            $('#selectColorProduct').addClass("border border-2 border-danger");
            $('#errorColorProduct').html("Color is required!");
        }
        else {
            $('#selectColorProduct').removeClass("border-danger");
            $('#errorColorProduct').addClass("d-none");
            $('#selectColorProduct').addClass("border-2 border-success");
        }


        if (errors == 0) {
            formData.append('nameProduct', name);
            formData.append('descProduct', desc);
            formData.append('priceProduct', price);
            formData.append('availabilityProduct', availability);
            formData.append('catID', catID);
            formData.append('colorID', colorID);

            $.ajax({
                url: "models/insertProduct.php",
                method: "post",
                data: formData,
                processData: false,
                contentType: false,
                dataType: "json",
                success: function (response) {
                    $('#response-text').removeClass("alert alert-danger");
                    $('#response-text').addClass("alert alert-success");
                    $('#response-text').html(response.msg);
                },
                error: function (xhr) {
                    var errorMsg = xhr.responseJSON ? xhr.responseJSON.error : "Unknown error.";
                    if (xhr.status == 422 || xhr.status == 409) {

                        $('#response-text').removeClass("alert alert-success");
                        $('#response-text').addClass("alert alert-danger");
                        $('#response-text').html(errorMsg);
                    }
                    else if (xhr.status == 500) {
                        console.log(errorMsg);
                    }
                }
            });
        }
    });



    // Back to home button
    $(document).on('click', '#homeButton', function () {
        window.location.href = "index.php";
    });

    // Back to admin panel with products button
    $(document).on('click', '#backToProducts', function () {
        window.history.back();
    });

    // Insert new product in admin panel
    $(document).on('click', '#goToInsertProduct', function () {
        window.location.href = "adminInsertProduct.php";
    });

    // Update product in admin panel
    $(document).on('click', '#updateProduct', function () {
        let productID = $(this).data('id');
        let profileImageInput = $('#imageProductUpdateBtn')[0];
        let profileImageFile = profileImageInput.files[0];
        let name = $('#inputNameProduct').val();
        let currentName = $('#inputCurrentNameProduct').val();
        let desc = $('#inputDescriptionProduct').val();
        let price = $('#inputPriceProduct').val();
        let availability = $('#inputAvailabilityProduct').val();
        let catID = $('#selectCategoryProduct').val();
        let colorID = $('#selectColorProduct').val();
        let formData = new FormData();

        let errors = 0;
        let regName = /^[A-zŠĐČĆŽšđčćž0-9\\\!\@\#\$\%\^\&\*\(\)\_\+\{\}\:\"\|\<\>\?\[\]\;\'\,\.\/\`\§\±\~\-\s]{3,250}$/;
        let allowedTypes = ["jpeg", "jpg", "png", "svg"];

        if (profileImageFile != undefined) {
            let profileImageFileName = profileImageFile.name;
            let profileImageFileExtArr = profileImageFileName.split('.');
            let profileImageFileExt = profileImageFileExtArr[profileImageFileExtArr.length - 1].toLowerCase();

            if (profileImageFile.size > 5000000) {
                errors++;
                $('#errorImageProduct').removeClass("d-none");
                $('#imageProductUpdateBtn').addClass("border border-2 border-danger");
                $('#errorImageProduct').html("Upload size should be less than 5mb!");
            }
            else if (!allowedTypes.includes(profileImageFileExt)) {
                errors++;
                $('#errorImageProduct').removeClass("d-none");
                $('#imageProductUpdateBtn').addClass("border border-2 border-danger");
                $('#errorImageProduct').html("Supported svg, jpg, jpeg and png!");
            }
            else {
                $('#imageProductUpdateBtn').removeClass("border-danger");
                $('#errorImageProduct').addClass("d-none");
                $('#imageProductUpdateBtn').addClass("border-2 border-success");

                formData.append('file', profileImageFile);
            }
        }

        if (name == "") {
            errors++;
            $('#errorNameProduct').removeClass("d-none");
            $('#inputNameProduct').addClass("border border-2 border-danger");
            $('#errorNameProduct').html("Name is required!");
        }
        else if (!regName.test(name)) {
            errors++;
            $('#errorNameProduct').removeClass("d-none");
            $('#inputNameProduct').addClass("border border-2 border-danger");
            $('#errorNameProduct').html("Length 3-200 max.");
        }
        else {
            $('#inputNameProduct').removeClass("border-danger");
            $('#errorNameProduct').addClass("d-none");
            $('#inputNameProduct').addClass("border-2 border-success");
        }


        if (desc == "") {
            errors++;
            $('#errorDescriptionProduct').removeClass("d-none");
            $('#inputDescriptionProduct').addClass("border border-2 border-danger");
            $('#errorDescriptionProduct').html("Description is required!");
        }
        else if (!regName.test(desc)) {
            errors++;
            $('#errorDescriptionProduct').removeClass("d-none");
            $('#inputDescriptionProduct').addClass("border border-2 border-danger");
            $('#errorDescriptionProduct').html("Length 3-200 max.");
        }
        else {
            $('#inputDescriptionProduct').removeClass("border-danger");
            $('#errorDescriptionProduct').addClass("d-none");
            $('#inputDescriptionProduct').addClass("border-2 border-success");
        }


        if (price <= 0) {
            errors++;
            $('#errorPriceProduct').removeClass("d-none");
            $('#inputPriceProduct').addClass("border border-2 border-danger");
            $('#errorPriceProduct').html("Price must be higher than 0(zero)!");
        }
        else {
            $('#inputPriceProduct').removeClass("border-danger");
            $('#errorPriceProduct').addClass("d-none");
            $('#inputPriceProduct').addClass("border-2 border-success");
        }


        if (availability < 0) {
            errors++;
            $('#errorAvailabilityProduct').removeClass("d-none");
            $('#inputAvailabilityProduct').addClass("border border-2 border-danger");
            $('#errorAvailabilityProduct').html("Availability can't be below 0(zero)!");
        }
        else {
            $('#inputAvailabilityProduct').removeClass("border-danger");
            $('#errorAvailabilityProduct').addClass("d-none");
            $('#inputAvailabilityProduct').addClass("border-2 border-success");
        }


        if (catID == "0") {
            errors++;
            $('#errorCategoryProduct').removeClass("d-none");
            $('#selectCategoryProduct').addClass("border border-2 border-danger");
            $('#errorCategoryProduct').html("Category is required!");
        }
        else {
            $('#selectCategoryProduct').removeClass("border-danger");
            $('#errorCategoryProduct').addClass("d-none");
            $('#selectCategoryProduct').addClass("border-2 border-success");
        }


        if (colorID == "0") {
            errors++;
            $('#errorColorProduct').removeClass("d-none");
            $('#selectColorProduct').addClass("border border-2 border-danger");
            $('#errorColorProduct').html("Color is required!");
        }
        else {
            $('#selectColorProduct').removeClass("border-danger");
            $('#errorColorProduct').addClass("d-none");
            $('#selectColorProduct').addClass("border-2 border-success");
        }


        if (errors == 0) {
            formData.append('productID', productID);
            formData.append('nameProduct', name);
            formData.append('currentNameProduct', currentName);
            formData.append('descProduct', desc);
            formData.append('priceProduct', price);
            formData.append('availabilityProduct', availability);
            formData.append('catID', catID);
            formData.append('colorID', colorID);

            $.ajax({
                url: "models/updateProduct.php",
                method: "post",
                data: formData,
                processData: false,
                contentType: false,
                dataType: "json",
                success: function (response) {
                    $('#response-text').removeClass("alert alert-danger");
                    $('#response-text').addClass("alert alert-success");
                    $('#response-text').html(response.msg);

                    // console.log("path: " + response);
                    // console.log("path: " + response.path);
                    // console.log("movePathFS: " + response.movePathFS);
                    // console.log("movePathDB: " + response.movePathDB);
                },
                error: function (xhr) {
                    var errorMsg = xhr.responseJSON ? xhr.responseJSON.error : "Unknown error.";

                    if (xhr.status == 422 || xhr.status == 409) {
                        $('#response-text').removeClass("alert alert-success");
                        $('#response-text').addClass("alert alert-danger");
                        $('#response-text').html("Error: " + errorMsg);
                        console.log("Error: " + errorMsg);
                    } else if (xhr.status == 500) {
                        console.log("Server error: " + errorMsg);
                    }
                }
            });
        }
    });

    // Delete product in admin panel
    $(document).on('click', '#deleteProduct', function () {
        let productID = $(this).data('id');
        console.log(productID);

        $.ajax({
            url: "models/deleteProduct.php",
            method: "post",
            data: { "productID": productID },
            dataType: "json",
            success: function (response) {
                $('#response-text').removeClass("alert alert-danger");
                $('#response-text').addClass("alert alert-success");
                $('#response-text').html(response.msg);
                setTimeout(function () { window.location.href = "adminPanel.php"; }, 1500);
            },
            error: function (xhr) {
                if (xhr.status == 422 || xhr.status == 409) {
                    var errorMsg = xhr.responseJSON ? xhr.responseJSON.msg : "Unknown error.";

                    $('#response-text').removeClass("alert alert-success");
                    $('#response-text').addClass("alert alert-danger");
                    $('#response-text').html(errorMsg);
                }
                else if (xhr.status == 500) {
                    var errorMsg = xhr.responseJSON ? xhr.responseJSON.msg : "Unknown error.";
                    console.log(errorMsg);
                }
            }
        });
    });

    // Go to messages in admin panel
    $(document).on('click', '#goToMessages', function () {
        window.location.href = "adminMessages.php";
    });

    // Go to preview changes in admin panel
    $(document).on('click', '#previewChangesBtn', function () {
        let productID = $(this).data("product-id");
        window.location.href = "product.php?id=" + productID;
    });



    // Functions for calculations and cart related
    function calculatePrice(price, quant, type, totalPrice) {
        let result
        switch (type) {
            case "inc":
                result = price * quant;
                return result;
            case "dec":
                result = totalPrice - price;
                return result;
            default:
                break;
        }
    }

    function calculateTotalPrice(isAddedMore) {
        let subtotal = 0;
        let subtotalArray = [];
        let shippingCost = 14.99;

        $('.totalValue').each(function () {
            // Replace the Indian Rupee symbol (₹) with empty string before parsing
            subtotalArray.push(parseFloat($(this).text().replace('₹', '')));
        });
        if (isAddedMore) {
            subtotalArray.forEach(function (value) {
                subtotal += value;
            });
        }
        else {
            subtotalArray.forEach(function (value) {
                subtotal -= value;
            });
            subtotal = Math.abs(subtotal);
        }

        let total = subtotal + shippingCost;

        $('#subtotalValue').html('&#8377;' + subtotal.toFixed(2));
        $('#totalValue').html('&#8377;' + total.toFixed(2));
    }

    function updateCartAjax(productID, currentQuantVal, totalValue) {
        $.ajax({
            url: "models/updateCartCheckout.php",
            method: "post",
            data: { "productID": productID, "quantity": currentQuantVal, "totalPrice": totalValue },
            dataType: "json",
            success: function (response) {
                // console.log(response);
            },
            error: function (xhr) {
                var errorMsg = xhr.responseJSON ? xhr.responseJSON.msg : "Unknown error.";
                if (xhr.status == 409) {
                    console.log(errorMsg);
                }
                else if (xhr.status == 500) {
                    console.log(errorMsg);
                }
            }
        });
    }

    calculateTotalPrice(true);

    // Decrease quantity value button on cart page
    $(document).on('click', '.decreaseButton', function () {
        let productID = $(this).data('product-id');
        let price = parseFloat($(this).data('price'));
        let currentQuantVal = parseInt($(this).closest('.quantity-container').find('.inputQuant').val());

        if (currentQuantVal > 1) {
            let newQuantVal = currentQuantVal - 1;
            $(this).closest('.quantity-container').find('.inputQuant').val(newQuantVal);

            // Replace the Indian Rupee symbol (₹) with empty string before parsing
            let totalPrice = parseFloat($(this).closest('.cart-item-container').find('.totalValue').text().replace('₹', ''));
            let newTotalPrice = calculatePrice(price, 1, "dec", totalPrice);

            $(this).closest('.cart-item-container').find('.totalValue').html('&#8377;' + newTotalPrice);

            updateCartAjax(productID, newQuantVal, newTotalPrice);
            calculateTotalPrice(true);
        }
    });

    // Increase quantity value button on cart page
    $(document).on('click', '.increaseButton', function () {
        let productID = $(this).data('product-id');
        let price = parseFloat($(this).data('price'));
        let inputQuant = $(this).closest('.quantity-container').find('.inputQuant');
        let maxValue = parseInt(inputQuant.data('max'));
        let currentQuantVal = parseInt(inputQuant.val());

        if (currentQuantVal < maxValue) {
            let newQuantVal = currentQuantVal + 1;
            inputQuant.val(newQuantVal);

            let totalValueMobile = calculatePrice(price, newQuantVal, "inc");
            $(this).closest('.cart-item-container').find('.totalValue').html('&#8377;' + totalValueMobile.toFixed(2));

            updateCartAjax(productID, newQuantVal, totalValueMobile);
            calculateTotalPrice(true);
        }
    });

    // Add to cart button
    $(document).on('click', '#buyProduct', function () {
        let productID = $("#product-details").data("prodid");

        $.ajax({
            url: "models/addToCart.php",
            method: "post",
            data: { "productID": productID },
            dataType: "json",
            success: function (response) {
                window.location.href = "cart.php";
            },
            error: function (xhr) {
                var errorMsg = xhr.responseJSON ? xhr.responseJSON.msg : "Unknown error.";
                if (xhr.status == 409) {
                    let productToast = $('#productExistsToast');
                    let toastBootstrap = bootstrap.Toast.getOrCreateInstance(productToast);
                    toastBootstrap.show();
                }
                else if (xhr.status == 500) {
                    console.log(errorMsg);
                }
            }
        });
    });

    // Remove from cart button
    $(document).on('click', '#removeButton', function () {
        let productID = $(this).data("prodid");
        // console.log("Product ID to be deleted: " + productID);

        $.ajax({
            url: "models/deleteFromCart.php",
            method: "post",
            data: { "productID": productID },
            dataType: "json",
            success: function (response) {
                window.location.reload();
            },
            error: function (xhr) {
                if (xhr.status == 422 || xhr.status == 409) {
                    var errorMsg = xhr.responseJSON ? xhr.responseJSON.msg : "Unknown error.";
                    console.log(errorMsg);
                }
                else if (xhr.status == 500) {
                    var errorMsg = xhr.responseJSON ? xhr.responseJSON.msg : "Unknown error.";
                    console.log(errorMsg);
                }
            }
        });
    });

    // Go to checkout page button
    $(document).on('click', '#checkoutBtn', function () {
        window.location.href = "checkout.php";
    });

    // Place order button
    $(document).on('click', '#placeOrderBtn', function () {
        let orderID = $(this).data("order-id");
        let totalPrice = $('#checkout-totalPrice').text();
        let totalPriceInt = totalPrice.substring(1);

        $.ajax({
            url: "models/placeOrder.php",
            method: "post",
            data: { "orderID": orderID, "totalPrice": totalPriceInt, },
            dataType: "json",
            success: function (response) {
                window.location.href = "thankyou.php";
            },
            error: function (xhr) {
                var errorMsg = xhr.responseJSON ? xhr.responseJSON.msg : "Unknown error.";
                if (xhr.status == 409) {
                    console.log(errorMsg);
                }
                else if (xhr.status == 500) {
                    console.log(errorMsg);
                }
            }
        });
    });

    // Update profile button
    $(document).on('click', '#updateProfileBtn', function () {
        let profileImageInput = $('#imageUpdateBtn')[0];
        let profileImageFile = profileImageInput.files[0];
        let firstName = $('#inputFName').val();
        let lastName = $('#inputLName').val();
        let phone = $('#inputPhone').val();
        let city = $('#selectCity').val();
        let address = $('#inputAddress').val();

        let formData = new FormData();

        let errors = 0;
        let regName = /^[A-ZŠĐČĆŽ]{1}[A-zŠĐČĆŽšđčćž]{2,20}$/;
        let regPhone = /^\+1-[0-9]{3}-[0-9]{3}-[0-9]{4}$/;
        let allowedTypes = ["jpeg", "jpg", "png", "svg"];

        // console.log(profileImageFile);

        if (profileImageFile != undefined) {
            let profileImageFileName = profileImageFile.name;
            let profileImageFileExtArr = profileImageFileName.split('.');
            let profileImageFileExt = profileImageFileExtArr[profileImageFileExtArr.length - 1].toLowerCase();

            if (profileImageFile.size > 5000000) {
                errors++;
                $('#errorProfilePicture').removeClass("d-none");
                $('#imageUpdateBtn').addClass("border border-2 border-danger");
                $('#errorProfilePicture').html("Upload size should be less than 5mb!");
            }
            else if (!allowedTypes.includes(profileImageFileExt)) {
                errors++;
                $('#errorProfilePicture').removeClass("d-none");
                $('#imageUpdateBtn').addClass("border border-2 border-danger");
                $('#errorProfilePicture').html("Supported svg, jpg, jpeg and png!");
            }
            else {
                $('#imageUpdateBtn').removeClass("border-danger");
                $('#errorProfilePicture').addClass("d-none");
                $('#imageUpdateBtn').addClass("border-2 border-success");

                formData.append('file', profileImageFile);
            }
        }

        if (firstName == "") {
            errors++;
            $('#errorFName').removeClass("d-none");
            $('#inputFName').addClass("border border-2 border-danger");
            $('#errorFName').html("First is required!");
        }
        else if (!regName.test(firstName)) {
            errors++;
            $('#errorFName').removeClass("d-none");
            $('#inputFName').addClass("border border-2 border-danger");
            $('#errorFName').html("Uppercase and 3 characters min!");
        }
        else {
            $('#inputFName').removeClass("border-danger");
            $('#errorFName').addClass("d-none");
            $('#inputFName').addClass("border-2 border-success");
        }


        if (lastName == "") {
            errors++;
            $('#errorLName').removeClass("d-none");
            $('#inputLName').addClass("border border-2 border-danger");
            $('#errorLName').html("Last is required!");
        }
        else if (!regName.test(lastName)) {
            errors++;
            $('#errorLName').removeClass("d-none");
            $('#inputLName').addClass("border border-2 border-danger");
            $('#errorLName').html("Uppercase and 3 characters min!");
        }
        else {
            $('#inputLName').removeClass("border-danger");
            $('#errorLName').addClass("d-none");
            $('#inputLName').addClass("border-2 border-success");
        }


        if (phone == "") {
            errors++;
            $('#errorPhone').removeClass("d-none");
            $('#inputPhone').addClass("border border-2 border-danger");
            $('#errorPhone').html("Phone is required!");
        }
        else if (!regPhone.test(phone)) {
            errors++;
            $('#errorPhone').removeClass("d-none");
            $('#inputPhone').addClass("border border-2 border-danger");
            $('#errorPhone').html("Example: +1-XXX-XXX-XXXX");
        }
        else {
            $('#inputPhone').removeClass("border-danger");
            $('#errorPhone').addClass("d-none");
            $('#inputPhone').addClass("border-2 border-success");
        }


        if (city == "0") {
            errors++;
            $('#errorCity').removeClass("d-none");
            $('#selectCity').addClass("border border-2 border-danger");
            $('#errorCity').html("City is required!");
        }
        else {
            $('#selectCity').removeClass("border-danger");
            $('#errorCity').addClass("d-none");
            $('#selectCity').addClass("border-2 border-success");
        }


        if (address == "") {
            errors++;
            $('#errorAddress').removeClass("d-none");
            $('#inputAddress').addClass("border border-2 border-danger");
            $('#errorAddress').html("Address is required!");
        }
        else if (address.length <= 3) {
            errors++;
            $('#errorAddress').removeClass("d-none");
            $('#inputAddress').addClass("border border-2 border-danger");
            $('#errorAddress').html("Address is too short!");
        }
        else {
            $('#inputAddress').removeClass("border-danger");
            $('#errorAddress').addClass("d-none");
            $('#inputAddress').addClass("border-2 border-success");
        }


        if (errors == 0) {
            formData.append('firstName', firstName);
            formData.append('lastName', lastName);
            formData.append('phone', phone);
            formData.append('city', city);
            formData.append('address', address);

            $.ajax({
                url: 'models/updateProfile.php',
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function (response) {
                    $('#response-text').removeClass("alert alert-danger");
                    $('#response-text').addClass("alert alert-success");
                    $('#response-text').html(response.msg);
                    console.log(response.msg);
                    setTimeout(function () { window.location.href = "profile.php"; }, 1000);
                },
                error: function (xhr) {
                    var errorMsg = xhr.responseJSON ? xhr.responseJSON.error : "Unknown error.";
                    if (xhr.status == 422) {
                        console.log("Error: " + errorMsg);

                        $('#response-text').removeClass("alert alert-success");
                        $('#response-text').addClass("alert alert-danger");
                        $('#response-text').html(errorMsg);
                    }
                    else if (xhr.status == 500) {
                        console.log("Error: " + errorMsg);
                    }
                }
            });
        }
    });
});