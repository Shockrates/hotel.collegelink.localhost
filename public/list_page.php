<?php
    require __DIR__.'/../boot/boot.php';
    
    use Hotel\User;
    use Hotel\Room;
    use Hotel\RoomType;

    //Initialize Room and RoomType service
    $room = new Room();
    $roomType = new RoomType();
    
    //Get current User id
    $userId  = User::getCurrentUserId();

    //Get all cities, room types and no of guests for populating select fields
    $cities = $room->getCities();
    $roomTypes = $roomType->getRoomTypes();
    $countOfGuestss = $room->getCountOfGuests();

    //Find the chepest and the most expensive room in the database to set in price range;
    $minPrice = $room->getMinaAndMaxPrice()[0];
    $maxPrice = $room->getMinaAndMaxPrice()[1];
    
    $setMinPrice = isset($_REQUEST['minPrice']) ? $_REQUEST['minPrice'] : intval($minPrice); 
    $setMaxPrice = isset($_REQUEST['maxPrice']) ? $_REQUEST['maxPrice'] : intval($maxPrice); 
    

    //Get page Parameters
    //If parameter is not passed variable is set to empty string to avoid warnings
    $selectedCity = isset($_REQUEST['city']) ? $_REQUEST['city'] : '';
    $selectedRoomType = isset($_REQUEST['roomType']) ? $_REQUEST['roomType'] : '';
    $selectedNumberOfGuests =isset($_REQUEST['guests']) ? $_REQUEST['guests'] : ''; 
    $selectedMinPrice = isset($_REQUEST['minPrice']) ? $_REQUEST['minPrice'] : ''; 
    $selectedMaxPrice = isset($_REQUEST['maxPrice']) ? $_REQUEST['maxPrice'] : '';
   
    //If no checkin or/and checkout dates are passed dates are set to current date and current date + 2 days.
    $checkInDate =isset($_REQUEST['check_in_date']) ? $_REQUEST['check_in_date'] : date('d-m-Y'); 
    $checkOutDate =isset($_REQUEST['check_out_date']) ? $_REQUEST['check_out_date'] : date('d-m-Y',strtotime('+ 2 days')); 
    

    //Search for room
    $allAvailablerooms = $room->searchRoom($checkInDate, $checkOutDate, $selectedCity, $selectedRoomType,$selectedNumberOfGuests, $selectedMinPrice, $selectedMaxPrice);
 

   
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/list_page.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <script src="https://kit.fontawesome.com/c8c9f21169.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script src="assets/js/list_page.js"></script>
    
    <title>List</title>
