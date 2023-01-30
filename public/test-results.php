<?php
    require __DIR__.'/../boot/boot.php';

    use Hotel\User;
    use Hotel\Room;
    use Hotel\RoomType;


    //Get All Cities
    $room = new Room();
    //$cities = $room->getCities();

    //Get users
    $user = new User();
    //$user->insertUser('test', 'test@example.com','asdfasdf');
    //$list = $user->getUserList();
    //$userRecord = $user->getByEmail('eg@example.com');
    //Searc for Rooms
    $rooms = $room->searchRoom('2023-01-01', '2023-01-10', 'Athens', '2', '2', 166, 333);

    $type = new RoomType();
    //$types = $type->getRoomTypes();

    
    print_r( $rooms);
    // print_r( sizeof($rooms));
?>