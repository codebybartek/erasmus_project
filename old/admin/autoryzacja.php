<?php
function autoryzacja($login, $haslo)
{
    include("polacz.php");
    $conn = polacz();
    if (!$conn) {
        header("Location: error.php");
    }
    $query = mysqli_query($conn, "SELECT * FROM `admin` WHERE login = '" . $login . "'");
    if (mysqli_num_rows($query) > 0) {
        $row = mysqli_fetch_row($query);
        if ($row[1] == $haslo) {
            $_SESSION['login'] = $login;
            $_SESSION['password'] = $haslo;
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}
function sprawdzLoginSesji()
{
    session_start();
    if (isset($_SESSION['login']) && isset($_SESSION['password'])) {
        $login = $_SESSION['login'];
        $haslo = $_SESSION['password'];
        if (autoryzacja($login, $haslo)) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}
function sprawdz($login, $haslo)
{
    $login = $_POST['login'];
    $haslo = $_POST['password'];
    $haslo = addslashes($haslo);
    $login = addslashes($login);
    $login = htmlspecialchars($login);
    $haslo = sha1($haslo);
    if (autoryzacja($login, $haslo)) {
        return true;
    } else {
        return false;
    }
}
function sprawdzSesje()
{
    if (!sprawdzLoginSesji()) {
        header("Location: zaloguj.php");
    }
}
?>