</head>
<body>
    
    <!--Move to top button-->
    <button onclick="goToTop()" id="goToTopBtn" title="Go to top">Top</button>  
    <!-- SHARED NAVBAR COMPONNNT -->
    <?php include "components/navbar.php";?>

    <main>
        <div class="container">
            <!-- Hotel Advanced Search Form Start -->
            <aside class="hotel-search-results hotel-search-filters">
                <header class="hotel-search-filters__title">
                    <p>
                        FIND THE PERFECT HOTEL
                    </p>
                   
                </header>
                <form name="searchForm" id="searchForm" method="get" action="list_page.php">
                    <div class="room-search">
                        
                        <div class="form-group">
                           
                            <select id="countOfGuests" name="guests">
                                <option value="" selected>Count of Guests</option>
                                <?php
                                foreach ($countOfGuestss as $guests) {
                                    # code...
                                ?>
                                    <option <?=($selectedNumberOfGuests == $guests ? 'selected="selected"' : '')?> value="<?=$guests?>"><?=htmlentities($guests)?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        
                        <div class="form-group">
                        
                            <select id="roomType" name="roomType">
                                <option value="" selected>Room Type</option>
                                <?php
                                foreach ($roomTypes as $type) {
                                    # code...
                                ?>
                                    <option <?=($selectedRoomType == $type['type_id'] ? 'selected="selected"' : '')?> value="<?=$type['type_id']?>"><?=htmlentities($type['title'])?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                        
                            <select id="city" name="city">
                                <option value="" selected>City</option>
                                <?php
                                foreach ($cities as $city) {
                                    # code...
                                ?>
                                    <option <?=($selectedCity == $city ? 'selected="selected"' : '')?> value="<?=$city?>"><?=htmlentities($city)?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                    
                        <div class="form-group ">
                            <div class="price">
                                <div class="range-price">
                                    <input type="number" name="minPrice" id="minPrice" value="<?=$setMinPrice?>">
                                    <input type="number" name="maxPrice" id="maxPrice" value="<?=$setMaxPrice?>">
                                </div>
                                <div class="range-slider">
                                    <span class="range-selected"></span>
                                </div>
                                <div class="range-input">
                                    <input type="range" class="min" min="0" max="<?=$maxPrice?>" value="<?=$setMinPrice?>" step="1">
                                    <input type="range" class="max" min="0" max="<?=$maxPrice?>" value="<?=$setMaxPrice?>" step="1">
                                </div>
                                <div class="range-price">
                                    <label for="minPrice">PRICE MIN.</label>
                                    <label for="maxPrice">PRICE MAX.</label>
                                </div>
                                    
                            </div>
                        </div>
                    </div>
                    <div class="date-search">
                        <div class="form-group">
                            <input type="text" id="check_in_date" name="check_in_date" placeholder="Check-In Date" value="<?=$checkInDate?>" required>
                        </div>
                        <div class="form-group">
                            <input type="text" id="check_out_date" name="check_out_date" placeholder="Check-Out Date" value="<?=$checkOutDate?>" required>
                        </div>
                    </div>
                    
                    <div class="action">
                        <input name="submit" id="submitButton" type="submit" value="FIND HOTEL">
                    </div>
                </form>
                
            </aside>
            <!-- Hotel Advanced Search Form End-->
             
            <!--THE FOLLOWING SECTION WILL BE FILLED WITH JS ON LOAD PAGE AND WHEN SHEARCHFORM IS SUBMMMITED-->
            <!-- Hotel List Start -->
            <section class="hotel-search-results hotel-list" id="search_results">
                <!-- <header class="hotel-list__title">
                    <h2>Search Results</h2>
                </header>
                
                <?php
                //foreach ($allAvailablerooms as $availableroom) {
                    # code...
                ?>
                <article>
                    <div class="hotel-list__hotel">
                   
                        <aside class="hotel-list__hotel__media">
                            <img src="../assets/images/rooms/<?//=$availableroom['photo_url']?>" alt="room-1" width="100%" height="auto">
                        </aside>
                        <div class="hotel-list__hotel__info">
                            <h1><?//=$availableroom['name']?></h1>
                            
                            <h2><?//=$availableroom['city']?>, <?//=$availableroom['area']?></h2>
                            <p><?//=$availableroom['description_short']?></p>
                            <div class="button-right">
                                <button>
                                    <a href="../room/?room_id=<?//=$availableroom['room_id']?>&check_in_date=<?//=$checkInDate?>&check_out_date=<?//=$checkOutDate?>">Go to room page</a>
                                </button>
                            </div>
                        </div> 
                  
                    </div>
                    <div class="hotel-list__hotel__info__room">
                        <div class="room-price">
                            <div class="room-details__text">
                                <span>Per Night: <?//=$availableroom['price']?></span> 
                            </div>
                           
                        </div>
                        <div class="room-details">
                           
                           
                            <div class="room-details__text">
                                <span>Count of Guests: <?//=$availableroom['count_of_guests']?></span>
                            </div>
                            <div class="room-details__text">
                                <div class="room-type">
                                    <span>Type of room:</span><span><?//=$availableroom['room_type']?></span>
                                </div>
                                
                            </div>
                       
                        </div>
                    </div>
                </article>
                <?php
                // }
                ?>
                <section>
                <?php
                    //if (count($allAvailablerooms) == 0) {
                ?>
                    <h2>There are no available rooms</h2>
                <?php
                   // }
                ?>
                </section> -->
            </section>
                    
            <!-- Hotel List End -->
        </div>
     
    </main>
    <footer>
        <p>(c) Copyright T S.Rates 2022</p>
    </footer>
</body>
</html>