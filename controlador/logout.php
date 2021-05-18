<?php
    
    require_once "../modelo/sentenciasCRUD.php";
    
    session_destroy();

    header("Location: ../index.php");
?>