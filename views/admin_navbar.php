<!-- Image and text -->
<nav class="navbar navbar-light bg-light" style="padding: 5px 20px">
  <div>
    <?php 
      if ( is_adm_connected()){
        ?>
         <img id="sidebar_btn" data-target="adm_sidebar" src="../shop_icons/menu.png" alt="" srcset="" width="30" height="30">
        <?php 
      }
    
    ?>
  <a class="navbar-brand" href="">
   

    <img src="/shop_icons/admin.png" width="30" height="30" class="d-inline-block align-top" alt="">
    Admin Portal 
  </a>

  </div>

  <?php 
      if (is_adm_connected()) {

        ?>
         <span><i class="fa-solid fa-circle fa-fade" style="color:greenyellow;margin:0 5px"></i>connected</span>
         <a href="../controllers/admin_controller.php?do=disconnect"><button class="btn btn-danger"><i class="fa-regular fa-circle-xmark"></i> Disconnect </button> </a>
        <?php 
 
      } 
    ?>


</nav>

