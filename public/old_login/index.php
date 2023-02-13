<?php
    require __DIR__.'/../../boot/boot.php';

    use Hotel\User;

    //Check for existing logged user
    if (!empty(User::getCurrentUserId())){
        //Return to HOME page
        header('Location: /');
        die;
    }

    $invalidMessage = (isset($_COOKIE['invalid_credentials']) && $_COOKIE['invalid_credentials']) ? "Please give a valid email and password" : "" ;
    var_dump($invalidMessage);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/login.">
    <script src="https://kit.fontawesome.com/c8c9f21169.js" crossorigin="anonymous"></script>
    <title>Login</title>
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
                        <a href="../index.php">
                            <i class="fas fa-home"></i>
                            Home
                        </a>
                        
                    </li>
                    <li>
                        <a href="../register">
                            <i class="fa-solid fa-user-plus"></i>
                            Register 
                        </a>  
                    </li> 
                </ul>
            </ul>
        </div>
    </header>
    <main class="main-content">
        <section class="hero">
            <form method="post" action="../actions/login.php">
              

                <fieldset id="formLogIn">  
                    <div class="">
                        <p><?=$invalidMessage?></p>
                    </div>
                    <div class="form-group">
                        <input type="email" id="email" name="email" placeholder="Email Address" required>
                    </div>
                    <div class="form-group"> 
                        <input type="password" id="password" name="password" placeholder="Password" required> 
                    </div>
                </fieldset>
              
                    <div class="action">
                        <input name="login" id="loginButton" type="submit" value="Login">
                    </div>
                
                
            </form>
        </section>
    </main>
    <footer>
        <p>(c) Copyright T S.Rates 2022</p>
    </footer>
   
    
</body>
</html>