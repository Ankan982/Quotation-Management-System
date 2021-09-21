<?php
session_start();
$user_email = $_SESSION['user_email'] ;
echo "$user_email";
require_once("database.php");

if (!empty($_GET["action"])) {
	switch ($_GET["action"]) {
		case "add":

			if (!empty($_POST["quantity"]) && !empty($_POST["partnumber"])) {

				$quantity = $_POST["quantity"];
				$partnumber = $_POST["partnumber"];

				$query = "SELECT * FROM `MKP_tbl` WHERE part_number='$partnumber'";

				//echo "$query";
				$query_run = mysqli_query($conn, $query);
				$check = mysqli_num_rows($query_run) > 0;

				$rows = mysqli_fetch_array($query_run);

				//echo "$rows[price]";

				$itemArray = array($rows["part_number"] => array('part_number' => $rows["part_number"], 'description' => $rows["description"], 'price' => $rows["price"], 'weight' => $rows["weight"], 'quantity' => $quantity));

				if (!empty($_SESSION["cart_item"])) {
					if (in_array($rows["part_number"], array_keys($_SESSION["cart_item"]))) {
						foreach ($_SESSION["cart_item"] as $k => $v) {
							if ($rows["part_number"] == $k) {
								if (empty($_SESSION["cart_item"][$k]["quantity"])) {
									$_SESSION["cart_item"][$k]["quantity"] = 0;
								}
								$_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
							}
						}
					} else {
						$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"], $itemArray);
					}
				} else {
					$_SESSION["cart_item"] = $itemArray;
				}
			}
			break;
		case "remove":
			if (!empty($_SESSION["cart_item"])) {
				foreach ($_SESSION["cart_item"] as $k => $v) {
					if ($_GET["code"] == $k)
						unset($_SESSION["cart_item"][$k]);
					if (empty($_SESSION["cart_item"]))
						unset($_SESSION["cart_item"]);
				}
			}
			break;
		case "empty":
			unset($_SESSION["cart_item"]);
			break;
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
	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>


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
						<a class="nav-link active" href="#">Quote</a>
					</li>


			</div>
		</div>
	</nav>


	<div class="container d-flex  justify-content-center mt-2 ">
		<form class="row g-3" method="POST" action="part_number.php?action=add">
			<div class="col-auto">
				<label>Part Number</label>
				<input type="text" class="form-control" name="partnumber" placeholder="Part number">
			</div>
			<div class="col-auto">
				<label>Quantity</label>
				<input type="text" class="form-control" name="quantity" placeholder="quantity">
			</div>

			<button type="submit" class="btn btn-primary ">Add</button>

		</form>


	</div>




	<div class="d-flex flex-row-reverse mr-2">
		<a id="btnEmpty" href="part_number.php?action=empty"><button class="btn btn-danger me-2 ">Clear Quote</button></a>
	</div>

	<?php
	if (isset($_SESSION["cart_item"])) {
		$total_quantity = 0;
		$total_weight = 0;
		$total_price = 0;
	?>
		<div class="container d-flex justify-content-center mt-2">

			<table class="table table-bordered" id="tbUser">
				<tbody>
					<thead class="table-dark">
						<tr>
							<th>Part Number</th>
							<th>Description</th>
							<th>Unit Weight</th>
							<th>Quantity</th>
							<th>Unit Price</th>
							<th>Price</th>
						</tr>
					</thead>
					<?php
					foreach ($_SESSION["cart_item"] as $item) {
						$item_price = $item["quantity"] * $item["price"];
						$weight = number_format($item["weight"], 2);
					?>
						<tr>
							<td align="center"><?php echo $item["part_number"]; ?></td>
							<td><?php echo $item["description"]; ?></td>
							<td><?php echo $weight ?></td>
							<td><?php echo $item["quantity"]; ?></td>
							<td><?php echo "$ " . number_format($item["price"], 2) ?></td>
							<td><?php echo "$ " . number_format($item_price, 2); ?></td>
							
								
						</tr>
					<?php
						$total_quantity += $item["quantity"];
						$total_price += ($item["price"] * $item["quantity"]);
						$total_weight += $item["weight"];
					}
					?>

					<tr>
						<td colspan="3" align="right"><b>Total Quantity: </b></td>
						<td align="left"><b><?php echo $total_quantity; ?></b></td>
						<td align="left"></td>

						<td></td>
					</tr>
					<tr>
						<td colspan="3" align="right"><b>Total Weight: </b></td>
						<td align="left"><b><?php echo $total_weight; ?></b></td>
						<td align="left"></td>

						<td></td>
					</tr>
					<td colspan="3" align="center"><b>Total Price: </b></td>
					<td align="left"><b><?php echo "$ " . number_format($total_price, 2); ?></b></td>
					<td align="left"></td>
					<tr>

					</tr>
				</tbody>
			</table>

		<?php
	} else {
		?>
			<div class="container d-flex justify-content-center">
				<p><strong> No quote has been added yet. </strong> </p>
			</div>
		<?php
	}
		?>

		</div>
		</div>

		<button type="submit" class="btn btn-warning ">Sava & download</button>

	


</body>

</html>