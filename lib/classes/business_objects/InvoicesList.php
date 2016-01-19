<?php  
    class InvoicesList extends util {
	
        
        function GetAllInvoicesList($strWhere,$fieldaArray=array("*")){
            global $link;
            reset($fieldaArray);
            $strFields="";
            foreach ($fieldaArray as $field){
                $strFields .=  "".$field . " ,";
            } 
            //remove the last comma
            $strFields = substr($strFields, 0, strlen($strFields) - 1);	
            $sql="SELECT $strFields FROM invoiceslist  " . " WHERE $strWhere " ;
            $result=mysqli_query($link,$sql) ;
            while($row=mysqli_fetch_array($result)){
                $arr[] = $row;
            }
            //log_error($encoded_query);
            return $arr; 
        }
	
	function UpdateInvoiceList($where,$array){
            if($array){
                $updated_id = util::updateRecord("invoiceslist",$where,$array);
                return $updated_id;
            } else {
                return 0;
            }
	}	
	
        function InsertInvoiceList($array){
            if($array){
                $inserted_id = util::insertRecord("invoiceslist",$array);
                return $inserted_id;
            } else {
                return 0;
            }
	}
	
        function DeleteInvoiceList($ID){
            if($ID){
                    $deleted_id = util::deleteRecord("invoiceslist","DocNumber = $ID");
                    return $deleted_id;
            } else {
                    return 0;
            }
        }
               
		
}
 
?>