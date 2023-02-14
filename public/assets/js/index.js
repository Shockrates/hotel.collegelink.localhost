$( function() {
    $( "#check_in_date" )
        .datepicker({ 
            dateFormat: 'dd-mm-yy', 
            minDate: 0,
            onSelect: (dateText) => {
                $('#check_out_date').datepicker('option','minDate' , dateText);
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
            } 
         }).keyup(function(e) {
            if(e.keyCode == 8 || e.keyCode == 46) {
                $('#check_in_date').datepicker('option','maxDate' ,"");
            }
        });
} );

//Used to submit logoutform with a tag
function submit() {
  
    let form = document.getElementById("logoutForm");
    form.submit();  
}