<?php

require_once dirname(__FILE__) . '/config.php';

require_once dirname(__FILE__) . '/views/header.tpl.php';

?>

<div class="row">
    <div class="col-md-12">
        <h1>Customers from QB Live Application</h1>
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

$CustomerService = new QuickBooks_IPP_Service_Customer();

$customers = $CustomerService->query($Context, $realm, "SELECT * FROM Customer MAXRESULTS 25");

foreach ($customers as $Customer)
{ ?>
     <tr>
        <td>
             <?php echo $Customer->getId();?>
        </td>
        <td>
             <?php echo $Customer->getFullyQualifiedName();?>
        </td>
        
        
        <td class="col-md-2 pull-right">
             <a class="btn btn-success btn-sm" href="#">Edit</a>&nbsp;<a class="btn btn-success btn-sm" href="#">Send Email</a>
        </td>
    </tr>
    <?php
	//print('Customer Id=' . $Customer->getId() . ' is named: ' . $Customer->getFullyQualifiedName() . '<br>');
}

/*
print("\n\n\n\n");
print('Request [' . $CustomerService->lastRequest() . ']');
print("\n\n\n\n");
print('Response [' . $CustomerService->lastResponse() . ']');
print("\n\n\n\n");
print('Error [' . $CustomerService->lastError() . ']');
print("\n\n\n\n");
*/	

?>

</table>

<?php

require_once dirname(__FILE__) . '/views/footer.tpl.php';

?>