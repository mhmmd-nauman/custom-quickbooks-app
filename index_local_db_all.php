<?php
require_once dirname(__FILE__) . '/config.php';
require_once dirname(__FILE__) . '/lib/include.php';
$objInvoice = new Invoice();
?>
<html>
    <head>
        <meta charset = "utf-8">
        <meta http-equiv = "X-UA-Compatible" content = "IE = edge">
        <meta name = "viewport" content = "width = device-width, initial-scale = 1">

        <title>Quickbooks Custom Application</title>

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
    
        <link rel="stylesheet" href="http://cdn.datatables.net/1.10.2/css/jquery.dataTables.min.css"></style>
        <script type="text/javascript" src="http://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>
        <script>
        $(document).ready(function(){
            $('#myTable').dataTable();
        });
        </script>
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
        <div class="col-md-4">
            <h1>Hidden Invoices</h1>
        </div>
       
    </div>
    <div class="row">
        <div class="col-md-7 alert alert-info" >This page all lists hidden Invoices.<br>
            
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
                    <td colspan="2"> Action</td>
                    
                </tr>
            </thead>
            <tbody>
<?php 
$InvoiceService = new QuickBooks_IPP_Service_Invoice();
$CustomerService = new QuickBooks_IPP_Service_Customer();
$invoices = $objInvoice->GetAllInvoices("Visible = 0 order by ShipDate desc",array("*"));
$print_supplier_array=array("SuperGraphics","Double L","Top Notch","True Screen");
$shipement_method_array=array("Print","UPS","CANADA POST","SPOTSHUB","A COASTAL REIGN REPRESENTATIVE");
$garment_supplier_array=array("Sanmar","Technosport");
        
//var_dump($invoices);
$sr = 0;
if($invoices)
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
            //echo    $id= $Invoice->getCustomerRef();
            echo $name= $Invoice['CustomerRef_name'];
            //echo "/";
            $email=$Invoice['BillEmail'];
            
            if($email){
                ?>
                <?php echo $email;?>
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
        if($ship_date!="0000-00-00"){
            $ship_date_value = date("m/d/Y",  strtotime($ship_date));
            //$ship_date_value = "";
        }?>
         <?php echo $ship_date_value ;?>
    </td>
    
    <td>    
    <?php
        $BillService = new QuickBooks_IPP_Service_Bill();
        $bills = $BillService->query($Context, $realm, "SELECT * FROM Bill where SalesTermRef='".QuickBooks_IPP_IDS::usableIDType($Invoice['SalesTermRef'])."'"); 
        
        ?>          
           
        <select  disabled="" name="print_supplier" class="big-drop-down">
            <?php  foreach ($bills as $bill) {?>
            <option value="<?php echo $bill->getId();?>" <?php if($bill->getId() == $Invoice['PrintSupplier'])echo"selected";?>><?php echo $bill->getVendorRef_name();?></option>
            
               <?php }
            ?>
            </select>
        <select  disabled="" name="PrintSupplier2" class="small-drop-down">
                    <option value="">Select</option>
                    <?php   foreach ($print_supplier_array as $supplier)    {   ?>
                    <option value="<?php echo $supplier;?>" <?php if($supplier == $Invoice['PrintSupplier2'])echo"selected";?>><?php echo $supplier;?></option>
                <?php        }   ?>
                </select>    
    </td>
    <td>
        <select  name="blank_garment_supplier" class="small-drop-down" disabled="">
            <option value="">Select</option>
            <?php   foreach ($garment_supplier_array as $supplier)  { ?>
            <option value="<?php echo $supplier;?>" <?php if($supplier == $Invoice['blank_garment_supplier'])echo"selected";?>><?php echo $supplier;?></option>
            <?php  }   ?>
        </select>    
    </td>
    <td> <?php echo $Invoice['ship_address'] ;?>
    </td>
    <td>        
         <?php echo $Invoice['PhoneNo'] ;?>
    </td>
    <td>
        <select name="shipping_method" class="small-drop-down" disabled="">
        <?php 
        //
        foreach($shipement_method_array as $shippingmethod){
        ?>
            <option value='<?php echo $shippingmethod;?>' <?php if($Invoice['CustomerPreferredDeliveryMethod'] == $shippingmethod)echo"selected";?>><?php echo $shippingmethod;?></option>
        <?php }?>
                
        </select>
    </td>
    <td><?php echo $Invoice['tracking_no'];?> / <?php echo date("m/d/Y",  strtotime($Invoice['TxnDate']));?></td>
    <td> 
        <button  type = "button" name="hide_button" id="hide_button" class = "btn btn-success btn-sm">Visible</button>
<!--    //-->
    </td>
    <td><b id="ajax_wait<?php echo $invoice_id;?>" align="center" style=" display:none;"><h2>Please Wait...</h2></b>
    </td>
  </tr>
<?php } ?>  
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
    modalbox(this.href,this.title,200,400);
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
    
</body>
</html>