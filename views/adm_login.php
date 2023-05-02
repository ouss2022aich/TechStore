 
 <div class="adm_login_bg"></div>
<div class="adm_login_section">

  
   <h2 align="center"> Admin Login </h2>

   <?php 
        if (isset($_GET['login_state'])){
           $login_state = $_GET['login_state'];
          switch( $login_state ){
           case 0:
              echo "<div class='alert alert-danger'><i class='fa-regular fa-circle-xmark'></i> Information Incorrects </div>"; 
           break;  
          }

        }


   ?>
   <form action="/controllers/admin_controller.php?do=login" method="post">
        <label for="adm_email"> Email : </label>
        <input type="email" required name="adm_email" class="form-control" id="adm_email">
        <label for="adm_pass"> Mot de passe : </label>
        <input type="password" required name="adm_pass" class="form-control" id="adm_pass">
        <br>
        <input type="submit" class="btn btn-primary form-control" value="Se Connecter">
   </form>


</div>