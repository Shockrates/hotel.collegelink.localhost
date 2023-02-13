$(document).on('submit', '#reviewForm', (e) => {
    //Prevent the event from submitting the form, no redirect or page reload
    e.preventDefault();
    //Get form data
    const serializedData = $('#reviewForm').serialize();
    //Ajax request
    $.ajax(
        'http://hotel.collegelink.localhost/actions/ajax/review.php',
        {
            type: "POST",
            dataType: "html",
            data: serializedData, 
        }).done((result) =>{
            
            //Prepends results to html
            $('#review-list').prepend(result);
            //Changes all counters to accomonadate fro new entry
            $('.review-counter').text(i => (i+1) + '.');

            //Clears the form
            $('#reviewForm')[0].reset();
            //deselects stars
            $('.my-star').each(function(){
                $(this).removeClass('is-active');
            });
            
            
        });
    
});