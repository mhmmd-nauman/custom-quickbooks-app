<?php
require_once dirname(__FILE__) . '/config.php';
?>
<html>
<head>
      <meta charset = "utf-8">
      <meta http-equiv = "X-UA-Compatible" content = "IE = edge">
      <meta name = "viewport" content = "width = device-width, 
         initial-scale = 1">
      
      <title>Bootstrap 101 Template</title>
      
      <!-- Bootstrap -->
      <link href = "//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" 
         rel = "stylesheet">
<!--<link rel="stylesheet" href="css/popup.css" />-->
      
      <!-- HTML5 shim and Respond.js for IE8 support of HTML5 
         elements and media queries -->
      <!-- WARNING: Respond.js doesn't work if you view the 
         page via file:// -->
      
      <!--[if lt IE 9]>
      <script src = "https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src = "https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
      <style type="text/css">
          .big-drop-down{ width: 120px;}
          .small-drop-down{ width: 80px;}
          .small-date-box{ width: 60px;}
      </style>
   </head>
<body>
<div class="container-fluid">

<div class="row">
  <ul class = "nav navbar-nav">
    <li class = "active"><a href = "index.php">Home</a></li>
    <li><a href = "example_customer_query.php">Customers</a></li>
    <li><a href = "example_invoice_query.php">Invoices</a></li>
    <li><a href = "example_invoice_w_lines_query.php">Invoices with Lines</a></li>
    <li><a href = "example_payment_query.php">Payments</a></li>
    <li><a href = "example_items_query.php">Items</a></li>
  </ul>
</div>

<div class="row">
  <div class="col-md-12">
    <h1>Invoices from QB Live Application</h1>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <hr>
  </div>
</div>
	
<div class="row">
  <div class="col-md-12">
      <table class="table table-striped table-bordered table-responsive" style=" font-size: 10px;">
  <tr>
      <td style=" width: 10%;"> Client Name/Email </td>
    <td> Invoice# /<br>Amount Owing /<br>Ship Date </td>
    
    <td style=" width: 10%;"> Print Supplier </td>
    <td> Blank Garment Supplier </td>
    <td> Shipping Address </td>
    <td style=" width: 7%;"> Phone # </td>
    <td> Shipping Method </td>
    <td> Tracking Number/Date </td>
    <td> Follow up ? </td>
    <td> BG Email </td>
    <td> Send Print Instruction </td>
    <td> View Files </td>
  </tr>
<?php 
$InvoiceService = new QuickBooks_IPP_Service_Invoice();
$CustomerService = new QuickBooks_IPP_Service_Customer();
$invoices = $InvoiceService->query($Context, $realm, "SELECT * FROM Invoice STARTPOSITION 1 MAXRESULTS 25");
//echo "<pre>";
//print_r($invoices);
//echo "</pre>";
$print_supplier_array=array("SuperGraphics","Double L","Top Notch","True Screen");
$shipement_method_array=array("UPS","CANADA POST","SPOTSHUB","A COASTAL REIGN REPRESENTATIVE");
        
