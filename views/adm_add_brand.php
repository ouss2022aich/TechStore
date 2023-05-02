<div class="adm_add_brand_container">

     <h2 align="center"> Add a brand </h2>

     
  <?php 
       if ( isset($_GET['add_bra_state'])){
         $add_bra_state = $_GET['add_bra_state']; 
         switch ($add_bra_state) {
            case 1:
                echo '<div class="alert alert-success"><i class="fa-solid fa-check"></i> Brand added successfully </div>';
                break;
            
            default:
                # code...
                break;
         }
       }
 
     ?>

     <form action="/controllers/admin_controller.php?do=add_brand" method="post" enctype="multipart/form-data">
         
         <label for="des_bra"> Brand Name : </label>
         <input type="text" name="des_brand" id="des_bra" class="form-control" required>
         
         <label for="country"> Country : </label>
         <select name="country" id="country" class="form-control" required>

           <?php
               foreach ( COUNTRIES as $country ) {
                 echo '<option value="'.$country.'" >'.$country.'</option>';
               }
            
           ?>
         </select>

         <label for="img_bra"> Brand Logo : </label>
         <input type="file" accept="image/*" name="img_bra" id="img_bra" required class="form-control">
         
         <br>
         <input type="submit" class="btn btn-primary form-control" value="Add Brand">
        
        


     </form>
 


</div>