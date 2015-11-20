<?php

require_once dirname(__FILE__) . '/config.php';

require_once dirname(__FILE__) . '/views/header.tpl.php';

?>

<div class="row">
    <div class="col-md-12">
        <h1>Payments from QB Live Application</h1>
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
            RefNum
        </td>
        <td>
            Amount
        </td>
        
        <td>
             Actions
        </td>
    </tr>

<?php

$PaymentService = new QuickBooks_IPP_Service_Payment();

$list = $PaymentService->query($Context, $realm, "SELECT * FROM Payment STARTPOSITION 1 MAXRESULTS 10");

//print_r($salesreceipts);

foreach ($list as $Payment)
{
	//print('Payment # ' . $Payment->getPaymentRefNum() . ' has a total of $' . $Payment->getTotalAmt() . "\n");
	//print('   Internal Id: ' . $Payment->getId() . "\n");
	//print("\n");
    
?>
    <tr>
        <td>
             <?php echo $Payment->getPaymentRefNum();?>
        </td>
        <td>
             $<?php echo $Payment->getTotalAmt();?>
        </td>
        
        
        <td class="col-md-2 pull-right">
             <a class="btn btn-success btn-sm" href="#">Edit</a>&nbsp;<a class="btn btn-success btn-sm" href="#">Delete</a>
        </td>
    </tr>
    <?php
}

/*
print($IPP->lastError());

print("\n\n\n\n");
print('Request [' . $IPP->lastRequest() . ']');
print("\n\n\n\n");
print('Response [' . $IPP->lastResponse() . ']');
print("\n\n\n\n");
*/

?>
</table>

<?php

require_once dirname(__FILE__) . '/views/footer.tpl.php';

?>