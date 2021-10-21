<?php
 require_once 'process.php';
 $con = new mysqli("sql6.freesqldatabase.com","sql6443394","CJ5xmVq4Xm","sql6443394"); 
 
 if(isset($_POST['login'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $user = $con->query($sql) or die ($con->error);
    $row = $user->fetch_assoc();
    $total = $user->num_rows;

    if($total > 0){

        $_SESSION['UserLogin'] = $row['username'];
        $_SESSION['Access'] = $row['access'];
        echo header("Location: index.php");
    
    }else{
        echo "No user found ";
    }

}

 ?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        .form-div{
            margin: 50px auto 50px;
            padding: 25px 15px 10px 15px;
            border: 1px solid #80ced7;
            border-radius: 5px;

    }

     @media only screen and (max-width: 667px){
        .form-div{
            border: none;
        }
            }
    </style>
</head>
<body>
   <div class="container">
       <div class="row">
           <div class="col-md-4 offset-md-4 form-div">
               <form action="login.php" method="post">
                    <h3 class="text-center">Login</h3>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" class="form-control form-control-lg">
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="username" class="form-control form-control-lg">
                    </div>
                    <br>
                    <div class="form-group">
                        <button type="submit" name="login" class="btn btn-primary btn-block btn-lg btn-hk">Login</button>
                    </div>

               </form>

           </div>

       </div>
   </div>
</body>
</html>




