<?php
	$sql = "SELECT * FROM listings WHERE userId = {$_SESSION['id']} ORDER BY last_update DESC";
	$result = mysqli_query($conn, $sql);
	$resultCheck = mysqli_num_rows($result);
	$listings = mysqli_fetch_all($result, MYSQLI_ASSOC);
	mysqli_free_result($result);
	mysqli_close($conn);

?>
<section id="dashboard">
	<div class="container">
		<h1 class="text-center d-inline-block">Notes</h1>
		<a href="<?php echo ROOT_URL; ?>newNote.php" class="d-inline-block mt-3 float-right" style="color: #c69c27;"><i class="fa fa-pencil-square-o fa-lg "></i></a>
		
		<div id="search-wrapper">
			
		</div>
		<div>
			<?php if($resultCheck > 0) : ?>
			<?php foreach ($listings as $listing) : ?>
				<div class="my-row my-4" style="border-bottom: 1px solid #bbb"><a href="<?php echo ROOT_URL; ?>note.php?id=<?php echo $listing['id']; ?>" class="note">
						<p><?php echo $listing['title'].'...' ?></p>
						<br>
						<p class="ellipsis">
						<small style="margin: 0;"><?php echo date('m/d/y', strtotime($listing['last_update'])); ?></small>
						<small>&nbsp;&nbsp;<?php echo $listing['description']; ?></small>
						</p>
						<form action="<?php echo(ROOT_URL); ?>processes.php" method="POST" class="delete-form">
							<input type="hidden" name="delete_id" value="<?php echo $listing['id']; ?>">
							<input type="hidden" name="delete" value="delete">
							<a href="#" class="delete-btn"><i class=" fa fa-trash float-right mr-2"></i></a>
							<!-- <button class="delete-btn" type="submit" name="delete"><i class="fa fa-trash float-right mr-2"></i></button> -->
						</form>
					</a>
				</div>
			<?php endforeach; ?>
			<?php else: ?>
				<div class="text-center">
					<p>You do not have any notes.</p>
					<p>Click the pencil in the top right corner to get started.</p>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>
