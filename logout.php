<?php
require 'config.php';

$_SESSION['token'] = '';
$_SESSION['errorLogin'] = 'Sessão finalizada!';
header('Location: '.$base);
exit;
