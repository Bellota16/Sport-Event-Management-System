<?php
session_start();
function is_logged_in() {
    return isset($_SESSION['username']);
}
function is_admin() {
    return isset($_SESSION['is_admin']) && $_SESSION['is_admin'] === true;
}
function set_user_data($username, $email, $user_id, $is_admin = false) {
    $_SESSION['username'] = $username;
    $_SESSION['email'] = $email;
    $_SESSION['id'] = $user_id;
    $_SESSION['is_admin'] = $is_admin;
}
function get_user_data() {
    if (is_logged_in() && isset($_SESSION['email']) && isset($_SESSION['id'])) {
        return array(
            'username' => $_SESSION['username'],
            'email' => $_SESSION['email'],
            'id' => $_SESSION['id'],
            'is_admin' => is_admin()
        );
    } else {
        return null;
    }
}
function logout() {
    session_unset();
    session_destroy();
}

function set_flash_message($type, $message) {
    $_SESSION['flash_message'] = array(
        'type' => $type,
        'message' => $message
    );
}

// Function to get and clear the flash message from session
function get_flash_message() {
    if (isset($_SESSION['flash_message'])) {
        $flash_message = $_SESSION['flash_message'];
        unset($_SESSION['flash_message']);
        return $flash_message;
    } else {
        return null;
    }
}
?>
