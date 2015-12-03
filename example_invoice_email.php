<?php require_once dirname(__FILE__) . '/config.php'; ?> 

  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <script src="js/tinymce/tinymce.min.js"></script>
<?php         
$InvoiceService = new QuickBooks_IPP_Service_Invoice();
$CustomerService = new QuickBooks_IPP_Service_Customer();

if(isset($_REQUEST['follow']))
{
$invoices = $InvoiceService->query($Context, $realm, "SELECT * FROM Invoice where DocNumber='".QuickBooks_IPP_IDS::usableIDType("{-".$_REQUEST['follow']."}")."'");

foreach ($invoices as $Invoice)  // email address  of customer 
    {   
    $addr=$Invoice->getBillEmail(0);
    if(isset($addr))  $to=$Invoice->getBillEmail(0)->getAddress();
    else {
        foreach ($customer as $customers)
                {
                 $to=$customers->getPrimaryEmailAddr(0)->getAddress();
                }
    }
}
            ?> 
  <div class="container">
  
  <form role="form">
    <div class="form-group">
        <label for="email">Subject:</label>
        <input type="text" id="subject" name="subject" class="form-control" placeholder="Subject" value="Thank you for your order from Coastal Reign."/>
    </div>
    <div class="form-group">
        <label for="pwd">To:</label>
        <input type="text" id="to" name="to" placeholder="To" class="form-control" value="<?php echo $to; ?>"/>
    </div>
    <div class="form-group">
        <label for="pwd">Message:</label>
        <textarea id="message" class="form-control" name="message" placeholder="Message.......">
            Hello 
                    <?php foreach ($invoices as $Invoice) {
                    echo $name= $Invoice->getCustomerRef_name()."<br>";
                    }
                    ?>             
<br><br> 
            We hope you loved the custom printed clothing items we provided! If you have any issues with the products, please let us know and we will do our best to resolve any issues. 
<br><br> 
           If you have time to, please leave us a review on Google Plus. It helps build our online reputation and provides us with valuable feedback so we can better ourselves the next time.
<br><br>   
            Thank you and have a great day!
<br><br>   
            Kind Regards,
<br><br>
            Boaz Chan
<br><br>            Coastal Reign Printing Team
            </textarea>
    </div>

      
    <button type="submit" class="btn btn-info">Send</button>
    <button type="submit" class="btn btn-danger">Cancel</button>
  </form>
</div>
<?php } 

if(isset($_REQUEST['bg']))
{
$invoices = $InvoiceService->query($Context, $realm, "SELECT * FROM Invoice where DocNumber='".QuickBooks_IPP_IDS::usableIDType("{-".$_REQUEST['bg']."}")."'");

//echo "<pre>";
//echo print_r($invoices);
//echo"</pre>";

foreach ($invoices as $Invoice)  
    {
    //
    }
?> 
  <div class="container">
  
  <form role="form">
    <div class="form-group">
        <label for="email">Subject:</label>
        <input type="text" id="subject" name="subject" class="form-control" placeholder="Subject" value="PO#<?php echo $_REQUEST['bg'];?>."/>
    </div>
    <div class="form-group">
        <label for="pwd">Recipient :</label>
        <input type="text" id="to" name="to" placeholder="To" class="form-control" value="[Blank Garment Supplier Email]"/>
    </div>
    <div class="form-group">
        <label for="pwd">Message:</label>
        <textarea id="message" class="form-control" name="message" placeholder="Message.......">
            Please have the following items shipped over to [Print Supplier]. 


            <br><br>
<?php 
foreach ($invoices as $Invoice)  // email address  of customer 
    { 
    echo "<br><br>Product Line ".$Invoice->getLine(0)->getLineNum().":"; 
        
    echo "<br>-  ".$Invoice->getLine(0)->getSalesItemLineDetail(0)->getItemRef_name();
    echo "<br>-  ".$Invoice->getLine(0)->getDescription();
    
//
//echo "my count".    count($Invoice->getLine()) ."<br><br>";
//    
//$arr=$Invoice->getLine();
//foreach($arr as $var)
//    {
//    echo $var;
//    echo "code executing";
//    }

    }
    ?>
        <br><br> Thanks
        <br><br> Boaz Chan
        </textarea>
    </div>

      
    <button type="submit" class="btn btn-info">Send</button>
    <button type="submit" class="btn btn-danger">Cancel</button>
  </form>
</div>
<?php 
} 

