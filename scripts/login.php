<?php
session_start();
include_once 'connect.php';
if (isset($_POST['login']) && isset($_POST['password1'])) {
    $email = $_POST['login'];
    $password = $_POST['password1'];

    if (empty($email)) {
        header("Location: ../pages/index.php?error=Podaj login");
        exit();
    } elseif (empty($password)) {
        header("Location: ../pages/index.php?error=Podaj Hasło");
        exit();
    } else {
        $stmt = $conn->prepare("SELECT * FROM users WHERE login = ?");
        $stmt->execute([$email]);

        if ($stmt->rowCount() === 1) {
            $user = $stmt->fetch();
            $user_id = $user['user_id'];
            $user_email = $user['login'];
            $user_password = $user['password'];
            $user_name = $user['name'];
            $user_surname = $user['surname'];
            $user_role = $user['role_as'];

            if ($email === $user_email && password_verify($password, $user_password)) {
                $_SESSION['user_id'] = $user_id;
                $_SESSION['login'] = $user_email;
                $_SESSION['name'] = $user_name;
                $_SESSION['surname'] = $user_surname;
                $_SESSION['role_as'] = $user_role;
                if ($user_role == 0) {
                    header("Location: ../pages/student.php");
                } elseif ($user_role == 1) {
                    header("Location: ../pages/admin.php");
                }
                exit();
            } else {
                header("Location: ../pages/index.php?error=Nieprawidłowe hasło");
                exit();
            }
        } else {
            header("Location: ../pages/index.php?error=Nieprawidłowy email lub hasło");
            exit();
        }
    }
}
?>