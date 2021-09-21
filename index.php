<?php
session_start();
ob_start();
?>


<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Quote</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css" integrity="sha512-xnP2tOaCJnzp2d2IqKFcxuOiVCbuessxM6wuiolT9eeEJCyy0Vhcwa4zQvdrZNVqlqaxXhHqsSV1Ww7T2jSCUQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<script type="text/javascript">
		window.history.forward();
	</script>

</head>

<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<div class="container-fluid">
			<a class="navbar-brand" href="#">Quotation</a>
		</div>
	</nav>



	<div class="container">
		<h1 class="text-light bg-dark text-center">Customer Information</h1>
	</div>

	<div class="container mt-2">
		<form method="POST" action="">
			<div class="row ">
				<div class="col">
					<h5>Bill To</h5>
					<div class="input-group">
						<span class="input-group-text">Name</span>
						<input type="text" name="BillToName" class="form-control">
					</div>
				</div>
				<div class="col">
					<h5>Ship To</h5>
					<div class="input-group">
						<span class="input-group-text">Name</span>
						<input type="text" name="ShipToName" class="form-control">
					</div>
				</div>
			</div>
			<div class="row  mt-3">
				<div class="col">
					<div class="row mb-3">
						<label for="colFormLabel" class="col-sm-2 col-form-label">Address</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="BillToAddress" placeholder="address">
						</div>
					</div>
					<div class="row mb-3">
						<label for="colFormLabel" class="col-sm-2 col-form-label">City</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="BillToCity" placeholder="city">
						</div>
					</div>
					<div class="row mb-3">
						<label for="colFormLabel" class="col-sm-2 col-form-label">State</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="BillToState" placeholder="state">
						</div>
					</div>
					<div class="row mb-3">
						<label for="colFormLabel" class="col-sm-2 col-form-label">Zipcode</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="BillToZip" placeholder="zipcode">
						</div>
					</div>
				</div>
				<div class="col">
					<div class="row mb-3">
						<label for="colFormLabel" class="col-sm-2 col-form-label">Address</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="ShipToAddress" placeholder="address">
						</div>
					</div>
					<div class="row mb-3">
						<label for="colFormLabel" class="col-sm-2 col-form-label">City</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="ShipToCity" placeholder="city">
						</div>
					</div>
					<div class="row mb-3">
						<label for="colFormLabel" class="col-sm-2 col-form-label">State</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="ShipToState" placeholder="state">
						</div>
					</div>
					<div class="row mb-3">
						<label for="colFormLabel" class="col-sm-2 col-form-label">Zipcode</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="ShipToZip" placeholder="zipcode">
						</div>
					</div>
				</div>
			</div>
			<div class="row mt-2">
				<div class="col">
					<div class="row mb-3">
						<label for="colFormLabel" class="col-sm-2 col-form-label">Contact Name</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="ContactName" placeholder="contact name">
						</div>
					</div>
					<div class="row mb-3">
						<label for="colFormLabel" class="col-sm-2 col-form-label">Email</label>
						<div class="col-sm-10">
							<input type="email" class="form-control" name="Email" placeholder="email">
						</div>
					</div>
					<div class="row mb-3">
						<label for="colFormLabel" class="col-sm-2 col-form-label">Phone Number</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="Phone" placeholder="phone number">
						</div>
					</div>
				</div>
				<div class="col">
					<div class="row mb-3">
						<label for="colFormLabel" class="col-sm-2 col-form-label">Sales Person</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="SalesPerson" placeholder="sales person">
						</div>
					</div>
					<div class="row mb-3">
						<label for="colFormLabel" class="col-sm-2 col-form-label">Email</label>
						<div class="col-sm-10">
							<input type="email" class="form-control" name="SalesEmail" placeholder="email">
						</div>
					</div>

		
					<div class="row mb-3">
						<label for="colFormLabel" class="col-sm-2 col-form-label">Quote</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="Qnum" value="<?php
                                     
									 require_once("database.php");

$query = "SET @sl:=0;";
$query.= "SELECT @sl:=@sl+1 AS 'Qnum' FROM `custinfo_tbl`,(SELECT @sl:=0) AS sl;";
$re=0;
if (mysqli_multi_query($conn, $query)) {
    do {
        /* store first result set */
        if ($result = mysqli_store_result($conn)) {
            while ($row = mysqli_fetch_array($result)) 
    
    /* print your results */    
    {
    //echo $row['Qnum'];
				$re = end($row)		;														
	
	//echo "$quote_val";

    }
    mysqli_free_result($result);
    }   
    } while (mysqli_next_result($conn));
    }
	$re=$re +1;
	$str = "KP-210";
	$quote_val = $str .$re;
	echo $quote_val;

	 ?>" placeholder="quote">
						</div>
					</div>
				</div>
			</div>
			<div class="row mb-2">
				<button type="submit" name="submit" class="btn btn-primary mt-2">Procced</button>
			</div>
		</form>
	</div>

</body>

</html>

<?php

include_once 'database.php';

if (isset($_POST['submit'])) {



	$BillToName = $_POST['BillToName'];
	$ShipToName = $_POST['ShipToName'];

	$BillToAddress = $_POST['BillToAddress'];
	$BillToCity = $_POST['BillToCity'];
	$BillToState = $_POST['BillToState'];
	$BillToZip = $_POST['BillToZip'];

	$ShipToAddress = $_POST['ShipToAddress'];
	$ShipToCity = $_POST['ShipToCity'];
	$ShipToState = $_POST['ShipToState'];
	$ShipToZip = $_POST['ShipToZip'];

	$ContactName = $_POST['ContactName'];
	$Email = $_POST['Email'];
	$Phone = $_POST['Phone'];

	$SalesPerson = $_POST['SalesPerson'];
	$SalesEmail = $_POST['SalesEmail'];
	$Qnum = $_POST['Qnum'];

	$query = "INSERT INTO `custinfo_tbl`
	( `Qnum`, `BillToName`, `BillToAddress`,
	 `ShipToName`, `ShipToAddress`, `ContactName`, 
	 `Email`, `Phone`, `SalesPerson`, `SalesEmail`,
	  `BillToCity`, `BillToZip`, `ShipToCity`, `ShipToState`,
	   `ShipToZip`, `BillToState`)
	 VALUES
	  ('$Qnum','$BillToName','$BillToAddress',
	  '$ShipToName','$ShipToAddress','$ContactName',
	  '$Email','$Phone','$SalesPerson','$SalesEmail',
	  '$BillToCity', '$BillToZip','$ShipToCity','$ShipToState',
	  '$ShipToZip','$BillToState')";

	$data = mysqli_query($conn, $query);
	if ($data) {

		$_SESSION['Qnum'] = $Qnum;
		header("Location: cart.php");
		exit();
    
	} else {
		echo "All fields required!!";
	}
}
?>