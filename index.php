<?php 
	require('config/config.php'); 
	require('config/db.php'); 
	if (session_status() !== PHP_SESSION_ACTIVE) { session_start(); }
?>

<?php include 'inc/header.php'; ?>
	<section id="home">
		<div class="container">
			<div class="mt-3">
				<?php if(!isset($_SESSION['loggedIn'])) : ?>
					<h1 class="text-center mb-5">Welcome</h1>
					<div class="text-center">
					<a href="<?php echo ROOT_URL ?>signup.php" class="link-btn">Sign Up</a>
					<div class="my-2"></div>
					<a href="<?php echo ROOT_URL ?>login.php" class="link-btn">Log In</a>
					</div>

				<?php else: include('dashboard.php'); endif;?>

			</div>
			
		</div>
	</section>

<?php include 'inc/footer.php'; ?>