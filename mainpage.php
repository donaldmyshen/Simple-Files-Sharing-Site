<!DOCTYPE html>
<html lang="en">
    <meta charset="utf-8"/>
    <title>Your Files</title>
    <style type="text/css">
    div#Header{
        background-color:lightblue;
        border: 2px solid black;
        padding: 10px;
    }

    p#headerWords{
        text-align:center;
        font-family: Georgia, 'Times New Roman', Times, serif;
        font-size: 40px;
        font-weight: bold;
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

    .listOfFiles{
        border: 2px solid black;
        padding: 10px;
        font-family: Georgia, 'Times New Roman', Times, serif;
        font-size: 20px;
    }

    .openFile{
        border: 2px solid black;
        padding: 10px;
        font-family: Georgia, 'Times New Roman', Times, serif;
        font-size: 20px;
    }

    .uploadFile{
        border: 2px solid black;
        padding: 10px;
        font-family: Georgia, 'Times New Roman', Times, serif;
        font-size: 20px;
    }

    .deleteFile{
        border: 2px solid black;
        padding: 10px;
        font-family: Georgia, 'Times New Roman', Times, serif;
        font-size: 20px;
    }
    .addFriend{
        border: 2px solid black;
        padding: 10px;
        font-family: Georgia, 'Times New Roman', Times, serif;
        font-size: 20px;
    }
    .viewFriend{
        border: 2px solid black;
        padding: 10px;
        font-family: Georgia, 'Times New Roman', Times, serif;
        font-size: 20px;
    }
</style>
</head>

<body>
    <div id = "Header">
    <p id = headerWords>Your Personal File Sharing System</p>
    </div>

    <div class="listOfFiles">
        <p>List of your files:<p><br>       
        <?php
            //show the files that the user upload
            session_start(); 
            $username = $_SESSION['username'];
            $fileDirectory = sprintf("/home/donaldshen/M2data/users/%s/files", $username);
            $dh=opendir($fileDirectory);
            if (is_dir($fileDirectory)){
                while ((($filename=readdir($dh))!=false)){
                    if (($filename != '.') && ($filename != '..')){
                        echo $filename. "<br>";
                    }    
                }
                closedir($dh);
            }
        ?>    
    </div>
    <!-- open chosen file -->
    <div class="openFile">
            <form action = "openFile.php" method="POST">
            <br>
            Choose a file to open:
            <br>
            <select name = "openFiles">

            <?php
            session_start();
            $username = $_SESSION['username'];
            if( !preg_match('/^[\w_\-]+$/', $username) ){
                echo "Invalid username";
                exit;
            }
            // open a file 
            $fileDirectory = sprintf('/home/donaldshen/M2data/users/%s/files', "$username");
            $dh = opendir($fileDirectory);
            if(is_dir($fileDirectory)){
                    while ((($filename=readdir($dh)) != false)){
                        if (($filename != '.') && ($filename != '..')){
                             echo '<option value=' . $filename . '>' . $filename .'</option>'. "<br>";
                        }
                        
                    }
                    closedir($dh);
            }
            ?>
            </select>
            <input type = "submit" name = "open" value="open">
        </form>   
    </div>
    <!-- upload chosen file -->
    <div class = "uploadFile">
        <form enctype = "multipart/form-data" action = "uploadFile.php" method = "POST" > 
                <input type = "hidden" name = "MAX_FILE_SIZE" value = "20000000" />
                <br>
                <label for = "uploadingfilet">Choose a file to upload:</label>
                <br>
                <input name = "uploadedfile" type = "file" id = "uploadingfile" />
                <input type = "submit" value = "Upload File" />
        </form>
    </div>
    <!-- Delete chosen file -->
    <div class = "deleteFile">
        <form action = "deleteFile.php" method = "POST">
            <br>
            Choose a file to be deleted:
            <br>
            <select name = "files">
            <?php
                session_start();
                $username = $_SESSION['username'];
                // delete a file
                $fileDirectory = sprintf("/home/donaldshen/M2data/users/%s/files", $username); 
                $dh = opendir($fileDirectory);
                if (is_dir($fileDirectory)) {
                    while((($filename = readdir($dh)) != false)){
                        if(($filename != '.') && ($filename != '..')){
                            echo '<option value=' . $filename . '>' . $filename .'</option>'. "<br>";
                        }        
                    }
                    closedir($dh);
                }
            ?>
            </select>
            <input type = "submit" name = "delete" value = "Delete">
        </form>
    </div>

    <!-- Add friend with input name -->
    <div class = "addFriend">
        <form action="addFriend.php" method="POST">
            <br>
                <label for = "frinedName">Add a friend:</label>
            <br>
            <input type = "text" name = "fname" id = "frinedName"/>
            <input type = "Submit" value = "Add!"/>
        </form>
        <br>
    </div>

    <!-- see files with input friend's name -->
    <div class = "viewFriend">
        <form action="viewFriend.php" method="POST" enctype="multipart/form-data">
            <br>
                <label for = "frinedName"> Choose the friend you want to view his files:</label>
            <br>
            <input type = "text" name = "friendname" id = friendName/>
            <input type = "submit" value = "View!" />
        </form>
        <br>
    </div>

    <div>
        <blockquote>
            <form action = "logout.php" method = "POST">
                <label>Logout here! <input type = "submit" name = "logout" value = "LOGOUT"><label>
            </form>

            <form action = "signout.php" method = "POST">
                <label>Delete user! <input type = "submit" name = "delete" value = "DELETE"><label>
            </form>    
        </blockquote>
    </div>
</body>
</html>