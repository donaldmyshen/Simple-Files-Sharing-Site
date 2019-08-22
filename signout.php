<!DOCTYPE html>
<html lang="en">
    <meta charset = "utf-8"/>
    <title>User delete!</title>
    <style type = "text/css">
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
        padding-top: 50px;
        padding-bottom: 50px;
    }
    </style>
</head>

<body>
<div id = "Header">
    <?php
        session_start();
        $username = $_SESSION['username'];
        if(isset($_POST['submit'])){
            if(isset($_POST['username'])){
                $_SESSION['username']=$_POST['username'];
                $username=$_SESSION['username'];
                if( !preg_match('/^[\w_\-]+$/', $username) ){
                    echo "Invalid username, check again!";
                    exit;
                }
            }
        }
        // remove files users upload
        function deleteDocument($userSpace){
            unlink("$userSpace/friends.txt");
            if ( $handle = opendir( "$userSpace/files" ) ) {
                while ( false !== ( $item = readdir( $handle ) ) ) {
                    if ( $item != "." && $item != ".." ) {
                        if( unlink( "$userSpace/files/$item" ) ) echo "delete the file successfully：$userSpace/$item  \n"; 
                    }
                }
                closedir( $handle );
                rmdir("$userSpace/files");
                if( rmdir( $userSpace ) ) echo "delete Directory successfully： $userSpace  \n";
            }
        }

        $fileLocation = sprintf("/home/donaldshen/M2data/users/%s",$username);
        deleteDocument($fileLocation);
        
        // remoce name on valid users list
        $removeuser = "$username";
        $data = file("/home/donaldshen/M2data/users.txt");
        $farray = array();
        // compare the users without pwd
        foreach($data as $line) {
            $tmp  =  strstr($line , ',' , true);
            if (trim($tmp) != $removeuser) $farray[] = $line or die("Unable to open file!");
        }
        $fp = fopen("/home/donaldshen/M2data/users.txt", "w+");
        flock($fp, LOCK_EX);
        foreach($farray as $line) {
            fwrite($fp, $line) or die("Unable to open file!2");
        }
        flock($fp, LOCK_UN);
        fclose($fp);
    ?>

</div>
<div>
    <blockquote>Login here!<br>
        <form action = "logout.php" method = "POST">
            <input type = "submit" name = "logout" value = "LOGIN"> 
        </form>
    </blockquote>
</div>

</body>
</html>