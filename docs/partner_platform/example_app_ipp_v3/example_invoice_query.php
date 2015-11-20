<?php

require_once dirname(__FILE__) . '/config.php';

require_once dirname(__FILE__) . '/views/header.tpl.php';

?>
<div class="row">
    <div class="col-md-12">
        <h1>Invoices from QB Live Application</h1>
    </div>
    
</div>
<div class="row">
    <div class="col-md-12">
        <hr>
    </div>
    
</div>
<table class="table-striped table">
    <tr>
        <td>
            Internal ID
        </td>
        <td>
            Invoice#
        </td>
        <td>
            Amount
        </td>
        <td>
            Details
        </td>
        <td>
             Actions
        </td>
    </tr>


<?php
$InvoiceService = new QuickBooks_IPP_Service_Invoice();

$invoices = $InvoiceService->query($Context, $realm, "SELECT * FROM Invoice STARTPOSITION 1 MAXRESULTS 10");
//$invoices = $InvoiceService->query($Context, $realm, "SELECT * FROM Invoice WHERE DocNumber = '1002' ");

//print_r($customers);

foreach ($invoices as $Invoice)
{
    ?>
    <tr>
        <td>
             <?php echo $Invoice->getId();?>
        </td>
        <td>
             <?php echo $Invoice->getDocNumber();?>
        </td>
        <td>
            $<?php echo $Invoice->getTotalAmt();?>
        </td>
        <td>
            <?php echo $Invoice->getLine(0)->getDescription();?>
        </td>
        <td>
             <a class="btn btn-success btn-sm" href="#">Edit</a>&nbsp;<a class="btn btn-success btn-sm" href="#">Send Email</a>
        </td>
    </tr>
    
<?php 
}
?>
    </table>
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