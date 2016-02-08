<?php
require_once dirname(__FILE__) . '/config.php';
require_once dirname(__FILE__) . '/lib/include.php';
if ($quickbooks_is_connected){
$objInvoice = new Invoice();
$objInvoiceList = new InvoicesList();
$InvoiceService = new QuickBooks_IPP_Service_Invoice();
$CustomerService = new QuickBooks_IPP_Service_Customer();
$ItemService = new QuickBooks_IPP_Service_Item();
$invoices = $InvoiceService->query($Context, $realm, "SELECT * FROM Invoice ");
$print_supplier_array=array("SuperGraphics","Double L","Top Notch","True Screen");
$shipement_method_array=array("Print","UPS","CANADA POST","SPOTSHUB","A COASTAL REIGN REPRESENTATIVE");
?>
<html>
<head>
    <meta charset = "utf-8">
    <meta http-equiv = "X-UA-Compatible" content = "IE = edge">
    <meta name = "viewport" content = "width = device-width,  initial-scale = 1">
    <title>Quickbooks Custom Application</title>
    <link href = "//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" rel = "stylesheet">
    <style type="text/css">
        .big-drop-down{ width: 120px;}
        .small-drop-down{ width: 80px;}
        .small-date-box{ width: 60px;}
        .mid-text-box{width: 120px;}
    </style>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
   </head>
<body>
<div class="container-fluid">
    <?php    include 'lib/nav.php';?>
    <div class="row">
        <div class="col-md-12" >
          <h1>Debugging page to delete local Invoices and Fetch Invoice from QB Application</h1>
        </div>
      </div>
    <div class="row">
        <div class="col-md-7 alert alert-info" >This page is used to delete all local cache data by Clicking "Delete Invoices".<br>
            Invoices can be fetched again using "Copy Invoices" from Quickbook Application.<br>
        </div>
        <div class="col-md-3 pull-right"> 
            <form name="form" method="post" onsubmit="return confirmation();"  >         
                <input type="submit" name="updateinvoice"  class="btn btn-success btn-large" value="Copy Invoices">  
                <input type="submit" name="deleteinvoice"  class="btn btn-warning btn-large" value="Delete Invoices">  
            </form>
        </div>
    <div class="row">
        <div class="col-md-12">
            <hr>
        </div>
    </div>
	
    <div class="row">
        <div class="col-md-12" >
            
            <?php 
            $added=$already_exist=$delete=0;
            if(isset($_REQUEST['updateinvoice']))  {
                //echo "<h5>Updated Records Detail</h5>";
            }     
            if(isset($_REQUEST['deleteinvoice']))  {
                //echo "<h5>Deleted Records Detail</h5>";
            }     

            foreach ((array)$invoices as $Invoice) {
                $ship_add=$phone='';
                $total=0;
                $Customer = $CustomerService->query($Context, $realm, "SELECT * FROM Customer WHERE id ='".QuickBooks_IPP_IDS::usableIDType($Invoice->getCustomerRef())."'"); 
                $invoice_id = $Invoice->getId();
                $invoice_id = str_replace("-", "", $invoice_id);
                $invoice_id = str_replace("{", "", $invoice_id);
                $invoice_id = str_replace("}", "", $invoice_id);
                if(is_object($Customer[0])){
                 $PreferredDeliveryMethod= $Customer[0]->getXPath('//Customer/PreferredDeliveryMethod');
                }
                $addr=$Invoice->getBillEmail(0);
                if(isset($addr)) $email = $Invoice->getBillEmail(0)->getAddress();
                else {
                     if(is_object($Customer[0])){
                          // $email=$Customer[0]->getPrimaryEmailAddr(0)->getAddress();

                    }
                }
                if(is_object($Customer[0])){
                    $customers = $Customer[0];
                    $checkinprimary = $customers->getBillAddr(0);
                    if ($checkinprimary) {
                        $checkinshipping = $Invoice->getShipAddr(0);
                        if ($checkinshipping) {
                            $ship_add= $Invoice->getShipAddr(0)->getLine1().$Invoice->getShipAddr(0)->getCity().$Invoice->getShipAddr(0)->getPostalCode();
                        }
                        else {
                            $ship_add= $customers->getBillAddr(0)->getLine1()." , " .$customers->getBillAddr(0)->getCountrySubDivisionCode()." , " .$customers->getBillAddr(0)->getPostalCode();
                        }
                    } 
                }   
                $check=$Invoice->getTotalAmt(0);
                    if($check) $total=$Invoice->getTotalAmt();
                    //if(is_object($Customer[0])){ $phone= $customers->getPrimaryPhone(0)->getFreeFormNumber(); }
         
                    
                if(isset($_REQUEST['deleteinvoice'])){
                    $local_delete= $objInvoice->DeleteInvoice($Invoice->getDocNumber());
                    $local_list_delete= $objInvoiceList->DeleteInvoiceList($Invoice->getDocNumber());
                    if($local_delete){
                        //echo $Invoice->getDocNumber() ." local records deleted<br>";
                        $delete++;
                    }else {
                       // echo $Invoice->getDocNumber() ." Not deleted or Not Found <br>";
                    }

                    if($local_list_delete){
                       //echo $Invoice->getDocNumber() ." local List records deleted<br>";
                    }else {
                       //echo $Invoice->getDocNumber() ." Not deleted or Not Found <br>";
                    }
                }
                if(isset($_REQUEST['updateinvoice']))   {
                    $local_already_exist= $objInvoice->GetAllInvoices("DocNumber = ".$Invoice->getDocNumber() ,array("*"));
                    if($local_already_exist){
                        //echo $Invoice->getDocNumber()."already exist<br>";
                        $already_exist++;
                    }
                    else  {
                        $objInvoice->InsertInvoice(array("DocNumber"=>$Invoice->getDocNumber(),
                        "TxnDate"=>$Invoice->getTxnDate(),
                        "Id"=>$invoice_id,
                        //"CurrencyRef_name"=>$Invoice->getCurrencyRef_name(),
                        "CustomerRef"=>$Invoice->getCustomerRef(),
                        "CustomerRef_name"=>$Invoice->getCustomerRef_name(),
                        //"CustomerMemo"=>$Invoice->getCustomerMemo(),
                        "SalesTermRef"=>$Invoice->getSalesTermRef(),
                        "DueDate"=>$Invoice->getDueDate(),
                        "ShipDate"=>$Invoice->getShipDate(),
                        "ship_address"=>$ship_add, // found in customer table please remove if not working in cron job
                        "TotalAmt"=>$total,
                        "ApplyTaxAfterDiscount"=>$Invoice->getApplyTaxAfterDiscount(),
                        "PrintStatus"=>$Invoice->getPrintStatus(),
                        "EmailStatus"=>$Invoice->getEmailStatus(),
                        "BillEmail"=>$email,
                        "Balance"=>$Invoice->getBalance(),
                        "Deposit"=>$Invoice->getDeposit(),
                        "AllowIPNPayment"=>$Invoice->getAllowIPNPayment(),
                        "AllowOnlinePayment"=>$Invoice->getAllowOnlinePayment(),
                        "AllowOnlineCreditCardPayment"=>$Invoice->getAllowOnlineCreditCardPayment(),
                        "AllowOnlineACHPayment"=>$Invoice->getAllowAllowOnlineACHPayment(),
                         "PhoneNo"=>$phone
                        ));
                        $num_lines = $Invoice->countLine(); 		// How many line items are there?
                        for ($i = 0; $i < $num_lines; $i++) {
                            $Line = $Invoice->getLine($i);
                            if ($Line->getDetailType() == 'SalesItemLineDetail')
                            {
                                $Detail = $Line->getSalesItemLineDetail();
                                $item_id = $Detail->getItemRef();
                                $items = $ItemService->query($Context, $realm, "SELECT * FROM Item WHERE Id = '" . QuickBooks_IPP_IDS::usableIDType($item_id)."'");

                                $local_list_already_exist= $objInvoiceList->GetAllInvoicesList("DocNumber = ".$Invoice->getDocNumber() ." and LineNum = ".$Invoice->getLine($i)->getLineNum() ,array("*"));

                                if($local_list_already_exist) {}
                                else{
                                    $ref_name='';
                                    if(isset($items[0]) && $items[0]!=''){
                                    $check_ref_name=$items[0]->getName();
                                    if($check_ref_name) $ref_name=$items[0]->getName();
                                    }
                                    $objInvoiceList->InsertInvoiceList(array(
                                        "DocNumber"=>$Invoice->getDocNumber(),
                                        "LineNum"=>$Invoice->getLine($i)->getLineNum(),
                                        "ItemRef_name"=>$ref_name,
                                        "Description"=>$Invoice->getLine($i)->getDescription()
                                        ));    
                                }
                            }
                        }
                        //echo $Invoice->getDocNumber()."Added to Local Database<br>";
                        $added++;
                        }   
                    }
                     ?>


                <?php } ?>   
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?php if(isset($added) && $added>0) { ?>
                <div class="widget-body">
                  <div class="alert alert-success">
                          <button class="close" data-dismiss="alert">×</button>
                          <strong>Success!</strong> <?php echo $added; ?> Invoices added in Local Database .
                  </div>
                </div>
                <?php } if(isset($already_exist) && $already_exist>0) { ?>
                <div class="widget-body">
                  <div class="alert alert-warning">
                          <button class="close" data-dismiss="alert">×</button>
                          <strong>Alert!</strong> <?php echo $already_exist; ?> Invoices already exist in Local Database
                  </div>
                </div>
                <?php } if(isset($delete) && $delete>0) { ?>
                <div class="widget-body">
                  <div class="alert alert-info">
                          <button class="close" data-dismiss="alert">×</button>
                          <strong>Success!</strong> <?php echo $delete; ?> Invoices deleted from Local Database
                  </div>
                </div>
                <?php } ?>
                
                <hr>
            </div>
        </div>
    </div>
</div>
</body>
</html>
<script>
    function confirmation() {
        var answer = confirm("Do you want to perform this action?");
    if(answer){
            return true;
    }else{
            return false;
    }
}
</script>
<?php } else{?>
<html>
<head>
      <meta charset = "utf-8">
      <meta http-equiv = "X-UA-Compatible" content = "IE = edge">
      <meta name = "viewport" content = "width = device-width, 
         initial-scale = 1">
      
      <title>Quickbooks Custom Application</title>
      <script type="text/javascript" src="https://appcenter.intuit.com/Content/IA/intuit.ipp.anywhere.js"></script>
       <script type="text/javascript">
        intuit.ipp.anywhere.setup({
                menuProxy: '<?php print($quickbooks_menu_url); ?>',
                grantUrl: '<?php print($quickbooks_oauth_url); ?>'
        });
        </script>
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
          .mid-text-box{width: 120px;}
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
<?php    include 'lib/nav.php';?>
<div class="row">
  <div class="col-md-12">
      <br>
  </div>
</div>
<div class="row">
    <div class="col-md-12" style="border: 2px solid red; text-align: center; padding: 8px; color: red;">
        <b>NOT</b> CONNECTED!<br>
        <br>
        <ipp:connectToIntuit></ipp:connectToIntuit>
        <br>
        <br>
        You must authenticate to QuickBooks <b>once</b> before you can exchange data with it. <br>
        <br>
        <strong>You only have to do this once!</strong> <br><br>

        After you've authenticated once, you never have to go 
        through this connection process again. <br>
        Click the button above to 
        authenticate and connect.
    </div>
</div>
</body>
</html>
<?php } ?>
