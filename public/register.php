<?php
    require __DIR__.'/../boot/boot.php';

    use Hotel\User;

    //Cehck for existing logged user
    if (!empty(User::getCurrentUserId())){
        //Return to HOME page
        header('Location: /');
        die;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/register.css">
    <script src="https://kit.fontawesome.com/c8c9f21169.js" crossorigin="anonymous"></script>
    <title>Register</title>
</head>
<body>
    <header>
        <div class="container">
            <div class="main-logo">
                <span>Hotels</span>
            </div>
            <ul class="main-navigation">
                <ul>
                    <li class="main-navigation_home">
                        <a href="index.php">
                            <i class="fas fa-home"></i>
                            Home
                        </a>
                        
                    </li>
                    <li>
                        <a href="login.php">
                            <i class="fa-solid fa-right-to-bracket"></i>
                            Login 
                        </a>  
                    </li> 
                </ul>
            </ul>
        </div>
    </header>
    <main class="main-content">
        <section class="hero">
            <form method="post" action="../actions/register.php">
              

                <fieldset id="formRegister">
                    <div class="form-group"> 
                        <input type="text" id="username" name="username" placeholder="Name" required>
                    </div>
                    <div class="form-group">
                        <input type="email" id="email" name="email" placeholder="Email Address" required>
                    </div>
                    <div class="form-group"> 
                        <input type="password" id="password" name="password" placeholder="Password" required>
                    </div>
                    <div class="form-group"> 
                        <input type="password" id="rePassword" name="rePassword" placeholder="Repeat Password" required>
                    </div>
                </fieldset>
              
                    <div class="action">
                        <input name="register" id="registerButton" type="submit" value="Register">
                    </div>
                
                
            </form>
        </section>
    </main>
    <footer>
        <p>(c) Copyright T S.Rates 2022</p>
    </footer>
   
    
</body>
</html>