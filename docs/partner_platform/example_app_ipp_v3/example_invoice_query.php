<?php

require_once dirname(__FILE__) . '/config.php';

require_once dirname(__FILE__) . '/views/header.tpl.php';

/*
$conn = new mysqli("localhost","root","","ezb2599b_qb");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

if(isset($_REQUEST['invoice'])){
	$UpdateStatus_sql = "UPDATE quickbooks_invoice SET invoice_status = 1 WHERE invoice_num = ".$_REQUEST['invoice']."";
	$conn->query($UpdateStatus_sql);
	header('Location:'.$actual_link.'');
}

if(isset($_REQUEST['send_email'])){
	// To send HTML mail, the Content-type header must be set
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	
	// Additional headers
	$headers .= 'To: <'.$_REQUEST['to'].'>' . "\r\n";
	$headers .= 'From: <'.$_REQUEST['from'].'>' . "\r\n";
	
	// Mail it
	mail($_REQUEST['to'], $_REQUEST['subject'], $_REQUEST['message'], $headers);
}
*/
?>
<script type="text/javascript">
tinymce.init({
    selector: "textarea#message",
    plugins: [
        "advlist autolink lists link image charmap print preview anchor",
        "searchreplace visualblocks code fullscreen",
        "insertdatetime media table contextmenu paste"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
});
</script>
<div id="contactdiv">
  <form class="form" method="post" action="" id="contact">
    <img src="css/button_cancel.png" class="img" id="cancel"/>
    <h3>Send E-mail</h3>
    <hr/>
    <br/>
    <label>To: <span>*</span></label>
    <br/>
    <input type="text" id="to" name="to" placeholder="To"/>
    <br/>
    <br/>
    <label>From: <span>*</span></label>
    <br/>
    <input type="text" id="from" name="from" placeholder="From"/>
    <br/>
    <br/>
    <label>Subject: <span>*</span></label>
    <br/>
    <input type="text" id="subject" name="subject" placeholder="Subject" value="Your order has been shipped! Order Number# [INVOICE #]"/>
    <br/>
    <br/>
    <label>Message:</label>
    <br/>
    <textarea id="message" name="message" placeholder="Message.......">
    Hello [Client],
    I am pleased to inform you that your order has finished printing! As stated in our earlier conversation, your order is being shipped via  [Shipping Method], which will take [dependant on shipping method] days.
    Here are the details of your delivery.
    [Shipping Address]
    </textarea>
    <br/>
    <br/>
    <input type="button" id="send" name="send_email" value="Send"/>
    <input type="button" id="cancel" value="Cancel"/>
    <br/>
  </form>
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
      <td> Client </td>
    <td> Email Name </td>
    <td> Invoice# </td>
    <td> Amount Owing </td>
    <td> Ship Date </td>
    <td> Print Supplier </td>
    <td> Blank Garment Supplier </td>
    <td> Shipping Address </td>
    <td> Phone # </td>
    <td> Shipping Method </td>
    <td> Tracking Number / Date </td>
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
$blank_garment_supplier=array("Sanmar","Technosport");
$print_supplier_array=array("SuperGraphics","Double L","Top Notch","True Screen");
$shipement_method_array=array("UPS","CANADA POST","SPOTSHUB","A COASTAL REIGN REPRESENTATIVE");
        
foreach ($invoices as $Invoice)
{
   $customer = $CustomerService->query($Context, $realm, "SELECT * FROM Customer WHERE id ='".QuickBooks_IPP_IDS::usableIDType($Invoice->getCustomerRef())."'");
?>
  <tr>
    <td><?php 
            //  echo $id= $Invoice->getCustomerRef();
            echo $name= $Invoice->getCustomerRef_name();
        ?>
    </td>
    <td><?php 
            $addr=$Invoice->getBillEmail(0);
            if(isset($addr)) echo $Invoice->getBillEmail(0)->getAddress();
            else {
                foreach ($customer as $customers)
                        {
                        echo $customers->getPrimaryEmailAddr(0)->getAddress();
                        }
            }
?>
    </td>    
    <td><?php echo $Invoice->getDocNumber();?></td>
    <td>$<?php echo $Invoice->getTotalAmt();?></td>
    <td><?php echo $Invoice->getShipDate();?></td>
    <td><?php
        $BillService = new QuickBooks_IPP_Service_Bill();
        $bills = $BillService->query($Context, $realm, "SELECT * FROM Bill where SalesTermRef='".QuickBooks_IPP_IDS::usableIDType($Invoice->getSalesTermRef())."'"); ?>          
            <select name="print_supplier">
            <?php  foreach ($bills as $bill) {
            echo "<option value=".$bill->getVendorRef_name().">".$bill->getVendorRef_name()."</option>";
            }
            ?>
            </select>
                <select name="print_supplier2">
                <?php
                foreach ($print_supplier_array as $supplier)
                {
                echo "<option value='".$supplier."'>".$supplier."</option>";
                }
                ?>
                </select>
    </td>
    <td>
        <select name="blank_garment_supplier">
        <?php
        foreach ($blank_garment_supplier as $supplier)
	{
        echo "<option value='".$supplier."'>".$supplier."</option>";
        }
        ?>
        </select>
    </td>
    <td><?php    
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
    <td><?php             echo $Invoice->getShipMethodRef_name(); ?>
        <select name="blank_garment_supplier">
        <?php
        foreach ($shipement_method_array as $value)
	{
        echo "<option value='".$value."'>".$value."</option>";
        }
        ?>
        </select>
    </td>
    <td> <?php echo $Invoice->getDocNumber()." /<br>".$Invoice->getTxnDate(); ?><input type="text" name="tract_num" value=""></td>
    <td> <a class="btn btn-success btn-sm" href=?follow="<?php echo $Invoice->getDocNumber();?>">Follow up ?</a></td>
    <td> <a class="btn btn-danger btn-sm" href=?bg="<?php echo $Invoice->getDocNumber();     ?>">BG Email</a> </td>
    <td> <a class="btn btn-warning btn-sm" href=?print="<?php echo $Invoice->getDocNumber(); ?>">Print</a> </td>
    <td> <a class="btn btn-info btn-sm" href=?files="<?php echo $Invoice->getDocNumber();    ?>">View Files</a> </td>
  </tr>
  <?php 
}

?>
</table>  
  </div>
</div><div class="row">
  <div class="col-md-12">
    <hr>
  </div>
</div>
<table class="table table-striped table-bordered table-responsive">
  <tr>
    <td> Internal ID </td>
    <td> Invoice# </td>
    <td> Amount </td>
    <td> Details </td>
    <td> Actions </td>
  </tr>
  <?php
$InvoiceService = new QuickBooks_IPP_Service_Invoice();

$invoices = $InvoiceService->query($Context, $realm, "SELECT * FROM Invoice STARTPOSITION 1 MAXRESULTS 10");
//$invoices = $InvoiceService->query($Context, $realm, "SELECT * FROM Invoice WHERE DocNumber = '1002' ");

# perform the local query....
	$sql = "Select * from quickbooks_invoice";
	//$result = $conn->query($sql);
	
	//$row = $result->fetch_assoc();
//echo "<pre>";
//print_r($invoices);
//echo "</pre>";
//	
foreach ($invoices as $Invoice)
{	
	if($Invoice->getDocNumber() ){
		//$insert_sql = "INSERT INTO quickbooks_invoice (invoice_num,invoice_amount,invoice_status) VALUES('".$Invoice->getDocNumber()."','".$Invoice->getTotalAmt()."','0')";
		//$conn->query($insert_sql);
	}

?>
  <tr>
    <td><?php echo $Invoice->getId();?></td>
    <td><?php echo $Invoice->getDocNumber();?></td>
    <td>$<?php echo $Invoice->getTotalAmt();?></td>
    <td><?php echo $Invoice->getLine(0)->getDescription();?></td>
    <td><a class="btn btn-success btn-sm" href="#">Edit</a>&nbsp;<a class="btn btn-success btn-sm" id="send_email" href="javascript:void(0);">Send Email</a>
    <a class="btn btn-success btn-sm" href="<?php echo $actual_link.'?invoice='.$Invoice->getDocNumber().'';?>">X</a>
    </td>
  </tr>
  <?php 
}
?>
</table>
<?php
//print('Invoice # ' . $Invoice->getDocNumber() . ' has a total of $' . $Invoice->getTotalAmt() . "\n");
//print('    First line item: ' . $Invoice->getLine(0)->getDescription() . "\n");
//print('    Internal Id value: ' . $Invoice->getId() . "\n");
//print("\n");

//print_r($Invoice);
//$Line = $Invoice->getLine(0);
//print_r($Line);
require_once dirname(__FILE__) . '/views/footer.tpl.php';

?>
