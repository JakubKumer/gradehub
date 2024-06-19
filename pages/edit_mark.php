<?php
session_start();
include_once "../scripts/connect.php"; // Include connection script

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_POST['user_id'];
    $subject_id = $_POST['subject_id'];
    $new_grade_value = $_POST['new_grade_value'];

    // Update the latest grade in the grades table
    $sql_update_grade = "
        UPDATE grades
        SET grade_value = :new_grade_value
        WHERE grade_id = (
            SELECT grade_id
            FROM grades
            WHERE student_id = (SELECT student_id FROM students WHERE user_id = :user_id)
            AND subject_id = :subject_id
            ORDER BY date_of_issuance DESC
            LIMIT 1
        )
    ";
    $stmt_update_grade = $conn->prepare($sql_update_grade);
    $stmt_update_grade->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt_update_grade->bindParam(':subject_id', $subject_id, PDO::PARAM_INT);
    $stmt_update_grade->bindParam(':new_grade_value', $new_grade_value, PDO::PARAM_STR);

    if ($stmt_update_grade->execute()) {
        // Redirect back to admin_marks.php after successful update
        header("Location: admin_marks.php?student_id=$user_id");
        exit();
    } else {
        // Handle error if grade update fails
        echo "Error updating grade.";
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

// Fetch last grade details
$sql_last_grade = "
    SELECT grade_value
    FROM grades
    WHERE student_id = (SELECT student_id FROM students WHERE user_id = :user_id)
    AND subject_id = :subject_id
    ORDER BY date_of_issuance DESC
    LIMIT 1
";
$stmt_last_grade = $conn->prepare($sql_last_grade);
$stmt_last_grade->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$stmt_last_grade->bindParam(':subject_id', $subject_id, PDO::PARAM_INT);
$stmt_last_grade->execute();
$last_grade = $stmt_last_grade->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GradeEase Hub - Edit Mark</title>
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
        <h1 class="text-2xl font-bold mb-4">Edit Mark</h1>
        <div>
            <h2 class="text-xl mb-2">Student: <?php echo htmlspecialchars($student['name'] . ' ' . $student['surname']); ?>, Class: <?php echo htmlspecialchars($student['class']); ?></h2>
            <form action="edit_mark.php" method="POST">
                <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($user_id); ?>">
                <input type="hidden" name="subject_id" value="<?php echo htmlspecialchars($subject_id); ?>">
                <div class="mb-4">
                    <label for="new_grade_value" class="block text-sm font-medium text-gray-700">Grade</label>
                    <select id="new_grade_value" name="new_grade_value" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="1" <?php if ($last_grade['grade_value'] == '1') echo 'selected'; ?>>1</option>
                        <option value="2" <?php if ($last_grade['grade_value'] == '2') echo 'selected'; ?>>2</option>
                        <option value="3" <?php if ($last_grade['grade_value'] == '3') echo 'selected'; ?>>3</option>
                        <option value="4" <?php if ($last_grade['grade_value'] == '4') echo 'selected'; ?>>4</option>
                        <option value="5" <?php if ($last_grade['grade_value'] == '5') echo 'selected'; ?>>5</option>
                        <option value="6" <?php if ($last_grade['grade_value'] == '6') echo 'selected'; ?>>6</option>
                    </select>
                </div>
                <div class="flex items-center justify-between">
                    <input type="submit" value="Update Grade" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                </div>
            </form>
        </div>
    </div>
</body>
</html>
