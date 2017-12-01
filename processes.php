<?php 
	require 'config/config.php';
	require 'config/db.php';
	session_start();

	// Register
	if(isset($_POST['register'])){
		$firstname = mysqli_real_escape_string($conn, $_POST['firstName']);
		$lastname = mysqli_real_escape_string($conn, $_POST['lastName']);
		$password = mysqli_real_escape_string($conn, $_POST['pass']);
		$email = mysqli_real_escape_string($conn, $_POST['email']);

		if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
			echo 'Please use a valid email address';
		}
		else{
			$sql = "SELECT * FROM users WHERE email = '$email'";
			$result = mysqli_query($conn, $sql);
			$resultCheck = mysqli_num_rows($result);

			if($resultCheck > 0){
				echo 'This email has already been registered';
			}
			else{
				$hashedPwd = password_hash($password, PASSWORD_DEFAULT);
				$sql = "INSERT INTO users (firstName, lastName, pass, email) VALUES ('$firstname', '$lastname', '$hashedPwd', '$email')";


				if(mysqli_query($conn, $sql)){
					header('Location:'. ROOT_URL);
				}
				else{
					echo 'ERROR: '. mysqli_error($conn);;
					die();
				}
			}
			
		}
	}

	// Log In
	if(isset($_POST['login'])){
		$password = mysqli_real_escape_string($conn, $_POST['pass']);
		$email = mysqli_real_escape_string($conn, $_POST['email']);

		if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
			echo 'Please use a valid email address';
		}
		else{
			$sql = "SELECT * FROM users WHERE email = '$email'";
			$result = mysqli_query($conn, $sql);
			$resultCheck = mysqli_num_rows($result);

			if($resultCheck < 1){
				echo 'You have entered an invalid email or password';
			}
			else{
				
				if($row = mysqli_fetch_assoc($result)){
					$hashedPwdCheck = password_verify($password, $row['pass']);
					if($hashedPwdCheck === false){
						echo 'You have entered an invalid email or password';
					}
					else{
						
						$_SESSION['u_first'] = $row['firstName'];
						$_SESSION['u_last'] = $row['lastName'];
						$_SESSION['u_email'] = $row['email'];
						$_SESSION['id'] = $row['id'];
						$_SESSION['loggedIn'] = true;
						//Free Result
						mysqli_free_result($result);
						header('Location:'. ROOT_URL);					
					}
				}
			}
		}
	}

	// Create new note
	if(isset($_SESSION['loggedIn'])){
		if(isset($_POST['submit'])){
			$desc = mysqli_real_escape_string($conn, $_POST['description']);
			$title = implode(' ', array_slice(explode(' ', $desc), 0, 5));
			$author = "SELECT id FROM users WHERE id = " . $_SESSION['id'];
			$result = mysqli_query($conn, $author);
			$row = mysqli_fetch_assoc($result);
			$authorId = $row['id'];

			$sql = "INSERT INTO listings(title, description, userId) VALUES ('$title', '$desc', '$authorId')";
			$result = mysqli_query($conn, $sql);

			if($result){
				mysqli_free_result($result);
				header('Location:' .ROOT_URL);
			}
			else{
				echo 'ERROR: '. mysqli_error($conn);
			}
		}
	}
	else{
		echo 'Unautherized Access';
		die();
	}

	// Edit note
	if(isset($_POST['description'])){
		$desc = mysqli_real_escape_string($conn, $_POST['description']);
		$title = implode(" ", array_slice(explode(" ", $desc), 0,5));
		$update_id = mysqli_real_escape_string($conn, $_POST['update_id']);
		date_default_timezone_set('America/Chicago');
		$time = mysqli_real_escape_string($conn, $_POST['updatedTime']);
		$update_time = date('Y-m-d H:i:s', $time);
		$sql = "UPDATE listings SET title = '$title', description = '$desc', last_update = '$update_time' WHERE id = {$update_id}";

		if(mysqli_query($conn, $sql)){
			echo 'Successfully updated note'.$update_id;
			echo $id;
		}
		else{
			echo 'ERROR: '.mysqli_error($conn);
		}
	}

	// Delete note
	if(isset($_POST['delete'])){
		$deleteId = mysqli_real_escape_string($conn, $_POST['delete_id']);

		$sql = "DELETE FROM listings WHERE id = {$deleteId}";
		if(mysqli_query($conn, $sql)){
			header('Location:'.ROOT_URL);
		}
		else{
			echo 'ERROR:'.mysqli_error();
		}

	}

	// Log out
	if(isset($_POST['logout'])){
			session_start();
			session_unset();
			$_SESSION = array();
			if (ini_get("session.use_cookies")) {
			    $params = session_get_cookie_params();
			    setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
			}
			session_destroy();
			header('Location: ' .ROOT_URL);
	}

 ?>