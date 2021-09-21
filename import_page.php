<!DOCTYPE html>
<?php 
	include 'database.php';
 
?>	
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Import Excel To MySQL Database Using PHP </title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="Import Excel File To MySQL Database Using php">
 
		<!--<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/bootstrap-responsive.min.css">
		<link rel="stylesheet" href="css/bootstrap-custom.css">-->
 
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
 
	</head>
	<body>    
 
	<!-- Navbar
    ================================================== -->
 
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<div class="container-fluid">
			<a class="navbar-brand" href="#">Quotation</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav me-auto mb-2 mb-lg-0">
					<li class="nav-item">
						<a class="nav-link active" aria-current="page" href="index.php">Home</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#">Quote</a>
					</li>
					<li class="nav-item">
					<a class="nav-link" href="customer.php">Customer Info</a>
					</li>
				</div>
			</div>
		</nav>
 
	<div id="wrap">
	<div class="container ">
		<div class="row">
			<div class="span3 hidden-phone"></div>
			<div class="span6" id="form-login">
				<form class="form-horizontal well" action="import.php" method="post" name="upload_excel" enctype="multipart/form-data">
					<fieldset>
						<legend>Batch import</legend>
						<div class="control-group">
							<div class="control-label">
								<label>Upload CSV File:</label>
							</div>
							<div class="controls">
								<input type="file" name="file" id="file" class="input-large" accept=".csv">
							</div>
						</div>
 
						<div class="control-group mt-2">
							<div class="controls">
							<button type="submit" id="submit" name="Import" class="btn btn-primary button-loading" data-loading-text="Loading...">Upload</button>
							</div>
						</div>
					</fieldset>
				</form>
			</div>
			<div class="span3 hidden-phone"></div>
		</div>
 
		<table class="table table-bordered mt-5">
			<thead>
				  	<tr>
				  		<th>Part NUmber</th>
				  		<th>Quantity</th>
				  		<th>Qnum</th>
				  		<th>LineSeq</th>
				  	
 
 
				  	</tr>	
				  </thead>
			<?php
				$SQLSELECT = "SELECT * FROM BatchImport_tmp ";
				$result_set =  mysqli_query($conn, $SQLSELECT);
				while($row = mysqli_fetch_array($result_set))
				{
				?>
 
					<tr>
						<td><?php echo $row['part_number']; ?></td>
						<td><?php echo $row['qty']; ?></td>
						<td><?php echo $row['Qnum']; ?></td>
						<td><?php echo $row['LineSeq']; ?></td>
					
 
 
					</tr>
				<?php
				}
			?>
		</table>
	</div>
 
	</div>
 
	</body>
</html>