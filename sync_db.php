<?php
require_once dirname(__FILE__) . '/config.php';
require_once dirname(__FILE__) . '/lib/include.php';
$objInvoice = new Invoice();
$InvoiceService = new QuickBooks_IPP_Service_Invoice();
$CustomerService = new QuickBooks_IPP_Service_Customer();
$local_invoices = $objInvoice->GetAllInvoices("Visible = 1 order by ShipDate desc",array("*"));
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
<?php
foreach ($local_invoices as $local_Invoice) {
    $live_invoices = $InvoiceService->query($Context, $realm, "SELECT * FROM Invoice WHERE DocNumber = '".QuickBooks_IPP_IDS::usableIDType($local_Invoice['DocNumber'])."' ");
    $Invoice = $live_invoices[0];
    $customers = $CustomerService->query($Context, $realm, "SELECT * FROM Customer WHERE id ='".QuickBooks_IPP_IDS::usableIDType($Invoice->getCustomerRef())."'"); 
    $Customer = $customers[0]; 
    $addr=$Invoice->getBillEmail(0);
    if(isset($addr)) 
    {
        $BillEmail = $Invoice->getBillEmail();
        $BillEmail->setAddress($local_Invoice['BillEmail']);
        if ($resp = $InvoiceService->update($Context, $realm, $Invoice->getId(), $Invoice))
        { 
          $message="Updated";
        }
        else
        {
        ?>
            <div class="widget-body">
              <div class="alert alert-warning">
                      <button class="close" data-dismiss="alert">×</button>
                      <strong>Alert!</strong> <?php echo $InvoiceService->lastError(); ?>
              </div>
            </div>

        <?php
            
        }
    }       
     else 
    {
        if(is_object($Customer->getPrimaryEmailAddr(0))){
            $PrimaryEmailAddr = $Customer->getPrimaryEmailAddr();
            $PrimaryEmailAddr->setAddress($local_Invoice['BillEmail']);
            if ($CustomerService->update($Context, $realm, $Customer->getId(), $Customer))
            {
                $message="Updated";

            }
            else
            {?>
                <div class="widget-body">
                  <div class="alert alert-warning">
                          <button class="close" data-dismiss="alert">×</button>
                          <strong>Alert!</strong> <?php echo $CustomerService->lastError($Context); ?>
                  </div>
                </div>
               
            <?php
            }
        }
    }
}

if($message) {?>
  <div class="widget-body">
    <div class="alert alert-info">
            <button class="close" data-dismiss="alert">×</button>
            <strong>Success!</strong> Invoices Updated.
    </div>
  </div>
<?php }
?>
</body>
</html>