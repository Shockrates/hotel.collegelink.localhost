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

    // When the user scrolls down 20px from the top of the document, show the button
    window.onscroll = function() {scrollFunction()};
    // Get the button:
    let mybutton = document.getElementById("goToTopBtn");

    function scrollFunction() {
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            mybutton.style.display = "block";
        } else {
            mybutton.style.display = "none";
        }
    }

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




// When the user clicks on the button, scroll to the top of the document
function goToTop() {
  document.body.scrollTop = 0; // For Safari
  document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
}






