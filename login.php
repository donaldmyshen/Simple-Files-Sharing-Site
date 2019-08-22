<?php
    session_start();
    // check the usename 
    if(isset($_POST['submit'])){
        if(isset($_POST['username'])){
            $_SESSION['username'] = $_POST['username'];
            $username = $_SESSION['username'];
            if( !preg_match('/^[\w_\-]+$/', $username) ){
                echo "Invalid username, check Again!";
                exit;
            }
        }
    }

    if (count($_POST)) {
    // Get users.txt path and read each line, put username and password as array
        $path = file('/home/donaldshen/M2data/users.txt');
        $contents = array();
        foreach ($path as $line) {
            list($user, $pwd) = explode(',', $line);
            $contents[trim($user)] = trim($pwd);
        }
        // Parse form input
        $username = $_POST['username'];
        $password = $_POST['password'];
        //  Check username is exist or not
        if (array_key_exists($username, $contents) && $password == $contents[$username]) {
            $_SESSION['username'] = $_POST['username'];
            header("Location: mainpage.php");
            exit;
        } else {
            header("Location: warning.html");
        }
    }
?>
