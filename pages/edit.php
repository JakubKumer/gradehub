<?php
session_start();
include_once "../scripts/connect.php"; // Include connection script

// Sprawdzenie, czy użytkownik jest zalogowany
if (!isset($_SESSION['id_user'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_GET['student_id']; // Pobranie student_id z parametru GET

// Pobranie danych użytkownika
$sql_student = "
    SELECT users.name, users.surname, users.login, students.class
    FROM users
    INNER JOIN students ON users.user_id = students.user_id
    WHERE users.user_id = :user_id
";
$stmt_student = $conn->prepare($sql_student);
$stmt_student->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$stmt_student->execute();
$student = $stmt_student->fetch(PDO::FETCH_ASSOC);

// Przetwarzanie formularza po jego wysłaniu
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $login = $_POST['login'];
    $password = $_POST['password'];
    $class = $_POST['class'];

    // Aktualizacja danych użytkownika
    $sql_update_user = "
        UPDATE users
        SET name = :name, surname = :surname, login = :login, password = :password
        WHERE user_id = :user_id
    ";
    $stmt_update_user = $conn->prepare($sql_update_user);
    $stmt_update_user->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt_update_user->bindParam(':surname', $surname, PDO::PARAM_STR);
    $stmt_update_user->bindParam(':login', $login, PDO::PARAM_STR);
    $stmt_update_user->bindParam(':password', $password, PDO::PARAM_STR); // Pamiętaj, aby hasło było bezpiecznie hashowane!
    $stmt_update_user->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt_update_user->execute();

    // Aktualizacja danych studenta
    $sql_update_student = "
        UPDATE students
        SET class = :class
        WHERE user_id = :user_id
    ";
    $stmt_update_student = $conn->prepare($sql_update_student);
    $stmt_update_student->bindParam(':class', $class, PDO::PARAM_STR);
    $stmt_update_student->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt_update_student->execute();

    // Przekierowanie z powrotem do panelu admina po zapisaniu zmian
    header("Location: admin.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User - GradeEase Hub</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/student.css"> <!-- Dodaj link do Twojego pliku CSS -->
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
        <h1 class="text-2xl font-bold mb-4">Edit User</h1>
        <div>
            <h2 class="text-xl mb-2">Student: <?php echo htmlspecialchars($student['name'] . ' ' . $student['surname']); ?>, Class: <?php echo htmlspecialchars($student['class']); ?></h2>
            <form action="edit.php?student_id=<?php echo htmlspecialchars($user_id); ?>" method="POST">
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name:</label>
                    <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($student['name']); ?>" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="mb-4">
                    <label for="surname" class="block text-gray-700 text-sm font-bold mb-2">Surname:</label>
                    <input type="text" id="surname" name="surname" value="<?php echo htmlspecialchars($student['surname']); ?>" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="mb-4">
                    <label for="login" class="block text-gray-700 text-sm font-bold mb-2">Login:</label>
                    <input type="text" id="login" name="login" value="<?php echo htmlspecialchars($student['login']); ?>" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password:</label>
                    <input type="password" id="password" name="password" value="12345" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="mb-4">
                    <label for="class" class="block text-gray-700 text-sm font-bold mb-2">Class:</label>
                    <select id="class" name="class" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <?php for ($i = 1; $i <= 8; $i++) { ?>
                            <option value="<?php echo $i; ?>" <?php echo ($student['class'] == $i) ? 'selected' : ''; ?>><?php echo $i; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="flex items-center justify-between">
                <button class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Save</button>
                <a href="admin.php" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
