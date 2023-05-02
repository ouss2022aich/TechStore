<?php 

 session_start();

 
  include_once '../functions/admin.php';
  include_once '../functions/global_vars.php';


  include_once '../functions/db_connector.php';
  include_once '../functions/category_funcs.php';
  include_once '../functions/brand_funcs.php';
  include_once '../functions/prod_funcs.php';

  
 
  if  (   is_adm_connected()  ){

     $conn = get_conn();
   
     if ( isset($_GET['do']) && !empty($_GET['do'])){
       
        $do = $_GET['do'];
      
        if ( $do == 'disconnect' ){
           disconnect_admin();
           header( 'Location:../admin/index.php');
        }elseif ($do == 'add_cat'){

            $des_cat = $_POST['des_cat'];
            $id_par_cat = !empty($_POST['par_cat'])  ? $_POST['par_cat'] : NULL ;

            $cat_state = add_cat( con : $conn , des_cat: $des_cat , id_par_cat: $id_par_cat );

            header('Location:../admin/index.php?do=add_cat&cat_state='.$cat_state);



        }elseif ( $do == 'edit_cat' ){
         
             $id_cat = $_POST['id_cat'];
             $des_cat = $_POST['des_cat'];
             $id_par_cat = !empty($_POST['par_cat']) ? $_POST['par_cat'] : NULL;


             $edt_cat_state = edit_cat( con : $conn , id_cat : $id_cat ,des_cat : $des_cat , id_par_cat : $id_par_cat);
             header('Location:../admin/index.php?do=edit_cat&edt_cat_state='.$edt_cat_state);

          

        }elseif(  $do == 'add_brand' ){
             
         
               $des_brand = $_POST['des_brand'];
               $country = $_POST['country'];
               $bra_img = $_FILES['img_bra'];
                  
               $add_bra_state = add_brand( con : $conn , des_bra: $des_brand , country: $country , bra_img: $bra_img);
       
               header('Location:../admin/index.php?do=add_brand&add_bra_state='.$add_bra_state);
              
        }elseif ( $do == 'edit_brand'){

         
          $id_bra = $_POST['id_bra'];
          $des_bra = $_POST['des_bra'];
          $country = $_POST['country'];
          $file_state = $_FILES['img_bra']['error'];
          $bra_img = $file_state == 0 ? $_FILES['img_bra'] : NULL ;
        
         $edt_bra_state = edit_brand( con : $conn , id_bra : $id_bra , des_bra: $des_bra , country: $country , bra_img: $bra_img);
         header('Location:../admin/index.php?do=edit_brand&edt_bra_state='.$edt_bra_state);

        }elseif( $do == 'add_prod' ){
     

         $des_prod = $_POST['prod_name'];
         $price_prod = $_POST['prod_price'];
         $desc_prod = $_POST['desc_prod'];
         $qte_prod = $_POST['qte_prod'];
         $cat_prod = $_POST['cat_prod'];
         $bra_prod = $_POST['bra_prod'];
         $prod_clrs = $_POST['img_color'];
         $prod_imgs = $_FILES['img_file'];
          
        


         $add_prod_state = add_product (  con : $conn ,
                        des_prod : $des_prod ,
                        price_prod  : $price_prod ,
                        discount_prod : 0  ,
                        desc_prod : $desc_prod , 
                        qte_prod : $qte_prod ,
                        cat_prod : $cat_prod ,
                        bra_prod : $bra_prod ,
                        prod_imgs : $prod_imgs ,
                        prod_clrs :  $prod_clrs 
                     );

         header('Location:../admin/index.php?do=add_prod&add_prod_state='.$add_prod_state);            

     
        }elseif ($do == 'edit_prod'){
         
         $id_prod = $_POST['id_prod'];
         $des_prod = $_POST['des_prod'];
         $desc_prod = $_POST['desc_prod'];
         $price_prod = $_POST['price_prod'];
         $qte_prod = $_POST['qte_prod'];
         $discount_prod = $_POST['discount_prod'];

         $edt_prod_state = edit_product( con : $conn , 
                                         id_prod : $id_prod ,
                                         des_prod : $des_prod ,
                                         desc_prod : $desc_prod ,
                                         price_prod : $price_prod ,
                                         qte_prod : $qte_prod ,
                                         discount_prod : $discount_prod 
                                       );

         header('Location:../admin/index.php?do=edit_prod&edt_prod_state='.$edt_prod_state);                                  

        }

     }
      
     


  }else{
   
    if ( $_SERVER['REQUEST_METHOD'] == 'POST' ){
       // get methods 
     
       if ( isset($_GET['do'])  && $_GET['do'] == 'login' ){
         // check login 
     
         $email = $_POST['adm_email'];
         $pass = $_POST['adm_pass'];

      
         
         $login_state = (int)check_admin_login( $email , $pass );
      
         header( 'Location:../admin/index.php?login_state='.$login_state );
         exit();
       }

       

    }


    header('Location : ../admin/index.php');
  }

 

?>