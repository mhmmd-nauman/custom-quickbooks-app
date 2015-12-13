<?php
require_once dirname(__FILE__) . '/config.php';
$InvoiceService = new QuickBooks_IPP_Service_Invoice();
//print_r($_REQUEST);
$invoices = $InvoiceService->query($Context, $realm, "SELECT * FROM Invoice WHERE Id = '".$_REQUEST['InvoiceId']."' ");
$Invoice = $invoices[0];
//print_r($Invoice);
//exit;
switch($_REQUEST['FieldName']){
    case"ship_date":
        //print_r($_REQUEST);
        $Invoice->setShipDate(date('Y-m-d',strtotime($_REQUEST['Data'])));
        //exit;
        if ($resp = $InvoiceService->update($Context, $realm, $Invoice->getId(), $Invoice))
        {
                print('&nbsp; Updated!<br>');
        }
        else
        {
                print('&nbsp; ' . $InvoiceService->lastError() . '<br>');
        }
        break;
    case"email":
        //print_r($_REQUEST);
        $CustomerService = new QuickBooks_IPP_Service_Customer();
        $customers = $CustomerService->query($Context, $realm, "SELECT * FROM Customer WHERE id ='".QuickBooks_IPP_IDS::usableIDType($Invoice->getCustomerRef())."'"); 
        $Customer = $customers[0];
        //print_r($Customer);
        //exit;
        $PrimaryEmailAddr = $Customer->getPrimaryEmailAddr();
        $PrimaryEmailAddr->setAddress($_REQUEST['Data']);
        print('Updating the customer name to: ' . $Customer->getDisplayName() . '<br>');
        if ($CustomerService->update($Context, $realm, $Customer->getId(), $Customer))
        {
                print('&nbsp; Updated!<br>');
        }
        else
        {
                print('&nbsp; Error: ' . $CustomerService->lastError($Context));
        }
        exit;
        break;
    case"shipping_method":
        //print_r($_REQUEST);
        $CustomerService = new QuickBooks_IPP_Service_Customer();
        $customers = $CustomerService->query($Context, $realm, "SELECT * FROM Customer WHERE id ='".QuickBooks_IPP_IDS::usableIDType($Invoice->getCustomerRef())."'"); 
        $Customer = $customers[0];        
        //$DeliveryMethod = $Customer->getDeliveryMethod();
        //$DeliveryMethod->setDeliveryMethod($_REQUEST['Data']);        
        //print_r($Customer);
        //exit;
        $Customer->setDeliveryMethod($_REQUEST['Data']);
        if ($CustomerService->update($Context, $realm, $Customer->getId(), $Customer))
        {
                print('&nbsp; Updated!<br>');
        }
        else
        {
                print('&nbsp; Error: ' . $CustomerService->lastError($Context));
        }
        break;
    default:
            
}
exit;
//$Invoice->setShipMethod($_REQUEST['Data']);


if ($resp = $InvoiceService->update($Context, $realm, $Invoice->getId(), $Invoice))
{
	print('&nbsp; Updated!<br>');
}
else
{
	print('&nbsp; ' . $InvoiceService->lastError() . '<br>');
}

?>