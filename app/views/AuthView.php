<?php

class AuthView {

    public function showLogin($error, $user) {
        require_once './templates/layout/header.phtml';
        require_once './templates/form_login.phtml';
        require_once './templates/layout/footer.phtml';
    }

    public function showError($error, $user) {
        echo "<h1>$error</h1>";
    }
}

