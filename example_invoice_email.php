<?php require_once dirname(__FILE__) . '/config.php'; 
require_once dirname(__FILE__) . '/lib/include.php';
$objInvoice = new Invoice();
$InvoiceService = new QuickBooks_IPP_Service_Invoice();
$garment_supplier_array=array(
                                "Sanmar"=>"mindir@sanmarcanada.com",
                                "Technosport"=>"mto@technosport.com "
                            );
$print_supplier_array=array(
                            "SuperGraphics"=>"Supergraphics@telus.net",
                            "Double L"=>"jenny@doublel.ca",
                            "Top Notch"=>"info@sewtopnotch.com",
                            "True Screen"=>"truescreen@telus.net");
//$CustomerService = new QuickBooks_IPP_Service_Customer();
?> 

  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <script src="js/tinymce/tinymce.min.js"></script>
<?php         
if(isset($_REQUEST['send']))
{
    $message = new Email();
    //$to = $_REQUEST['to'];
    $message->To = "mhmmd.nauman@gmail.com";
    $message->Cc = "sobiasafdar486@gmail.com";
    $message->From = "mhmmd.nauman@gmail.com";
    $message->Subject = "Invoice Email";
    $message->Content = $_REQUEST['message'];
    $message->TextOnly = false;
    if($message->Send()){?>
        <div class="alert alert-success">
            Mail Sent.
        </div>
        
    <?php }else{?>
        <div class="alert alert-warning">
            Error! Email Server not working.
        </div>
    <?php }
     
      
}

if(isset($_REQUEST['follow']))
{
$invoices = $objInvoice->GetAllInvoices("DocNumber=".$_REQUEST['follow'],array("*"));
?> 
  <div class="container">
  
  <form role="form">
    <div class="form-group">
        <label for="email">Subject:</label>
        <input type="text" id="subject" name="subject" class="form-control" placeholder="Subject" value="Thank you for your order from Coastal Reign."/>
    </div>
    <div class="form-group">
        <label for="pwd">To:</label>
        <input type="text" id="to" name="to" placeholder="To" class="form-control" value="<?php echo $invoices[0]['BillEmail']; ?>"/>
    </div>
    <div class="form-group">
        <label for="pwd">Message:</label>
        <textarea id="message" class="form-control" name="message" placeholder="Message.......">
            Hello <?php echo $invoices[0]['CustomerRef_name']."<br>"; ?>             
            <br><br>We hope you loved the custom printed clothing items we provided! If you have any issues with the products, please let us know and we will do our best to resolve any issues. 
            <br><br>If you have time to, please leave us a review on Google Plus. It helps build our online reputation and provides us with valuable feedback so we can better ourselves the next time.
            <br><br>Thank you and have a great day!
            <br><br>Kind Regards,
            <br><br>Boaz Chan
            <br><br>Coastal Reign Printing Team
        </textarea>
    </div>

      
    <button type="submit" class="btn btn-info" name="send">Send</button>
    <button type="submit" class="btn btn-danger">Cancel</button>
  </form>
</div>
<?php } 

if(isset($_REQUEST['bg']))
{
    $invoices = $objInvoice->GetAllInvoices("DocNumber=".$_REQUEST['bg'],array("*"));   
?>   
<div class="container">
  <form role="form">
    <div class="form-group">
        <label for="email">Subject:</label>
        <input type="text" id="subject" name="subject" class="form-control" placeholder="Subject" value="PO#<?php echo $_REQUEST['bg'];?>."/>
    </div>
    <div class="form-group">
        <label for="pwd">Recipient :</label>
        <input type="text" id="to" name="to" placeholder="To" class="form-control" value="<?php echo $garment_supplier_array[$invoices[0]['blank_garment_supplier']]; ?>"/>
    </div>
    <div class="form-group">
        <label for="pwd">Message:</label>
        <textarea id="message" class="form-control" name="message" placeholder="Message.......">
            Please have the following items shipped over to <?php echo $invoices[0]['PrintSupplier2']."[";   echo $print_supplier_array[$invoices[0]['PrintSupplier2']]."]"; ?>. 
                <br><br>
               
            <br><br> Thanks
            <br><br> Boaz Chan
        </textarea>
    </div>

      
    <button type="submit" class="btn btn-info" name="send">Send</button>
    <button type="submit" class="btn btn-danger">Cancel</button>
  </form>
</div>
<?php 
} 

