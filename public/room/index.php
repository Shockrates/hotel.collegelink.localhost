<?php
    require __DIR__.'/../../boot/boot.php';

    use Hotel\User;
    use Hotel\Room;
    use Hotel\Favorite;
    use Hotel\Review;


    //Initialize Room and Favorite service
    $room = new Room();
    $favorite = new Favorite();
    $review = new Review();
  

    //Check for Room id
    $roomId = $_REQUEST['room_id'];
    if (empty($roomId)) {
        header('Location: ../index.php');
        return;
    }

    //Load Romm info or redirect
    $roomInfo = $room->get($roomId);
    if (empty($roomInfo)) {
        header('Location: ../index.php');
        return;
    }

    //Get current User id
    $userId  = User::getCurrentUserId();
  
    // Check if Favorite
    $isFavorite = $favorite->isFavorite($roomId, $userId);

    //Load all room reviews
    $roomReviews = $review->getReviewsByRoom($roomId);
    

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
    <title>Document</title>
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
                        <a href="../index.php">
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
            <div class="room">

                <!-- Room data Section Start-->
                <div class="room-details">
                    <div class="room-details-left">
                        <!-- <div class="room-name">
                            
                        </div>
                        <div>
                        ~
                        </div>
                       
                        <div class="room-address">
                            Town, Area
                        </div> -->
                        <div class="room-hotel-info">
                            <?=sprintf('%s  ~  %s, %s ', $roomInfo['name'], $roomInfo['city'], $roomInfo['area'])?>
                        </div>
                        <div class="rating-reviews">
                            <span>Reviews:</span>
                            <ul class="star-reviews">
                            <?php
                                $roomAvgRview = $roomInfo['avg_reviews'];
                                for ($i=1; $i <= 5; $i++) { 
                                   if ($roomAvgRview >= $i){
                            ?>  
                              <li class="fa fa-star is-active"></li>
                            <?php 
                                   }else{
                            ?>
                                <li class="fa fa-star"></li>
                            <?php     
                                 }                       
                                }
                            ?>
                              
                            </ul>
                        </div>
                        <div class="favorites">
                            <form class="favorite" name="favorite" id="favorite" action="../actions/favorite.php" method="post">
                                <input type="hidden" name="room_id" value="<?=$roomId?>">
                                <input type="hidden" name="is_favorite" value="<?=($isFavorite) ? '1' : '0';?>">
                                <i class="fa fa-heart <?=($isFavorite) ? 'is-favorite' : '';?>" onclick="submitFavorite();return false;"></i>
                            </form>
                            
                        </div>
                    </div>
                    <div class="room-details-right">
                        <div class="price">
                            Per night: <?=$roomInfo['price']?>
                        </div>
                    </div>
                </div>
                 <!-- Room data Section End-->

                <!-- Room Image Section Start -->
                <div class="room-image">
                    <img src="../assets/images/rooms/room-1.jpg" alt="room-1">
                </div>
                <!-- Room Image Section End -->

                <!--More Room Details Section Start-->
                <div class="room-details">
                    <div class="room-data">
                        <i class="fi fi-ss-users-alt"> <?=$roomInfo['count_of_guests']?></i>
                        <p>COUNT OF GUESTS</p>
                    </div>
                    <div class="room-data">
                   
                        <i class="fi fi-ss-bed"> <?=$roomInfo['room_id']?></i>
                        <p>TYPE OF ROOM</p>
                     </div>
                     <div class="room-data">
                        <i class="fi fi-ss-garage-car"><?=$roomInfo['parking']?></i>
                        <p>PARKING</p>
                     </div>
                     <div class="room-data">
                        <!-- <i class="fa-solid fa-signal fa-lg"> </i> -->
                        <i class="fi fi-ss-signal-alt-2"> <?=( $roomInfo['wifi']) ? 'Yes' : 'No' ;?></i>
                        <p>WIFI</p>
                     </div>
                     <div class="room-data">
                        <p><?=( $roomInfo['pet_friendly']) ? 'Yes' : 'No' ;?></p>
                        <p>PET FRIENDLY</p>
                     </div>
                </div>
                <!--More Room Details Section End-->
              





                <!--Room Desrciptuon Section Start-->
                <div class="room-description border-left">
                    <h3>Room Description</h3>
                    <p>
                        "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."
                    </p>
                </div>
                <div class="room-booking">
                    <button>Book Now</button>
                </div>
                <!--Room Desrciption Section End-->
                <br/>
                <iframe src = "https://maps.google.com/maps?q=<?=$roomInfo['location_lat']?>,<?=$roomInfo['location_long']?>&hl=es;z=14&amp;output=embed"></iframe>
                <br/>
                <!--Review List Section Start-->
                <div class="room-review-list border-left">
                    <h3>Reviews</h3>
                    <?php
                        foreach ($roomReviews as $review) {
                    ?>
                    <div class="room-user-review">
                        <div class="user-rating">
                            <p>
                                <span><?=$review['review_id']?>.</span>
                                <span><?=$review['user_name']?></span>
                            </p>
                            <div>
                                <ul class="star-reviews">
                                <?php
                                    for ($i=1; $i <= 5; $i++) { 
                                        if ($review['rate'] >= $i){
                                ?>  
                                <li class="fa fa-star is-active"></li>
                                <?php 
                                        }else{
                                ?>
                                    <li class="fa fa-star"></li>
                                <?php     
                                        }                       
                                    }
                                ?>
                                </ul>
                            </div>
                        </div>
                    
                        <div class="time-added"><p>Add time: <?=$review['created_time']?></p ></div>
                        <div class="user-comment">
                            <p><?=$review['comment']?></p>
                        </div> 
                    </div>
                    <?php
                        }
                    ?>
                  
                </div>
                <!--Review List Section End-->

                <div class="my-rating border-left">
                    <h3>Add Review</h3>
        
                    <div class="star-rating">
                        <input type="radio" id="star5" name="rate" value="5" />
                        <label for="star5" class="my-star fa fa-star star-5" data-star="5" title="text"></label>
                        <input type="radio" id="star4" name="rate" value="4" />
                        <label for="star4" class="my-star fa fa-star star-4" data-star="4" title="text"></label>
                        <input type="radio" id="star3" name="rate" value="3" />
                        <label for="star3" class="my-star fa fa-star star-3" data-star="3" title="text"></label>
                        <input type="radio" id="star2" name="rate" value="2" />
                        <label for="star2" class="my-star fa fa-star star-2" data-star="2" title="text"></label>
                        <input type="radio" id="star1" name="rate" value="1" />
                        <label for="star1" class="my-star fa fa-star star-1" data-star="1" title="text"></label>
                    </div>
                    
                    <!-- <input type="number" readonly id="output" maxlength="1" size="1">  -->
                    <div class="user-review">
                       <textarea name="userReview" conte id="userReview" cols="25" rows="5"></textarea>
                    </div>
                    <div class="action">
                        <input name="submit" id="submitButton" type="submit" value="Submit Review">
                    </div>
                </div>
                
            </div> 
        </div>
        Uicons by <a href="https://www.flaticon.com/uicons">Flaticon</a>
    </main>
    
</body>
</html>