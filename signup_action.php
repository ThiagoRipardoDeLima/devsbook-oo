<?php
require 'config.php';
require 'models/Auth.php';

$email    = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$password = filter_input(INPUT_POST, 'password');
$name     = filter_input(INPUT_POST, 'name');
$birthdate= filter_input(INPUT_POST, 'birthdate');

if( $email && $password && $name && $birthdate){

    $auth = new Auth($pdo, $base);
    
    $dtaNascimento = $birthdate;
    $birthdate = explode('-', $birthdate);
    if( count( $birthdate) != 3 ){
        $_SESSION['errorLogin'] = "Data de nascimento inválida.";
        header('Location: '.$base."/login.php");
        exit;
    }
 
    $birthdate = $birthdate[2]. '-'. $birthdate[1] . '-' . $birthdate[0];
    if( strtotime( $birthdate ) == false ){
        $_SESSION['errorLogin'] = "Data de nascimento inválida.";
        header('Location: '.$base."/login.php");
        exit;
    }
    
    if( $auth->emailExists($email) !== false ){
        $_SESSION['errorLogin'] = "E-mail já cadastrado.";
        header('Location: '.$base."/login.php");
        exit;
    }

    $isOk = $auth->registerUser($name, $email, $password, $dtaNascimento);
    
    if(!$isOk){
        $_SESSION['errorLogin'] = "Falha ao salvar usuário";
        header('Location: '.$base);
        exit;
    }

    $_SESSION['errorLogin'] = "Usuário ". strtoupper($name). " cadastrado com sucesso!";
    header('Location: '.$base);
    exit;

}

$_SESSION['errorLogin'] = "Campos não enviados.";
header('Location: '.$base."/login.php");
exit;
