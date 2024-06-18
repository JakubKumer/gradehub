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
    <link rel="stylesheet" href="../css/login2.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <h1>BidHub</h1>
        <?php if(isset($_GET['error'])){?>
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 w-auto m-auto lg:w-1/3 " role="alert">
                <p class="font-bold">Błąd</p>
                <p><?php echo $_GET['error'];?></p>
            </div>
            
       <?php }
        
        ?>
        <div class="box m-auto">
            <span class="borderLine"></span>
            <form action="../scripts/login.php" method="POST" autocomplete="off">
                <h2>Logowanie</h2>
                
                <div class="inputBox">
                    <input type="text" name="login" id="login">
                    <span>login</span>
                    <i class="fa-solid fa-user"></i>
                </div>
                <div class="inputBox">
                    <input type="password" name="password1" id="password1">
                    <span>hasło</span>
                    <i class="fa-solid fa-lock"></i>
                </div>
                <input type="submit" value="Zaloguj" name="submit" id="submit">
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