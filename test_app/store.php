<?php
require_once('functions.php');
var_dump($_POST);
exit();

savePostedData($_POST); // 追記
header('Location: ./index.php');
