<?php 

     $brands = get_all_brands($conn);
     $cats = get_leaf_categories($conn);
    
     $filter = [];
     $only_discount = isset($_GET['discount']) ? true : false;
     $form_redirect =  isset($_GET['discount']) ? '/discount' : '/products';
     $page_title =  isset($_GET['discount']) ? 'Our Plans' : 'Our Products'; 


     if ( $_SERVER['REQUEST_METHOD'] == 'POST'){
       
       $des_prod = $_POST['des_prod'];
       $id_cat = (int)$_POST['cat_prod'];
       $id_bra = (int)$_POST['bra_prod'];

       
       if ( !empty($des_prod) ){ $filter['des_prod'] = $des_prod; }
       if ( $id_cat > 0 ){ $filter['id_cat'] = $id_cat; }
       if ( $id_bra > 0 ){ $filter['id_bra'] = $id_bra; }

     }
      

     $products = get_all_products( $conn , $filter , $only_discount);
    
?>
<div class="product_container container reveal">
   <h1 class="page_header"> <?php echo $page_title; ?> </h1>
  <form action="<?php echo $form_redirect; ?>" method="post">
  <div class="product_search_container row">
     <div class="col-sm-3">
        <label for="des_prod"> Product Name :  </label>
        <input class="form-control" type="text" name="des_prod" id="des_prod">
     </div>
     
     <div class="col-sm-3">
        <label for="cat_prod"> Category :  </label>
        <select class="form-select" name="cat_prod" id="cat_prod">

         <option value="0" selected>All</option>
         <?php
           foreach ($cats as $cat) {
             echo '<option value="'.$cat['id_cat'].'">'.$cat['des_cat'].'</option>';
           }
          
         ?>
        </select>
     </div>


     <div class="col-sm-3">
        <label for="bra_prod"> Brand :  </label>
        <select class="form-select" name="bra_prod" id="bra_prod">
        <option value="0" selected>All</option>
         <?php
           foreach ($brands as $bra) {
             echo '<option value="'.$bra['id_bra'].'">'.$bra['des_bra'].'</option>';
           }
          
          ?>
        </select>
     </div>

     <div class="col-sm-3">
        <label></label><br>
        <button class="btn btn-primary form-control" type="submit"><i class="fa fa-search" aria-hidden="true"></i>   Search</button>
       
     </div>

     
 
  </div>
  </form>
 <br>

  <div class="row" style="gap:5px">
   
 <?php 
   if ( !empty($products) ){
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
         <li class="list-group-item"> <b>Price : </b> <?php echo $prd['price_prod'].' Da'; ?></li>
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
        
      </div>


    <?php
   } 
  }else{
     ?>
         <div style="text-align: center;"> 
            <h3> No item found , Please Try Again </h3>
            <img src="/shop_icons/not_found.png" width="300" height="300">
           

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

     })


</script>