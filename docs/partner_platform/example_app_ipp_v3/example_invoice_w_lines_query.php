<?php

require_once dirname(__FILE__) . '/config.php';

require_once dirname(__FILE__) . '/views/header.tpl.php';

?>

<div class="row">
    <div class="col-md-12">
        <h1>Invoices with lines from QB Live Application</h1>
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
$ItemService = new QuickBooks_IPP_Service_Item();

$invoices = $InvoiceService->query($Context, $realm, "SELECT *, Line.* FROM Invoice STARTPOSITION 1 MAXRESULTS 5");

//print_r($customers);

foreach ($invoices as $Invoice)
{
?>
    <tr>
        
        <td>
             <?php echo $Invoice->getDocNumber();?>
        </td>
        <td>
            $<?php echo $Invoice->getTotalAmt();?>
        </td>
        <td>
            <?php echo $Invoice->getLine(0)->getDescription();
            echo "\n";
            $num_lines = $Invoice->countLine(); 		// How many line items are there?
            for ($i = 0; $i < $num_lines; $i++)
            {
                    $Line = $Invoice->getLine(0);

                    // Let's find out what item this uses
                    if ($Line->getDetailType() == 'SalesItemLineDetail')
                    {
                            $Detail = $Line->getSalesItemLineDetail();

                            $item_id = $Detail->getItemRef();

                            print('Item id is: ' . $item_id . "\n");

                            $items = $ItemService->query($Context, $realm, "SELECT * FROM Item WHERE Id = '" . QuickBooks_IPP_IDS::usableIDType($item_id) . "' ");
                            print('   That item is named: ' . $items[0]->getName() . "\n");
                    }
            }
            
            ?>
            
        </td>
        <td>
             <a class="btn btn-success btn-sm" href="#">Edit</a>&nbsp;<a class="btn btn-success btn-sm" href="#">Send Email</a>
        </td>
    </tr>
    <?php
    

	//print("\n\n\n");
}

/*
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