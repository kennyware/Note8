<?php 
	require 'config/config.php';
	require 'config/db.php';
?>

<?php include('inc/header.php'); ?>
	<section id="list-area">
		<div class="container">
			<div>
				<h1 class="text-center">To Do List</h1>
				<form action="<?php echo(ROOT_URL); ?>processes.php" method="post" id="todo-form">
					<a href="<?php echo ROOT_URL; ?>" class="cancel-btn">Cancel</a>
					<button type="submit" name="submit" class="add-btn">Add</button>
					<br>
					<textarea name="description" class="todoDesc" required></textarea>					
				</form>
			</div>
			

		</div>
	</section>
<?php include('inc/footer.php'); ?>