if(isset($_REQUEST['printing']))
{
    $invoices = $objInvoice->GetAllInvoices("DocNumber=".$_REQUEST['printing'],array("*"));    
?> 
<div class="container">  
  <form role="form">
    <div class="form-group">
        <label for="email">Subject:</label>
        <input type="text" id="subject" name="subject" class="form-control" placeholder="Subject" value="PO#<?php echo $_REQUEST['printing']; ?> Due for : “<?php echo date('Y-m-d');?> + <?php echo $invoices[0]['DueDate'];?> – 4 days."/>
    </div>
    <div class="form-group">
        <label for="pwd">To:</label>
        <input type="text" id="to" name="to" placeholder="To" class="form-control" value="<?php echo $print_supplier_array[$invoices[0]['PrintSupplier2']]; ?>"/>
    </div>
    <div class="form-group">
        <label for="pwd">Message:</label>
        <textarea id="message" class="form-control" name="message" placeholder="Message.......">
            Hello,
            <br><br>Please have this ready for pick up “<?php echo date('Y-m-d');?> + <?php echo $invoices[0]['DueDate'];?> – 4 days”. Attached is the packing slip, mockups, and any other relevant files. Please reply back letting us know if the Due Date is within schedule. 
            <br><br>   Thanks!
            <br><br>   Boaz Chan
        </textarea>
    </div>

      
    <button type="submit" class="btn btn-info" name="send">Send</button>
    <button type="submit" class="btn btn-danger">Cancel</button>
  </form>
</div>
<?php } 


if(isset($_REQUEST['shipping']))
{
    $invoices = $objInvoice->GetAllInvoices("DocNumber=".$_REQUEST['shipping'],array("*"));    
?> 
<div class="container">
   <form role="form">
    <div class="form-group">
        <label for="email">Subject:</label>
        <input type="text" id="subject" name="subject" class="form-control" placeholder="Subject" value="Coastal Reign: Your order has been shipped! Order Number# <?php echo $_REQUEST['shipping']; ?>."/>
    </div>
    <div class="form-group">
        <label for="pwd">To:</label>
        <input type="text" id="to" name="to" placeholder="To" class="form-control" value="<?php echo $invoices[0]['BillEmail']; ?>"/>
    </div>
    <div class="form-group">
        <label for="pwd">Message:</label>
        <textarea id="message" class="form-control" name="message" placeholder="Message.......">
            Hello <?php echo $invoices[0]['CustomerRef_name'];  ?>             
            I am pleased to inform you that your order has finished printing! As stated in our earlier conversation, your order is being shipped via  <?php echo $invoices[0]['CustomerPreferredDeliveryMethod'];  ?>, which will take <?php echo $invoices[0]['ShipDate'];  ?> days.
            <br><br>Here are the details of your delivery.
            <br><br>Shipping Address : <?php echo $invoices[0]['ship_address'];  ?> 
            <br><br>Tracking No : <?php echo $invoices[0]['tracking_no'];  ?> 
            <br><br>Please let us know if you have any concerns. Otherwise, we are excited to say that your items will be in your hands in no time. 
            <br><br>Thanks,
            <br><br>Boaz
        </textarea>
    </div>

      
       <button type="submit" class="btn btn-info" name="send">Send</button>
    <button type="submit" class="btn btn-danger">Cancel</button>
  </form>
</div>
<?php } ?>

  
  
  
<script type="text/javascript">
tinymce.init({
    selector: "textarea#message",
    
    toolbar: " undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
});
</script>


