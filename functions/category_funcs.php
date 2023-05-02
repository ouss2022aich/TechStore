<?php 

     function get_all_categories ( $con ) : array {

       $stmt_get_all_cats = $con->prepare("SELECT c1.id_cat , c1.des_cat , c2.id_cat id_par_cat , c2.des_cat des_par_cat FROM category c1 LEFT JOIN category c2 ON c1.id_par_cat = c2.id_cat;");
       $stmt_get_all_cats->execute();
       return $stmt_get_all_cats->fetchAll(PDO::FETCH_ASSOC);

     }

     function get_category ( $con , $id_cat){
       
          $stmt_get_cat = $con->prepare("SELECT * FROM category WHERE id_cat = ?");
          $stmt_get_cat->execute([ $id_cat]);
          return $stmt_get_cat->fetch(PDO::FETCH_ASSOC);

     }

     function get_root_categories( $con ) : array {
          
      $stmt_cats = $con->prepare("SELECT * FROM category WHERE id_par_cat IS NULL");   
      $stmt_cats->execute();
      return $stmt_cats->fetchAll(PDO::FETCH_ASSOC); 
     }

     function get_leaf_categories($con) : array {
       
        $stmt_get_leaf_cat = $con->prepare("SELECT * FROM category WHERE id_par_cat IS NOT NULL");
        $stmt_get_leaf_cat->execute();
        return $stmt_get_leaf_cat->fetchAll(PDO::FETCH_ASSOC);
     }

     function add_cat( $con , $des_cat , $id_par_cat = NULL ) : int 
     {
        $stmt_add_cat = $con->prepare("INSERT INTO category (des_cat,id_par_cat) VALUES (?,?)");
        $stmt_add_cat->bindParam(1, $des_cat , PDO::PARAM_STR);
        $stmt_add_cat->bindParam(2, $id_par_cat , PDO::PARAM_INT);
        $stmt_add_cat->execute();
        return $stmt_add_cat->rowCount();
     }

     function edit_cat( $con , $id_cat , $des_cat , $id_par_cat = NULL ) : int{
      
        $stmt_add_cat = $con->prepare("UPDATE category SET des_cat = ? , id_par_cat = ? WHERE id_cat = ?");
        $stmt_add_cat->bindParam(1, $des_cat , PDO::PARAM_STR);
        $stmt_add_cat->bindParam(2, $id_par_cat , PDO::PARAM_INT);
        $stmt_add_cat->bindParam(3, $id_cat , PDO::PARAM_INT);
        $stmt_add_cat->execute();
        return $stmt_add_cat->rowCount();

     } 

?>