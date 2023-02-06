$(document).on('submit', '#searchForm', (e) => {
    //Prevent the event from submitting the form, no redirect or page reload
    e.preventDefault();
    //Get form data
    const serializedData = $('#searchForm').serialize();
    //Ajax request
    $.ajax(
        'http://hotel.collegelink.localhost/components/search_results.php',
        {
            type: "GET",
            dataType: "html",
            data: serializedData, 
        }).done((result) =>{
            //Clear search_results container
            $('#search_results').html('');
            //Append results to html
            $('#search_results').append(result);
            //Push state to URL
            history.pushState({}, '', 'http://hotel.collegelink.localhost/list_page?'+serializedData);
        });
    
});