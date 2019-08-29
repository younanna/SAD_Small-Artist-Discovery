<?php

session_start();

$username = "";
$errors = array();
//$password_1 = "";
//$password_2= "";

    // connect to the database
    $db = mysqli_connect('localhost', 'ykim', 'younkyforky', 'SAD');

    // if register button is clicked
    if(isset($_POST['register'])) {
        $username = mysqli_real_escape_string($db,$_POST['username']);
        $password_1 = mysqli_real_escape_string($db,$_POST['password_1']);
        $password_2 = mysqli_real_escape_string($db,$_POST['password_2']);


        // ensure that form fields are filled properly
        if (empty($username)) {
            array_push($errors, "Username is required");
        }
        if (empty($password_1)) {
            array_push($errors, "Password is required");
        }
        if ($password_1 != $password_2) {
            array_push($errors, "The two password do not match");
        }

        // if no error
        if (count($errors) == 0) {
            $password = md5($password_1); //encrypt
            $sql = "INSERT INTO Username(user_id, pass) VALUES('$username', '$password')";
            mysqli_query($db, $sql);
            $_SESSION['username'] = $username;
            $_SESSION['success'] = "You are now logged in";
            header('location: index.php'); //redirect to home page
        }
    }

    if(isset($_POST['home'])){

        header('location: index.php');
    }

    if(isset($_POST['GenreSearch'])){

            header('location: genre.php');
    }

    if(isset($_POST['SliderSearch'])){

        header('location: slider6.php');
    }

    if(isset($_POST['user_list'])){
        header('location: userlist.php');
    }


    // log user in from login page
     if (isset($_POST['login'])) {
         $username = mysqli_real_escape_string($db,$_POST['username']);
         $password = mysqli_real_escape_string($db,$_POST['password']);


         // ensure that form fields are filled properly
         if (empty($username)) {
             array_push($errors, "Username is required");
         }
         if (empty($password)) {
             array_push($errors, "Password is required");
         }
         if (count($errors) == 0) {
             $password = md5($password);
             $query= "SELECT * FROM Username WHERE user_id = '$username' AND pass = '$password'";
             $result= mysqli_query($db, $query);
             if(mysqli_num_rows($result) == 1) {
                 //log user in
                 $_SESSION['username'] = $username;
                 $_SESSION['success'] = "You are now logged in";
                 header('location: index.php'); //redirect to home page
             }else{
                 array_push($errors, "The username/password combination");

             }
         }
     }

    //logout
    if (isset($_GET['logout'])){
        session_destroy();
        unset($_SESSION['username']);
        header('location: login.php');
    }


?>

<?php

if(isset($_POST['genreSearch_List'])){

    // select more than three genres
    if (!empty($_POST['check_list']) && count($_POST['check_list']) > 1){
        echo "<b>Please select ONE genre you like!</b>";
    }

    else if (!empty($_POST['check_list'])) {

        // init empty array for checked genres
        $checked_array = array();

        // Counting number of checked checkboxes.
        $checked_count = count($_POST['check_list']);
        echo "You have selected following " . $checked_count . " option(s): <br/>";

        $i = 0;
        // Loop to store and display values of individual checked checkbox.
        foreach ($_POST['check_list'] as $selected) {

            $qr = mysqli_query($db,"SELECT genre_id FROM Genre WHERE genre_name LIKE '$selected%' ");
            $obj = mysqli_fetch_array($qr);
            $checked_array[$i] = $obj['genre_id'];

            $i = $i + 1;
        }



        $_SESSION['get_genre_id'] = $checked_array;

        // move to songList page
        header('location: songList.php');
        //die;
    }
    else {
        // no genre is selected
        echo "<b>Please select ONE genre you like!</b>";
    }
}
?>





