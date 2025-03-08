<?php
$user = isset($_SESSION['user']) ? $_SESSION['user'] : null;
if ($user != null) {
	$roleName = $user->name_role;
	$navArr = getNavWithRoles($roleName);
	$profileURL = "profile.php";
} else {
	$roleName = "guest";  // Set default role for non-logged in users
	$navArr = getNavWithRoles("user");
	$profileURL = "login.php";
}

$path = $_SERVER['REQUEST_URI'];
if (!str_contains($path, "login.php")) {
?>
	<!-- Start Header/Navigation -->
	<nav class="custom-navbar navbar navbar navbar-expand-md navbar-dark bg-dark" arial-label="Furni navigation bar">

		<div class="container">
			<a class="navbar-brand" href="index.php">Furni<span>.</span></a>

			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsFurni" aria-controls="navbarsFurni" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarsFurni">
				<ul id="navbarsFurniUl" class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">
					<?php foreach ($navArr as $nav) : ?>
						<li><a class="nav-link" href="<?= $nav->path_nav ?>"><?= $nav->name_nav ?></a></li>
					<?php endforeach; ?>
				</ul>

				<ul class="custom-navbar-cta navbar-nav mb-2 mb-md-0 ms-5">
					<li>
						<?php if ($roleName == "user") : ?>
							<a class="nav-link" href="<?php echo $profileURL; ?>">
								<i class="fa-regular fa-user"></i>
								<span class="ms-1"><?php echo $_SESSION['user']->fn_user; ?></span>
							</a>
						<?php elseif ($roleName == "admin") : ?>
							<a class="nav-link d-none" href="login.php">
								<i class="fa-regular fa-user"></i>
							</a>
						<?php else : ?>
							<a class="nav-link" href="login.php">
								<i class="fa-regular fa-user"></i>
							</a>
						<?php endif; ?>
					</li>
					<li>
						<?php if (isset($_SESSION['user'])) : ?>
							<a class="nav-link" href="models/logout.php">
								<i class="fa-solid fa-arrow-right-from-bracket"></i>
							</a>
						<?php endif; ?>
					</li>
					<li>
						<a class="nav-link" href="cart.php">
							<i class="fa-solid fa-cart-shopping"></i>
						</a>
					</li>
				</ul>
			</div>
		</div>

	</nav>
	<!-- End Header/Navigation -->
<?php
}
?>