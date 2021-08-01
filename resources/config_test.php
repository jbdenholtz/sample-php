<?php

$server_root = $_SERVER['DOCUMENT_ROOT'];

if($server_root === '/workspace')
{
    $GLOBALS['root_reference'] = $server_root;
}
elseif($server_root === '/var/www/q.brasstaxes.com')
{
    $GLOBALS['root_reference'] = $server_root . "/expenses";
}

?>