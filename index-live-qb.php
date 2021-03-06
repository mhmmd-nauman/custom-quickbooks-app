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
<div class="container-fluid">
<?php if ($quickbooks_is_connected){ ?>
<?php    include 'lib/nav.php';?>

<div class="row">
    <div class="col-md-12">
      <h1>Preview Quickbook Application Invoices(for tests only)</h1>
    </div>
</div>
    <div class="row">
        <div class="col-md-7 alert alert-info" >This page previews all Invoices from QuickBook Live Application.<br>
            These Invoices are for only viewing on Quickbook Application.<br>
            Please do not update data from this page as it will effect live data directly.
        </div>
        <div class="col-md-2 pull-right"> <a title="Synchronize Invoice Data" class="btn btn-success btn-large invoice-sync"  href="cron_job.php">Synchronize Invoice Data</a> </div>
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
    <td> SrNo </td>
    <td style=" width: 10%;"> Client Name/Email </td>
    <td> Invoice# /<br>Amount Owing /<br>Ship Date </td>
    
    <td style=" width: 10%;"> Print Supplier </td>
    <td> Blank Garment Supplier </td>
    <td> Shipping Address </td>
    <td style=" width: 7%;"> Phone # </td>
    <td> Shipping Method </td>
    <td> Tracking Number/Date </td>
    
  </tr>
<?php 
$InvoiceService = new QuickBooks_IPP_Service_Invoice();
$CustomerService = new QuickBooks_IPP_Service_Customer();
$invoices = $InvoiceService->query($Context, $realm, "SELECT * FROM Invoice   ORDERBY TxnDate DESC   ");

$print_supplier_array=array("SuperGraphics","Double L","Top Notch","True Screen");
$shipement_method_array=array("Print","UPS","CANADA POST","SPOTSHUB","A COASTAL REIGN REPRESENTATIVE");
$sr=0;        
foreach ($invoices as $Invoice) {
   $sr++; 
   $Customer = $CustomerService->query($Context, $realm, "SELECT * FROM Customer WHERE id ='".QuickBooks_IPP_IDS::usableIDType($Invoice->getCustomerRef())."'"); 
   
   $invoice_id = $Invoice->getId();
   $invoice_id = str_replace("-", "", $invoice_id);
   $invoice_id = str_replace("{", "", $invoice_id);
   $invoice_id = str_replace("}", "", $invoice_id);
   if(is_object($Customer[0])){
    $PreferredDeliveryMethod= $Customer[0]->getXPath('//Customer/PreferredDeliveryMethod');
   }
  
   ?>
    <script>
    $(function() {
      $( "#ship_date<?php echo $invoice_id;?>" ).datepicker();
    });
    </script>
<tr>
    <td><?php echo $sr; ?></td>
    <td><?php 
            echo $name= $Invoice->getCustomerRef_name();
            
            $addr=$Invoice->getBillEmail(0);
            if(isset($addr)) $email = $Invoice->getBillEmail(0)->getAddress();
            else {
                if(is_object($Customer[0])){
                      $email=$Customer[0]->getPrimaryEmailAddr(0)->getAddress();
                     
                }
            }
            if($email){
                ?>
                <?php echo $email;?>
               <?php
            }
        ?>
    </td>    
    <td>    
        <?php echo $Invoice->getDocNumber();?> /
        $<?php echo $Invoice->getTotalAmt();?> /
        <?php 
        $ship_date_value = date("m/d/Y",  strtotime($Invoice->getShipDate()));
        $ship_date=$Invoice->getShipDate();
        if(empty($ship_date)){ 
            $ship_date_value = "";
        }?>
        <?php echo $ship_date_value ;?>
    </td>
    
    <td>    
    <?php
        $BillService = new QuickBooks_IPP_Service_Bill();
        $bills = $BillService->query($Context, $realm, "SELECT * FROM Bill where SalesTermRef='".QuickBooks_IPP_IDS::usableIDType($Invoice->getSalesTermRef())."'"); ?>          
        <select name="print_supplier" class="big-drop-down" disabled="disabled">
            <?php  foreach ($bills as $bill) {
            echo "<option value=".$bill->getVendorRef_name().">".$bill->getVendorRef_name()."</option>";
            }
            ?>
            </select>
                <select name="print_supplier2" class="small-drop-down" disabled="disabled">
                <?php
                foreach ($print_supplier_array as $supplier)
                {
                echo "<option value='".$supplier."'>".$supplier."</option>";
                }
                ?>
                </select>    
    </td>
    <td>
        <select name="blank_garment_supplier" class="small-drop-down" disabled="disabled">
        <option value='Sanmar'>Sanmar</option>
        <option value='Technosport'>Technosport</option>        
        </select>
    </td>
    <td>
        <?php    
            if(is_object($Customer[0])){
                $customers = $Customer[0];
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
        
            if(is_object($Customer[0])){
                if(is_object($customers->getPrimaryPhone(0))){
                    echo $customers->getPrimaryPhone(0)->getFreeFormNumber();
            
                }
            }
        ?>        
    </td>
    <td>
        <select name="shipping_method" class="small-drop-down" disabled="disabled" >
        <?php 
        //
        foreach($shipement_method_array as $shippingmethod){
        ?>
            <option value='<?php echo $shippingmethod;?>' <?php if($PreferredDeliveryMethod == $shippingmethod)echo"selected";?>><?php echo $shippingmethod;?></option>
        <?php }?>
                
        </select>
    </td>
    <td> <?php echo $Invoice->getDocNumber(); ?> / <?php echo date("m/d/Y",  strtotime($Invoice->getTxnDate()));?></td>
    </tr>
<?php } ?>  </table>  
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <hr>
  </div>
</div>
<?php }else{ ?>
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
<?php }?>
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
