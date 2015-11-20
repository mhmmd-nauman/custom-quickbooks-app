<?php

require_once dirname(__FILE__) . '/config.php';

require_once dirname(__FILE__) . '/views/header.tpl.php';

?>

<div class="row">
    <div class="col-md-12">
        <h1>Items from QB Live Application</h1>
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
            ID
        </td>
        <td>
            Name
        </td>
        
        <td>
             Actions
        </td>
    </tr>

<?php

$ItemService = new QuickBooks_IPP_Service_Term();

$items = $ItemService->query($Context, $realm, "SELECT * FROM Item WHERE Metadata.LastUpdatedTime > '2013-01-01T14:50:22-08:00' ORDER BY Metadata.LastUpdatedTime ");

foreach ($items as $Item)
{
	?>
     <tr>
        <td>
             <?php echo $Item->getId();?>
        </td>
        <td>
             <?php echo $Item->getName();?>
        </td>
        
        
        <td class="col-md-2 pull-right">
             <a class="btn btn-success btn-sm" href="#">Edit</a>&nbsp;<a class="btn btn-success btn-sm" href="#">Delete</a>
        </td>
    </tr>
    <?php

	//print('Item Id=' . $Item->getId() . ' is named: ' . $Item->getName() . '<br>');
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