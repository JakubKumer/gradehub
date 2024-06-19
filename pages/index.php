<?php 
session_start();
if(!isset($_SESSION['user_id'])){
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/login.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    <div class="navbar">
        <h1>GradeEase Hub</h1>
    </div>
    <div class="container">
        <?php if(isset($_GET['error'])){?>
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 w-auto m-auto lg:w-1/3 " role="alert">
                <p class="font-bold">Błąd</p>
                <p><?php echo $_GET['error'];?></p>
            </div>
       <?php } ?>
        <div class="box">
            <form action="../scripts/login.php" method="POST" autocomplete="off">
                <h2>Log in</h2>
                <div class="inputBox">
                    <input type="text" name="login" id="login" required>
                    <span>Username:</span>
                </div>
                <div class="inputBox">
                    <input type="password" name="password1" id="password1" required>
                    <span>Password:</span>
                </div>
                <input type="submit" value="Log in" name="submit" id="submit">
            </form>
        </div>
    </div>
</body>
</html>
<?php
}else{
    header("Location: student.php");
}
?>
