<?php
require_once dirname(__FILE__) . '/config.php';
?>
<html>
<head>
      <meta charset = "utf-8">
      <meta http-equiv = "X-UA-Compatible" content = "IE = edge">
      <meta name = "viewport" content = "width = device-width, 
         initial-scale = 1">
      
      <title>Quickbooks Custom Application</title>
      
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
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script>
    $(function() {
      $( ".tract_date" ).datepicker();
    });
    </script>
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
    <div class="col-md-4">
      <h1>Invoice Details</h1>
    </div>
    <div class="col-md-6 pull-right" id="ajax_wait" align="center" style=" display:none;font-weight:bold; font-size:18px; color:#CCCCCC; border: solid #000 1px;">Please Wait...</div>
    </div>
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
//print_r($invoices[0]);
//echo "</pre>";
//exit;
$print_supplier_array=array("SuperGraphics","Double L","Top Notch","True Screen");
$shipement_method_array=array("Print","UPS","CANADA POST","SPOTSHUB","A COASTAL REIGN REPRESENTATIVE");
        
foreach ($invoices as $Invoice) {
   $Customer = $CustomerService->query($Context, $realm, "SELECT * FROM Customer WHERE id ='".QuickBooks_IPP_IDS::usableIDType($Invoice->getCustomerRef())."'"); 
   //$delivery_method = $customer->getCustomerPreferredDeliveryMethod();
   //echo "<pre>";
   //print_r((array)$Customer[0]);
   //echo "</pre>";
   //$customer->PrimaryPhone->FreeFormNumber;
   //$num = $Customer[0]->getXPath('//Customer/PrimaryPhone/FreeFormNumber'); 
   //print('Phone #: ' . $num);
   $invoice_id = $Invoice->getId();
   $invoice_id = str_replace("-", "", $invoice_id);
   $invoice_id = str_replace("{", "", $invoice_id);
   $invoice_id = str_replace("}", "", $invoice_id);
   $PreferredDeliveryMethod= $Customer[0]->getXPath('//Customer/PreferredDeliveryMethod');
   //exit;
   ?>

<tr>
    <td><?php 
            //echo    $id= $Invoice->getCustomerRef();
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
    <td>
        <select name="shipping_method" class="small-drop-down" onchange="UpdateInvoiceData('<?php echo $invoice_id;?>',this.name,this.value);">
        <?php 
        //
        foreach($shipement_method_array as $shippingmethod){
        ?>
            <option value='<?php echo $shippingmethod;?>' <?php if($PreferredDeliveryMethod == $shippingmethod)echo"selected";?>><?php echo $shippingmethod;?></option>
        <?php }?>
                
        </select>
    </td>
    <td> <?php echo $Invoice->getDocNumber(); ?>/<input class="small-date-box tract_date" type="text" name="tract_date" id="tract_date" value="<?php echo date("m/d/Y",  strtotime($Invoice->getTxnDate()));?>"></td>
    <td> <a title="Follow Up Email" class="btn btn-success btn-sm invoice-email"  href="example_invoice_email.php?follow=<?php echo $Invoice->getDocNumber();?>">Follow Up</a></td>
    <td> <a title="BG Email" class="btn btn-danger btn-sm invoice-email"  href="example_invoice_email.php?bg=<?php echo $Invoice->getDocNumber();?>">BG Email</a> </td>
    <td> <a title="Print Email" class="btn btn-warning btn-sm invoice-email"  href="example_invoice_email.php?printing=<?php echo $Invoice->getDocNumber();?>">Print</a> </td>
    <td> <a title="View Files Email" class="btn btn-info btn-sm invoice-email" href="example_invoice_email.php?shipping=<?php echo $Invoice->getDocNumber();?>">View Files</a> </td>
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
<script>
$(".invoice-email").click(function(e){
    e.preventDefault();	
    modalbox(this.href,this.title,550,700);
});
function modalbox(linkt,setTitle,SetHeight,SetWidth){
$('<iframe id="some-dialog" class="window-Frame" src='+linkt+' />').dialog({
		autoOpen: true,
		width: SetWidth,
		height: SetHeight,
		modal: true,
		resizable: true ,
		title:setTitle,
                position: { my: "top", at: "top", of: window  }
	}).width(SetWidth-20).height(SetHeight-20);
}
function UpdateInvoiceData(InvoiceId,FieldName,Data){ 
    var url = "ajax_invoice_add.php?InvoiceId="+InvoiceId+"&FieldName="+FieldName+"&Data="+Data;
    //alert("");
    //$('#main_body').hide();
    $('#ajax_wait').show();
    $.ajax({
    url: url,
    success: function(data) {
        alert(data);
        $('#ajax_wait').hide();
        //$('#main_body').html(data);
        //$('#main_body').show();     
     }
    });
}
</script>
