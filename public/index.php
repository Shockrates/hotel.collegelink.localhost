<?php
    require __DIR__.'/../boot/boot.php';

    use Hotel\Room;
    use Hotel\RoomType;

    //Initialize Room service
    $room = new Room();
    $cities = $room->getCities();

    //Initialize RoomType service
    $roomType = new RoomType();
    $allTypes = $roomType->getRoomTypes();
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <script src="https://kit.fontawesome.com/c8c9f21169.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script>
        $( function() {
            $( "#checkInDate" ).datepicker({ dateFormat: 'dd-mm-yy' });
            $( "#checkOutDate" ).datepicker({ dateFormat: 'dd-mm-yy' });
        } );
    </script>
    <title>Document</title>
</head>
<body>
    <header>    
        <div class="flex-container">
            <div class="header-content">
                <div class="header-logo">
                    <span>Hotels</span>
                </div>
                <ul class="header-navigation">
                    <ul>
                        <li class="main-navigation_home">
                            <a href="index.php">
                                <i class="fas fa-home"></i>
                                Home
                            </a>
                            
                        </li>
                        <li>
                            <a href="register">
                                <i class="fa-solid fa-user-plus"></i>
                                Register 
                            </a>  
                        </li> 
                        <li>
                            <a href="login.html">
                                <i class="fa-solid fa-right-to-bracket"></i>
                                Login 
                            </a>  
                        </li> 
                    </ul>
                </ul>
            </div>
           
        </div>
    </header>
    <main>
        <div class="flex-container">
            <section class="main-content">
                <form method="get" action="list_page">
                    <fieldset id="room-details">
                        <div class="form-group">
                           
                            <select id="city" name="city">
                                <option value="" selected>City</option>
                                <?php
                                foreach ($cities as $city) {
                                    # code...
                                ?>
                                    <option value="<?=$city?>"><?=$city?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                         
                            <select id="roomType" name="roomType">
                                <option value="" selected>Room Type</option>
                                <?php
                                foreach ($allTypes as $type) {
                                    # code...
                                ?>
                                    <option value="<?=$type['type_id']?>"><?=$type['title']?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                    </fieldset>
    
                    <fieldset id="formSearch">
                        <div class="form-group">
                           
                            <input type="text" id="checkInDate" name="checkInDate" placeholder="Check-In Date" >
                        </div>
                        <div class="form-group">
                            <input type="text" id="checkOutDate" name="checkOutDate" placeholder="Check-Out Date">
                        </div>
                    </fieldset>
                   
                    <div class="action">
                        <!-- <a href="list_page"> -->
                            <input name="search" id="searchButton" type="submit" value="Search">
                        <!-- </a> -->
                    </div>
                    
                    
                </form>
            </section>
        </div>
        
    </main>
    <footer>
        <p>(c) Copyright T S.Rates 2022</p>
    </footer>
   
    
</body>
</html>