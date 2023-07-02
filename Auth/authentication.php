<?php
include "../tables/users.php";
header('WWW-Authenticate: Basic realm="My Private Area"');
header('HTTP/1.0 401 Unauthorized');
header('Content-type: application/json; charset=UTF-8');

$auth = new Users();

$auth->setup();

echo $auth->authentication();
?>