<?php
require_once dirname(__FILE__) . '/config.php';
require_once dirname(__FILE__) . '/lib/include.php';
$objInvoice = new Invoice();
if ($quickbooks_is_connected){
?>

<html>
    <head>
        <meta charset = "utf-8">
        <meta http-equiv = "X-UA-Compatible" content = "IE = edge">
        <meta name = "viewport" content = "width = device-width, initial-scale = 1">

        <title>Coastalreign.Com</title>

        <!-- Bootstrap -->
        <link href = "//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css"  rel = "stylesheet">
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src = "https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src = "https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
       <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
         <style type="text/css">
            .big-drop-down{ width: 120px;}
            .small-drop-down{ width: 80px;}
            .small-date-box{ width: 60px;}
            .mid-text-box{width: 120px;}
        </style>
        <style>
        .intro {
            font-size: 150%;
            color: red;
        }
        </style>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
        <script src="//code.jquery.com/jquery-1.10.2.js"></script>
        <script type="text/javascript" src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
        
        <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
        <!--
        <link rel="stylesheet" href="http://cdn.datatables.net/1.10.2/css/jquery.dataTables.min.css"></style>
        <script type="text/javascript" src="http://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>
        <script>
        $(document).ready(function(){
            $('#myTable').dataTable();
        });
        </script>
        -->
        <script type="text/javascript">
    function displayRow(str){
        var row = document.getElementById(str);
	row.style.display = 'none';
	}
</script>
    </head>
<body>
<div class="container-fluid">
    <?php    include 'lib/nav.php';?>
    <div class="row">
        <?php if(is_object($quickbooks_CompanyInfo)){ ?>
        <div class="col-md-12">
            <div class="col-md-7 alert alert-info" >
            <?php print($quickbooks_CompanyInfo->getCompanyName()); ?><br>
            <?php print($quickbooks_CompanyInfo->getEmail()->getAddress()); ?>
            <?php print($quickbooks_CompanyInfo->getCountry()); ?>
            </div>
        </div>
        <?php }?>
        <div class="col-md-3 pull-right">
            <a  title="DISCONNECT" class="btn btn-success btn-large"  href=" disconnect.php">DISCONNECT</a> 
        </div>
      </div>
    <div class="row">
        <div class="col-md-12">
            <h1>Invoice Details</h1>
        </div>
      </div>
    <div class="row">
       <div class="col-md-7 alert alert-info" >This page lists Invoices that are fetched from QuickBook Application.<br>
       Th Invoices on this page are stored and update locally.<br>
       Data is not updated to QuickBook Application Until Button <b>"Update Changes to Quickbooks Account"</b> is pressed.
       </div>
       <div class="col-md-3 pull-right" > 
          
           <a  title="Update Changes to Quickbooks Account" class="btn btn-success btn-large invoice-sync"  href=" sync_db.php">Update Changes to Quickbooks Account</a> 
       </div>
    </div>
<div class="row">
  <div class="col-md-12">
    <hr>
  </div>
</div>
	
<div class="row">
 
    <div class="col-md-12"  align="center">
      <div class="table-responsive" align="center"  >
        <table class="table table-striped table-bordered table-responsive" style=" font-size: 10px;">
            <thead>
                <tr>
                    <td> SrNo </td>
                    <td style=" width: 10%;"> Client Name/Email </td>
                    <td> Invoice#/<br>Amount/<br>ShipDate </td>
                    <td style=" width: 10%;"> Print Supplier </td>
                    <td> BG Supplier </td>
                    <td> Shipping Address </td>
                    <td style=" width: 7%;"> Phone # </td>
                    <td> Shipping Method </td>
                    <td> TrackingNo <br>/Date </td>
                    <td> Action</td>
                    <td> Follow up ? </td>
                    <td> BG Email </td>
                    <td> Print Instruction</td>
                    <td> View Files </td>
                    <td>  </td>
                </tr>
            </thead>
            <tbody>
<?php 
$InvoiceService = new QuickBooks_IPP_Service_Invoice();
$CustomerService = new QuickBooks_IPP_Service_Customer();
$invoices = $objInvoice->GetAllInvoices("Visible = 1 order by ShipDate desc",array("*"));
$print_supplier_array=array("SuperGraphics","Double L","Top Notch","True Screen");
$shipement_method_array=array("Print","UPS","CANADA POST","SPOTSHUB","A COASTAL REIGN REPRESENTATIVE");
$garment_supplier_array=array("Sanmar","Technosport");
$sr = 0;
//echo "<pre>";
//print_r($invoices);
//echo "</pre>";
if($invoices){
    foreach ($invoices as $Invoice) {
   $sr++;
   $invoice_id = $Invoice['Id'];
   $invoice_id = str_replace("-", "", $invoice_id);
   $invoice_id = str_replace("{", "", $invoice_id);
   $invoice_id = str_replace("}", "", $invoice_id);
   
   ?>
<script>
    $(function() {
      $( "#ship_date<?php echo $invoice_id;?>" ).datepicker();
      $( "#tract_date<?php echo $invoice_id;?>" ).datepicker();
      
    });
    </script>
    <tr id="<?php echo $invoice_id;?>">
        <td><?php echo $sr; ?></td>
    <td><?php 
            
            echo $name= $Invoice['CustomerRef_name'];
            
            $email=$Invoice['BillEmail'];
            
            if($email){
                ?>
                <input  onchange="UpdateInvoiceData('<?php echo $invoice_id;?>',this.name,this.value);" class="mid-text-box" type="text" name="email" value="<?php echo $email;?>">
               <?php
            }
        ?>
    </td>    
    <td>    
        <?php echo $Invoice['DocNumber'];?> /
        $<?php echo $Invoice['TotalAmt'];?> /<br>
        <?php 
        $ship_date=$Invoice['ShipDate'];
        $ship_date_value="";
        if($ship_date!="0000-00-00" && $ship_date!="1970-01-01"){
            $ship_date_value = date("m/d/Y",  strtotime($ship_date));
            //$ship_date_value = "";
        }?>
        <input onchange ="UpdateInvoiceData('<?php echo $invoice_id;?>',this.name,this.value);" class="small-date-box" type="text" name="ship_date" id="ship_date<?php echo $invoice_id;?>" value="<?php echo $ship_date_value ;?>">
    </td>
    
    <td>    
    <?php
        $BillService = new QuickBooks_IPP_Service_Bill();
        $bills = $BillService->query($Context, $realm, "SELECT * FROM Bill where SalesTermRef='".QuickBooks_IPP_IDS::usableIDType($Invoice['SalesTermRef'])."'"); 
        
        ?>          
           
        <select onchange="UpdateInvoiceData('<?php echo $invoice_id;?>',this.name,this.value);" name="print_supplier" class="big-drop-down">
            <option value="">Select</option>
            <?php  foreach ($bills as $bill) {?>
            <option value="<?php echo $bill->getId();?>" <?php if($bill->getId() == $Invoice['PrintSupplier'])echo"selected";?>><?php echo $bill->getVendorRef_name();?></option>
            
               <?php }
            ?>
            </select>
                <select onchange="UpdateInvoiceData('<?php echo $invoice_id;?>',this.name,this.value);" name="PrintSupplier2" class="small-drop-down">
                    <option value="">Select</option>
                    <?php   foreach ($print_supplier_array as $supplier)    {   ?>
                    <option value="<?php echo $supplier;?>" <?php if($supplier == $Invoice['PrintSupplier2'])echo"selected";?>><?php echo $supplier;?></option>
                <?php        }   ?>
                </select>    
    </td>
    <td>
         <select onchange="UpdateInvoiceData('<?php echo $invoice_id;?>',this.name,this.value);" name="blank_garment_supplier" class="small-drop-down">
            <option value="">Select</option>
            <?php   foreach ($garment_supplier_array as $supplier)  { ?>
            <option value="<?php echo $supplier;?>" <?php if($supplier == $Invoice['blank_garment_supplier'])echo"selected";?>><?php echo $supplier;?></option>
            <?php  }   ?>
        </select>    
    </td>
    <td>
        <?php    
              
          ?>
        <textarea onchange ="UpdateInvoiceData('<?php echo $invoice_id;?>',this.name,this.value);" class="mid-text-box" name="ship_address"> <?php echo $Invoice['ship_address'] ;?></textarea>
    </td>
    <td><?php
          
        ?>        
        <input onchange ="UpdateInvoiceData('<?php echo $invoice_id;?>',this.name,this.value);" class="small-date-box" type="text" name="PhoneNo" value="<?php echo $Invoice['PhoneNo'] ;?>"> 
    </td>
    <td>
        <select name="shipping_method" class="small-drop-down" onchange="UpdateInvoiceData('<?php echo $invoice_id;?>',this.name,this.value);">
        <option value="">Select</option>
        <?php 
        //
        foreach($shipement_method_array as $shippingmethod){
        ?>
            <option value='<?php echo $shippingmethod;?>' <?php if($Invoice['CustomerPreferredDeliveryMethod'] == $shippingmethod)echo"selected";?>><?php echo $shippingmethod;?></option>
        <?php }?>
                
        </select>
    </td>
    <td> <?php //echo $Invoice['Number']; ?>
        <input onchange ="UpdateInvoiceData('<?php echo $invoice_id;?>',this.name,this.value);" class="small-date-box tracking_no" type="text" name="tracking_no" id="tracking_no<?php echo $invoice_id;?>"  disabled="" value="<?php echo $invoice_id;?>">
        <input onchange ="UpdateInvoiceData('<?php echo $invoice_id;?>',this.name,this.value);" class="small-date-box tract_date" type="text" name="tract_date" id="tract_date<?php echo $invoice_id;?>" value="<?php echo date("m/d/Y",  strtotime($Invoice['TxnDate']));?>"></td>
    <td> 
        <button onclick="UpdateInvoiceData('<?php echo $invoice_id;?>',this.name,this.value);displayRow('<?php echo $invoice_id;?>');" type = "button" name="hide_button" id="hide_button" class = "btn btn-success btn-sm">Hide</button>
<!--    //-->
    </td>
    <td> <a title="Follow Up Email" class="btn btn-success btn-sm invoice-email"  href="example_invoice_email.php?follow=<?php echo $Invoice['DocNumber'];?>">Follow Up</a></td>
    <td> <a title="BG Email" class="btn btn-danger btn-sm invoice-email"  href="example_invoice_email.php?bg=<?php echo $Invoice['DocNumber'];?>">BG Email</a> </td>
    <td> <a title="Print Email" class="btn btn-warning btn-sm invoice-email"  href="example_invoice_email.php?printing=<?php echo $Invoice['DocNumber'];?>">Print</a> </td>
    <td> <a title="View Files Email" class="btn btn-info btn-sm invoice-email" href="example_invoice_email.php?shipping=<?php echo $Invoice['DocNumber'];?>">View Files</a></td>
   <td><b id="ajax_wait<?php echo $invoice_id;?>" align="center" style=" display:none;"><h2>Please Wait...</h2></b>
    </td>
  </tr>
<?php } 
}else{?>
  <tr>
      <td style="text-align:center;" colspan="15" >
          <div class="alert alert-info">
          No Invoices Please go to Settings Page to Copy Invoices<br>
          <a class="btn btn-success" href = "cron_job.php">Settings</a>
          </div>
      </td>
  </tr>
<?php }?>  
                </tbody>
            </table>  
        </div>
    </div>

</div>

<div class="row">
  <div class="col-md-12">
    <hr>
  </div>
</div>


<script>
$(".invoice-sync").click(function(e){
    e.preventDefault();	
     var answer = confirm("Do you want to perform this action?");
    if(answer){
            modalbox(this.href,this.title,200,400);
    }else{
            return false;
    }
    
});
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
    var url = "ajax_invoice_local_add.php?InvoiceId="+InvoiceId+"&FieldName="+FieldName+"&Data="+Data;
    $('#ajax_wait'+InvoiceId).show();
    $('#ajax_wait'+InvoiceId).html("Please wait....");
    $('#'+InvoiceId).css("background-color", "#cccccc");
    $.ajax({
    url: url,
    success: function(data) {
        $('#ajax_wait'+InvoiceId).html(data);
        $('#'+InvoiceId).fadeOut()
        $('#'+InvoiceId).fadeIn(2000);
    $('#'+InvoiceId).css("background-color", "transparent");
    $('#ajax_wait'+InvoiceId).delay(5000).fadeOut();
     }
    });
}
</script>
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
</body>
</html>
<?php } else {?>
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