foreach ($invoices as $Invoice) {
   $customer = $CustomerService->query($Context, $realm, "SELECT * FROM Customer WHERE id ='".QuickBooks_IPP_IDS::usableIDType($Invoice->getCustomerRef())."'"); ?>

<tr>
    <td><?php 
           //    $id= $Invoice->getCustomerRef();
            echo $name= $Invoice->getCustomerRef_name();
            echo "/";
            $addr=$Invoice->getBillEmail(0);
            if(isset($addr)) echo $Invoice->getBillEmail(0)->getAddress();
            else {
                foreach ($customer as $customers)
                        {
                        echo $customers->getPrimaryEmailAddr(0)->getAddress();
                        }
            }
        ?></td>    
    <td>    
        <?php echo $Invoice->getDocNumber();?> /
        $<?php echo $Invoice->getTotalAmt();?> /
        <?php echo $Invoice->getShipDate();?>
    </td>
    
    <td>    
    <?php
        $BillService = new QuickBooks_IPP_Service_Bill();
        $bills = $BillService->query($Context, $realm, "SELECT * FROM Bill where SalesTermRef='".QuickBooks_IPP_IDS::usableIDType($Invoice->getSalesTermRef())."'"); ?>          
            <select name="print_supplier" class="big-drop-down">
            <?php  foreach ($bills as $bill) {
            echo "<option value=".$bill->getVendorRef_name().">".$bill->getVendorRef_name()."</option>";
            }
            ?>
            </select>
                <select name="print_supplier2" class="small-drop-down">
                <?php
                foreach ($print_supplier_array as $supplier)
                {
                echo "<option value='".$supplier."'>".$supplier."</option>";
                }
                ?>
                </select>    
    </td>
    <td>
        <select name="blank_garment_supplier" class="small-drop-down">
        <option value='Sanmar'>Sanmar</option>
        <option value='Technosport'>Technosport</option>        
        </select>
    </td>
    <td>
        <?php    
            foreach ($customer as $customers)
                {
                $checkinprimary = $customers->getBillAddr(0);
                if ($checkinprimary) {
                     $checkinshipping = $Invoice->getShipAddr(0);
                            if ($checkinshipping) {
                                echo $Invoice->getShipAddr(0)->getLine1();?><?php echo $Invoice->getShipAddr(0)->getCity();?><?php echo $Invoice->getShipAddr(0)->getPostalCode();
                            }
                            else {
                                echo $customers->getBillAddr(0)->getLine1()." , " .$customers->getBillAddr(0)->getCountrySubDivisionCode()." , " .$customers->getBillAddr(0)->getPostalCode();
                            }
                } 
                }
          ?>
    </td>
    <td> 
        <?php
        foreach ($customer as $customers)
            {
            echo $customers->getPrimaryPhone(0)->getFreeFormNumber();
            }
        ?>        
    </td>
    <td>        <select name="blank_garment_supplier" class="small-drop-down">
        <option value='UPS'>UPS</option><option value='CANADA POST'>CANADA POST</option><option value='SPOTSHUB'>SPOTSHUB</option><option value='A COASTAL REIGN REPRESENTATIVE'>A COASTAL REIGN REPRESENTATIVE</option>        </select>
    </td>
    <td> <?php echo $Invoice->getDocNumber()." / ".$Invoice->getTxnDate(); ?>/<input class="small-date-box" type="text" name="tract_num" value="2015-12-02"></td>
    <td> <a class="btn btn-success btn-sm" target="_blank" href="example_invoice_email.php?follow=<?php echo $Invoice->getDocNumber();?>">Follow up ?</a></td>
    <td> <a class="btn btn-danger btn-sm" target="_blank" href="example_invoice_email.php?bg=<?php echo $Invoice->getDocNumber();?>">BG Email</a> </td>
    <td> <a class="btn btn-warning btn-sm" target="_blank" href="example_invoice_email.php?printing=<?php echo $Invoice->getDocNumber();?>">Print</a> </td>
    <td> <a class="btn btn-info btn-sm" target="_blank" href="example_invoice_email.php?shipping=<?php echo $Invoice->getDocNumber();?>">View Files</a> </td>
  </tr>
<?php } ?>  </table>  
  </div>
</div><div class="row">
  <div class="col-md-12">
    <hr>
  </div>
</div>

</div>
	</body>
</html>


<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js"></script>
	<script src="js/jquery.popup.js"></script>
	<script>
		$(function(){
$('.default_popup2').popup({
					width				: 420,
				height				: 315
			});
			});
</script>-->
<!-- Hosting24 Analytics Code -->
<script type="text/javascript" src="http://stats.hosting24.com/count.php"></script>
<!-- End Of Analytics Code -->
