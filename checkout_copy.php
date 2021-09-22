<?php
session_start();


$Qnum = $_SESSION['Qnum'];
//echo "$Qnum";


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
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.3/jspdf.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>
    <link rel="stylesheet" href="css/styles.css">
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
                        <a class="nav-link active" href="index.php">Next Quote</a>
                    </li>


            </div>
        </div>
    </nav>

    <div class="bs-example">
        <div class="container">
            <div class="row">
                <div class="col-md-12 bg-light text-right">
                    <button type="button" name="save" class="btn btn-success ml-2" id="download"><i class="bi bi-file-pdf-fill"></i>Print</button>
                </div>
            </div>
        </div>

        <!--  <div  style = "display: flex; justify-content:flex-end ">
        <button type="button" name="save" class="btn btn-success mt-2" onclick="printDiv('pdf','Quotation Invoice')">Save</button>
    </div>-->


        <div class="main-content" id="invoice">

            <div class="container">


                <div class="row">
                    <div class="col-xs-12">
                        <div class="invoice-title">
                            <!-- <h2>Quotation Invoice</h2>-->
                            <img src="quotation.jpeg" />
                            <h3 class="pull-right">Quote: <?php echo $Qnum  ?></h3>
                        </div>
                        <hr>
                        <?php
                        require_once("database.php");
                        $query = "SELECT * FROM `custinfo_tbl` WHERE Qnum ='$Qnum'";

                        $query_run = mysqli_query($conn, $query);
                        $check = mysqli_num_rows($query_run) > 0;

                        //$rows = mysqli_fetch_array($query_run);

                        while ($row = mysqli_fetch_array($query_run)) {

                        ?>
                            <div class="row ">
                                <div class="col-xs-6">
                                    <address>

                                    <?php
                                   
                                   $city = $row['BillToCity'];
                                   $state = $row['BillToState'];
                                   $zipcode= $row['BillToZip'];
                                   $Country= $row['BillToCountry'];
                                   $details_addrress= $city.", ".$state.", ".$zipcode ;


                                      ?>
                                        <strong>ORDER TO:</strong><br>
                                        <?php echo $row['BillToName']  ?><br>
                                        <?php echo $row['BillToAddress']  ?><br>
                                        <?php echo $details_addrress  ?><br>
                                        <?php echo $Country  ?><br>
                                    </address>
                                </div>
                                <div class="col-xs-6">
                                <?php 
                                   $city = $row['ShipToCity'];
                                   $state = $row['ShipToState'];
                                   $zipcode= $row['ShipToZip'];
                                   $ship_details_addrress= $city.", ".$state.", ".$zipcode ;
                                   $Country= $row['ShipToCountry'];
                                      ?>
                                    <address>
                                        <strong>SHIP TO:</strong><br>
                                        <?php echo $row['ShipToName']  ?><br>
                                        <?php echo $row['ShipToAddress']  ?><br>
                                        <?php echo $ship_details_addrress  ?><br>
                                        <?php echo $Country  ?><br>
                                    </address>
                                </div>
                                <div class="col-xs-6 ">
                                    <address>
                                        <strong>Contact Details:</strong><br>
                                        <?php echo $row['ContactName']  ?><br>
                                        <?php echo $row['Email']  ?><br>
                                        <?php echo $row['Phone']  ?><br>
                                    </address>
                                </div>
                                <div class="col-xs-6">
                                    <address>
                                        <strong>Sales Person Details :</strong><br>
                                        <?php echo $row['SalesPerson']  ?><br>
                                        <?php echo $row['SalesEmail']  ?><br>
                                    </address>
                                </div>
                            </div>

                          <!--  <div class="row">
                                <div class="col-xs-6">
                                    <address>
                                        <strong>Contact Details:</strong><br>
                                        <?php /* echo $row['ContactName']  ?><br>
                                        <?php echo $row['Email']  ?><br>
                                        <?php echo $row['Phone']  ?><br>
                                    </address>
                                </div>
                                <div class="col-xs-6 text-right">
                                    <address>
                                        <strong>Sales Person Details :</strong><br>
                                        <?php echo $row['SalesPerson']  ?><br>
                                        <?php echo $row['SalesEmail']  */?><br>
                                    </address>
                                </div>
                            </div> -->
                    </div>
                </div>


            <?php
                        }
            ?>

            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><strong>Order Summary</strong></h3>

                        </div>
                        
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-condensed">
                                    <thead>
                                        <tr>
                                            <td><strong>Line</strong></td>
                                            <td class="text-center"><strong></strong></td>
                                            <td class="text-center"><strong>Description</strong></td>
                                            <td class="text-center"><strong>Quantity</strong></td>
                                            <td class="text-center"><strong>Brand</strong></td>
                                            <td class="text-center"><strong>Unit Wt.(lbs)</strong></td>
                                            <td class="text-center"><strong>Status</strong></td>
                                            <td class="text-center"><strong>Unit Price</strong></td>
                                            <td class="text-center"><strong>Total Price </strong></td>               
                                        
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- foreach ($order->lineItems as $line) or some such thing here -->
                                        <?php
                                        require_once("database.php");
                                        $query = "SELECT * FROM `custinfo_tbl`
                                INNER JOIN `tempQuote`
                                ON custinfo_tbl.Qnum = tempQuote.Qnum 
                                WHERE custinfo_tbl.Qnum='$Qnum' AND tempQuote.Qnum='$Qnum'";

                                        $query_run = mysqli_query($conn, $query);
                                        $check = mysqli_num_rows($query_run) > 0;

                                        //$rows = mysqli_fetch_array($query_run);
                                        $total_quantity = 0;
                                        $total_weight = 0;
                                        $total_price = 0;
                                        $id = 0;
                                        while ($row = mysqli_fetch_array($query_run)) {
                                            $id++

                                        ?>

                                            <tr>
                                                <td><?php echo $id ?></td>
                                                <td class="text-center"></td>
                                                <td class="text-center"><?php echo $row['description']  ?></td>
                                                <td class="text-center"><?php echo $row['qty']  ?></td>
                                                <td class="text-center"><?php echo $row['brand']  ?></td>
                                                <td class="text-center"><?php echo number_format($row['weight'], 2)  ?></td>
                                                <td class="text-center"></td>
                                                <td class="text-center"><?php echo number_format($row['unit_price'], 2)  ?></td> 
                                                <td class="text-center"><?php echo number_format($row['price'], 2) ?></td>
                                                        
                                            </tr>
                                        <?php

                                            $total_quantity += $row['qty'];
                                            // $total_price += ($row["price"] * $row["qty"]);
                                            $total_price += $row['price'];
                                            $total_weight += ($row['qty'] * $row['weight']);
                                        }
                                        ?>
                                    
                                    <tr height = 50px></tr>
                                        <tr >
                                            <td class="thick-line" colspan="2"></td>
                                            <td class="thick-line"></td>
                                            <td class="thick-line text-center"><strong>Total weight</strong></td>
                                            <td class="thick-line text-center"><?php echo $total_weight   ?></td>
                                            <td class="thick-line"></td>
                                            <td class="thick-line" colspan="1"></td>
                                            <td class="no-line text-center"><strong>Total Price</strong></td>
                                            <td class="no-line text-center"><?php echo '$' . $total_price  ?></td>
                                        </tr>
                            
                                   

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            </div>
        </div>


        <script>
            window.onload = function() {
                document.getElementById("download")
                    .addEventListener("click", () => {

                        const invoice = this.document.getElementById("invoice");
                        console.log(invoice);
                        console.log(window);
                        var opt = {
                            margin: 1,
                            filename: 'Quotation_Invoice.pdf',
                            image: {
                                type: 'jpeg',
                                quality: 0.98
                            },
                            html2canvas: {
                                scale: 2
                            },
                            jsPDF: {
                                unit: 'in',
                                format: 'tabloid',
                                orientation: 'landscape'
                            }
                        };

                        html2pdf().from(invoice).set(opt).save();

                    })

            }
        </script>
</body>

</html>