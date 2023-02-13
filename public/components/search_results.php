<?php
    require __DIR__.'/../../boot/boot.php';
    
    use Hotel\Room;
    
    //Initialize Room and RoomType service
    $room = new Room();
    
    //Get page Parameters
    //If parameter is not passed variable is set to empty string to avoid warnings
    $selectedCity = isset($_REQUEST['city']) ? $_REQUEST['city'] : '';
    $selectedRoomType = isset($_REQUEST['roomType']) ? $_REQUEST['roomType'] : '';
    $selectedNumberOfGuests = isset($_REQUEST['guests']) ? $_REQUEST['guests'] : ''; 
    $selectedMinPrice = isset($_REQUEST['minPrice']) ? $_REQUEST['minPrice'] : ''; 
    $selectedMaxPrice = isset($_REQUEST['maxPrice']) ? $_REQUEST['maxPrice'] : '';
   
    //If no checkin or/and checkout dates are passed dates are set to current date and current date + 2 days.
    $checkInDate =isset($_REQUEST['check_in_date']) ? $_REQUEST['check_in_date'] : date('d-m-Y'); 
    $checkOutDate =isset($_REQUEST['check_out_date']) ? $_REQUEST['check_out_date'] : date('d-m-Y',strtotime('+ 2 days')); 

    //Search for room
    $allAvailablerooms = $room->searchRoom($checkInDate, $checkOutDate, $selectedCity, $selectedRoomType,$selectedNumberOfGuests, $selectedMinPrice, $selectedMaxPrice);
    // print_r($allAvailablerooms);die;

   
?>


    <header class="hotel-list__title">
        <h2>Search Results with Ajax</h2>
    </header>
    
    <?php
    foreach ($allAvailablerooms as $availableroom) {
        # code...
    ?>
    <article>
        <div class="hotel-list__hotel">
        
            <aside class="hotel-list__hotel__media">
                <img src="assets/images/rooms/<?=$availableroom['photo_url']?>" alt="room-1" width="100%" height="auto">
            </aside>
            <div class="hotel-list__hotel__info">
                <h1><?=htmlentities($availableroom['name'])?></h1>
                
                <h2><?=htmlentities($availableroom['city'])?>, <?=htmlentities($availableroom['area'])?></h2>
                <p><?=htmlentities($availableroom['description_short'])?></p>
                <div class="button-right">
                    <button>
                        <a href="room.php?room_id=<?=$availableroom['room_id']?>&check_in_date=<?=$checkInDate?>&check_out_date=<?=$checkOutDate?>">Go to room page</a>
                    </button>
                </div>
            </div> 
        
        </div>
        <div class="hotel-list__hotel__info__room">
            <div class="room-price">
                <div class="room-details__text">
                    <span>Per Night: <?=htmlentities($availableroom['price'])?></span> 
                </div>
                
            </div>
            <div class="room-details">
                
                
                <div class="room-details__text">
                    <span>Count of Guests: <?=htmlentities($availableroom['count_of_guests'])?></span>
                </div>
                <div class="room-details__text">
                    <div class="room-type">
                        <span>Type of room:</span><span><?=htmlentities($availableroom['room_type'])?></span>
                    </div>
                    
                </div>
            
            </div>
        </div>
    </article>
    <?php
        }
    ?>
    <section>
    <?php
        if (count($allAvailablerooms) == 0) {
    ?>
        <h2>There are no available rooms</h2>
    <?php
        }
    ?>
    </section>
