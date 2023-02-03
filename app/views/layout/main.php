<?php
    $title = ucfirst($controller);
    $childView = ROOTDIR."/app/views/$controller/$view.php";
    include('layout.php');
?>
