<?php

require_once "model/Muser.php";

$user = new User();
switch ($action) {
    case 'login':
        if ($_POST) {
            $data = $_POST['frm'];
            $row = $user->login($data['email']);
            if (password_verify($data['password'], $row->password)) {
                $email = $row->email;
                $password = $data['password'];
                if ($data['remember']) {
                    setcookie('email', $email, time()+60*60+24, '/');
                    setcookie('password', $password, time()+60*60+24, '/');
                }
                $_SESSION['name'] = $row->name . ' ' . $row->lastname;
                header("Location: index.php?login=ok");
            } else {
                header("Location: login.php?login=error");
            }
        }
        break;
    case 'cookie':
        $row = $user->login($_COOKIE['email']);
        $password = $_COOKIE['password'];
        if (password_verify($password, $row->password)) {
            $_SESSION['name'] = $row->name . ' ' . $row->lastname;
            header("location: index.php?login=cookie");
        }
        break;
    case 'logout':
        if (isset($_GET['logout'])) {
            if ($_GET['logout'] == 'ok') {
                if (isset($_COOKIE['email']) && isset($_COOKIE['password'])) {
                    $email = $_COOKIE['email'];
                    $password = $_COOKIE['password'];
                    setcookie('email', $email, time()-10, '/');
                    setcookie('password', $password, time()-10, '/');
                }
                session_destroy();
                header("Location: login.php?logout=ok");
            }
        }
        break;
}

require_once "view/user/V$action.php";

?>