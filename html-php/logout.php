<?php
    //Destroys the session so the user is logged out
    session_start();
    session_destroy();
    header('location: login.php');
