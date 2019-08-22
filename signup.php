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
            if (isset($_POST['submit'])) {
                // check user's name 
                if (isset($_POST['username'])) {
                    $_SESSION['username'] = $_POST['username'];
                    $username = $_SESSION['username'];
                    if ( !preg_match('/^[\w_\-]+$/', $username) ) {
                        echo "Invalid username, check again!";
                        exit;
                    }
                }
            }

            $checkusers = fopen("/home/donaldshen/M2data/users.txt","r");
            while ( !feof($checkusers)) { 
                // find if username exists
                if (trim(fgets($checkusers)) == $username) {
                    echo "This user name already exists!";
                    exit;
                }
            }
            fclose($checkusers);

            $password = $_POST['password'];
            $userlist = fopen("/home/donaldshen/M2data/users.txt", "a") or die("Unable to open file!");
            $txt = "$username, $password \n";
            fwrite($userlist, $txt);
            fclose($userlist);
    
            // creat a new document for user to store his file
            // create a txt file as friend list
            mkdir("/home/donaldshen/M2data/users/$username",0777); 
            chmod("/home/donaldshen/M2data/users/$username",0777);
            mkdir("/home/donaldshen/M2data/users/$username/files",0777); 
            chmod("/home/donaldshen/M2data/users/$username/files",0777);
            touch("/home/donaldshen/M2data/users/$username/friends.txt");
            chmod("/home/donaldshen/M2data/users/$username/friends.txt", 0755);
    
            echo "Creat successfully, welcom ". $username ."<br>";
        ?>
    </div>

    <div>
        <blockquote>Login here!<br>
            <!--Use logout func back to login page actually -->
            <form action = "logout.php" method = "POST">
                <input type = "submit" name = "logout" value="LOGIN"> 
            </form>
        </blockquote>
    </div>

</body>
</html>