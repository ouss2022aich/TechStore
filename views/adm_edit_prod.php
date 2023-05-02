
<?php 

 $products = get_all_products( $conn );

?>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
 <div class="modal-dialog modal-dialog-centered">
   <div class="modal-content">
     <div class="modal-header">
       <h1 class="modal-title fs-5" id="exampleModalLabel"> Brand Edition </h1>
       <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
     </div>
     <div class="modal-body">
     <form action="/controllers/admin_controller.php?do=edit_prod" method="post">
    
     <input class="form-control" type="text" name="id_prod" id="id_prod_inp" required readonly hidden>
     <label for="des_prod">Product Name : </label>
    <input class="form-control" type="text" name="des_prod" id="des_prod_inp" required>

    <label for="desc_prod"> Description </label>
    <textarea class="form-control" id="desc_prod_inp" name="desc_prod"   placeholder="describe the product ..." required>

    </textarea>

    <label for="prod_price">Product Price : </label>
    <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text" id="inputGroupPrepend"> DZD </span>
        </div>
        <input required class="form-control" maxlength="10" type="text" name="price_prod" id="currency-field" pattern="^\d{1,3}(,\d{3})*(\.\d+)?$" value="" data-type="currency" placeholder="1,000.00">
    </div>

    <label for="qte_prod">Quantity : </label>
    <input class="form-control" type="number" value="1" id="qte_prod_inp" name="qte_prod">

    <label for="discount_prod">Discount : </label>
    <input class="form-control" type="number" value="" min="0" max="100" id="discount_prod_inp" name="discount_prod">
         
         <br>
         <input type="submit" class="btn btn-primary form-control" value="Edit Brand">
         </form>
     </div>
     <div class="modal-footer">
       <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    
     </div>
  
   </div>
 </div>
</div>
<!-- End Modal here -->


<div class="adm_edit_prod_container">
 <div class="row" style="gap:5px">
 <?php 

   foreach ($products as $k => $prd) {
     
    ?>
    
   
      
      <div class="card col-sm-3" style="width: 18rem;margin:0px 5px">

      <?php 
         if ( $prd['discount_prod'] > 0){
            echo '<div class="discount_ribbon" >
                    <span class="discount_price">'.$prd['discount_prod'].'</span> 
                    <span class="discount_percent">%</span>
                  </div>';

         }
        ?>
         <img id="img<?php echo $k; ?>" style="object-fit: contain;width: 150px;height: 150px;width: 100%;" src="/images/prod_img/<?php echo $prd['images'][0]['prod_pic_fn']; ?>" class="card-img-top" alt="...">
         <div class="card-body">
          <h5 class="card-title"> <?php echo $prd['des_prod']; ?> </h5>
          <p class="card-text"> <?php echo $prd['desc_prod']; ?> </p>
         </div>
         <ul class="list-group list-group-flush">
         <li class="list-group-item" style="display : flex;align-items:center;justify-content: space-between;"> 
          <span><b>Brand : </b> <?php echo $prd['brand']['des_bra']; ?>  </span>
           <img style="float:right; object-fit: contain;" src="/images/brand_img/<?php echo $prd['brand']['bra_img'] ?>" alt="" srcset="" width="50" height="50">
         
          </li>
          <li class="list-group-item"> <b>Country : </b> <?php echo $prd['brand']['country']; ?> </li>
          <li class="list-group-item"> <b>Category : </b> <?php echo $prd['category']['des_cat']; ?></li>
          <li class="list-group-item"> <b>Colors : </b> 
           <div>   <?php 
                  foreach ($prd['images'] as $pi) {
                     
                    ?>
                     <span class="brand_colors" data-target="#img<?php echo $k; ?>" data-image="/images/prod_img/<?php echo $pi['prod_pic_fn']; ?>" style="background:<?php echo $pi['prod_pic_clr']; ?>"></span> 
                     
                     <?php 

                  }
                  

              ?>
              </div>
           </li>
         </ul>
         <div class="card-body">
        <button  class="btn btn-primary prod_edt_btn" data-prod="<?php echo $prd['id_prod'].'/'.$prd['des_prod'].'/'.$prd['desc_prod'].'/'.$prd['price_prod'].'/'.$prd['qte_prod'].'/'.$prd['discount_prod'];  ?>" data-bs-toggle="modal" data-bs-target="#exampleModal" ><i class="fa-solid fa-pen-to-square"></i> Edit Product </button>
          
         </div>
      </div>


    <?php
   }

 ?>
 </div>




</div>


<script>
     $(function (){

         $('.brand_colors').on('click',(e) => {
             
              let img_target = e.currentTarget.getAttribute('data-target');
              let img_fn = e.currentTarget.getAttribute('data-image');

              $(img_target).attr('src',img_fn);

         })

        $('.prod_edt_btn').on('click' , (e) => {

             let prod_data = e.currentTarget.getAttribute('data-prod').split('/');
             $('#id_prod_inp').val( prod_data[0] );
             $('#des_prod_inp').val( prod_data[1] ); 
             $('#desc_prod_inp').val( prod_data[2] ); 
             $('#currency-field').val( prod_data[3] ); 
             $('#qte_prod_inp').val( prod_data[4] ); 
             $('#discount_prod_inp').val( prod_data[5] );

        }) 




     })


</script>