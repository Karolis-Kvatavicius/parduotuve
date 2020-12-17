<?php
setcookie("vartotojas", "", time() - 3600);
setcookie("vardas", "", time() - 3600); 
setcookie("pavarde", "", time() - 3600);
// SUNAIKINU SESIJA KAD RANKINIU BUDU NEREIKTU TRINT SESIJOS ID IS BROWSERIO AR PERKRAUT SERVERIO 
session_start(); 
session_destroy();
header('Location: ./prisijungimas.php');