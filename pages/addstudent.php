<?php
session_start();
$errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : [];
$successMessage = isset($_SESSION['success']) ? $_SESSION['success'] : "";
unset($_SESSION['errors']);
unset($_SESSION['success']);
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/addstudent.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://www.google.com/recaptcha/api.js"></script>
    <title>Rejestracja</title>
</head>
<body>

    <div class="container">
        <?php if(!empty($errors)){?>
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 w-auto m-auto lg:w-1/3" role="alert">
                <p class="font-bold">Błąd</p>
                <ul><?php foreach($errors as $error){?>
                   <li> <?php echo $error; ?> <?php } ?></li>
                </ul>
            </div>  
       <?php }
        ?>
        <?php if (!empty($successMessage)) { ?>
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 w-auto m-auto lg:w-1/3" role="alert">
                <p class="font-bold">Sukces</p>
                <p><?php echo $successMessage; ?></p>
            </div>
        <?php } ?>
        <div class="box m-auto ">
            <span class="borderLine"></span>
            <form method="POST" action="../scripts/addstudent.php" autocomplete="off">
                <h1>Rejestracja</h1>
                <div class="inputBox">                   
                    <input type="text" name="login" id="login">
                    <span>Nazwa użytkownika</span>
                    <i class="fa-solid fa-envelope"></i>
                </div>
                <div class="inputBox">                    
                    <input type="password" name="password1" id="password1">
                    <span>Hasło</span>
                    <i class="fa-solid fa-lock"></i>
                </div>
                <div class="inputBox">
                    <input type="text" name="firstName" id="firstName">
                    <span>Imię</span>
                    <i class="fa-solid fa-user"></i>                    
                </div>
                <div class="inputBox">                    
                    <input type="text" name="lastName" id="lastName">
                    <span>Nazwisko</span>
                    <i class="fa-solid fa-user"></i>
                </div> 
                <label for="class" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Klasa</label>
                <select id="class" name="class" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option selected>Wybierz klase</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                </select>              
                <input type="submit" name="submit" id="submit" value="Dodaj">                
            </form>    
        </div>
    </div>
</body>
</html>