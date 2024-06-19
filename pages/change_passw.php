<?php
session_start();
include_once "../scripts/connect.php"; // Include connection script

$user_id = $_SESSION['user_id']; // Pobranie user_id z sesji

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Sprawdzenie poprawności aktualnego hasła
    $sql_check_password = "
        SELECT password
        FROM users
        WHERE user_id = :user_id
    ";
    $stmt_check_password = $conn->prepare($sql_check_password);
    $stmt_check_password->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt_check_password->execute();
    $user = $stmt_check_password->fetch(PDO::FETCH_ASSOC);

    if (password_verify($current_password, $user['password'])) {
        // Sprawdzenie zgodności nowego hasła z potwierdzeniem
        if ($new_password === $confirm_password) {
            // Zaktualizowanie hasła w bazie danych
            $new_password_hashed = password_hash($new_password, PASSWORD_DEFAULT);
            $sql_update_password = "
                UPDATE users
                SET password = :new_password
                WHERE user_id = :user_id
            ";
            $stmt_update_password = $conn->prepare($sql_update_password);
            $stmt_update_password->bindParam(':new_password', $new_password_hashed, PDO::PARAM_STR);
            $stmt_update_password->bindParam(':user_id', $user_id, PDO::PARAM_INT);

            if ($stmt_update_password->execute()) {
                echo "Password changed successfully.";
            } else {
                echo "Error updating password.";
            }
        } else {
            echo "New password and confirmation do not match.";
        }
    } else {
        echo "Current password is incorrect.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GradeEase Hub - Change Password</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/student.css"> <!-- Dodaj link do Twojego pliku CSS -->
</head>
<body>
    <div class="navbar">
    <div class="navbar-brand">
            <a href="admin.php" class="text-white">GradeEase Hub</a>
        </div>
        <div class="navbar-links">
            <a href="addstudent.php">Add student</a>
            <a href="../scripts/logout.php">Log out</a>
            <a href="change_passw.php">Change password</a> <!-- Zaktualizowany link -->
        </div>
    </div>

    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Change Password</h1>
        <form action="change_passw.php" method="POST">
            <div class="mb-4">
                <label for="current_password" class="block text-sm font-medium text-gray-700">Current Password</label>
                <input type="password" id="current_password" name="current_password" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
            </div>
            <div class="mb-4">
                <label for="new_password" class="block text-sm font-medium text-gray-700">New Password</label>
                <input type="password" id="new_password" name="new_password" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
            </div>
            <div class="mb-4">
                <label for="confirm_password" class="block text-sm font-medium text-gray-700">Confirm New Password</label>
                <input type="password" id="confirm_password" name="confirm_password" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
            </div>
            <div class="flex items-center justify-between">
                <input type="submit" value="Change Password" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
            </div>
        </form>
    </div>
</body>
</html>
