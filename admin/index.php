<?php 

  session_start();


  include_once '../functions/admin.php';


  include_once '../functions/db_connector.php';
  include_once '../functions/category_funcs.php';
  include_once '../functions/brand_funcs.php';
  include_once '../functions/prod_funcs.php';

  $conn = get_conn();
  

  include_once $_SERVER['DOCUMENT_ROOT'].'/views/header.php';
  include_once '../views/admin_navbar.php';



 
  if (is_adm_connected()){

   ?> 
   
    <div class="adm_container">

      <section class="adm_sidebar " id="adm_sidebar" style="z-index:99">
      <div class="accordion" id="accordionExample">
  <div class="accordion-item">
    <h2 class="accordion-header" id="headingOne">
      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
      <i class="fa-regular fa-copyright"></i>
        <span style="width:100%;text-align:center"> Brands </span>  
      </button>
    </h2>
    <div id="collapseOne" class="accordion-collapse collapse " aria-labelledby="headingOne" data-bs-parent="#accordionExample">
      <div class="accordion-body adm_sidebar_list_it">
          <ul class="adm_sidebar_list">
             <li class="adm_sidebar_sub_cat"><a href="?do=add_brand"><i class="fa-sharp fa-solid fa-plus"></i> Add Brand </a></li>
             <li class="adm_sidebar_sub_cat" ><a href="?do=edit_brand"><i class="fa-regular fa-pen-to-square"></i> Edit Brand </a></li>
          </ul>
      </div>
    </div>
  </div>

  <div class="accordion-item">
    <h2 class="accordion-header" id="headingTwo">
      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseOne">
      <i class="fa-solid fa-code-branch"></i>
        <span style="width:100%;text-align:center"> Categories </span>  
      </button>
    </h2>
    <div id="collapseTwo" class="accordion-collapse collapse " aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
      <div class="accordion-body adm_sidebar_list_it">
          <ul class="adm_sidebar_list">
             <li class="adm_sidebar_sub_cat"><a href="?do=add_cat"><i class="fa-sharp fa-solid fa-plus"></i> Add Category </a></li>
             <li class="adm_sidebar_sub_cat" ><a href="?do=edit_cat" ><i class="fa-regular fa-pen-to-square"></i> Edit Category </a></li>
          </ul>
      </div>
    </div>
  </div>

  <div class="accordion-item">
    <h2 class="accordion-header" id="headingThree">
      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="true" aria-controls="collapseOne">
        <i class="fa-solid fa-box-archive"></i> 
        <span style="width:100%;text-align:center"> Products </span>  
      </button>
    </h2>
    <div id="collapseThree" class="accordion-collapse collapse " aria-labelledby="headingThree" data-bs-parent="#accordionExample">
      <div class="accordion-body adm_sidebar_list_it">
          <ul class="adm_sidebar_list">
             <li class="adm_sidebar_sub_cat"><a href="?do=add_prod"><i class="fa-sharp fa-solid fa-plus"></i> Add Product </a></li>
             <li class="adm_sidebar_sub_cat" ><a href="?do=edit_prod"><i class="fa-regular fa-pen-to-square"></i> Edit Product </a></li>
          </ul>
      </div>
    </div>
  </div>
  
  
</div>


      </section>
  
      <section class="adm_content">
            
          <?php 
             
              if ( !isset($_GET['do'])  ){

                 echo "<div align='center'><h1 > Bienvenue sur l'interface admin !! <br>
                 <i class='fa-regular fa-hand fa-shake' ></i> </h1>
                 </div>";

              }else{
                 $do = $_GET['do'];

                 switch ($do) {
                    case 'add_cat':
                     require '../views/adm_add_cat.php';
                    break;

                    case 'edit_cat':
                      require '../views/adm_edit_cat.php';
                     break;

                    case 'add_brand':
                      require '../views/adm_add_brand.php';
                    break;
                    
                    case 'edit_brand':
                      require '../views/adm_edit_brand.php';
                    break;

                    case 'add_prod':
                      require '../views/adm_add_prod.php';
                    break;

                    case 'edit_prod':
                      require '../views/adm_edit_prod.php';
                    break;
                  
                  default:
                       require 'index.php';
                    break;
                 }

              }

          ?>
           
      </section>

    </div>
 <?php

          
     
  }else{
    // login required
    require '../views/adm_login.php';

  }

  
  require '../views/adm_footer.php';


?>