<?php

require_once dirname(__FILE__) . '/config.php';

require_once dirname(__FILE__) . '/views/header.tpl.php';

?>
<div class="row">
    <div class="col-md-2">
        Internal ID
    </div>
    <div class="col-md-2">
        Invoice#
    </div>
    <div class="col-md-2">
        Amount
    </div>
    <div class="col-md-3">
        Details
    </div>
    <div class="col-md-2">
        Actions
    </div>
    </div>
<?php
$InvoiceService = new QuickBooks_IPP_Service_Invoice();

$invoices = $InvoiceService->query($Context, $realm, "SELECT * FROM Invoice STARTPOSITION 1 MAXRESULTS 10");
//$invoices = $InvoiceService->query($Context, $realm, "SELECT * FROM Invoice WHERE DocNumber = '1002' ");

//print_r($customers);

foreach ($invoices as $Invoice)
{
    ?>
    <div class="row">
        <div class="col-md-2">
            <?php echo $Invoice->getId();?>
        </div>
        <div class="col-md-2">
            <?php echo $Invoice->getDocNumber();?>
        </div>
        <div class="col-md-2">
            <?php echo $Invoice->getTotalAmt();?>
        </div>
        <div class="col-md-3">
            <?php echo $Invoice->getLine(0)->getDescription();?>
        </div>
        <div class="col-md-2">
            <a class="btn btn-success btn-sm" href="#">Edit</a>&nbsp;<a class="btn btn-success btn-sm" href="#">Send Email</a>
        </div>
    </div>
<?php 
}
?>
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