<?php 
	require 'config/config.php';
	require 'config/db.php';
?>

<?php include 'inc/header.php'; ?>
<section id="login">
		<div class="container text-center">
			<h1 class="my-5">Login</h1>
			<form action="<?php echo(ROOT_URL); ?>processes.php" method="POST" id="login-form">
				<div class="row">
					<div class="col-12 col-lg-6 mb-2">
						<input type="email" name="email" placeholder="Email" required>
					</div>
					<div class="col-12 col-lg-6">
						<input type="password" name="pass" placeholder="Password" required>
					</div>
				</div>
				<button type="submit" name="login" class="submit-btn">Submit</button>
			</form>
		</div>
	</section>
<?php include 'inc/footer.php'; ?>