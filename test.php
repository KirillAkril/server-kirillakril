<?php

include 'trig.php';
include 'index.php';

$expression = file_get_contents(
    'Task/expression.txt'
);

echo calculate($expression);

?>