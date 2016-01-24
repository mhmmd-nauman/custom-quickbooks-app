<?php
require_once dirname(__FILE__) . '/config.php';
require_once dirname(__FILE__) . '/lib/include.php';
$objInvoice = new Invoice();
$objInvoiceList = new InvoicesList();
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
      <h1>Local Invoice Actions :</h1>
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
      <form name="form" method="post" >         
          <input type="submit" name="updateinvoice"  class="btn btn-success btn-sm" value="Update Invoice">  
          <input type="submit" name="deleteinvoice"  class="btn btn-warning btn-sm" value="Delete Invoice">  
    
      </form>
<?php 

  if(isset($_REQUEST['updateinvoice'])  )   
        {
             echo "<h3>Updated Records Detail</h3>";
         }     
  if(isset($_REQUEST['deleteinvoice'])  )   
        {
             echo "<h3>Updated Records Detail</h3>";
         }     

$InvoiceService = new QuickBooks_IPP_Service_Invoice();
$CustomerService = new QuickBooks_IPP_Service_Customer();
$ItemService = new QuickBooks_IPP_Service_Item();
$invoices = $InvoiceService->query($Context, $realm, "SELECT * FROM Invoice ");
//where 1 ORDERBY ShipDate DESC

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
   //print_r((array)$Invoice);
   //echo "</pre>";
   //exit;
   //$customer->PrimaryPhone->FreeFormNumber;
   //$num = $Customer[0]->getXPath('//Customer/PrimaryPhone/FreeFormNumber'); 
   //print('Phone #: ' . $num);
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
              $email=$Customer[0]->getPrimaryEmailAddr(0)->getAddress();

        }
    }
     
    $ship_add='';
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
            if($check)
                $total=$Invoice->getTotalAmt();
            else
                $total=0;
               $phone='';
            if(is_object($Customer[0])){
                $phone= $customers->getPrimaryPhone(0)->getFreeFormNumber();
            }
//////////////////////////////////////////  DELETE ALL RECORDS FROM LOCAL DATABASE /////
          
        if(isset($_REQUEST['deleteinvoice'])  )   
        {
             $local_delete= $objInvoice->DeleteInvoice($Invoice->getDocNumber());
            $local_list_delete= $objInvoiceList->DeleteInvoiceList($Invoice->getDocNumber());
            if($local_delete)
                echo $Invoice->getDocNumber() ." local records deleted<br>";
            else
                echo $Invoice->getDocNumber() ." Not deleted or Not Found <br>";


            if($local_list_delete)
               echo $Invoice->getDocNumber() ." local List records deleted<br>";
            else
               echo $Invoice->getDocNumber() ." Not deleted or Not Found <br>";
        }
////////////////////////////////////////////////////////////
 
        if(isset($_REQUEST['updateinvoice'])  )   
        {
            
            $local_already_exist= $objInvoice->GetAllInvoices("DocNumber = ".$Invoice->getDocNumber() ,array("*"));

            if($local_already_exist)
            {
                echo $Invoice->getDocNumber()."already exist<br>";
            }
           else
               {

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
                    for ($i = 0; $i < $num_lines; $i++)
                    {
                        $Line = $Invoice->getLine($i);
                        if ($Line->getDetailType() == 'SalesItemLineDetail')
                        {
                                 $Detail = $Line->getSalesItemLineDetail();
                                $item_id = $Detail->getItemRef();
                                $items = $ItemService->query($Context, $realm, "SELECT * FROM Item WHERE Id = '" . QuickBooks_IPP_IDS::usableIDType($item_id) . "' ");

                                $local_list_already_exist= $objInvoiceList->GetAllInvoicesList("DocNumber = ".$Invoice->getDocNumber() ." and LineNum = ".$Invoice->getLine($i)->getLineNum() ,array("*"));

                                if($local_list_already_exist) {}
                                else
                                    {
                                    $objInvoiceList->InsertInvoiceList(array(
                                        "DocNumber"=>$Invoice->getDocNumber(),
                                         "LineNum"=>$Invoice->getLine($i)->getLineNum(),
                                         "ItemRef_name"=>$items[0]->getName(),
                                         "Description"=>$Invoice->getLine($i)->getDescription()
                                            ));    
                                    }

                        }
                    }
                            echo $Invoice->getDocNumber()."Added to Local Database<br>";
                }   
  //  exit;
        }
        
        
        ?>

   
<?php } ?>   
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
    $('#ajax_wait').html("Please wait....");
    $.ajax({
    url: url,
    success: function(data) {
        //alert(data);
        $('#ajax_wait').html(data);
        //$('#main_body').html(data);
        //$('#main_body').show();     
     }
    });
}
</script>
