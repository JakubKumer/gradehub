<?php
session_start();
include_once "../scripts/connect.php"; // Include connection script

$user_id = $_SESSION['user_id']; // Pobranie user_id z sesji

// Pobranie danych studenta
$sql_student = "
    SELECT users.name, users.surname, students.class
    FROM users
    INNER JOIN students ON users.user_id = students.user_id
    WHERE users.user_id = :user_id
";
$stmt_student = $conn->prepare($sql_student);
$stmt_student->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$stmt_student->execute();
$student = $stmt_student->fetch(PDO::FETCH_ASSOC);

// Pobranie wszystkich przedmiotów i ocen studenta (jeśli są)
$sql_grades = "
    SELECT subjects.subject_name, GROUP_CONCAT(COALESCE(grades.grade_value, 'No Grade') ORDER BY grades.date_of_issuance SEPARATOR ', ') AS grades_list
    FROM subjects
    LEFT JOIN grades ON subjects.subject_id = grades.subject_id AND grades.student_id = (
        SELECT student_id FROM students WHERE user_id = :user_id
    )
    GROUP BY subjects.subject_name
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
    <title>GradeEase Hub - Student Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/student.css"> <!-- Dodaj link do Twojego pliku CSS -->
</head>
<body>
    <div class="navbar">
        <div class="navbar-brand">GradeEase Hub</div>
        <div class="navbar-links">
            <a href="#">Log out</a>
            <a href="change_passw.php">Change password</a> <!-- Zaktualizowany link -->
        </div>
    </div>

    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Student Dashboard</h1>
        <div>
            <h2 class="text-xl mb-2">Student: <?php echo htmlspecialchars($student['name'] . ' ' . $student['surname']); ?>, Class: <?php echo htmlspecialchars($student['class']); ?></h2>
            <table class="table-auto w-full">
                <thead>
                    <tr>
                        <th class="px-4 py-2">Subject</th>
                        <th class="px-4 py-2">Grades</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($grades as $grade) { ?>
                        <tr>
                            <td class="border px-4 py-2"><?php echo htmlspecialchars($grade['subject_name']); ?></td>
                            <td class="border px-4 py-2"><?php echo htmlspecialchars($grade['grades_list']); ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
