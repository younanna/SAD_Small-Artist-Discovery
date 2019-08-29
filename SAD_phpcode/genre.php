<!DOCTYPE html>
<?php include('server.php'); ?>

<html>
<head>
    <title>Genre Search</title>
    <link rel="stylesheet" href="css/php_checkbox.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>

        body {
            font-size: 120%;
            background-color: #CCE0F6;
        }

        .checkbox-grid li {
            display: block;
            float: left;
            width: 25%;
        }
        .checkbox-grid{
            color: royalblue;
            font-size: 20px;
        }


        /* Below line is used for online Google font */
        @import url(http://fonts.googleapis.com/css?family=Droid+Serif);
        div.container{


            width: 903px;
            height: 300px;
            margin:50px auto;
            /*width: 30%; */
            /*margin: 50px auto 0px;*/
            color: white;
            background: #5F9EA0;
            text-align: center;
            border: 1px solid #B0C4DE;
            border-bottom: none;
            border-radius: 10px 10px 0px 0px;
            /*padding: 20px;*/

        }
        div.main{

            width: 800px;
            margin-top: 35px;
            float:left;
            border-radius: 5px;
            Border:2px solid #4ea1d3;
            padding:0px 50px 20px;

            background-color: #d8e9ef;

            border-radius: 1.5em;
            box-shadow: 0px 11px 35px 2px rgba(0, 0, 0, 0.14);
        }

        .genrelist{
            text-align: center;

            color: #5561CB;
            font-family: 'Ubuntu', sans-serif;
            font-weight: bold;
            font-size: 40px;
        }
        span{
            font-size:13.5px;
        }
        label{
            color: #464646;
            text-shadow: 0 1px 0 #fff;
            font-size: 14px;
            font-weight: bold;
        }

        b{
            color:white;
            font-size: 20px;

            background-color: lightcoral;
            margin: auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            height: 10px;
        }
        input[type=checkbox]{
            margin-bottom:10px;
            margin-right: 10px;
        }
        input[type=submit]{
            padding: 10px;
            text-align: center;
            font-size: 18px;
            background: #4FB0C6;
            border: 2px solid #4F86C6;
            color: #ffffff;
            font-weight: bold;
            cursor: pointer;
            text-shadow: 0px 1px 0px #13506D;
            width: 100%;
            border-radius: 5px;
            margin-bottom: 15px;

        }
        input[type=submit]:hover{
            background: #4F86C6;
        }

    </style>


</head>
<body>

<div class="container">
    <p class="genrelist" align="center">&#9836; Welcome to SAD: &#9836; </p>
    <p class="subtitle" align="center"> Select ONE Genre you like! </p>

    <div class="main">

        <form action="genre.php" method="post">

            <!-- getting each genre as a form of checkbox -->
            <?php
            $db = mysqli_connect('localhost', 'ykim', 'younkyforky', 'SAD');
            $sql = "SELECT * FROM Genre";
            $result = mysqli_query($db, $sql);
            while ($column = mysqli_fetch_array($result)){
                ?>
                <ul class="checkbox-grid">

                    <li><input type="checkbox" value=<?php echo $column['genre_name']; ?> name="check_list[]" /> <label> <?php echo $column['genre_name']; ?>
                        </label></li>
                </ul>
                <?php

            }
            ?>


            <form method="post" action="genre.php">
                <input type="submit" name="home" Value="HOME"/>
                <input type="submit" name="genreSearch_List" Value="SEARCH"/>
            </form>


        </form>
    </div>
</div>
</body>
</html>