$(document).on('submit', '#reviewForm', (e) => {
    //Prevent the event from submitting the form, no redirect or page reload
    e.preventDefault();
    //Get form data
    const serializedData = $('#reviewForm').serialize();
    console.log(serializedData);
    //Ajax request
    $.ajax(
        'http://hotel.collegelink.localhost/actions/ajax/review.php',
        {
            type: "POST",
            dataType: "html",
            data: serializedData, 
        }).done((result) =>{
            
            //Append results to html
            $('#room-review-list').append(result);
            
            
        });
    
});