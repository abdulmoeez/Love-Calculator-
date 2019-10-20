<?php include "includes/header.php"; ?>
<?php
include "includes/connection.php"; 
if (isset($_GET['u'])) {
	$userLink = $_GET['u'];
	// $userLink = $_SESSION['userLink'];
	$sql = "SELECT * FROM users WHERE userLink =?";
   	$stmt = mysqli_stmt_init($conn);
   		mysqli_stmt_prepare($stmt, $sql);
   		mysqli_stmt_bind_param($stmt, "i", $userLink);
   		mysqli_stmt_execute($stmt);
     	$result = mysqli_stmt_get_result($stmt);
		while($row = mysqli_fetch_assoc($result)){
			$username = $row['username'];
		}
	}else{
		header("Location: index");
	}
?>

<div class="container">
	<div class="row">
		<div class="col-md-12 mx-auto">
			<div class="card card-body">
				<a href="admin.php" class="btn btn-info mb-5">Admin Page</a>
				<h1 class="heading text-center"><?php echo $username; ?> Information</h1>

					<table class="mt-4 table table-bordered table-hover">
					<thead>
		                <tr>
		                    <th>Name</th>
		                  	<th>Lovers Name</th>

		                </tr>
		            </thead>
		            <tbody>
						<?php
						$sql = "SELECT * FROM lovers WHERE userLink =?";
						$stmt = mysqli_stmt_init($conn);
						mysqli_stmt_prepare($stmt, $sql);
						mysqli_stmt_bind_param($stmt, "i", $userLink);
						mysqli_stmt_execute($stmt);
						$result = mysqli_stmt_get_result($stmt);
						while($row = mysqli_fetch_assoc($result)){

							$name = $row['name'];
							$lover = $row['loversName'];
							echo "<tr>";
							echo "<td class='admin-links'>$name</td>";
							echo "<td class='admin-links'>$lover</td>";
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