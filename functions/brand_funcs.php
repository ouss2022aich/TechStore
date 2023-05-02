<?php 
  
  
  function get_brand( $con , $id_bra ) : array {
  
    $stmt_get_bra = $con->prepare("SELECT * FROM brand WHERE id_bra = ?");
    $stmt_get_bra->bindParam(1, $id_bra , PDO::PARAM_INT);
    $stmt_get_bra->execute();
    return $stmt_get_bra->fetch(PDO::FETCH_ASSOC);
  }

  function get_all_brands( $con ) : array {

    $stmt_get_all_bra = $con->prepare("SELECT * FROM brand");
    $stmt_get_all_bra->execute();
    return $stmt_get_all_bra->fetchAll(PDO::FETCH_ASSOC);

  }

  function add_brand ( $con , $des_bra , $country , $bra_img  ) : int {

     
     $upload_state =  upload_img( $bra_img , BRAND_IMG_DIR );
     
     if ($upload_state){

       $bra_img = $upload_state;
       $stmt_add_bra = $con->prepare("INSERT INTO `brand`( `des_bra`, `country`, `bra_img`) VALUES (?,?,?)");
       $stmt_add_bra->bindParam( 1 , $des_bra , PDO::PARAM_STR );
       $stmt_add_bra->bindParam( 2 , $country , PDO::PARAM_STR );
       $stmt_add_bra->bindParam( 3 , $bra_img , PDO::PARAM_STR );
       $stmt_add_bra->execute(); 


       return $stmt_add_bra->rowCount();
     }else{
        return 0;
     }
  }

  function edit_brand ( $con , $id_bra , $des_bra , $country , $bra_img = NULL ) : int {
       
       // getting brand info 
       $brand = get_brand($con , $id_bra);
       $edit_state = 0;
       if ( $bra_img != NULL ){
        $upload_state =  upload_img( $bra_img , BRAND_IMG_DIR );

        if ( $upload_state ){
          
  
          $bra_img = $upload_state;
          $stmt_edt_bra_img = $con->prepare("UPDATE brand SET  bra_img = ? WHERE id_bra = ?");
          $stmt_edt_bra_img->bindParam( 1 , $bra_img , PDO::PARAM_STR  );
          $stmt_edt_bra_img->bindParam( 2 , $id_bra , PDO::PARAM_STR  );
          $stmt_edt_bra_img->execute(); 
        
          $edit_state = $stmt_edt_bra_img->rowCount();

      
          // delete previous img 
          $prev_bra_img = $brand['bra_img']; 

          unlink( BRAND_IMG_DIR.$prev_bra_img );

        }
       }

       $stmt_edt_bra = $con->prepare("UPDATE brand SET des_bra = ? , country = ? WHERE id_bra = ?");
       $stmt_edt_bra->bindParam( 1 , $des_bra , PDO::PARAM_STR );
       $stmt_edt_bra->bindParam( 2 , $country , PDO::PARAM_STR );
       $stmt_edt_bra->bindParam( 3 , $id_bra , PDO::PARAM_STR );
       $stmt_edt_bra->execute(); 

       $edit_state = ( $edit_state > 0 ) ? $edit_state : $stmt_edt_bra->rowCount();

       return $edit_state;


  }