<?php 
	require 'config/config.php';
	require 'config/db.php';

	$id = mysqli_real_escape_string($conn, $_GET['id']);

	$sql = "SELECT * FROM listings WHERE id = '$id'";
	$result = mysqli_query($conn, $sql);

	$listing = mysqli_fetch_assoc($result);

	mysqli_free_result($result);
	mysqli_close($conn);
 ?>

<?php include('inc/header.php'); ?>
	<div class="container">
			<div>
				<a href="<?php echo ROOT_URL; ?>" class="back-btn">&lt;Notes</a>
				<h1 class="text-center">To Do List</h1>
				<form action="<?php echo(ROOT_URL); ?>processes.php" method="post" id="edit-form">
					<button type="button" class="cancel-btn" style="display: none;">Cancel</button>
					<button type="submit" name="edit" class="add-btn" style="display: none;">Done</button>
					<br>
					<textarea name="description" class="todoDesc" required><?php echo $listing['description']; ?></textarea>
					<input type="hidden" name="updatedTime" id="updateTime" value="<?php date_default_timezone_set('America/Chicago'); echo(time()); ?>">
					<input type="hidden" name="update_id" id="updateId" value="<?php echo $listing['id']; ?>">
					
				</form>
				<form action="<?php echo ROOT_URL; ?>processes.php" method="POST" class="delete-form">
					<input type="hidden" name="delete_id" value="<?php echo $listing['id']; ?>">
					<button type="submit" name="delete"><i class=" fa fa-trash float-right mr-2 fa-lg"></i></button>
				</form>
			</div>
		</div>
<?php include('inc/footer.php'); ?>