if(isset($_REQUEST['printing']))
{
$invoices = $InvoiceService->query($Context, $realm, "SELECT * FROM Invoice where DocNumber='".QuickBooks_IPP_IDS::usableIDType("{-".$_REQUEST['printing']."}")."'");

foreach ($invoices as $Invoice)  // email address  of customer 
    {   
    $due= $Invoice->getDueDate();
}
            ?> 
  <div class="container">
  
  <form role="form">
    <div class="form-group">
        <label for="email">Subject:</label>
        <input type="text" id="subject" name="subject" class="form-control" placeholder="Subject" value="PO#<?php echo $_REQUEST['printing']; ?> Due for : “<?php echo date('Y-m-d');?> + <?php echo $due;?> – 4 days."/>
    </div>
    <div class="form-group">
        <label for="pwd">To:</label>
        <input type="text" id="to" name="to" placeholder="To" class="form-control" value="[Print Supplier Email.]"/>
    </div>
    <div class="form-group">
        <label for="pwd">Message:</label>
        <textarea id="message" class="form-control" name="message" placeholder="Message.......">
            Hello,
            <br><br>Please have this ready for pick up “<?php echo date('Y-m-d');?> + <?php echo $due;?> – 4 days”. Attached is the packing slip, mockups, and any other relevant files. Please reply back letting us know if the Due Date is within schedule. 
            <br><br>   Thanks!
            <br><br>   Boaz Chan
        </textarea>
    </div>

      
    <button type="submit" class="btn btn-info">Send</button>
    <button type="submit" class="btn btn-danger">Cancel</button>
  </form>
</div>
<?php } 


if(isset($_REQUEST['shipping']))
{
    $invoices = $InvoiceService->query($Context, $realm, "SELECT * FROM Invoice where DocNumber='".QuickBooks_IPP_IDS::usableIDType("{-".$_REQUEST['shipping']."}")."'");

    foreach ($invoices as $Invoice)  // email address  of customer 
    {   
    $addr=$Invoice->getBillEmail(0);
    if(isset($addr))  $to=$Invoice->getBillEmail(0)->getAddress();
    else {
        foreach ($customer as $customers)
                {
                 $to=$customers->getPrimaryEmailAddr(0)->getAddress();
                }
    }
    
   $customer = $CustomerService->query($Context, $realm, "SELECT * FROM Customer WHERE id ='".QuickBooks_IPP_IDS::usableIDType($Invoice->getCustomerRef())."'"); 
   
    
    foreach ($customer as $customers)
                {
                $checkinprimary = $customers->getBillAddr(0);
                if ($checkinprimary) {
                     $checkinshipping = $Invoice->getShipAddr(0);
                            if ($checkinshipping) {
                                $address= $Invoice->getShipAddr(0)->getLine1();?><?php echo $Invoice->getShipAddr(0)->getCity();?><?php echo $Invoice->getShipAddr(0)->getPostalCode();
                            }
                            else {
                                $address= $customers->getBillAddr(0)->getLine1()." , " .$customers->getBillAddr(0)->getCountrySubDivisionCode()." , " .$customers->getBillAddr(0)->getPostalCode();
                            }
                } 
                }
}
            ?> 
  <div class="container">
 
  <form role="form">
    <div class="form-group">
        <label for="email">Subject:</label>
        <input type="text" id="subject" name="subject" class="form-control" placeholder="Subject" value="Coastal Reign: Your order has been shipped! Order Number# <?php echo $_REQUEST['shipping']; ?>."/>
    </div>
    <div class="form-group">
        <label for="pwd">To:</label>
        <input type="text" id="to" name="to" placeholder="To" class="form-control" value="<?php echo $to; ?>"/>
    </div>
    <div class="form-group">
        <label for="pwd">Message:</label>
        <textarea id="message" class="form-control" name="message" placeholder="Message.......">
            Hello 
                    <?php foreach ($invoices as $Invoice) {
                    echo $name= $Invoice->getCustomerRef_name()." ,<br>";
                    }
                    ?>             
            I am pleased to inform you that your order has finished printing! As stated in our earlier conversation, your order is being shipped via  [Shipping Method], which will take [dependant on shipping method] days.
            <br><br>Here are the details of your delivery.
            <br><br><?php $address; ?>
            <br><br>[Tracking Number]
            <br><br>Please let us know if you have any concerns. Otherwise, we are excited to say that your items will be in your hands in no time. 
            <br><br>Thanks,
            <br><br>Boaz
        </textarea>
    </div>

      
    <button type="submit" class="btn btn-info">Send</button>
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


