<?php
include "template/head.php";
include "template/nav.php";

if (isset($_SESSION['user']) && $_SESSION['user']->name_role == "admin") {
    $msgArr = getAnyTable("message");
?>

    <div class="container untree_co-section product-section before-footer-section" id="adminPanel-div">
        <div class="d-flex align-items-center mb-5">
            <button id="backToProducts" class="me-3 btn"><i id="backArrow" class="fa-solid fa-chevron-left me-2"></i>Back to panel</button>
            <h2 class="mb-0">Messages from contact page</h2>
        </div>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Message</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($msgArr as $msg) : ?>
                        <tr>
                            <td scope="row"><?php echo $no; ?></td>
                            <td scope="row"><?php echo $msg->fn_msg . " " . $msg->ln_msg; ?></td>
                            <td scope="row"><?php echo $msg->email_msg; ?></td>
                            <td scope="row"><?php echo $msg->msg; ?></td>
                        </tr>
                    <?php $no++;
                    endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

<?php
} else {
    header("Location: 404.php");
}
?>

<?php
include "template/footer.php";
?>