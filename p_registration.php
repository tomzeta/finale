<?php
session_start();
if(!isset($_SESSION['registration_error'])){
    $_SESSION['registration_error'] = "";
}
if(!isset($_SESSION['nomeErr'])){
    $_SESSION['nomeErr'] = "";
}
if(!isset($_SESSION['cognomeErr'])){
    $_SESSION['cognomeErr'] = "";
}
if(!isset($_SESSION['emailErr'])){
    $_SESSION['emailErr'] = "";
}
if(!isset($_SESSION['usernameErr'])){
    $_SESSION['usernameErr'] = "";
}
if(!isset($_SESSION['passwordErr'])){
    $_SESSION['passwordErr'] = "";
}


if(isset($_SESSION['user'])!="" ) {
    if ($_SESSION['user_type'] == "admin") {
        header("Location: p_admin.php");
    } else if ($_SESSION['user_type'] == "user") {
        header("Location: p_ordini.php");
    }
} else {
    $headerpage = file_get_contents('template/header.txt');
    echo str_replace('[HOMEPAGE]', 'Registrazione', $headerpage);
    $finalpage = file_get_contents('template/h_registrazione.txt');
    $finalpage = str_replace('[nomeError]', $_SESSION['nomeErr'], $finalpage);
    $finalpage = str_replace('[cognomeError]', $_SESSION['cognomeErr'], $finalpage);
    $finalpage = str_replace('[emailError]', $_SESSION['emailErr'], $finalpage);
    $finalpage = str_replace('[usernameError]', $_SESSION['usernameErr'], $finalpage);
    echo str_replace('[passwordError]', $_SESSION['passwordErr'], $finalpage);

    echo file_get_contents('template/footer.txt');
}
?>