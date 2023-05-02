<?php 
  
  $all_brands = get_all_brands ( con : $conn );
  


?>
<!-- Modal here -->

<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
 <div class="modal-dialog modal-dialog-centered">
   <div class="modal-content">
     <div class="modal-header">
       <h1 class="modal-title fs-5" id="exampleModalLabel">Brand Edition</h1>
       <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
     </div>
     <div class="modal-body">
     <form action="/controllers/admin_controller.php?do=edit_brand" method="post" enctype="multipart/form-data">
         
         <input type="text" name="id_bra" id="id_bra_inp" readonly hidden>
         <label for="des_bra"> Brand Name : </label>
         <input type="text" name="des_bra" id="des_bra_inp" class="form-control" required>
         
         <label for="country"> Country : </label>
         <select name="country" id="country_inp" class="form-control" required>

           <?php
               foreach ( COUNTRIES as $country ) {
                 echo '<option value="'.$country.'" >'.$country.'</option>';
               }
            
           ?>
         </select>

         <label for="img_bra"> Brand Logo : </label>
         <input type="file" accept="image/*" name="img_bra" id="img_bra"  class="form-control">
         
         <br>
         <input type="submit" class="btn btn-primary form-control" value="Edit Brand">
     </div>
     <div class="modal-footer">
       <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    
     </div>
   </div>
 </div>
</div>
<!-- End Modal here -->


<div class="adm_add_brand_container">
 <h2 align="center"> Edit Brands </h2><br>

 
 <?php 
       if ( isset($_GET['edt_bra_state'])){
         $edt_bra_state = $_GET['edt_bra_state']; 
         switch ($edt_bra_state) {
            case 1:
                echo '<div class="alert alert-success"><i class="fa-solid fa-check"></i> Brand Modified successfully </div>';
                break;
            
            default:
                # code...
                break;
         }
       }
 
     ?>

 <?php 
      if ( isset($_GET['edt_cat_state'])){
        $edt_cat_state = $_GET['edt_cat_state']; 
        switch ($edt_cat_state) {
           case 1:
               echo '<div class="alert alert-success"><i class="fa-solid fa-check"></i> Category Modified successfully </div>';
               break;
           
           default:
               # code...
               break;
        }
      }

    ?>

 <div class="row">

  <?php 
     foreach ($all_brands as $ab ){ 
       ?>
         <div class="col-sm-3">
            <div class="card" style="width: 18rem;">
             <img style="height: 250px;object-fit:contain" src="../images/brand_img/<?php echo $ab['bra_img']; ?>" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title"><?php echo $ab['des_bra']; ?></h5>
                <p class="card-text"> <b>Country : </b> <?php echo $ab['country']; ?> </p>
                <a href="#" class="btn btn-primary bra_edt_btn" data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-primary" data-des-bra="<?php  echo $ab['id_bra'].'/'.$ab['des_bra'].'/'.$ab['country']; ?>"><i class="fa-regular fa-pen-to-square"></i> Edit Brand </a>
              </div>
           </div>
        </div>
       <?php 
         

     }
  
  ?>
  
  
 </div>
             


</div>


<script> 

       $('.bra_edt_btn').on('click' , (e)=> {

           let bra_data =  e.currentTarget.getAttribute('data-des-bra').split('/');
           console.log(bra_data);
           $('#id_bra_inp').val( bra_data[0] );
           $('#des_bra_inp').val( bra_data[1] );
           $('#country_inp').val( bra_data[2] );
          
               

        });
    
      
 

</script>