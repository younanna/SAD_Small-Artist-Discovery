

<?php
include ('server.php');



$conn = mysqli_connect("localhost", "ykim", "younkyforky", "SAD");



$acousMin = $_POST["filterOpts"]["acous"][0];
$acousMax = $_POST["filterOpts"]["acous"][1];
$speechMin = $_POST["filterOpts"]["speech"][0];
$speechMax = $_POST["filterOpts"]["speech"][1];
$valMin = $_POST["filterOpts"]["valence"][0];
$valMax = $_POST["filterOpts"]["valence"][1];
$tempMin = $_POST["filterOpts"]["tempo"][0];
$tempMax = $_POST["filterOpts"]["tempo"][1];
$danceMin = $_POST["filterOpts"]["dance"][0];
$danceMax = $_POST["filterOpts"]["dance"][1];
$energyMin = $_POST["filterOpts"]["energy"][0];
$energyMax = $_POST["filterOpts"]["energy"][1];
$instMin = $_POST["filterOpts"]["inst"][0];
$instMax = $_POST["filterOpts"]["inst"][1];
$liveMin = $_POST["filterOpts"]["live"][0];
$liveMax = $_POST["filterOpts"]["live"][1];


$result = mysqli_query($conn, "SELECT S.track_id, S.track_name, A.artist_name, L.album_name, G.genre_name
FROM Song S, Artist A, Album L, Genre G
WHERE S.artist_id = A.artist_id AND S.album_id = L.album_id AND S.genre_id = G.genre_id
AND S.acousticness BETWEEN '$acousMin' AND '$acousMax'
AND S.speechiness BETWEEN '$speechMin' AND '$speechMax' AND S.valence BETWEEN '$valMin' AND '$valMax' 
AND S.tempo BETWEEN '$tempMin' AND '$tempMax' AND S.danceability BETWEEN '$danceMin' AND '$danceMax'
AND S.energy BETWEEN '$energyMin' AND '$energyMax' AND S.instrumentalness BETWEEN '$instMin' AND '$instMax'
AND S.liveness between '$liveMin' and '$liveMax'
ORDER BY S.track_listens");

$count = mysqli_num_rows($result);


if ($count > 0) {
?>
<style>
    body {
        font-family: Arial;
        width: 1200px;
        background-color: #CCE0F6;
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
        padding: 10px 25px;

    }

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
<!-- <hr> -->
<div class="container">

    <form action="submit.php" method="post">
    <table class="s-table" cellspacing="1px" width="100%">
        <tr>
            <th>Song Title</th>
            <th>Artist</th>
            <th class="text-right">Album</th>
            <th>Genre</th>
            <th>Like</th>
        </tr>
        <?php
        while ($row = mysqli_fetch_array($result)) {
            ?>

            <tr>
                <td><?php echo $row['track_name']; ?></td>
                <td><?php echo $row['artist_name']; ?></td>
                <td class='text-right'><?php echo $row['album_name']; ?></td>
                <td><?php echo $row['genre_name']; ?></td>
                <td><input type="checkbox" name="feature_check[]" value = <?php echo $row['track_id'];?>></td>
            </tr>
            <?php
        } // end while
        } else {
            ?>
            <div class="no-result">No Results</div>
            <?php
        }

        ?>
    </table>

        <form method="post" action="submit.php">
            <input type="submit" name="home" Value="HOME"/>
            <input type="submit" name="sliderSearch_List" Value="SUBMIT"/>
            <!-- Including PHP Script-->
        </form>
    </form>



<?php

    if (isset($_POST['sliderSearch_List'])) {

        $conn = mysqli_connect('localhost', 'ykim', 'younkyforky', 'SAD');
        if (!empty($_POST['feature_check'])) {

        // Loop to store and display values of individual checked checkbox.
        foreach ($_POST['feature_check'] as $selected) {

        $selected_username = $_SESSION['username'];
        $int_trackid = (int)$selected;
        mysqli_query($conn, "CALL insertReview('$selected_username', '$int_trackid')");

    }

    // move to songList page
    header('location: userlist.php');
    } else {
    // no genre is selected
    echo "<b>No song added to the user's song list</b>";
    }
    }


    ?>


</div>
</body>
</html>




