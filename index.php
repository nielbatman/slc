 <?php

if(!isset($_SESSION)) {
    session_start();
}

if(isset($_SESSION['UserLogin'])) {
    echo "Welcome ".$_SESSION['UserLogin'];
}else {
    echo "Welcome Classmates!!!";
}

require_once 'process.php'; 
 $con = new mysqli("sql6.freesqldatabase.com","sql6443394","CJ5xmVq4Xm","sql6443394");
 if(isset($_SESSION['message'])):
    
?>
<?php endif ?> 
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Niel Budget Management System</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        .log {
            margin-left: 2px;
        }
        @media only screen and (max-width: 667px) {

            .but {
                margin-bottom: 2px;
                padding: 3.5px 3.5px;
            }
            .total {
                font-size: 25px
            }
            h2 {
                font-size: 25px
            }
            .log {
                margin-left: 2px;
            }
    
        }
    </style>

</head>
<body>
    <nav class="navbar navbar-dark bg-primary text-center navi">
    <span class="navbar-brand mb-0 h1 text-center">PSSLC Budget Management System</span>
    </nav>
    <br><br><br>
        
        <br>
        <div class="log">
        <?php if(isset($_SESSION['UserLogin'])){?>
            <a href="logout.php" class="btn btn-danger lg">Logout</a>
        <?php } else{?>
            <a href="login.php" class="btn btn-success lg">Login</a>
        <?php } ?>
        </div>
        

    <div class="container">
        <div class="row">
            <div class="col-md-4">

                <?php if(isset($_SESSION['UserLogin'])){?>
                <h2 class="text-center">Add Expense</h2>
                <?php } else{?>
                    <a href="login.php"></a>
                <?php } ?>

                <hr><br>
                <?php if(isset($_SESSION['UserLogin'])){?>
                <form action="process.php" method="POST">
                    <div class="form-group">
                        <label for="budgetTitle">Date</label>
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="datetime-local" name="date" class="form-control" placeholder="Enter Date/Time">
                    </div>
                    <div class="form-group">
                        <label for="budgetTitle">Budget Title</label>
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="text" name="budget" class="form-control" id="budgetTitle" placeholder="Enter Budget Title" required autocomplete="off"  value="<?php echo $name; ?>">
                    </div>
                    <div class="form-group">
                        <label for="amount">Amount</label>
                        <input type="text" name="amount" class="form-control" id="amount" placeholder="Enter Amount" required  value="<?php echo $amount; ?>">
                    </div>
                    <?php if($update == true): ?>
                    <button type="submit" name="update" class="btn btn-success btn-block">Update</button>
                    <?php else: ?>
                    <button type="submit" name="save" class="btn btn-primary btn-block">Save</button>
                    <?php endif; ?>
                </form>
                <?php } else{?>
                    <a href="login.php"></a>
                <?php } ?>
            </div>
            <div class="col-md-8">
                <h2 class="text-center total">Total Expenses : ₱ <?php echo $total;?></h2>
                <hr>
                <br><br>

                <?php 

                    if(isset($_SESSION['massage'])){
                        echo    "<div class='alert alert-{$_SESSION['msg_type']} alert-dismissible fade show ' role='alert'>
                                    <strong> {$_SESSION['massage']} </storng>
                                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                        <span aria-hidden='true'>&times;</span>
                                    </button>
                                </div>
                                ";
                    }

                ?>
                <h2>Expenses List</h2>

                <?php 
                    
                    $result = mysqli_query($con, "SELECT * FROM budget ORDER BY id DESC");
                ?>
                <div class="row justify-content-center">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Date Added</th>
                                <th>Budget Name</th>
                                <th>Budget Amount</th>
                                <?php if(isset($_SESSION['UserLogin'])){?>
                                <th colspan="2">Action</th>
                                <?php } else{?>
                                <a href="login.php"></a>
                                <?php } ?>
                            </tr>
                        </thead>
                        <?php 
                            while($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $row['date']; ?></td>
                                <td><?php echo $row['name']; ?></td>
                                <td> ₱<?php echo $row['amount']; ?></td>

                                <?php if(isset($_SESSION['UserLogin'])){?>
                                <td>
                                    <a href="index.php?edit=<?php echo $row['id']; ?>" class="btn btn-success but">Update</a>
                                    <a href="process.php?delete=<?php echo $row['id']; ?>"  class="btn btn-danger but">Delete</a>
                                </td>
                                <?php } else{?>
                                    <a href="login.php"></a>
                                <?php } ?>

                            </tr>
                            

                        <?php endwhile ?>
                    </table>
                </div>
            </div>
        </div>
    </div>

<script src="js/jquery-3.2.1.slim.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
