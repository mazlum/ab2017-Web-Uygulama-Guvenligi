<?php
$flag = 'prodaft_{header_basic_flag}';
$p =  rand(0, strlen($flag)-1);
$c = $flag[$p];
header($p.' : '.$c);
echo 'ctf';
?>
