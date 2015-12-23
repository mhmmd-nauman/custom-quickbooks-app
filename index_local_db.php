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
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
        <script type="text/javascript" src="jquery.sticky.js"></script>
        <style type="text/css">
            .big-drop-down{ width: 120px;}
            .small-drop-down{ width: 80px;}
            .small-date-box{ width: 60px;}
            .mid-text-box{width: 120px;}
        </style>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
        <script src="//code.jquery.com/jquery-1.10.2.js"></script>
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
    <div class="row">
        <ul class = "nav navbar-nav">
    <li class = "active"><a href = "index.php">QB Live Invoice Data</a></li>
    <li><a href = "index_local_db.php">Local Cached Invoice Data</a></li>
    <li><a href = "#">Link1</a></li>
    <li><a href = "#">Link2</a></li>
    <li><a href = "#">Link3</a></li>
    <li><a href = "#">Items</a></li>
  </ul>
    </div>
    <div class="row" style=" text-align: bottom;">
        <div class="col-md-9">
            <h1>Local Cached Invoice Data</h1>
        </div>
       <div class="col-md-2"> <a title="Synchronize Local Cache to Quickbooks" class="btn btn-success btn-large invoice-sync"  href="sync_db.php">Synchronize Local Cache to Quickbooks</a> </div>
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
        <table id="myTable" class="display table"  align="center"  style=" font-size: 10px;">
            <thead>
                <tr>
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
//$invoices = $InvoiceService->query($Context, $realm, "SELECT * FROM Invoice  ORDERBY TxnDate DESC  STARTPOSITION 1 MAXRESULTS 10 ");
//where 1 ORDERBY ShipDate DESC
//echo "<pre>";
//print_r($invoices[0]);
//echo "</pre>";
//exit;
$invoices = $objInvoice->GetAllInvoices("Visible = 1 order by ShipDate desc",array("*"));
$print_supplier_array=array("SuperGraphics","Double L","Top Notch","True Screen");
$shipement_method_array=array("Print","UPS","CANADA POST","SPOTSHUB","A COASTAL REIGN REPRESENTATIVE");
$garment_supplier_array=array("Sanmar","Technosport");
        
foreach ($invoices as $Invoice) {
   //$Customer = $CustomerService->query($Context, $realm, "SELECT * FROM Customer WHERE id ='".QuickBooks_IPP_IDS::usableIDType($Invoice['CustomerRef'])."'"); 
   //$delivery_method = $customer->getCustomerPreferredDeliveryMethod();
   //echo "<pre>";
   //print_r((array)$Invoice);ALTER TABLE `invoices` ADD `CustomerPreferredDeliveryMethod` VARCHAR(50) NULL ;
   //echo "</pre>";
   //exit;
   //$customer->PrimaryPhone->FreeFormNumber;
   //$num = $Customer[0]->getXPath('//Customer/PrimaryPhone/FreeFormNumber'); 
   //print('Phone #: ' . $num);
   $invoice_id = $Invoice['Id'];
   $invoice_id = str_replace("-", "", $invoice_id);
   $invoice_id = str_replace("{", "", $invoice_id);
   $invoice_id = str_replace("}", "", $invoice_id);
   /*
   if(is_object($Customer[0])){
    $PreferredDeliveryMethod= $Customer[0]->getXPath('//Customer/PreferredDeliveryMethod');
   }
    * 
    */
   //exit;
   ?>
<script>
    $(function() {
      $( "#ship_date<?php echo $invoice_id;?>" ).datepicker();
      $( "#tract_date<?php echo $invoice_id;?>" ).datepicker();
      
    });
    </script>
    <tr id="<?php echo $invoice_id;?>">
    <td><?php 
            //echo    $id= $Invoice->getCustomerRef();
            echo $name= $Invoice['CustomerRef_name'];
            //echo "/";
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
        if($ship_date!="0000-00-00"){
            $ship_date_value = date("m/d/Y",  strtotime($ship_date));
            //$ship_date_value = "";
        }?>
        <input onchange ="UpdateInvoiceData('<?php echo $invoice_id;?>',this.name,this.value);" class="small-date-box" type="text" name="ship_date" id="ship_date<?php echo $invoice_id;?>" value="<?php echo $ship_date_value ;?>">
    </td>
    
    <td>    
    <?php
        $BillService = new QuickBooks_IPP_Service_Bill();
        $bills = $BillService->query($Context, $realm, "SELECT * FROM Bill where SalesTermRef='".QuickBooks_IPP_IDS::usableIDType($Invoice['SalesTermRef'])."'"); 
        //echo "<pre>";
        //print_r($bills);
        //echo "</pre>";
        //exit;
        ?>          
           
        <select onchange="UpdateInvoiceData('<?php echo $invoice_id;?>',this.name,this.value);" name="print_supplier" class="big-drop-down">
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
            //if(is_object($Customer[0])){
             //   $customers = $Customer[0];
              //  $checkinprimary = $customers->getBillAddr(0);
                 
            //}   
          ?>
        <textarea onchange ="UpdateInvoiceData('<?php echo $invoice_id;?>',this.name,this.value);" class="mid-text-box" name="ship_address"> <?php echo $Invoice['ship_address'] ;?></textarea>
    </td>
    <td> 
        <?php
        
            //if(is_object($Customer[0])){
                //echo $customers->getPrimaryPhone(0)->getFreeFormNumber();
            //}
        ?>        
        <input onchange ="UpdateInvoiceData('<?php echo $invoice_id;?>',this.name,this.value);" class="small-date-box" type="text" name="PhoneNo" value="<?php echo $Invoice['PhoneNo'] ;?>"> 
    </td>
    <td>
        <select name="shipping_method" class="small-drop-down" onchange="UpdateInvoiceData('<?php echo $invoice_id;?>',this.name,this.value);">
        <?php 
        //
        foreach($shipement_method_array as $shippingmethod){
        ?>
            <option value='<?php echo $shippingmethod;?>' <?php if($Invoice['CustomerPreferredDeliveryMethod'] == $shippingmethod)echo"selected";?>><?php echo $shippingmethod;?></option>
        <?php }?>
                
        </select>
    </td>
    <td> <?php //echo $Invoice['Number']; ?>
        <input onchange ="UpdateInvoiceData('<?php echo $invoice_id;?>',this.name,this.value);" class="small-date-box tracking_no" type="text" name="tracking_no" id="tracking_no<?php echo $invoice_id;?>" value="<?php echo $Invoice['tracking_no'];?>">
        /
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
    //alert("");
    //$('#main_body').hide();
    $('#ajax_wait'+InvoiceId).show();
    $('#ajax_wait'+InvoiceId).html("Please wait....");
    $.ajax({
    url: url,
    success: function(data) {
        //alert(data);
        $('#ajax_wait'+InvoiceId).html(data);
         $("#ajax_wait"+InvoiceId).sticky({ topSpacing: 0 });
        //$('#main_body').html(data);
        //$('#main_body').show();     
     }
    });
}
</script>
    
</body>
</html>