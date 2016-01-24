<?php  
    class Invoice extends util {
	
        
        function GetAllInvoices($strWhere,$fieldaArray=array("*")){
            global $link;
            reset($fieldaArray);
            $strFields="";
            foreach ($fieldaArray as $field){
                $strFields .=  "".$field . " ,";
            } 
            $arr=array();
            //remove the last comma
            $strFields = substr($strFields, 0, strlen($strFields) - 1);	
            $sql="SELECT $strFields FROM invoices  " . " WHERE $strWhere " ;
            $result=mysqli_query($link,$sql) ;
            while($row=mysqli_fetch_array($result)){
                $arr[] = $row;
            }
            //log_error($encoded_query);
            return $arr; 
        }
	
	function UpdateInvoice($where,$array){
            if($array){
                $updated_id = util::updateRecord("invoices",$where,$array);
                return $updated_id;
            } else {
                return 0;
            }
	}	
	
        function InsertInvoice($array){
            if($array){
                $inserted_id = util::insertRecord("invoices",$array);
                return $inserted_id;
            } else {
                return 0;
            }
	}
	
        function DeleteInvoice($ID){
            if($ID){
                    $deleted_id = util::deleteRecord("invoices","DocNumber = $ID");
                    return $deleted_id;
            } else {
                    return 0;
            }
        }
               
		
}
 
?>