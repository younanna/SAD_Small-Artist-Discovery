<?php include ('server.php');

?>


<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Song List</title>
<link rel="stylesheet" type="text/css" href="style.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<style>

    body {
        text-align: center;
        background-color: #CCE0F6;
        width: 1000px;
        margin-left: 50px;
        margin-right: 50px;
    }

    .songlist{
        text-align: center;
        padding-top: 30px;
        color: #5561CB;
        font-family: 'Ubuntu', sans-serif;
        font-weight: bold;
        font-size: 40px;
    }

    .subtitle{
        font-family: 'Ubuntu', sans-serif;
        font-size:20px;
    }


    .s-table {
        width: 180%;
        font-size: 13px;
        border-top: #e5e5e5 1px solid;
        border-spacing: initial;
        margin: 15px 0px;
        word-break: break-word;
    }

    .s-table th {
        background-color: #B0C4DE;
        padding: 10px 20px;
        text-align: left;
    }

    .s-table td {
        border-bottom: #f0f0f0 1px solid;
        background-color: #d8e9ef;
        padding: 10px 20px;




    input[type=submit]{
        margin-top: 20px;
        justify-content: center;
        font-family: "arial", "sans-serif";
        background-color: Orange;
        border: none;
        color: white;
        padding: 10px 10px;
        font-size: 16px;
        cursor: pointer;
    }

    /* Darker background on mouse-over */
    input[type=submit]:hover {
        background-color: DarkOrange;
    }

</style>


</head>
<body>
<p class="songlist" align="center">&#9836; Genre filtered list of songs &#9836;</p>
<p class="subtitle" align="center">Select Songs you like!</p>


<?php


if(isset($_POST['submit_list'])) {

    $db = mysqli_connect('localhost', 'ykim', 'younkyforky', 'SAD');
    if (!empty($_POST['like'])) {

        // Loop to store and display values of individual checked checkbox.
        foreach ($_POST['like'] as $selected) {

            $selected_username = $_SESSION['username'];

            //foreach($_POST['like'] as $liked_track) {

                $int_trackid = (int)$selected;
                mysqli_query($db,"CALL insertReview('$selected_username', '$int_trackid')");

            //}
        }

        // move to songList page
        header('location: userlist.php');
    }
    else {
        // no genre is selected
        echo "<b>No song is checked as LIKED song </b>";
    }
}

?>



<div class="main">

    <form action="songList.php" method="post">

        <table class="s-table" cellspacing="1px" width="100%">
                    <tr>
                        <th>List</th>
                        <th>Song Title</th>
                        <th>Artist</th>
                        <th class="text-right">Album</th>
                        <th>Like</th>
                    </tr>

        <?php

        $db = mysqli_connect('localhost', 'ykim', 'younkyforky', 'SAD');
        foreach($_SESSION['get_genre_id'] as $gen){
            $genre = mysqli_query($db, "CALL findGenre('$gen')");

                    $i = 1;
                    while ($track = mysqli_fetch_array($genre)) {

                        ?>


                        <tr>
                            <td><?php echo $i ?></td>
                            <td><?php echo $track['track_name']; ?></td>
                            <td class="text-right"><?php echo $track['artist_name']; ?></td>
                            <td><?php echo $track['album_name']; ?></td>
                            <td><input type="checkbox" name ="like[]" value=<?php echo $track['track_id']; ?> /> </td>
                        </tr>


                        <?php
                        $i++;
                    }
                }
?>
        </table>







    <form method="post" action="songList.php">
        <input type="submit" name="home" Value="HOME"/>
        <input type="submit" name="submit_list" Value="SUBMIT"/>
        <!----- Including PHP Script ----->
    </form>

    </form>
</div>
</body>
</html>
