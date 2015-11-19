<?php  
    class Customer extends util {
	
        
        function GetAllCustomers($strWhere,$fieldaArray=""){
            global $link;
            reset($fieldaArray);
            foreach ($fieldaArray as $field){
                $strFields .=  "".$field . " ,";
            } 
            //remove the last comma
            $strFields = substr($strFields, 0, strlen($strFields) - 1);	
            $sql="SELECT $strFields FROM customers  " . " WHERE $strWhere " ;
            $result=mysqli_query($link,$sql) ;
            while($row=mysqli_fetch_array($result)){
                $arr[] = $row;
            }
            //log_error($encoded_query);
            return $arr; 
        }
	
	function UpdateCustomer($where,$array){
            if($array){
                $updated_id = util::updateRecord("customers",$where,$array);
                return $updated_id;
            } else {
                return 0;
            }
	}	
	
        function InsertCustomer($array){
            if($array){
                $inserted_id = util::insertRecord("customers",$array);
                return $inserted_id;
            } else {
                return 0;
            }
	}
	
        function DeleteCustomer($ID){
            if($ID){
                    $deleted_id = util::deleteRecord("customers","emp_id = $ID");
                    return $deleted_id;
            } else {
                    return 0;
            }
        }
               
		
}
 
?>