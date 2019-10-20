<?php include "includes/header.php"; ?>
<?php
include "includes/connection.php"; 
$errorMesg = '';
$userLink = mt_rand();


if (isset($_SESSION['userLink'])) {
	$userLink = $_SESSION['userLink'];
	header("Location: love?u=$userLink");

	}else{

if (isset($_POST['submit'])) {
	$username = $_POST['username'];
	if (empty($username)) {
   	 $errorMesg = "<div class='alert alert-danger'>Please enter username</div>";
   }
   else{
   	$sql = "SELECT username FROM users WHERE username =?";
   	$stmt = mysqli_stmt_init($conn);
   		mysqli_stmt_prepare($stmt, $sql);
   		mysqli_stmt_bind_param($stmt, "s", $username);
   		mysqli_stmt_execute($stmt);
   		mysqli_stmt_store_result($stmt);
   		$resultCheck = mysqli_stmt_num_rows($stmt);
   		if ($resultCheck > 0) {
   		$errorMesg = "<div class='alert alert-danger'>Username already taken</div>";

   		}
   		else{
   			$sql = "INSERT INTO users (username,userLink) VALUES (?, ?)";
   		  	$stmt = mysqli_stmt_init($conn);
   		  	mysqli_stmt_prepare($stmt, $sql);
	  		mysqli_stmt_bind_param($stmt, "si", $username, $userLink);
	    	mysqli_stmt_execute($stmt);
	    	$_SESSION['userLink'] = $userLink;
	    	header("Location: love?u=$userLink");
   		}
   	}
 
}
}
?>
<div class="container">
	<div class="row">
		<div class="col-md-12 mx-auto">
			<div class="card card-body">
					<?php
					$sql = "SELECT * FROM admin";
					$stmt = mysqli_query($conn,$sql);
						
					while($row = mysqli_fetch_assoc($stmt)){
						$imageURL = $row['imageURL'];
						$imageLink = $row['imageLink'];

					}
					?>


				
				<img src="images/heart2.png" height="200px" width="200px" class="img-register">
				

				<h1 class="heading text-center">Love Calculator Prank</h1>
				<p class="text-center register-paragraph">Find Secret Lover of your Friends using this Fake Love Calculator.</p>
				<ul class="register-links">
					<li>Register & Share your link.</li>
					<li>Check your Friend's Secret Crush on your Secret link.</li>
				</ul>
				<form method="post" action="" class="mt-4">
					<div class="form-group">
						<?php echo $errorMesg; ?>
						<label>Username</label>
						<div class="input-group">
							<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-heart"></i></span>
							</div>
							<input class="form-control" type="text" name="username" id="username" placeholder="username">
						</div>
					</div>
						<input type="hidden" name="" id="userLink" value="<?php echo $userLink ?>">


				

					<button name="submit" class="btn btn-dark btn-block" id="submitUser" type="submit">&#10084; Register &#10084;</button>
				</form>
				<a href="<?php echo $imageLink ?>" target="_blank"><img src="<?php echo $imageURL ?>" class="banner mt-4"></a>

			</div>
		</div>
	</div>
</div>

<?php include "includes/footer.php"; ?>