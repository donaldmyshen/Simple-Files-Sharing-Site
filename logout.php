<?php
   session_start();
   // Not just back to login
   session_destroy();
   header("Location:filesh.html");
?>