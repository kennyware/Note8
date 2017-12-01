<?php 
	require 'config/config.php';
	require 'config/db.php';
?>

<?php include 'inc/header.php'; ?>
	<section id="signup">
		<div class="container text-center">
			<h1 class="my-5">Sign Up</h1>
			<form action="<?php echo(ROOT_URL); ?>processes.php" method="POST" id="signup-form">
				<div class="row">
					<div class="col-12 col-lg-6 mb-2">
						<input type="text" name="firstName" placeholder="First Name" required>
					</div>
					<div class="col-12 col-lg-6 mb-2">
						<input type="text" name="lastName" placeholder="Last Name" required>
					</div>
				</div>
				<div class="row">
					<div class="col-12 col-lg-6 mb-2">
						<input type="password" name="pass" placeholder="Password" required>
					</div>
					<div class="col-12 col-lg-6">
						<input type="email" name="email" placeholder="Email" required>
					</div>
				</div>
				<button type="submit" name="register" class="submit-btn">Submit</button>
			</form>
		</div>
	</section>
<?php include 'inc/footer.php' ?>