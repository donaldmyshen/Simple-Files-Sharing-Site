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
            session_start();
            $username = $_SESSION['username'];
            // check the username 
            if ( !preg_match('/^[\w_\-]+$/', $username) ){
                echo "Invalid username";
                exit;
            }
            $filename = $_POST["files"];
            // find the file 
            $fileLocation = sprintf("/home/donaldshen/M2data/users/%s/files/%s", $username, $filename); 
            //delete the file
            unlink($fileLocation) or die("Can not delete file."); 
            echo $filename . " has been deleted!";
        ?>
    </div>

    <div>
        <blockquote>Back to main page!!<br>
            <!--Use logout func back to login page actually -->
            <form action = "back.php" method = "POST">
                <input type = "submit" name = "back" value="BACK"> 
            </form>
        </blockquote>
    </div>

</body>
</html>