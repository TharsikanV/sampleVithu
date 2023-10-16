<?php
session_start();
include "header.html";
include "process/p-login.php";
?>

<body>

    <div class="login-form">
        <form action="" method="post">
        <div class="title3">
        <h1>Login Page</h1>
       </div>
    <div class="form-group">
         <label for="email">Email</label>

         <div>
            <input type="text" class="form-control" name="email">
         </div>
        </div>

        <div class="form-group">
        <label for="password">Password</label>

        <div>
            <input type="password" class="form-control" name="password">
        </div>
        </div>
        <div class="register-buttons">
   <input type="submit" name="login" value="Login">
   <input type="reset" name="clear" value="Clear">
   </div>

   <?php
    echo $msg;
   ?>
        </form>
</div>
</body>
<?php
include "footer.html";

?>

