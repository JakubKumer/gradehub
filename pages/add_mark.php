<?php
session_start();
include_once "../scripts/connect.php"; // Include connection script

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Handle form submission to add grade
    $user_id = $_POST['user_id'];
    $subject_id = $_POST['subject_id'];
    $grade_value = $_POST['grade_value'];

    // Insert grade into grades table
    $sql_insert_grade = "
        INSERT INTO grades (student_id, subject_id, grade_value, date_of_issuance)
        VALUES (
            (SELECT student_id FROM students WHERE user_id = :user_id),
            :subject_id,
            :grade_value,
            CURDATE()
        )
    ";
    $stmt_insert_grade = $conn->prepare($sql_insert_grade);
    $stmt_insert_grade->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt_insert_grade->bindParam(':subject_id', $subject_id, PDO::PARAM_INT);
    $stmt_insert_grade->bindParam(':grade_value', $grade_value, PDO::PARAM_STR);
    
    if ($stmt_insert_grade->execute()) {
        // Redirect back to admin_marks.php after successful insertion
        header("Location: admin_marks.php?student_id=$user_id");
        exit();
    } else {
        // Handle error if grade insertion fails
        echo "Error adding grade.";
    }
}

// Get student_id and subject_id from URL parameters
$user_id = $_GET['student_id'];
$subject_id = $_GET['subject_id'];

// Fetch student details
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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GradeEase Hub - Add Mark</title>
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
        <h1 class="text-2xl font-bold mb-4">Add Mark</h1>
        <div>
            <h2 class="text-xl mb-2">Student: <?php echo htmlspecialchars($student['name'] . ' ' . $student['surname']); ?>, Class: <?php echo htmlspecialchars($student['class']); ?></h2>
            <form action="add_mark.php" method="POST">
                <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($user_id); ?>">
                <input type="hidden" name="subject_id" value="<?php echo htmlspecialchars($subject_id); ?>">
                <div class="mb-4">
                    <label for="grade_value" class="block text-sm font-medium text-gray-700">Grade</label>
                    <select id="grade_value" name="grade_value" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                    </select>
                </div>
                <input type="submit" value="Add" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
            </form>
        </div>
    </div>
</body>
</html>
