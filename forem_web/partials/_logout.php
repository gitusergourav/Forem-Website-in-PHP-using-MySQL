<?php
    session_start();
    
    session_unset();
    
    session_destroy();
    
    header("location: /forem_web/index.php");
?>