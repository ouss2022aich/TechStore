
<?php 
 
    $root_cats = get_root_categories( $conn );
    


?>
<div class="adm_add_brand_container">

     <h2 align="center"> Add a Category </h2>
     
     <?php 
       if ( isset($_GET['cat_state'])){
         $cat_state = $_GET['cat_state']; 
         switch ($cat_state) {
            case 1:
                echo '<div class="alert alert-success"><i class="fa-solid fa-check"></i> Category added successfully </div>';
                break;
            
            default:
                # code...
                break;
         }
       }
 
     ?>

      <form action="/controllers/admin_controller.php?do=add_cat" method="post">
         
          <label for="des_cat"> Category Name :  </label>
          <input type="text" class="form-control" name="des_cat" id="des_cat">
          
          <label for="des_cat"> Catégorie Parent :  </label>
          <div class="alert alert-info"><i class="fa-solid fa-circle-exclamation"></i> leave this empty if it's a primary category </div>
          <select class="form-select" name="par_cat" id="">
               <option value=""> None </option>
               <?php 
                  foreach ($root_cats as $rc ) {  
                     echo '<option value="'.$rc['id_cat'].'"> '.$rc['des_cat'].' </option>';
                  }
               ?>
          </select>
          <br>
          <input type="submit" value="Add the category" class="form-control btn btn-primary">

      </form>
 


</div>