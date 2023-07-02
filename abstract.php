<?php
abstract class Database
{
    abstract function initialize();
    abstract function sql($sql);
    abstract function error();
}

?>