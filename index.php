<?php 
 require './views/header.php';
 require './views/navbar.php';

 require './functions/db_connector.php';
 require './functions/brand_funcs.php';
 require './functions/category_funcs.php';
 require './functions/prod_funcs.php';

 $conn = get_conn();
?>
 
  <div class="shop_container">
     
     <?php 
        if (isset($_GET['do']) && !empty($_GET['do']) ){

           $do = $_GET['do'];
            
           switch ($do) {
              case 'products':
                include_once './views/products.php';
              break;

             case 'about':
                include_once './views/about.php';
             break;
            
            default:
              # code...
              break;
           }
           
        }else{
          include_once './views/home.php';
        }

     ?>


  </div>


<?php
 require './views/footer.php';
?>