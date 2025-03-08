<?php
$path = $_SERVER['REQUEST_URI'];
if (!str_contains($path, "login.php")) {
?>
	<!-- Start Footer Section -->
	<footer class="footer-section">
		<div class="container relative">

			<div class="row mb-5">

				<div class="col-lg-6">
					<div class="mb-4 footer-logo-wrap"><a href="#" class="footer-logo">Furni<span>.</span></a></div>
					<p class="mb-4">Furni is your trusted destination for exquisite furniture. Immerse yourself in a world of elegance and comfort, where each piece is crafted with precision and designed to elevate your living spaces. Explore our curated collections and transform your home with Furni, where style meets functionality.</p>

					<ul class="list-unstyled custom-social">
						<li><a href="#"><span class="fa fa-brands fa-facebook-f"></span></a></li>
						<li><a href="#"><span class="fa fa-brands fa-twitter"></span></a></li>
						<li><a href="#"><span class="fa fa-brands fa-instagram"></span></a></li>
						<li><a href="#"><span class="fa fa-brands fa-linkedin"></span></a></li>
					</ul>
				</div>

				<div class="col-lg-6">
					<div class="row links-wrap justify-content-end">
						<div class="col-6 col-sm-6 col-md-3">
							<ul class="list-unstyled">
								<li><a href="index.php">Home</a></li>
								<li><a href="shop.php">Shop</a></li>
								<li><a href="about.php">About</a></li>
								<li><a href="contact.php">Contact us</a></li>
								<li><a href="services.php">Services</a></li>
							</ul>
						</div>
					</div>
				</div>

			</div>

			<div class="border-top copyright">
				<div class="row pt-4">
					<div class="col-lg-6">
						<p class="mb-2 text-center text-lg-start">Copyright &copy; <script>
								document.write(new Date().getFullYear());
							</script>. All Rights Reserved. &mdash; Furni
						</p>
					</div>
				</div>
			</div>
		</div>
	</footer>
	<!-- End Footer Section -->
<?php
}
?>

<script src="assets/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/tiny-slider.js"></script>
<script src="assets/js/custom.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="assets/js/as-main.js"></script>
</body>

</html>