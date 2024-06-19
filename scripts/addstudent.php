<?php
session_start();
$errors = [];
$successMessage = "";

if (isset($_POST["submit"])) {
    $fine = true;
    $login = $_POST['login'];
    $password1 = $_POST['password1'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $class = $_POST['class'];

    // Data sanitization and validation
    if (strlen($firstName) < 3 || strlen($firstName) > 20) {
        $fine = false;
        $errors[] = "Imię musi zawierać od 3 do 20 znaków.";
    }

    if (!ctype_alnum($firstName)) {
        $fine = false;
        $errors[] = "Imię musi zawierać tylko litery (bez polskich znaków).";
    }

    if (!ctype_alnum($lastName)) {
        $fine = false;
        $errors[] = "Nazwisko musi składać się z liter (bez polskich znaków).";
    }

    if (strlen($password1) < 8) {
        $fine = false;
        $errors[] = "Hasło musi zawierać przynajmniej 8 znaków.";
    }

    // Hash the password
    $passwordHash = password_hash($password1, PASSWORD_DEFAULT);

    require_once "connect.php";

    try {
        $conn->beginTransaction();

        // Check if login exists
        $stmt = $conn->prepare("SELECT login FROM users WHERE login = :login");
        $stmt->bindParam(':login', $login);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $fine = false;
            $errors[] = "Podany login jest zajęty.";
        }

        if ($fine) {
            // Insert new user
            $stmt = $conn->prepare("INSERT INTO users (login, password, name, surname) VALUES (:login, :password, :firstname, :lastname)");
            $stmt->bindParam(':login', $login);
            $stmt->bindParam(':password', $passwordHash);
            $stmt->bindParam(':firstname', $firstName);
            $stmt->bindParam(':lastname', $lastName);

            if ($stmt->execute()) {
                // Get the last inserted user_id
                $userId = $conn->lastInsertId();

                // Insert into students table
                $stmt = $conn->prepare("INSERT INTO students (user_id, class) VALUES (:user_id, :class)");
                $stmt->bindParam(':user_id', $userId);
                $stmt->bindParam(':class', $class);

                if ($stmt->execute()) {
                    $conn->commit();
                    $_SESSION['success'] = "Rejestracja zakończona sukcesem. Możesz się zalogować.";
                    header('Location: ../pages/addstudent.php');
                    exit();
                } else {
                    throw new Exception("Insert into students failed");
                }
            } else {
                throw new Exception("Insert into users failed");
            }
        } else {
            $conn->rollBack();
        }
    } catch (PDOException $e) {
        $conn->rollBack();
        $errors[] = 'Ups, coś poszło nie tak!';
        // Optional: Log the error message for debugging
        // error_log($e->getMessage());
    }
}

if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
    header('Location: ../pages/addstudent.php');
    exit();
}
?>
