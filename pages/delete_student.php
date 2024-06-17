<?php
session_start();
include_once "../scripts/connect.php"; // Include connection script

if (isset($_GET['student_id'])) {
    $student_id = $_GET['student_id'];

    // Usunięcie studenta z bazy danych
    $sql_delete_student = "
        DELETE FROM students WHERE user_id = :student_id;
        DELETE FROM users WHERE user_id = :student_id;
    ";
    $stmt_delete_student = $conn->prepare($sql_delete_student);
    $stmt_delete_student->bindParam(':student_id', $student_id, PDO::PARAM_INT);

    if ($stmt_delete_student->execute()) {
        // Przekierowanie do panelu admina po usunięciu studenta
        header("Location: admin.php");
        exit();
    } else {
        echo "Error deleting student.";
    }
} else {
    echo "Invalid student ID.";
}
?>
