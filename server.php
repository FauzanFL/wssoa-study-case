<?php

require 'vendor/autoload.php';
require_once('handle.php');

use nguyenanhung\MyFixNuSOAP\nusoap_server;

$server = new nusoap_server();

$server->configureWSDL('registrasi', 'urn:registrasi');

$server->register(
    'getAllMahasiswaWithStatus',
    [],
    array('return' => 'xsd:string')
);

$server->register(
    'statusPembayaran',
    array('nim' => 'xsd:string'),
    array('return' => 'xsd:string')
);

$server->service(file_get_contents("php://input"));
