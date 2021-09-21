<?php

use Phppot\DataSource;

require_once 'DataSource.php';
$db = new DataSource();
$conn = $db->getConnection();

if (isset($_POST["import"])) {

	error_reporting(E_ALL);
	//echo "Inside if block";
	$fileName = $_FILES["file"]["tmp_name"];
    
    if ($_FILES["file"]["size"] > 0) {
        
        $file = fopen($fileName, "r");

		while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {

			$part_number = "";
			if (isset($column[0])) {
				$part_number = mysqli_real_escape_string($conn, $column[0]);
			}
			$qty = "";
			if (isset($column[1])) {
				$qty = mysqli_real_escape_string($conn, $column[1]);
			}
			$Qnum = "";
			if (isset($column[2])) {
				$Qnum = mysqli_real_escape_string($conn, $column[2]);
			}
			$LineSeq = "";
			if (isset($column[3])) {
				$LineSeq = mysqli_real_escape_string($conn, $column[3]);
			}

			$sqlInsert = "INSERT into BatchImport_tmp (part_number, qty, Qnum, LineSeq)
                   values (?,?,?,?)";
			$paramType = "issss";
			$paramArray = array(
				$part_number,
				$qty,
				$Qnum,
				$LineSeq
			);
			$insertId = $db->insert($sqlInsert, $paramType, $paramArray);

			if (!empty($insertId)) {
				$type = "success";
				$message = "CSV Data Imported into the Database";
			} else {
				$type = "error";
				$message = "Problem in Importing CSV Data";
			}
		}
	}
}
?>




<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Quote</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>

	<style>
		#response {
			padding: 10px;
			margin-bottom: 10px;
			border-radius: 2px;
			display: none;
		}

		.success {
			background: #c7efd9;
			border: #bbe2cd 1px solid;
		}

		.error {
			background: #fbcfcf;
			border: #f3c6c7 1px solid;
		}

		div#response.display-block {
			display: block;
		}
	</style>






	<script type="text/javascript">
		$(document).ready(function() {
			$("#frmCSVImport").on("submit", function() {

				$("#response").attr("class", "");
				$("#response").html("");
				var fileType = ".csv";
				var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + fileType + ")$");
				if (!regex.test($("#file").val().toLowerCase())) {
					$("#response").addClass("error");
					$("#response").addClass("display-block");
					$("#response").html("Invalid File. Upload : <b>" + fileType + "</b> Files.");
					return false;
				}
				return true;
			});
		});
	</script>



</head>

<body>
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
						<a class="nav-link" href="import.php">Import</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="customer.php">Customer Info</a>
					</li>
			</div>
		</div>
	</nav>

	<div id="response" class="<?php if (!empty($type)) { echo $type . " display-block";} ?>">
		<?php if (!empty($message)) {
			echo $message;
		} ?>
	</div>


	<div class="d-flex justify-content-center mt-3">
		<div class="row">
			<form aaction="" method="post" name="frmCSVImport" id="frmCSVImport" enctype="multipart/form-data">
				<label for="formFile" class="form-label">Import Batch</label>
				<input class="form-control" type="file" name="type=" file" name="file" id="file" accept=".csv">
				<button type="submit" id="submit" name="import" class="btn btn-primary mt-2">Import</button>
			</form>
		</div>
	</div>






</body>

</html>