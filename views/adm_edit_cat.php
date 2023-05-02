
<?php 
  
   $all_cats = get_all_categories ( $conn );
   $root_cats = get_root_categories( $conn );


?>
<!-- Modal here -->

<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Category Edition</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
         <form action="/controllers/admin_controller.php?do=edit_cat" method="post">
           <input id="id_cat_inp"  type="text" name="id_cat" readonly hidden>
           <label for="des_cat"> Category Name :  </label>
           <input id="des_cat_inp" type="text" class="form-control" name="des_cat" id="des_cat">
         
           <label for="des_cat"> Catégorie Parent :  </label>
           <div class="alert alert-info"><i class="fa-solid fa-circle-exclamation"></i> leave this empty if it's a primary category </div>
           <select  class="form-select" name="par_cat" id="id_par_cat_inp">
              <option value="0" default selected> None </option>
              <?php 
                 foreach ($root_cats as $rc ) {  
                    echo '<option value="'.$rc['id_cat'].'"> '.$rc['des_cat'].' </option>';
                 }
              ?>
           </select>
           <br>
           <input type="submit" value="Edit Category" class="form-control btn btn-primary">

         </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
     
      </div>
    </div>
  </div>
</div>
<!-- End Modal here -->


<div class="adm_add_brand_container">
  <h2 align="center"> Edit Categories </h2><br>

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
      foreach ($all_cats as $ac ){ 
        ?>
          <div class="col-sm-4">
           <div class="card" style="margin :5px 0">
             <div class="card-body">
             <h5 class="card-title" > <?php  echo $ac['des_cat']; ?> </h5>
             <p class="card-text" > <span> Has parent category :
                 <?php echo ( !empty($ac['id_par_cat']) ?  $ac['des_par_cat'] :  '/' );  ?> </span> </p>
             <a href="#" class="btn btn-primary cat_edt_btn" data-bs-toggle="modal" data-bs-target="#exampleModal" data-des-cat="<?php  echo $ac['id_cat'].'/'.$ac['des_cat'].'/'.$ac['id_par_cat']; ?>"><i class="fa-regular fa-pen-to-square"></i> Edit Category </a>
          </div>
          </div>
         </div>
        <?php 
          

      }
   
   ?>
   
   
  </div>
              


</div>


<script> 

        $('.cat_edt_btn').on('click' , (e)=> {

            let cat_data =  e.currentTarget.getAttribute('data-des-cat').split('/');
            console.log(cat_data);
            $('#des_cat_inp').val( cat_data[1] );
            $('#id_cat_inp').val( cat_data[0] );

            if ( cat_data[2] != '' ){
                $('#id_par_cat_inp').val( cat_data[2] );
            }else{
              $('#id_par_cat_inp').val( 0 );
            }
                

         });
     
       
  

</script>