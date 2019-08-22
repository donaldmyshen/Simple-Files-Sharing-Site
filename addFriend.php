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
            //  get input as friend name
            $fname = $_POST["fname"];   
            $friendFlag = 0;
    
            // trans to array, username & passward as element
            $path = file('/home/donaldshen/M2data/users.txt');
            $contents = array();
            foreach ($path as $line) {
                // ignor ","
                // possible bug here, users may choose "," as username or passward
                list($user, $pwd) = explode(',', $line);
                $contents[trim($user)] = trim($pwd);
            }

            //  Check friend name is exist or not 
            if (!array_key_exists(trim($fname), $contents)) {  
                echo "Username is not found in system.";
                exit;
            } 
    
            //  Check friend name already in friend list or not
            $friendList = file('/home/donaldshen/M2data/users/'.$username.'/friends.txt');
            foreach ($friendList as $line) {
                if (trim($line) == $fname){
                 $friendFlag = 1;
                } 
            }
            // ad frien to list
            if ($friendFlag === 1) { 
                echo "$fname is already your friend. You cannot add again.";
            } else {
                $flist = fopen('/home/donaldshen/M2data/users/'.$username.'/friends.txt', "a") or die("Unable to open file!");
                $txt = "$fname \n";
                fwrite($flist, $txt);
                fclose($flist);
                echo $fname.' is added to your friend list!';
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
