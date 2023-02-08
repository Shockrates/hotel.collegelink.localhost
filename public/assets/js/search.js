$(document).on('submit', '#searchForm', (e) => {
    //Prevent the event from submitting the form, no redirect or page reload
    e.preventDefault();
    //Get form data
    const serializedData = $('#searchForm').serialize();
    console.log(serializedData);
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

// A $( document ).ready() block.
$(document).ready(() => {

    //const urlParams = new URLSearchParams(window.location.search);
    var urlParams = window.location.href.slice(window.location.href.indexOf('?') + 1);
    
    console.log(urlParams);

    $.ajax(
        'http://hotel.collegelink.localhost/components/search_results.php',
        {
            type: "GET",
            dataType: "html",
            data: urlParams, 
        }).done((result) =>{
            //Clear search_results container
            $('#search_results').html('');
            //Append results to html
            $('#search_results').append(result);
        });
});