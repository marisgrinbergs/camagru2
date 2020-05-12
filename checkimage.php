<?php
    global $image;
    if (isset($_POST["image"]))
    {
    $image = $_POST["image"];
    print($image);
}
?>

