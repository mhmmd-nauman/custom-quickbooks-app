<?php
require_once dirname(__FILE__) . '/config.php';
require_once dirname(__FILE__) . '/lib/include.php';
$objInvoice = new Invoice();
//$objInvoiceList = new InvoicesList();
$InvoiceService = new QuickBooks_IPP_Service_Invoice();
$CustomerService = new QuickBooks_IPP_Service_Customer();

//$print_supplier_array=array("SuperGraphics","Double L","Top Notch","True Screen");
//$shipement_method_array=array("Print","UPS","CANADA POST","SPOTSHUB","A COASTAL REIGN REPRESENTATIVE");
//$garment_supplier_array=array("Sanmar","Technosport");

$local_invoices = $objInvoice->GetAllInvoices("Visible = 1 order by ShipDate desc",array("*"));

foreach ($local_invoices as $local_Invoice) {
            //  print_r($Invoice);
            //  $live_invoices = $InvoiceService->query($Context, $realm, "SELECT * FROM Invoice WHERE DocNumber = '1012' ");
    $live_invoices = $InvoiceService->query($Context, $realm, "SELECT * FROM Invoice WHERE DocNumber = '".QuickBooks_IPP_IDS::usableIDType($local_Invoice['DocNumber'])."' ");
    $Invoice = $live_invoices[0];
            
//              echo "<pre>";
//              print_r($Invoice);
//              echo "</pre>";
//              echo "<pre>";
//             echo $Invoice->getCustomerRef();
//              echo "</pre>";

    $customers = $CustomerService->query($Context, $realm, "SELECT * FROM Customer WHERE id ='".QuickBooks_IPP_IDS::usableIDType($Invoice->getCustomerRef())."'"); 
    $Customer = $customers[0];

            // echo "<pre>";
            // print_r($Customer);
            // echo "</pre>";

//// Email Address 
        $addr=$Invoice->getBillEmail(0);
        if(isset($addr)) 
        {
           // $PrimaryEmailAddr = $Invoice->getBillEmail(0)->getAddress();
            $BillEmail = $Invoice->getBillEmail();
            $BillEmail->setAddress($local_Invoice['BillEmail']);

            if ($resp = $InvoiceService->update($Context, $realm, $Invoice->getId(), $Invoice))
            { 
                //print('&nbsp; Shipment Email Address of DocNumber '.$local_Invoice['DocNumber'].' Updated!<br>');
             $message="Updated";
            }
            else
            { print('&nbsp; ' . $InvoiceService->lastError() . '<br>');}
        }       
         else 
        {
     //  if(is_object($Customer[0])){
                if(is_object($Customer->getPrimaryEmailAddr(0))){
                   
                //   $email=$Customer[0]->getPrimaryEmailAddr(0)->getAddress();

                $PrimaryEmailAddr = $Customer->getPrimaryEmailAddr();
                $PrimaryEmailAddr->setAddress($local_Invoice['BillEmail']);

               // print('Updating the customer name to: ' . $Customer->getDisplayName() . '<br>');
                if ($CustomerService->update($Context, $realm, $Customer->getId(), $Customer))
                {
                //        print('&nbsp; Primary Email Address of DocNumber '.$local_Invoice['DocNumber'].' Updated!<br>');
                        $message="Updated";
                
                }
                else
                {
                        print('&nbsp; Error: ' . $CustomerService->lastError($Context));
                }
        }
       //}
    }
// ship Date
//            $Invoice->setShipDate(date('Y-m-d', strtotime($local_Invoice['ShipDate']))); // Update the invoice date to today's date 
//            // $ShipDate = $Invoice->getShipDate();
//            if ($resp = $InvoiceService->update($Context, $realm, $Invoice->getId(), $Invoice))
//            {
//                    print('&nbsp; Shipment Date Updated!<br>');
//            }
//            else
//            {
//                    print('&nbsp; ' . $InvoiceService->lastError() . '<br>');
//            }
//        
// ship Address
//        $PrimaryShipAddr = $Customer->getBillAddr(0);
//        $PrimaryShipAddr->setBillAddr($local_Invoice['ship_address']);
//
//        if ($CustomerService->update($Context, $realm, $Customer->getId(), $Customer))
//        {
//                print('&nbsp; Primary Shipment Address Updated!<br>');
//        }
//        else
//        {
//                print('&nbsp; Error: ' . $CustomerService->lastError($Context));
//        }
// Phone Number 
//        $Phone = $Customer->getPrimaryPhone();
//        $Phone->setFreeFormNumber($local_Invoice['PhoneNo']);
//
//        if ($CustomerService->update($Context, $realm, $Customer->getId(), $Customer))
//        {
//                print('&nbsp; PhoneNo Updated!<br>');
//        }
//        else
//        {
//                print('&nbsp; Error: ' . $CustomerService->lastError($Context));
//        }
}

if($message) 
  print('&nbsp; All Email Address Updated!<br>');
?>