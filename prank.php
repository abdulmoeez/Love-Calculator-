<?php include "includes/header.php"; ?>
<?php
include "includes/connection.php"; 
if (isset($_GET['u'])) {
	$usersLink = $_GET['u'];
	
	
	}else{
		header("Location: index");
	}
?>


<div class="container">
	<div class="row">
		<div class="col-md-12 mx-auto">
			<div class="card card-body text-center">
					<?php
					$sql = "SELECT * FROM admin";
					$stmt = mysqli_query($conn,$sql);
						
					while($row = mysqli_fetch_assoc($stmt)){
						$imageURL = $row['imageURL'];
						$imageLink = $row['imageLink'];

					}
					?>
					<a href="<?php echo $imageLink ?>" target="_blank"><img src="<?php echo $imageURL ?>" class="banner"></a>

		<!--SECTION USER PRANKED-->
				<section class="sectionPrank">
				<a class="btn btn-info" href="<?php
				if(isset($_SESSION['userLink'])){
					$userLink = $_SESSION['userLink'];
					echo "love?u=$userLink";
				}else{
					echo "index";
				}
				?>">My Dashboard</a>
				<?php
				// name of the user who pranked friend
				$sql = "SELECT * FROM users WHERE userLink =?";
				$stmt = mysqli_stmt_init($conn);
				mysqli_stmt_prepare($stmt, $sql);
				mysqli_stmt_bind_param($stmt, "s", $usersLink);
				mysqli_stmt_execute($stmt);
				$result = mysqli_stmt_get_result($stmt);
				while($row = mysqli_fetch_assoc($result)){
				$username = $row['username'];
		}
				?>
				<p class="prankPara mt-3 prankPara1">You have been fooled by <span class="prankSpan"><?php echo $username ?></span></p>
				<p class="prankPara">Your name as well as name of your love has been sent to  <span class="prankSpan"><?php echo $username ?></span> </p>
				<img src="https://lovecalculator.site/images/prank.gif" width="200px" height="200px" style="margin: auto;">
				<hr>
				<p>Register NOW to play the same prank on your friends.</p>
				<a class="btn btn-success" href="index">Register Now</a>
				<h3 class="howWork mt-4">How it works?</h3>
					<table class="mt-2 table">
					<tbody>
					<tr>
					<th>STEP 1</th>
					<td>Check your Friend's Secret Crush on your Secret link.</td>
					
					</tr>
					<tr>
					<th>STEP 2</th>
					<td>Register & Share your link.</td>
					
					</tr>



					</tbody>
					</table>
				</section>
					</div>
		</div>
	</div>
</div>

<?php include "includes/footer.php"; ?>