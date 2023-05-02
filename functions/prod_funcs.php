<?php 

 function edit_product( $con , $id_prod , $des_prod , $desc_prod , $price_prod , $qte_prod , $discount_prod = 0){

       $stmt_edt_prd = $con->prepare("UPDATE product SET des_prod = ? , desc_prod = ? , price_prod = ? , qte_prod = ? , discount_prod = ? WHERE id_prod = ?");
       $stmt_edt_prd->bindParam( 1 , $des_prod , PDO::PARAM_STR);
       $stmt_edt_prd->bindParam( 2 , $desc_prod , PDO::PARAM_STR);
       $stmt_edt_prd->bindParam( 3 , $price_prod , PDO::PARAM_STR);
       $stmt_edt_prd->bindParam( 4 , $qte_prod , PDO::PARAM_STR);
       $stmt_edt_prd->bindParam( 5 , $discount_prod , PDO::PARAM_STR);
       $stmt_edt_prd->bindParam( 6 , $id_prod , PDO::PARAM_STR);
       $stmt_edt_prd->execute();

       return $stmt_edt_prd->rowCount();
 } 

 function get_all_products( $con  ,  $filter = [] , $only_discount = false ) :array {
 
   $condition = '';
   $param = [];
   $counter = 0;

   $query = "SELECT * FROM product INNER JOIN category on product.cat_prod = category.id_cat INNER JOIN brand ON product.bra_prod = brand.id_bra ";
 
   if (!empty($filter)){
      foreach ($filter as $field => $val) {
       if ( $counter == 0){
          $condition = 'WHERE '.$field.' = ?';
       }else{
         $condition .= ' AND '.$field.' = ?';
       }
       $param[] = $val;
       $counter++;
      }
   }


   
   $query = $query.$condition;  
   if  ( $only_discount ){
      $query.= ' AND discount_prod > 0';
   }
  
   $query .= ' ORDER BY added_prod';
   
  

   $stmt_get_all_prod = $con->prepare($query);
   $stmt_get_all_prod->execute($param);

   $products = $stmt_get_all_prod->fetchAll(PDO::FETCH_ASSOC);
   $product_count = count( $products );

   // get brand of product 

   
  
   
   // get img and colors of products 



   for ($i=0; $i < $product_count ; $i++) { 

      $id_prod = $products[$i]['id_prod'];
      $id_bra  = $products[$i]['bra_prod'];
      $id_cat  = $products[$i]['cat_prod'];


      $brand_info = get_brand( $con , $id_bra );
      $products[$i]['brand'] = $brand_info;
      $cat_info = get_category ( $con , $id_cat);
      $products[$i]['category'] = $cat_info;

      $stmt_get_prod_pics = $con->prepare("SELECT * FROM prod_pics WHERE id_prode = ?");
      $stmt_get_prod_pics->execute( [ $id_prod ] );
      $prod_pics = $stmt_get_prod_pics->fetchAll(PDO::FETCH_ASSOC);
      
      foreach ($prod_pics as $pp) {
        $products[$i]['images'][] = $pp;
      }
   } 
   
   return $products;
  
 }

 function add_product ( $con , $des_prod , $price_prod , $discount_prod , $desc_prod , $qte_prod , $cat_prod , $bra_prod , array $prod_imgs , array  $prod_clrs ) : int {

     
    
    $stmt_add_prod = $con->prepare("INSERT INTO `product`(`des_prod`, `price_prod`, `discount_prod`, `desc_prod`, `qte_prod`, `cat_prod`, `bra_prod`) VALUES (?,?,?,?,?,?,?);SELECT LAST_INSERT_ID() id_prod;");

    $stmt_add_prod->bindParam( 1 , $des_prod , PDO::PARAM_STR );
    $stmt_add_prod->bindParam( 2 , $price_prod , PDO::PARAM_STR );
    $stmt_add_prod->bindParam( 3 , $discount_prod , PDO::PARAM_STR );
    $stmt_add_prod->bindParam( 4 , $desc_prod , PDO::PARAM_STR );
    $stmt_add_prod->bindParam( 5 , $qte_prod , PDO::PARAM_STR );
    $stmt_add_prod->bindParam( 6 , $cat_prod , PDO::PARAM_STR );
    $stmt_add_prod->bindParam( 7 , $bra_prod , PDO::PARAM_STR );
    $stmt_add_prod->execute();

    $add_prod_state = $stmt_add_prod->rowCount();

    $id_prod =  $con->lastInsertId(); 
    // upload images and their colors  

    // get images count == img colors 

    $img_count = count( $prod_imgs['name'] );

    for ($i=0; $i < $img_count; $i++) { 
          
        $img_clr = $prod_clrs[$i];
        $prod_img_tmp = $prod_imgs['tmp_name'][$i];
        $prod_img_name = $prod_imgs['name'][$i];

        $prod_img  = array ( 
                'tmp_name' => $prod_img_tmp,
                'name' => $prod_img_name
        );

        $upload_state = upload_img( $prod_img , PROD_IMG_DIR );


        if ( $upload_state ){


           $prod_img_fname = $upload_state;
          
           $stmt_add_prod->closeCursor();
           $stmt_add_prod_img = $con->prepare("INSERT INTO `prod_pics`( `prod_pic_fn`, `prod_pic_clr`, `id_prode`) VALUES (?,?,?)");
           $stmt_add_prod_img->bindParam( 1 , $prod_img_fname , PDO::PARAM_STR );
           $stmt_add_prod_img->bindParam( 2 , $img_clr , PDO::PARAM_STR );
           $stmt_add_prod_img->bindParam( 3 , $id_prod , PDO::PARAM_STR );
           $stmt_add_prod_img->execute();
  

        }

    }
    
     return $add_prod_state;

 }