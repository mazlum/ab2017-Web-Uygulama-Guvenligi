<?php

$m = new Memcached();
$m->addServer('localhost', 11211);

$m->set('flag', 'prodaft_{servisi_nasil_configure_ettin}');
$m->set('int', 99);

var_dump($m->get('int'));
?>
