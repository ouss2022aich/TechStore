<?php 

 
 

  require '../functions/global_vars.php';
  

   function is_adm_connected () : bool {
     return isset( $_SESSION['adm_email'] ) && !empty( $_SESSION['adm_email']) ;
   }

   function check_admin_login ( string $email , string $pass ) : bool {
     
      if ( $email == ADMIN_EMAIL && $pass == ADMIN_PASSWORD ){ 
        
        $_SESSION['adm_email'] = $email;
        return true;

      }else{

        return false;

      }

   }

   function disconnect_admin(){
     session_unset();
     session_destroy();
   }

   function generateRandomString($length = 15) {
    return bin2hex(openssl_random_pseudo_bytes(10));
   }

   function upload_img( array $file , $dest )   {
                                  
        $tmp = $file['tmp_name'];
        $fname = $file['name'];
        $file_ext =  explode('.',$fname);
        $file_ext = strtolower(end($file_ext));

        $extensions= array("jpeg","jpg","png");
        
        if (  in_array( $file_ext , $extensions ) && file_exists($tmp) ){
         // not an image 
         $final_fname =  generateRandomString($fname . time());
         $final_filepath = $dest.$final_fname;
         try {
   
          move_uploaded_file( $tmp , $final_filepath );
          return $final_fname ;
         }catch(Exception $e){
           return 0;
         }
       

        }else{
          return 0;
        }
   }


?>