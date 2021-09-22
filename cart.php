<?php
session_start();
ob_start();

$Qnum = $_SESSION['Qnum'];


require_once("database.php");
if (!empty($_GET["action"])) {
    switch ($_GET["action"]) {
        case "add":

            if (!empty($_POST["quantity"]) && !empty($_POST["partnumber"])) {

                $quantity =  floatval($_POST["quantity"]);
                $partnumber = $_POST["partnumber"];



                $query = "SELECT * FROM `MKP_tbl` WHERE part_number='$partnumber'";

                $query_run = mysqli_query($conn, $query);
                $check = mysqli_num_rows($query_run) > 0;

                if ($check > 0) {
                    $rows = mysqli_fetch_array($query_run);
                } else {
                    $query = "SELECT * FROM `KM_tbl` WHERE part_number='$partnumber'";
                    $query_run = mysqli_query($conn, $query);
                    $rows = mysqli_fetch_array($query_run);
                    // $check = mysqli_num_rows($query_run) > 0;
                }

                 

                //     print_r(gettype(floatval($rows['price'])));



                $itemArray = array($rows["part_number"] =>
                array(
                    'part_number' => $rows["part_number"],
                    'description' => $rows["description"],
                    'price' => (floatval($rows['price'])),
                    'brand' => $rows["brand"],
                    'weight' => floatval($rows['weight']),
                    'quantity' => $quantity
                ));


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

        case "csv":

            if (isset($_POST["Import"])) {

                $filename = $_FILES["file"]["tmp_name"];
                if ($_FILES["file"]["size"] > 0) {



                    $row = 1;
                    $csv = [];
                    if (($handle = fopen($filename, "r")) !== FALSE) {
                        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                            $num = count($data);
                            //  echo "<p> $num fields in line $row: <br /></p>\n";
                            $row++;
                            // for ($c = 0; $c < $num-2; $c++) {
                            //    echo $data[0] . "<br />\n";
                            //    echo $data[1] . "<br />\n";
                            $quantity = $data[1];
                            $query = "SELECT * FROM `MKP_tbl` WHERE part_number='$data[0]'";

                            $query_run = mysqli_query($conn, $query);
                            $check = mysqli_num_rows($query_run) > 0;

                            $rows = mysqli_fetch_array($query_run);

                            //  print_r(gettype(floatval($rows['price'])));



                            $itemArray = array($rows["part_number"] =>
                            array(
                                'part_number' => $rows["part_number"],
                                'description' => $rows["description"],
                                'price' => (floatval($rows['price'])),
                                'brand' => $rows["brand"],
                                'weight' => floatval($rows['weight']),
                                'quantity' => $quantity
                            ));


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
                        fclose($handle);
                    }
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>
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
                </ul>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Import CSV
                </button>
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Upload csv file</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form class="form-horizontal well" action="cart.php?action=csv" method="post" name="upload_excel" enctype="multipart/form-data">
                                <div class="modal-body">

                                    <input type="file" name="file" id="file" class="input-large" accept=".csv">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" id="submit" name="Import" class="btn btn-success">Upload</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </nav>


    <div class="container d-flex  justify-content-center mt-2 ">
        <form class="row g-3" method="POST" action="cart.php?action=add">
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




    <!--<div class="d-flex flex-row-reverse mr-2">
        <a id="btnEmpty" href="cart.php?action=empty"><button class="btn btn-danger me-2 ">Clear Quote</button></a>
    </div>-->


    <?php
    if (isset($_SESSION["cart_item"])) {
        $total_quantity = 0;
        $total_weight = 0;
        $total_price = 0;
    ?>
        <div class="container d-flex justify-content-center mt-2">

            <table class="table table-bordered mt-3" id="tbUser">
                <tbody>
                    <thead class="table-dark">
                        <tr>
                            <!--   <th>Serial Number</th>-->
                            <!--  <th>Part Number</th>-->
                            <th style="text-align:center;">Description</th>
                            <th style="text-align:center;">Brand</th>
                            <th style="text-align:center;">Quantity</th>
                            <th style="text-align:center;">Unit Price</th>
                            <th style="text-align:center;">Total </th>
                            <th style="text-align:center;">Status</th>
                            <th style="text-align:center;">Unit Wt.(lbs)</th>
                            <th style="text-align:center;">Remove</th>
                        </tr>
                    </thead>

                    <?php
                    $id = 0;
                    //  print_r($_SESSION["cart_item"]);
                    foreach ($_SESSION["cart_item"] as $item) {


                        $unit_weight = $item["weight"];
                        $unit_price = $item["price"];
                        $item_price = $item["quantity"] * $unit_price;

                        //echo $unit_price;
                        //echo gettype($unit_price) . "<br>";

                        $curent_unit_price = $unit_price;
                        //echo gettype($curent_unit_price);

                        $current_weight = $item["quantity"] * floatval($unit_weight);
                        $id++;

                    ?>
                        <tr>
                            <!-- <td align="center"><?php /* echo $id */ ?></td>-->
                            <!-- <td align="center"><?php echo $item["part_number"]; ?></td>-->
                            <td style="text-align:center;"><?php echo $item["description"]; ?></td>
                            <td style="text-align:center;"><?php echo $item["brand"]; ?></td>
                            <td style="text-align:center;"><?php echo $item["quantity"]; ?></td>
                            <td style="text-align:center;"><?php echo "$" . $curent_unit_price ?></td>
                            <td style="text-align:center;"><?php echo "$" . $item_price; ?></td>
                            <td style="text-align:center;"></td>
                            <td style="text-align:center;"><?php echo $unit_weight ?></td>
                            <td style="text-align:center;"><a href="cart.php?action=remove&code=<?php echo $id - 1; ?>" class="btnRemoveAction"><img src="icon-delete.png" alt="Remove Item" /></a></td>
                        </tr>


                    <?php
                        $total_quantity += $item["quantity"];
                        $total_price += ($item["price"] * $item["quantity"]);
                        $total_weight += $current_weight;
                    }
                    ?>

                    <!-- <tr>
                        <td colspan="3" align="right"><b>Total Quantity: </b></td>
                        <td align="left"><b></b></td>
                        <td align="left"></td>

                        <td></td>
                    </tr>-->
                    <tr>
                        <td colspan="4" align="center"><b>Total Weight: </b></td>
                        <td align="center"><b><?php echo $total_weight; ?></b></td>
                        <td align="left"></td>

                        <td></td>
                    </tr>
                    <tr>
                    <td colspan="4" align="center"><b>Total Price: </b></td>
                    <td align="center"><b><?php echo "$ " . number_format($total_price, 2); ?></b></td>
                    <td align="left"></td>
                    <tr>

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

        <div class="container d-flex justify-content-center">
            <form>
                <button type="submit" name="save" class="btn btn-success mt-2">Save</button>
            </form>

        </div>


</body>

</html>

<?php

include_once 'database.php';

if (isset($_GET['save'])) {

    // print_r($_SESSION["cart_item"]);
    // echo "$Qnum";
    $id = 0;
    $flag = 0;


    foreach ($_SESSION["cart_item"] as $item) {

        $partnumber = $item["part_number"];
        $description = $item["description"];
        $brand = $item["brand"];

        $quantity =  floatval($item["quantity"]);

        $unit_weight = floatval($item["weight"]);


        $unit_price = floatval($item["price"]);

        // echo gettype($unit_price);


        $item_price = $quantity * $unit_price;
        $lineseq = $id++;


        // echo  $unit_price ;
        // echo gettype($unit_price);

        $query = "INSERT INTO `tempQuote`

        ( 
        `Qnum`, `part_number`, `description`, `brand`,
        `weight`, `price`, `qty`, 
        `LineSeq`,`unit_price`
        )

	 VALUES
     
	  ('$Qnum','$partnumber','$description','$brand',
	  '$unit_weight','$item_price','$quantity',
	  '$lineseq','$unit_price'
      )";

        // echo "$query";
        // echo "<br>";

        $data = mysqli_query($conn, $query);
        if (!$data) {
            die(mysqli_error($conn));
        } else {
            //echo "Success";
            $flag++;
        }
    }

    if ($flag == 0) {
        die(mysqli_error($conn));
    } else {

        unset($_SESSION["cart_item"]);
        header("Location: checkout_copy.php");
        exit();
    }
}
?>