$( function() {
    $( "#check_in_date" )
        .datepicker({ 
            dateFormat: 'dd-mm-yy',
            minDate: 0,
            onSelect: (dateText) => {
                $('#check_out_date').datepicker('option','minDate' , dateText);
                logFunction();
            }
		}).keyup(function(e) {
            if(e.keyCode == 8 || e.keyCode == 46) {
                $('#check_out_date').datepicker('option','minDate' ,+1);
            }
        });

         
    $( "#check_out_date" )
        .datepicker({ 
            dateFormat: 'dd-mm-yy',
            minDate: +1,
            onSelect: (dateText) => {
                $('#check_in_date').datepicker('option','maxDate' , dateText);
                logFunction();
		    }
		}).keyup(function(e) {
            if(e.keyCode == 8 || e.keyCode == 46) {
                $('#check_in_date').datepicker('option','maxDate' ,"");
            }
        });
    
} );

logFunction = () => {
    checkIn = $("#check_in_date").val();
    checkOut = $("#check_out_date").val();
    roomId = $("#room_id").val();
    const serializedData = $('form.bookingForm').serialize();
    //console.log(`${from} `+date);
    //console.log(serializedData);

    //Ajax request
    $.ajax(
        'http://hotel.collegelink.localhost/actions/ajax/checkRoomAvailability.php',
        {
            type: "GET",
            dataType: "json",
            data: { 
                check_in_date: checkIn, 
                check_out_date: checkOut, 
                room_id: roomId 
                }, 
        }).done((result) =>{
            console.log(result);
            if (result) {
                $('.bookingForm span').prop('hidden', false);              
                $('.bookingForm button').prop('hidden', true);
            } else {
                $('.bookingForm span').prop('hidden', true);
                $('.bookingForm button').prop('hidden', false);
                
            }
            
            //Push state to URL
            history.pushState({}, '', `http://hotel.collegelink.localhost/room.php?room_id=${roomId}&check_in_date=${checkIn}&check_out_date=${checkOut}`);
        });

}
