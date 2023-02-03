document.addEventListener('DOMContentLoaded', function(){
    
    
    (function(){
        let stars = document.querySelectorAll('.my-star');
        let i = 0;
        let ele = document.getElementsByName('rate');
        //loop through stars
        while (i < stars.length){
            //attach click event
            stars[i].addEventListener('click', function(){

                //current star
                let star = parseInt(this.getAttribute("data-star"));

                //output current clicked star value
                // document.querySelector('#output').value = star;
                //document.querySelector('#output').value = document.querySelector('#star'+star).value;
             
                
                /*our first loop to set the class on preceding star elements*/
                let preStars = star; //set the current star value

                //loop through and set the active class on preceding stars
                while(1 <= preStars){
                    //check if the classlist contains the active class, if not, add the class
                    if(!document.querySelector('.star-'+preStars).classList.contains('is-active')){
                        document.querySelector('.star-'+preStars).classList.add('is-active');
                    }
                    //decrement our current index
                    --preStars;
                }//end of first loop

                /*our second loop to unset the class on succeeding star elements*/ 
                //loop through and unset the active class, skipping the current star
                let succStars = star+1;
                while(5 >= succStars){
                    //check if the classlist contains the active class, if yes, remove the class
                    if(document.querySelector('.star-'+succStars).classList.contains('is-active')){
                        document.querySelector('.star-'+succStars).classList.remove('is-active');
                    }
                    //increment current index
                    ++succStars;
                }

            })//end of click event
            i++;

        }//end of while loop
        
    })();//end of function


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

    // Get the review form,
    const reviewForm = document.getElementById('reviewForm'); 
    reviewForm.addEventListener('submit', function(event){
        //Prevent the event from submitting the form, no redirect or page reload
        // event.preventDefault();
        // const formattedData = new FormData(reviewForm);
        // addReview(formattedData);
   });
   

})

//Used to submit logoutform with a tag
function submit() {
    let form = document.getElementById("logoutForm");
    form.submit();  
}

function submitFavorite() {
    let form = document.getElementById("favorite");
    //form.submit();  
}

// Get the whole form,
//const form = document.getElementById('reviewForm');



async function addReview(formattedData){
    
    /**
     * If we want to 'POST' something we need to change the `method` to 'POST'
     * 'POST' also expectes the request to send along values inside of `body`
     * so we must specify that property too. We use the earlier created 
     * FormData()-object and just pass it along.
     */
    const response = await fetch('../actions/review.php',{
        method: 'POST',
        body: formattedData
    });
    /*
     * Because we are using `echo` inside of `handle_form.php` the response
     * will be a string and not JSON-data. Because of this we need to use
     * `response.text()` instead of `response.json()` to convert it to someting
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

        commentHtml = `<div class="room-user-review">
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
    console.log(commentHtml);
    document.getElementById('room-review-list').innerHTML += commentHtml;
    
}

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
     * Because we are using `echo` inside of `handle_form.php` the response
     * will be a string and not JSON-data. Because of this we need to use
     * `response.text()` instead of `response.json()` to convert it to someting
     * that JavaScript understands
     */
    const data = await response.json();
    //This should later print out the values submitted through the form
    if(data){
        document.getElementById('is_favorite').value = "1";
        document.getElementById('favorite').classList.add('is-favorite');
    } else {
        document.getElementById('is_favorite').value = "0";
        document.getElementById('favorite').classList.remove('is-favorite');
    }
    
}

