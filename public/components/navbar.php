<?php
use Hotel\User;
?>

<!-- NAvbar Section Start -->
<header>
        <div class="container">
            <div class="header-content">
                <div class="main-logo">
                    <span>Hotels</span>
                </div>
                <ul class="main-navigation">           
                    <li class="main-navigation__home">
                        <a href="../index.php">
                            <i class="fas fa-home"></i>
                            Home
                        </a>  
                    </li>
                    <?php 
                            //Check for existing logged user
                            if (empty($userId)){
                          
                        ?>
                        <li>
                            <a href="../register">
                                <i class="fa-solid fa-user-plus"></i>
                                Register 
                            </a>  
                        </li> 
                        <li>
                            <a href="../login">
                                <i class="fa-solid fa-right-to-bracket"></i>
                                Login 
                            </a>  
                        </li> 
                        <?php
                            } else {
                        ?>
                         <li>
                            <a href="../profile">
                                <i class="fa-solid fa-user"></i>
                                Profile
                            </a>  
                        </li>    
                        <li>
                            <form action="../actions/logout.php" method="post" name="logoutForm" id="logoutForm" >
                                <input type="hidden" name="csrf" value="<?=(!empty(User::getCurrentUserId()))?User::getCsrf():""?>"> 
                                <a href="#" onclick="submit();return false;">
                                    <i class="fa-solid fa-right-to-bracket"></i>
                                    Logout 
                                </a> 
                            </form> 
                        </li> 
                        <?php        
                            }
                        ?>        
                </ul>
            </div> 
        </div>
    </header>
    <!-- Navbar Section End -->