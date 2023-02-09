$( function() {
    $( "#check_in_date" )
        .datepicker({ 
            dateFormat: 'dd-mm-yy',
            onSelect: function(dateText) {
                console.log("Selected date: " + dateText + "; input's current value: " + this.value);
		        $(this).change();
		    }
		});
        // .on("change", function() {
        //     console.log("Got change event from field");
        //  });

         
    $( "#check_out_date" )
        .datepicker({ 
            dateFormat: 'dd-mm-yy',
            onSelect: function(dateText) {
                console.log("Selected date: " + dateText + "; input's current value: " + this.value);
		        $(this).change();
		    }
		});
        // .on("change", function() {
        //     console.log("Got change event from field");
        //  });
} );

