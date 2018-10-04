<?php
$title = isset($_REQUEST['s']) ? "Results: ".$_REQUEST['s'] : "Search";
$css = ['select2.min', 'select2-bootstrap4.min'];
include('view/header.php');
if($sessionStarted == false){
	header('Location: /~iot3/');
}
?>
<div class="container mt-3"><!-- Search Bar Container -->
	<form class="row justify-content-center" action="<?php echo htmlentities($_SERVER['REQUEST_URI']); ?>" method="get">
		<!-- <div class="col-12"><h3 class="text-center font-weight-light mb-0">Search</h3></div> -->
		<div class="col-12">
			<div class="form-group row mb-0">
				<div class="col-lg-11 col-md-10 col-sm-12 pr-lg-1 pr-md-1 mb-2 mb-md-0"><!-- Search Bar -->
					<select id="search" class="custom-select" name="s"></select>
				</div><!-- [END] Search Bar -->
				<div class="col-lg-1 col-md-2 col-sm-12 pl-lg-1 pl-md-1"><!-- Search Button -->
					<button class="btn btn-success btn-block" type="submit">
						<span class="d-none d-md-block"><span class="oi oi-magnifying-glass"></span></span>
						<span class="d-sm-block d-md-none">Search</span>
					</button>
				</div><!-- [END] - Search Button -->
			</div>
		</div>
	</form>
</div><!-- [END] - Search Bar Container -->

<?php
if(isset($_REQUEST['s']) && strlen($_REQUEST['s']) > 0){
	$query = explode(':', urldecode($_REQUEST['s']));
	if(sizeof($query) == 2){
		include('controller/resultsController.php');
		include('view/resultsView.php');
		$rc = new resultsController();
		$rv = new resultsView();
		$category = $query[0];
		$id = $query[1];
		$results = $rc->results($category, $id);
		if(isset($results['status']) && $results['status'] == false){
			echo "<h3 class='text-center font-weight-normal'>".$results['message']."</h3>";
		}else{
			$rv->view($results);
		}
	}else{
		echo "<h3 class='text-center font-weight-normal'>Invalid Search Type.</h3>";
	}
}else {
	//echo "<h3 class='text-center font-weight-normal'>Invalid Search.</h3>";
}

$javascript = ['select2.min', 'search', 'bootbox.min', 'results'];
include('view/footer.php');
?>
