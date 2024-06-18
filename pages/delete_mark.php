<?php
session_start();
include_once "../scripts/connect.php"; // Include connection script

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $user_id = $_GET['student_id'];
    $subject_id = $_GET['subject_id'];

    // Delete the latest grade in the grades table
    $sql_delete_grade = "
        DELETE FROM grades
        WHERE grade_id = (
            SELECT grade_id
            FROM (
                SELECT grade_id
                FROM grades
                WHERE student_id = (SELECT student_id FROM students WHERE user_id = :user_id)
                AND subject_id = :subject_id
                ORDER BY date_of_issuance DESC
                LIMIT 1
            ) AS temp_table
        )
    ";
    $stmt_delete_grade = $conn->prepare($sql_delete_grade);
    $stmt_delete_grade->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt_delete_grade->bindParam(':subject_id', $subject_id, PDO::PARAM_INT);

    if ($stmt_delete_grade->execute()) {
        // Redirect back to admin_marks.php after successful deletion
        header("Location: admin_marks.php?student_id=$user_id");
        exit();
    } else {
        // Handle error if grade deletion fails
        echo "Error deleting grade.";
    }
}
?>
