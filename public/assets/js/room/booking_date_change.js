$( function() {
    $( "#check_in_date" )
        .datepicker({ 
            dateFormat: 'dd-mm-yy',
            onSelect: function(dateText){
                logFunction("Check-In", dateText);
            }
		})
        // .on("change", function() {
        //     console.log("Got change event from field");
        //  });

         
    $( "#check_out_date" )
        .datepicker({ 
            dateFormat: 'dd-mm-yy',
            onSelect: function(dateText) {
                logFunction("Check-Out",dateText);
		    }
		});
        // .on("change", function() {
        //     console.log("Got change event from field");
        //  });
    
} );

logFunction = (from, date) => {
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
            //history.pushState({}, '', 'http://hotel.collegelink.localhost/list_page?'+serializedData);
        });

}
