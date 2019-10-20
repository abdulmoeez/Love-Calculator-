<?php include "includes/header.php"; ?>
<?php
$errorMesg = '';
include "includes/connection.php"; 
if (isset($_GET['admin'])) {
	if (isset($_POST['submitAdmin'])) {
	$imageURL = $_POST['imageUrl'];
	$imageLink = $_POST['imageLink'];

if (empty($imageURL) || empty($imageLink)) {
$errorMesg = "<div class='alert alert-danger'>Please enter all fields</div>";
}
else{
$sql = "UPDATE admin SET imageURL = ? ,imageLink = ?";
$stmt = mysqli_stmt_init($conn);
mysqli_stmt_prepare($stmt, $sql);
mysqli_stmt_bind_param($stmt, "ss", $imageURL, $imageLink);
mysqli_stmt_execute($stmt);
$errorMesg = "<div class='alert alert-success'>Update Success</div>";

}

}
}else{
	header("Location:index");
}

?>

<div class="container">
	<div class="row">
		<div class="col-md-12 mx-auto">
			<div class="card card-body">
				<h1 class="heading text-center">Admin Page</h1>
				<?php echo $errorMesg; ?>
				<form method="post" action="">
					<input class="form-control mt-5" placeholder="Enter URL of the image" type="text" name="imageUrl">
					<input class="form-control mt-2" placeholder="Enter Website Link" type="text" name="imageLink">
					<button type="submit" class="mt-3 btn btn-dark btn-block" name="submitAdmin">Update</button>

				</form>

					<table class="mt-5 table table-bordered table-hover">
					<thead>
		                <tr>
		                    <th>Users</th>
		                </tr>
		            </thead>
		            <tbody>
						<?php
						$query = "SELECT * FROM users";
						$stmt = mysqli_query($conn,$query);
						while ($row = mysqli_fetch_assoc($stmt)) {
							$username = $row['username'];
							$id = $row['id'];
							$usersLink = $row['userLink'];
							echo "<tr>";

							echo "<td><a href='userInfo?u=$usersLink' class='admin-links'>$id - $username</a></td>";
							echo "</tr>";


						}
						?>
						
		            </tbody>

				</table>

			</div>
		</div>
	</div>
</div>
<?php include "includes/footer.php"; ?>