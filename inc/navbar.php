<header id="header">
	<div class="container">
		<nav class="navigation">
			<a href="<?php echo ROOT_URL ?>" class="logo">Note8</a>
			<div class="float-right mt-3">
			<?php if(isset($_SESSION['loggedIn'])) : ?>
				<div class="dropdown show">
				  <a class="dropdown-toggle profile-link" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				    <i class="open-navBtn fa fa-user-circle-o fa-2x" style="color: #c69c27;"></i><?php echo($_SESSION['u_first'].' '.$_SESSION['u_last']); ?>
				  </a>

				  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
				    <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Log Out
				    	<form action="<?php echo ROOT_URL; ?>processes.php" method="POST" id="logout-form">
							<input type="hidden" name="logout">
						</form>
					</a>
				  </div>
				</div>
			<?php else: ?>
				Please <a href="<?php echo(ROOT_URL); ?>login.php" class="profile-link">login</a> or <a href="<?php echo(ROOT_URL); ?>signup.php" class="profile-link">register</a>
			<?php endif; ?>
			</div>
			<!-- <button class="open-navBtn"><i class="fa fa-bars"></i></button> -->

			<div class="responsive-nav d-lg-none">
				<ul>
					<li><a href="<?php echo ROOT_URL ?>">Home</a></li>
					<?php if(isset($_SESSION['loggedIn'])): ?>
						<li><a href="<?php echo ROOT_URL; ?>newNote.php">New Note</a></li>
						<li><a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Log Out
							<!-- <form action="<?php //echo ROOT_URL; ?>logout.php" method="POST" id="logout-form">
								<input type="hidden" name="logout">
							</form> -->
						</a></li>
					<?php endif; ?>
				</ul>

			</div>
		</nav>
	</div>
</header>

<div class="bg-cover"></div>