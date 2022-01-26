<?php
class helpers {
    function Clean($input){

        return  trim(strip_tags(stripslashes($input)));
   }
   
   
     function Validate($input,$flag){
   
       $status = true;
   
        switch ($flag) {
            case 1:
                # code...
                if (empty($input)) {
                   $status = false;
                }
                break;
         
           
   
           case 2: 
              #code .... 
              if (strlen($input) < 50){
                  $status = false;
              }  
              break;
    
   
           case 3: 
            # code .... 
            if (!filter_var($input, FILTER_VALIDATE_INT)){
               $status = false;
            } 
             break;    
   
   
             case 4: 
                # Code ....
                $allowedExt = ['png','jpg']; 
                     if(!in_array($input,$allowedExt)){
                        $status = false;
                     }
                break;

             case 5: 
                  #code .... 
                  if(!preg_match('/^[a-zA-Z\s]*$/',$input)){
                     $status = false;
                  }
                  break;  
   
        }
   
        return $status;
   
     }
   
   
   
      function Errors($errors){
       foreach ($errors as $key => $value) {
               # code...
               echo '* ' . $key . ' : ' . $value . '<br>';
           }
   
      }
   
   
   
   
}
?>