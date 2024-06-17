<?php
session_start();
include_once "../scripts/connect.php"; // Include connection script


// Pobranie danych wszystkich studentów
$sql_students = "
    SELECT students.student_id, users.name AS student_name, users.surname AS student_surname, students.class
    FROM students
    INNER JOIN users ON students.user_id = users.user_id
";

$stmt_students = $conn->prepare($sql_students);
$stmt_students->execute();
$students = $stmt_students->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GradeEase Hub - Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/admin.css"> <!-- Dodaj link do Twojego pliku CSS -->
</head>
<body>
    <div class="navbar">
        <div class="navbar-brand">GradeEase Hub</div>
        <div class="navbar-links">
            <a href="#">Log out</a>
            <a href="#">Change password</a>
        </div>
    </div>

    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Admin Panel</h1>
        <div>
            <?php if (isset($admin) && is_array($admin)) { ?>
                <h2 class="text-xl mb-2">User: <?php echo htmlspecialchars($admin['name'] . ' ' . $admin['surname']); ?></h2>
            <?php } else { ?>
                <h2 class="text-xl mb-2">User: Unknown</h2>
            <?php } ?>
            <table class="students-table">
                <thead>
                    <tr>
                        <th>Name and Surname</th>
                        <th>Class</th>
                        <th>Options</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($students as $student) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($student['student_name'] . ' ' . $student['student_surname']); ?></td>
                            <td><?php echo htmlspecialchars($student['class']); ?></td>
                            <td class="options">
                                <a href="Admin_marks.php?student_id=<?php echo htmlspecialchars($student['student_id']); ?>">
                                <button>Marks</button>
                                </a>
                                <button>Edit</button>
                                <button>Delete</button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
