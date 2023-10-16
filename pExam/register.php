<?php
include "header.html";
include "process/p-register.php";
?>

<body>
<div class="container">
   <div class="title2">
        <h1>Registration Page</h1>
   </div>

   <div class="form">
     <form action="" method="post" class="form">
        <div class="form-group">
         <label for="email">Email</label>

         <div>
            <input type="text" class="form-control" name="email">
         </div>
        </div>

        <div class="form-group">
        <label for="profile-name">Profile Name</label>

        <div>
            <input type="text" class="form-control" name="profile-name">
        </div>
        </div>

        <div class="form-group">
        <label for="password">Password</label>

        <div>
            <input type="password" class="form-control" name="password">
        </div>
        </div>

        <div class="form-group">
        <label for="confirm-password">Confirm Password</label>

        <div>
            <input type="password" class="form-control" name="confirm-password">
        </div>
        </div>
        <div class="register-buttons">
   <input type="submit" name="register" value="Register">
   <input type="reset" name="clear" value="Clear">
   </div>

   <div class="error">
    <?php
    echo $msg;
    ?>
   </div>
      
     </form>
   </div>

   
   


</div>
    
</body>

<?php
include "footer.html";
?>