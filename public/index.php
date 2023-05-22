<?php

require_once '../vendor/autoload.php';

$randArray = new App\RandArray(4, 4);

$array = [];


//var_dump($randArray->buildMatrix($array));
$randArray->buildMatrix($array);


