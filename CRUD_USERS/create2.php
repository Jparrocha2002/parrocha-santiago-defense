<?php
include "../Tables/users.php";

header('Content-type: application/json; charset=UTF-8');

$create = new Users();

$create->setup();

echo $create->create($_POST);