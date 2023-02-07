document.addEventListener('DOMContentLoaded', function(){

    // Get the favorite form,
    const favoriteForm = document.getElementById('favoriteForm');

    favoriteForm.addEventListener('click', (event) => {
        //Prevent the event from submitting the form, no redirect or page reload
        event.preventDefault();
        /**
         * If we want to use every input-value inside of the form we can call
         * `new FormData()` with the form we are submitting as an argument
         * This will create a body-object that PHP can read properly
         */
       
        const formattedData = new FormData(favoriteForm);
        setFavorite(formattedData);
    });
});


async function setFavorite(formattedData){
    /**
     * If we want to 'POST' something we need to change the `method` to 'POST'
     * 'POST' also expectes the request to send along values inside of `body`
     * so we must specify that property too. We use the earlier created 
     * FormData()-object and just pass it along.
     */
    const response = await fetch('../actions/favorite.php',{
        method: 'POST',
        body: formattedData
    });
    /*
     * Because we are using `echo json_encode()` inside of `actions/favorite.php` the response
     * will be JSON-data. Because of this we need to use
     * `response.json()` to convert it to something
     * that JavaScript understands
     */
    const data = await response.json();
    //data return TRUE if user set room as "favorite" and false if NOT FAVORite
    if(data){
        document.getElementById('is_favorite').value = "1";
        document.getElementById('favorite').classList.add('is-favorite');
    } else {
        document.getElementById('is_favorite').value = "0";
        document.getElementById('favorite').classList.remove('is-favorite');
    }
    
}

