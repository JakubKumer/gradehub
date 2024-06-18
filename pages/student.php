<?php
session_start();
include_once "../scripts/connect.php"; // Include connection script

// Check if the user is logged in
if (!isset($_SESSION['user_id']) || $_SESSION['role_as'] != 0) {
    header("Location: index.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch student data
$sql_student = "
    SELECT users.name, users.surname
    FROM users
    INNER JOIN students ON users.user_id = students.user_id
    WHERE users.user_id = :user_id
";
$stmt_student = $conn->prepare($sql_student);
$stmt_student->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$stmt_student->execute();
$student = $stmt_student->fetch(PDO::FETCH_ASSOC);

// Fetch all subjects and student grades (if any)
$sql_grades = "
    SELECT subjects.subject_name, COALESCE(grades.grade_value, 'No Grade') AS grade_value
    FROM subjects
    LEFT JOIN grades ON subjects.subject_id = grades.subject_id
    LEFT JOIN students ON grades.student_id = students.student_id
    AND students.user_id = :user_id
";
$stmt_grades = $conn->prepare($sql_grades);
$stmt_grades->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$stmt_grades->execute();
$grades = $stmt_grades->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GradeEase Hub - Student Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/student.css"> <!-- Dodaj link do Twojego pliku CSS -->
</head>
<body>
<div class="navbar">
        <div class="navbar-brand">GradeEase Hub</div>
        <div class="navbar-links">
            <a href="../scripts/logout.php">Log out</a>
            <a href="#">Change password</a>
        </div>
    </div>
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Panel Studenta</h1>
        <div>
            <h2 class="text-xl mb-2">Student: <?php echo htmlspecialchars($student['name'] . ' ' . $student['surname']); ?>, Class: <?php echo htmlspecialchars($student['class']); ?></h2>
            <table class="table-auto w-full">
                <thead>
                    <tr>
                        <th class="px-4 py-2">Subject</th>
                        <th class="px-4 py-2">Grade</th>
                    </tr>
                </thead>
                <tbody id="grades-list">
                    <?php foreach ($grades as $grade) { ?>
                        <tr>
                            <td class="border px-4 py-2"><?php echo htmlspecialchars($grade['subject_name']); ?></td>
                            <td class="border px-4 py-2"><?php echo htmlspecialchars($grade['grade_value']); ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
