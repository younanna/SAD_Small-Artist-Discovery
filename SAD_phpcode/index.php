<?php include ('server.php');


/*
 // if user is not logged in they cannot access this page
if(empty($_SESSION['username'])){
    header('location: login.php');
}

*/

?>
<!DOCTYPE html>
<html>
<head>
    <title>User Registration System</title>
    <link rel="stylesheet" type="text/css" href="style.css">

    <style>

        body {
            font-size: 120%;
            background: #F8F8FF;
            text-align: center;
        }

        form {
            width: 30%;
            margin: 0px auto;
            padding: 20px;
            border: 1px solid #B0C4DE;
            background: white;
            border-radius: 0px 0px 10px 10px;
        }

        .header {
            width: 30%;
            margin: 50px auto 0px;
            color: white;
            background: #5F9EA0;
            text-align: center;
            border: 1px solid #B0C4DE;
            border-bottom: none;
            border-radius: 10px 10px 0px 0px;
            padding: 20px;
        }

        .Ibtn{
            position: relative;

            padding: 10px;
            font-size: 15px;
            color: white;
            background: #5F9EA0;
            border: none;
            border-radius: 5px;
        }

    </style>


</head>
<body>
<div class="header">
    <h2>Small Artist Discovery</h2>
</div>

<div class="content">
    <?php if (isset($_SESSION['success'])): ?>
        <div class="error success">
            <h3>
                <?php
                echo $_SESSION['success'];
                unset($_SESSION['success']);
                ?>
            </h3>
        </div>
    <?php endif ?>

    <?php if (isset($_SESSION["username" ])): ?>
        <p style = "font-size: 30px; color: #5F9EA0" align="center">Welcome <strong><?php echo $_SESSION['username'];?></strong></p>
        <p align="center"><a href="index.php?logout='1'" style="color: red;">Logout</a> </p>
    <?php endif?>

<form method="post" action="index.php">
    <!-- <div class="Sbtn_group"> -->
    <button type="submit" name="SliderSearch" class="Ibtn">Slider Search</button>
    <button type="submit" name="GenreSearch" class="Ibtn">Genre Search</button>
    <button type="submit" name="user_list" class="Ibtn"><?php echo $_SESSION['username']?>'s song list</button>
    <!-- </div> -->

</form>
</div>



</body>
</html>
