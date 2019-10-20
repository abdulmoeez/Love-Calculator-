<?php include "includes/header.php"; ?>
<?php
include "includes/connection.php";
if (isset($_GET['love'])) {
	$usersLink = $_GET['love'];
	if (isset($_POST['submit'])) {
		$name = $_POST['name'];
		$loversName = $_POST['loversName'];
		if (!empty($name) && !empty($loversName)) {
		
		$sql = "INSERT INTO lovers (name,loversName,userLink) VALUES (?, ?, ?)";
		$stmt = mysqli_stmt_init($conn);
		mysqli_stmt_prepare($stmt, $sql);
		mysqli_stmt_bind_param($stmt, "ssi", $name, $loversName, $usersLink);
		mysqli_stmt_execute($stmt);
		header("Location: prank?u=$usersLink");

	}
	
	}
}

?>
<div class="container">
	<div class="row">
		<div class="col-md-12 mx-auto">
			<div class="card card-body text-center">
 
				<div class="hide-div">
					<?php
					$sql = "SELECT * FROM admin";
					$stmt = mysqli_query($conn,$sql);
						
					while($row = mysqli_fetch_assoc($stmt)){
						$imageURL = $row['imageURL'];
						$imageLink = $row['imageLink'];

					}
					?>

					
				<img class="mainImg mt-3" src="images/Heart-Transparent-Free-PNG.png" height="300px" width="100%">
				<h1 class="heading mb-5">Finally a love calculator that works, try it out and see</h1>
				<form action="" method="post" class="mt-4 hide-form" id="formHide">
					<div class="form-group">
						<label>Your Name</label>
						<div class="input-group">
							<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-heart"></i></span>
							</div>
							<input placeholder="Your Name" class="form-control" type="text" name="name" id="name">
						</div>
					</div>

					<div class="form-group">
						<label>Lover's Name</label>
						<div class="input-group">
							<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-heart"></i></span>
							</div>
							<input placeholder="Lover's Name" class="form-control" type="text" name="loversName" id="loversName">
						</div>
					</div>

					<button id="submit" name="submit" class="btn btn-dark btn-block" type="submit">&#10084; Calculate &#10084;</button>
				</form>
					<a href="<?php echo $imageLink ?>" target="_blank"><img src="<?php echo $imageURL ?>" class="banner mt-4"></a>

				

			

				</div>
					
		
			</div>
		</div>
	</div>
</div>

<?php include "includes/footer.php"; ?>