<?php

require __DIR__.'/../boot/boot.php';
    
use Hotel\User;
use Hotel\Room;
use Hotel\Favorite;
use Hotel\Review;
use Hotel\Booking;

$userId = User::getCurrentUserId();
//print_r($userId);die;
//If there is NO logged User return to main
if (empty($userId)) {
    header('Location: /');
    return;
} 

//Get all favorite rooms
$favorite = new Favorite();
$favorites = $favorite->getListByUser($userId);

//Get all reviewd rooms
$review = new Review();
$reviews = $review->getReviewsByUser($userId);

//Get all user Bookings
$booking = new Booking();
$bookings = $booking->getBookingsByUser($userId);
//print_r($bookings);die;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/profile.css">
    <script src="https://kit.fontawesome.com/c8c9f21169.js" crossorigin="anonymous"></script>
    <script src="assets/js/profile.js"></script>
    <title>List</title>
</head>
<body>

    <!--Move to top button-->
    <button onclick="goToTop()" id="goToTopBtn" title="Go to top">Top</button>  
    
    <!-- NAvbar Section Start -->
<header>
        <div class="container">
            <div class="header-content">
                <div class="main-logo">
                    <span>Hotels</span>
                </div>
                <ul class="main-navigation">           
                    <li class="main-navigation__home">
                        <a href="index.php">
                            <i class="fas fa-home"></i>
                            Home
                        </a>  
                    </li>
                    <?php 
                            //Check for existing logged user
                            if (empty($userId)){
                          
                        ?>
                        <li>
                            <a href="register.php">
                                <i class="fa-solid fa-user-plus"></i>
                                Register 
                            </a>  
                        </li> 
                        <li>
                            <a href="login.php">
                                <i class="fa-solid fa-right-to-bracket"></i>
                                Login 
                            </a>  
                        </li> 
                        <?php
                            } else {
                        ?>   
                        <li>
                            <form action="actions/logout.php" method="post" name="logoutForm" id="logoutForm" >
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
   
    <main>
        <div class="container">
            <!-- Hotel Reviews & Favorites Start -->
            <aside class="profile-hotels box">

                <div class="profile-favorites">
                    <h4>
                        Favorites      
                    </h4>
                    <?php
                        if (count($favorites) > 0) {
                            # code...
                        
                    ?>
                    <ol>
                        <?php 
                            foreach ($favorites as $key => $favoriteRoom) {
                                # code...
                        ?>
                        <li>
                
                                <a href="room.php?room_id=<?=$favoriteRoom['room_id']?>"><?=htmlentities($favoriteRoom['name'])?></a>
                        </li>
                        <?php 
                            }
                        ?>
                    <?php 
                        }else{
                    ?>
                    <h4 class="alert">You don't have any favorite Hotel</h4>
                    <?php         
                        }    
                    ?>
                    
                </div>
                <div class="profile-reviews">
                    <h4>
                        Reviews
                    </h4>
                        <div class="hotel-name">
                    <?php
                    if (count($reviews) > 0) {
                        # code...
                        
                    ?>
                    <ol>
                        <?php 
                            foreach ($reviews as $key => $reviewedRoom) {
                                # code...
                        ?>
                        <li>
                            <a href="room.php?room_id=<?=$reviewedRoom['room_id']?>"><?=htmlentities($reviewedRoom['name'])?></a>
                                <div> 
                                    <?php
                                        $roomAvgRview = $reviewedRoom['rate'];
                                        for ($i=1; $i <= 5; $i++) { 
                                            if ($roomAvgRview >= $i){
                                    ?>  
                                        <span class="fa fa-star checked"></span>
                                    <?php 
                                            }else{
                                    ?>
                                        <span class="fa fa-star"></span>
                                    <?php     
                                            }                       
                                        }
                                    ?>
                                </div>  
                            </li>
                        <?php 
                            }
                        ?>
                    <?php 
                        }else{
                    ?>
                    <h4 class="alert">You made any reviews yet</h4>
                    <?php         
                        }    
                    ?>
                        </div>   
                </div>  
            </aside>
            <!-- Hotel Reviews & Favorites End-->

            <!-- Hotel List Start -->
            <section class="box hotel-list">
                <header class="hotel-list__title">
                    <h2>My Bookings</h2>
                </header>
                <?php
                foreach ($bookings as $bookedRoom) {
                ?>
                <article>
                    <div class="hotel-list__hotel">
                        
                        <aside class="hotel-list__hotel__media">
                            <img src="assets/images/rooms/<?=$bookedRoom['photo_url']?>" alt="room-<?=$bookedRoom['photo_url']?>" width="100%" height="auto">
                        </aside>
                        <div class="hotel-list__hotel__info">
                            <h1><?=htmlentities($bookedRoom['name'])?></h1>
                            <h2><?=htmlentities($bookedRoom['city'])?>, <?=htmlentities($bookedRoom['area'])?></h2>
                            <p><?=htmlentities($bookedRoom['description_short'])?></p>
                            <div class="button-right">
                                <button>
                                    <a href="room.php?room_id=<?=$bookedRoom['room_id']?>">Go to room page</a>
                                </button>
                            </div>
                        </div> 
                        
                    </div>
                    <div class="hotel-list__hotel__info__room">
                        
                            <div class="room-price">
                                <span>Total Cost: <?=htmlentities($bookedRoom['total_price'])?></span> 
                            </div>
                            <div class="room-details">
                                <div class="room-details__text">
                                    <span>Check-in Date: <?=htmlentities($bookedRoom['check_in_date'])?></span>
                                </div>
                                <div class="room-details__text">
                                    <span>Check-in Date: <?=htmlentities($bookedRoom['check_out_date'])?></span>
                                </div>
                                <div class="room-details__text">
                                    <span>Type pf room: <?=htmlentities($bookedRoom['room_type'])?></span>
                                </div>
                            </div>
                        </div>
                </article>
                <?php 
                    }
                ?>
                <?php
                    if (count($bookings) == 0) {
                ?>
                    <h4>You haven't made any bookings yet</h4>
                <?php
                    }
                ?>
            </section>
            
            <!-- Hotel List End -->
        </div>
    </main>
    <footer>
        <p>(c) Copyright T S.Rates 2022</p>
    </footer>
</body>
</html>