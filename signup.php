<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Registration Form</title>

    <!-- Bootstrap -->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/dcalendar.picker.css" rel="stylesheet">
    <style type="text/css">
        #deceased {
            background-color: #FFF3F5;
            padding-top: 10px;
            margin-bottom: 10px;
        }

        .remove_field {
            float: right;
            cursor: pointer;
            position: absolute;
        }

        .remove_field:hover {
            text-decoration: none;
        }
    </style>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery-1.12.4.js"></script>
    <script src="js/dcalendar.picker.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>

</head>

<body>

    <p style="text-align: center; line-height: 100px; font-size:40px;">Registration Form </p>

    <div class="panel panel-primary" style="margin:20px; margin-top:20px;">
        <div class="panel-heading">
            <h3 class="panel-title">Registration Form</h3>
        </div>
        <div class="panel-body">
            <form>
                <div class="col-md-12 col-sm-12">
                    <div class="form-group col-md-6 col-sm-6">
                        <label for="name">Name* </label>
                        <input type="text" class="form-control input-sm" id="name" placeholder="">
                    </div>
                    <div class="form-group col-md-6 col-sm-6">
                        <label for="email">Email*</label>
                        <input type="email" class="form-control input-sm" id="email" placeholder="">
                    </div>

                    <div class="form-group col-md-6 col-sm-6">
                        <label for="mobile">Mobile*</label>
                        <input type="text" class="form-control input-sm" id="mobile" placeholder="">
                    </div>

                    <div class="form-group col-md-6 col-sm-6">
                        <label for="address">Address*</label>
                        <textarea class="form-control input-sm" id="address" rows="3"></textarea>
                    </div>

                    <div class="form-group col-md-6 col-sm-6">
                        <label for="city">City*</label>
                        <input type="text" class="form-control input-sm" id="city" placeholder="">
                    </div>

                    <div class="form-group col-md-6 col-sm-6">
                        <label for="state">State*</label>
                        <input type="text" class="form-control input-sm" id="state" placeholder="">
                    </div>

                    <div class="form-group col-md-6 col-sm-6">
                        <label for="country">Country*</label>
                        <input type="text" class="form-control input-sm" id="country" placeholder="">
                    </div>

                    <div class="form-group col-md-6 col-sm-6">
                        <label for="pincode">Pincode</label>
                        <input type="text" class="form-control input-sm" id="pincode" placeholder="">
                    </div>

                   
                    <div class="col-md-12 col-sm-12" id="addblock">
                        <div class="form-group col-md-3 col-sm-3">
                            <button type="submit" name="save" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                    <!--<div class="col-md-12 col-sm-12">
                    <div class="form-group col-md-3 col-sm-3 pull-right">
                        <input type='text' class="form-control input-sm" id="amount" readonly placeholder="Total Amount" />
                    </div>
                </div>
                <div class="col-md-12 col-sm-12">
                    <div class="form-group col-md-3 col-sm-3 pull-right">
                        <input type="submit" class="btn btn-primary" value="Submit" />
                    </div>
                </div>
            
            url https://bootsnipp.com/snippets/97Bpj
            -->
            </form>
        </div>

       
</body>

</html>