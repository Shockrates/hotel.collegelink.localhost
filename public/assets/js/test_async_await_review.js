document.addEventListener('DOMContentLoaded', function(){

    // Get the review form,
    const reviewForm = document.getElementById('reviewForm'); 
    reviewForm.addEventListener('submit', function(event){
        //Prevent the event from submitting the form, no redirect or page reload
        event.preventDefault();
        const formattedData = new FormData(reviewForm);
        console.log(formattedData);
        addReview(formattedData);
    });
});

async function addReview(formattedData){
    
    /**
     * If we want to 'POST' something we need to change the `method` to 'POST'
     * 'POST' also expectes the request to send along values inside of `body`
     * so we must specify that property too. We use the earlier created 
     * FormData()-object and just pass it along.
     */
    const response = await fetch('../actions/ajax/review.php',{
        method: 'POST',
        body: formattedData
    });
    /*
     * Because we are using `echo json_encode()` inside of `actions/review.php` the response
     * will be JSON-data. Because of this we need to use
     * `response.json()` to convert it to something
     * that JavaScript understands
     */
    const data = await response.json();
    //This should later print out the values submitted through the form
    let li = '';
    let commentHtml ='';
    if(data){
        for ($i=1; $i <= 5; $i++) { 
            if (data['rate'] >= $i){
                li += `<li class="fa fa-star is-active"></li>\n`;
             }else{
                
                li +=`<li class="fa fa-star"></li>\n`;
            }                       
        }

        commentHtml =  `<div class="room-user-review">
                            <div class="user-rating">
                                <p>
                                    <span>${data['count']}.</span>
                                    <span>${data['user_name']}</span>
                                </p>
                                <div>
                                    <ul class="star-reviews">
                                        ${li}
                                    </ul>
                                </div>
                            </div>
                            <div class="time-added"><p>Add time: ${data['created_time']}</p ></div>
                            <div class="user-comment">
                                <p>${data['comment']}</p>
                            </div> 
                        </div>`;
    }
    document.getElementById('room-review-list').innerHTML += commentHtml;
    
}
