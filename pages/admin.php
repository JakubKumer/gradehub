<?php
session_start();
include_once "../scripts/connect.php"; // Include connection script
if (!isset($_SESSION['user_id']) || $_SESSION['role_as'] != 1) {
    header("Location: index.php");
    exit();
}
// Pobranie danych wszystkich studentów
$sql_students = "
    SELECT users.user_id, users.name AS student_name, users.surname AS student_surname, students.class
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
<<<<<<< HEAD
            <a href="../scripts/logout.php">Log out</a>
            <a href="#">Change password</a>
=======
            <a href="#">Log out</a>
            <a href="change_passw.php">Change password</a> <!-- Zaktualizowany link -->
>>>>>>> 2cb5cb08c7f4060e12b8a7840cafbf492e42e10a
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
                                <a href="Admin_marks.php?student_id=<?php echo htmlspecialchars($student['user_id']); ?>">
                                    <button>Marks</button>
                                </a>
                                <a href="edit.php?student_id=<?php echo htmlspecialchars($student['user_id']); ?>">
                                    <button>Edit</button>
                                </a>
                                <a href="delete_student.php?student_id=<?php echo htmlspecialchars($student['user_id']); ?>" onclick="return confirm('Are you sure you want to delete this student?');">
                                    <button>Delete</button>
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
