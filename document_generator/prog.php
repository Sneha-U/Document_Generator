<?php
    $con = mysqli_connect("localhost", "root", "", "document_generator");
    if ($con === false) {
        die("Connection Failed: " . mysqli_connect_error());
    }
?>
