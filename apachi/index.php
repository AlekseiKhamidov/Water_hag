<?php
	require_once '../bundles.php';
	  $PAGE = "apachi";
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
			var partner = 865467;
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
