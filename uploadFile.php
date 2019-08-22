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
            // Get the username and check if it is valid
            $username = $_SESSION['username'];
            if ( !preg_match('/^[\w_\-]+$/', $username) ) {
                echo "Invalid username, check again!";
                exit;
            }

            // Get the filename and check if it is valid
            $filename = basename($_FILES['uploadedfile']['name']);
            if ( !preg_match('/^[\w_\.\-]+$/', $filename) ) {
                echo "Invalid filename";
                exit;
            }
            // upload to user's space 
            $fullPath = sprintf("/home/donaldshen/M2data/users/%s/files/%s", $username, $filename); 
            if ( move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $fullPath) ){
                header("refresh:2; url=mainpage.php");
                echo "The file ". $filename . " has been successfully uploaded";        
                exit;
            } 
            else {
                // auto back after 2 sec
                header("refresh:2; url=mainpage.php");
                echo "The file ". $filename . " upload unsuccessfully! Try again.";
                exit;
            }
        ?>
    </div>

        <blockquote>Back to main page!!<br>
            <!--Use logout func back to login page actually -->
            <form action = "back.php" method = "POST">
                <input type = "submit" name = "back" value="BACK"> 
            </form>
        </blockquote>

</body>
</html>