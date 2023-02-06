<?php

function debuguear($variable) {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

// Escapa / Sanitizar el HTML
function s($html) {
    $s = htmlspecialchars($html);
    return $s;
}

// Función que revisa que el usuario está autenticado
function isAuth() {
    if (!isset($_SESSION['login'])) {
        header('Location: /');
    }
}

// Función que revisa que el usuario es un administrador
function isAdmin() {
    if (!isset($_SESSION['login']) || $_SESSION['admin'] !== '1') {
        header('Location: /');
    }
}