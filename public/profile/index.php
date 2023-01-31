<?php

require __DIR__.'/../../boot/boot.php';
    
use Hotel\User;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/c8c9f21169.js" crossorigin="anonymous"></script>
    <script src="script.js"></script>
    <title>List</title>
</head>
<body>
    <!-- NAvbar Section Start -->
    <header>
        <div class="container">
            <div class="header-content">
                <div class="main-logo">
                    <span>Hotels</span>
                </div>
                <ul class="main-navigation">           
                    <li class="main-navigation__home">
                        <a href="../">
                            <i class="fas fa-home"></i>
                            Home
                        </a>  
                    </li>
                    <?php 
                            //Check for existing logged user
                            if (empty(User::getCurrentUserId())){
                          
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

   
    <main>
        <div class="container">
            <!-- Hotel Reviews & Favorites Start -->
            <aside class="hotel-reviews box">
                    <header>
                        <p>
                           Favorites
                        </p>
                       
                       
                    </header>
                    <div class="hotel-name">
                        <span>1.</span>   
                        <span>Michelangello </span> 
                    </div>
                    <header>
                        <p>
                           Reviews
                        </p>
                       
                    </header>
                    <div class="star-rating">
                        <div class="hotel-name">
                            <span>1.</span> 
                            <span> <p>Michelangello</p> 
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                            </span>  
                        </div>
                        
                    </div>
                
            </aside>
            <!-- Hotel Reviews & Favorites End-->

            <!-- Hotel List Start -->
            <section class="box hotel-list">
                <header class="hotel-list__title">
                    <h2>Search Results</h2>
                </header>

                <article>
                    <div class="hotel-list__hotel">
                   
                        <aside class="hotel-list__hotel__media">
                            <img src="../assets/images/rooms/room-1.jpg" alt="room-1" width="100%" height="auto">
                        </aside>
                        <div class="hotel-list__hotel__info">
                            <h1>Hotel Title</h1>
                            <h2>Location</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Mi bibendum neque egestas congue quisque. </p>
                            <div class="button-right">
                                <button>
                                    <a href="">Go to room page</a>
                                </button>
                            </div>
                        </div> 
                  
                    </div>
                    <div class="hotel-list__hotel__info__room">
                        
                        <div class="room-price">
                            <span>Total Cost: 500</span> 
                        </div>
                        <div class="room-details">
                            <div class="room-details__text">
                                <span>Check-in Date: 2018-04-27</span>
                            </div>
                            <div class="room-details__text">
                                <span>Check-in Date: 2018-04-30</span>
                            </div>
                            <div class="room-details__text">
                                <span>Type pf room: Double Room</span>
                            </div>
                       
                        </div>
                    </div>
                </article>
                
                  
            </section>
            
            <!-- Hotel List End -->
        </div>
     
    </main>
    <footer>
        <p>(c) Copyright T S.Rates 2022</p>
    </footer>
</body>
</html>