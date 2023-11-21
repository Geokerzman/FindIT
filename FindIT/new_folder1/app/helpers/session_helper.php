<?php

// Flash message helper
// EXAMPLE - flash('register_success', 'You are now registered');
// DISPLAY IN VIEW - echo flash('register_success');


function flash($name = '', $message = '', $class = 'alert alert-success'){
    if (!empty($name)){
        if (!empty($message) && !isset($_COOKIE[$name])){
            setcookie($name, $message, time() + 3600, "/"); // Кука действительна в течение 1 часа
            setcookie($name. '_class', $class, time() + 3600, "/"); // Кука действительна в течение 1 часа
        } elseif (empty($message) && isset($_COOKIE[$name]) && $_COOKIE[$name] != $_SERVER['COOKIE_NAME']){
            $class = isset($_COOKIE[$name. '_class']) ? $_COOKIE[$name. '_class'] : '';
            echo '<div class="'.$class.'" id="msg-flash">'.$_COOKIE[$name].'</div>';
            setcookie($name, "", time() - 3600, "/"); // Удаление куки
            setcookie($name. '_class', "", time() - 3600, "/"); // Удаление куки
        }
    }
}

// Функция для проверки входа пользователя
function isLoggedIn(){
    return isset($_COOKIE['user_id']) && $_COOKIE['user_id'] == $_SERVER['COOKIE_NAME'];
}
