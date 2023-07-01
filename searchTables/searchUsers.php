<?php
include "../Tables/users.php";

header('Content-type: application/json; charset=UTF-8');

$search = new Users();

$search->setup();

echo $search->search($_POST);
?>