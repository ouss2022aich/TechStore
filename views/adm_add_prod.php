<?php 

     $leaf_cats = get_leaf_categories($conn);
     $all_brands = get_all_brands($conn);
 

?>

<div class="adm_add_prod_container">

  <h2 align="center"> Add A Product </h2>

  <?php 
       if ( isset($_GET['add_prod_state'])){
         $add_prod_state = $_GET['add_prod_state']; 
         switch ($add_prod_state) {
            case 1:
                echo '<div class="alert alert-success"><i class="fa-solid fa-check"></i> Product added successfully </div>';
                break;
            
            default:
                # code...
                break;
         }
       }
 
     ?>

  <form action="/controllers/admin_controller.php?do=add_prod" method="post" enctype="multipart/form-data">

    <label for="prod_name">Product Name : </label>
    <input class="form-control" type="text" name="prod_name" id="prod_name" required>

    <label for="desc_prod"> Description </label>
    <textarea class="form-control" id="desc_prod" name="desc_prod" id=""  placeholder="describe the product ..." required>

    </textarea>

    <label for="prod_price">Product Price : </label>
    <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text" id="inputGroupPrepend"> DZD </span>
        </div>
        <input required class="form-control" maxlength="10" type="text" name="prod_price" id="currency-field" pattern="^\d{1,3}(,\d{3})*(\.\d+)?$" value="" data-type="currency" placeholder="1,000.00">
    </div>


    <label for="qte_prod">Quantity : </label>
    <input class="form-control" type="number" value="1" id="qte_prod" name="qte_prod">

    <label for="cat_prod"> Category : </label>
    <select required name="cat_prod" class="form-select" id="cat_prod">
            
           <?php 
              foreach ($leaf_cats as $lc ) {
                
               echo '<option value="'.$lc['id_cat'].'">'.$lc['des_cat'].'</option>';  

              }
           ?>
         
    </select>

    <label for="bra_prod"> Brand : </label>
    <select required name="bra_prod" class="form-select" id="bra_prod">  
            <?php 
               foreach ($all_brands as $ab ) { 
                echo '<option value="'.$ab['id_bra'].'">'.$ab['des_bra'].'</option>';  
               }
            ?>  
     </select>

     

     <div id="add_prod_img_btn" style="margin: 16px 0px;" class="btn btn-warning"><i class="fa fa-plus" aria-hidden="true"></i>
 Add another image</div>

     <div></div>         
   
 
     <div class="row" id="prod_images_wrapper">
        <div class="col-sm-3" class="img_card" name="products_imgs[]">
         <div class="card">
         <div class="card-body">
          <h5 class="card-title"> Add An Image </h5>
           <p class="card-text"> 

             <label for="img_color">Color : </label>
             <input required type="color" name="img_color[0]" id="img_color">

           </p>
             <input required type="file" name="img_file[0]" id="img_file">
         </div>
        </div>
       </div>

      </div> 
     
     
  
     <input style="margin: 16px 0px;" type="submit" class="form-control btn btn-primary" name="add_prod" value="Add Product">
     <br>

     
   


  </form>

</div>

<script> 

  $( function(){
   
    var add_times = 1;

    
    $('#add_prod_img_btn').on('click' , function(){
     
      $("#prod_images_wrapper").append(` <div class="col-sm-3" class="img_card" name="products_imgs[]">
         <div class="card">
         <div class="card-body">
          <h5 class="card-title"> Add An Image </h5>
           <p class="card-text"> 

             <label for="img_color">Color : </label>
             <input required type="color" name="img_color[${add_times}]" id="img_color">

           </p>
             <input required type="file" name="img_file[${add_times}]" id="img_file">
         </div>
        </div>
       </div>`)

       add_times++;
    })

  });


</script>