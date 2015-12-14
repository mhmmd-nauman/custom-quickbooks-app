<?php
require_once dirname(__FILE__) . '/config.php';
require_once dirname(__FILE__) . '/lib/include.php';
$objInvoice = new Invoice();

//print_r($_REQUEST);
//exit;
//$invoices = $InvoiceService->query($Context, $realm, "SELECT * FROM Invoice WHERE Id = '".$_REQUEST['InvoiceId']."' ");
//$Invoice = $invoices[0];
//print_r($Invoice);
//exit;
switch($_REQUEST['FieldName']){
    case"tracking_no":
        $objInvoice->UpdateInvoice("Id = ".$_REQUEST['InvoiceId'], array("tracking_no"=>$_REQUEST['Data']));
        print('&nbsp; Updated!<br>');
        break;
    case"PhoneNo":
        $objInvoice->UpdateInvoice("Id = ".$_REQUEST['InvoiceId'], array("PhoneNo"=>$_REQUEST['Data']));
        print('&nbsp; Updated!<br>');
        break;
    case"ship_address":
        $objInvoice->UpdateInvoice("Id = ".$_REQUEST['InvoiceId'], array("ship_address"=>$_REQUEST['Data']));
        print('&nbsp; Updated!<br>');
        break;
    case"blank_garment_supplier":
        $objInvoice->UpdateInvoice("Id = ".$_REQUEST['InvoiceId'], array("blank_garment_supplier"=>$_REQUEST['Data']));
        print('&nbsp; Updated!<br>');
        break;
    case"PrintSupplier2":
        $objInvoice->UpdateInvoice("Id = ".$_REQUEST['InvoiceId'], array("PrintSupplier2"=>$_REQUEST['Data']));
        print('&nbsp; Updated!<br>');
        break;
    case"print_supplier":
        $objInvoice->UpdateInvoice("Id = ".$_REQUEST['InvoiceId'], array("PrintSupplier"=>$_REQUEST['Data']));
        print('&nbsp; Updated!<br>');
        break;
    case"tract_date":
        $objInvoice->UpdateInvoice("Id = ".$_REQUEST['InvoiceId'], array("TxnDate"=>date('Y-m-d',strtotime($_REQUEST['Data']))));
        print('&nbsp; Updated!<br>');
        break;
    case"hide_button":
        //print_r($_REQUEST);
        //exit;
        $objInvoice->UpdateInvoice("Id = ".$_REQUEST['InvoiceId'], array("Visible"=>0));
        print('&nbsp; Updated!<br>');
        break;
    case"ship_date":
        //print_r($_REQUEST);
        
        $objInvoice->UpdateInvoice("Id = ".$_REQUEST['InvoiceId'], array("ShipDate"=>date('Y-m-d',strtotime($_REQUEST['Data']))));
        print('&nbsp; Updated!<br>');
        
        break;
    case"shipping_method":
        $objInvoice->UpdateInvoice("Id = ".$_REQUEST['InvoiceId'], array("CustomerPreferredDeliveryMethod"=>$_REQUEST['Data']));
        print('&nbsp; Updated!<br>');
        break;
    case"email":
        //print_r($_REQUEST);
        $objInvoice->UpdateInvoice("Id = ".$_REQUEST['InvoiceId'], array("BillEmail"=>$_REQUEST['Data']));
        
        print('&nbsp; Updated!<br>');
        
        exit;
        break;
    case"shipping_method1":
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