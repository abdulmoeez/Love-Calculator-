<?php include "includes/header.php"; ?>
<?php

include "includes/connection.php"; 
if (isset($_GET['u'])) {
	$userLink = $_GET['u'];
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

<script type="text/javascript" src="https://platform-api.sharethis.com/js/sharethis.js#property=5d71090bab6f1000123c7f16&product=inline-share-buttons" async="async"></script>
<!-- The Modal -->

<!--INSTAGRAM MODAL-->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h5 class="modal-title text-center">How to add this link to your Instagram BIO.</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <ul>
        	<li>Copy your link</li>
        	<li>Go on your profile in the app</li>
        	<li>Click on Edit Profile</li>
        	<li>Paste the link under Website section</li>

        </ul>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

  
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
					<a href="<?php echo $imageLink ?>" target="_blank"><img src="<?php echo $imageURL ?>" class="banner"></a>

				<h1 class="heading text-center"><?php echo $username; ?></h1>
				<p class="text-center register-paragraph">Share your link.</p>


				<p class="form-control" id="p1">http://flakerocks.com/lovecalc/main?love=<?php echo $userLink ?></p>

				
				<button onclick="copyToClipboard('#p1')" class="btn btn-info mt-4 copyBtn" style="width: 150px;margin:30px auto;">Copy this Link</button>
				<button class="insta-popup" data-toggle="modal" data-target="#myModal">Add to Instagram Bio</button>
                <!-- AddToAny BEGIN -->
                <div class="a2a_kit a2a_kit_size_32 a2a_default_style" data-a2a-url="http://flakerocks.com/lovecalc/love?u=<?php echo $userLink ?>" data-a2a-title="Finally a love calculator that works, try it out and see">
                <a class="a2a_button_facebook"></a>
                <a class="a2a_button_twitter"></a>
                <a class="a2a_button_whatsapp"></a>
                </div>
                <script async src="https://static.addtoany.com/menu/page.js"></script>
                <!-- AddToAny END -->

				

				<table class="table table-bordered table-hover">
					<thead>
		                <tr>
		                    <th>Friends Name</th>
		                    <th>Lover</th>
		                </tr>
		            </thead>
		            <tbody>
						<?php
						$query = "SELECT * FROM lovers WHERE userLink = $userLink";
						$stmt = mysqli_query($conn,$query);
						while ($row = mysqli_fetch_assoc($stmt)) {
							$name = $row['name'];
							$Loversname = $row['loversName'];
							echo "<tr>";
							echo "<td>$name</td>
							<td>$Loversname</td>";
							echo "</tr>";


						}
						?>
		            	
		            	
		            	</tr>
		            </tbody>

				</table>
			</div>
		</div>
	</div>
</div>

<?php include "includes/footer.php"; ?>