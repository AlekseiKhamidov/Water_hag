<?php
	require_once '../bundles.php';
    $PAGE = "gyroscooter-perm";
?>
<!DOCTYPE html>
<html lang="en">
	<?php require_once '../parts/headHTML.php'?>
	<body>
    <?php require_once '../parts/preloader.php'	?>
		<section class="form-gradient" >
			<div class="row justify-content-center">
			    <div class="col-md-6 mb-4" style="width: 90%">
					<form id="formReg">
						<?php	require_once '../parts/form.php';	?>
					</form>
					<?php require_once '../parts/footer.php';	?>
		    </div>
			</div>
		</section>
		<?php 	require_once '../parts/addScript.php'; ?>
		<script>
			var stepIndex=0;
		  var stepSuccess = 11;
		  var stepAgeError = 13;
		  var stepAccessError =12;
		  var stepAccess = 10;
		  var stepAge = 0;
		  var maxSize = 8000000;
		  var stepDoc = 9;
			var partner = 836257;
			var pipeline = "pos-credit";
			var group = <?php
				require_once '../config.php';
				echo json_encode(VK['group']['main']);
			?>;
		  $(".readonly").on('keydown paste', function(e){
		    e.preventDefault();
		  });
			<?php 	require_once '../parts/mainScript.php'; ?>
		</script>
	</body>
</html>
