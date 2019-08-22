<!DOCTYPE html>
<html lang="en">
    <meta charset="utf-8"/>
    <title>Creat User</title>
    <style type="text/css">

    div#Header{
        background-color:lightblue;
        border: 2px solid black;
        padding: 10px;
        font-family: Georgia, 'Times New Roman', Times, serif;
        font-size: 125%;
        text-align:center;
    }

    blockquote{ 
        border-top: 3px solid black;
        border-bottom: 3px solid black;
        font-family: Georgia, 'Times New Roman', Times, serif;
        font-size: 125%;
        text-align:center;
        padding-top: 30px;
        padding-bottom: 30px;
    }
    </style>
</head>

<body>
    <div id = "Header">
<?php
    error_reporting( E_ALL^E_NOTICE );
    session_start();
    // Get the username and check if it is valid
    $username = $_SESSION['username'];
    if ( !preg_match('/^[\w_\-]+$/', $username) ) {
        echo "Invalid username, check again!";
        exit;
    }

    
    $friendFlag = 0;
    //  Get friend name
    $fname = $_POST['friendname'];
    $path = file('/home/donaldshen/M2data/users.txt');
    $contents = array();
    foreach ($path as $line) {
        list($user, $pwd) = explode(',', $line);
        $contents[trim($user)] = trim($pwd);
    }
    
    // check if user name exist
    if (!array_key_exists(trim($fname), $contents)) {
        echo "Username not found, check agian.";
        exit;
    } 
    // check if current user already in list
    $friendList = file('/home/donaldshen/M2data/users/'.$username.'/friends.txt');
    foreach($friendList as $line) {
        if (trim($line) == $fname) $friendFlag = 1;
    }
    
    //  If not exist, error message displayed 
    if ($friendFlag == 0) {
        echo "Friend does not exist, try again!";
    } else{
        
        // Diplay friend's file through url
        echo "<b>Here are your friend shared files: </b><br>";
        $dir = "/home/donaldshen/M2data/users/".$fname ."/files/";
        $dh  = opendir($dir);
        while (false !== ($newfilename = readdir($dh))) {
            if ($newfilename !== "." && $newfilename !== ".."){
                echo '<div><a href="openFile.php?openFile='.urlencode($newfilename).'">'.$newfilename.'</a></div>';
            }
        }
    }
?>
    </div>

    <div>
        <blockquote>Back to main page!<br>
            <!--Use logout func back to login page actually -->
            <form action = "back.php" method = "POST">
                <input type = "submit" name = "back" value="BACK"> 
            </form>
        </blockquote>
    </div>

</body>
</html>