document.addEventListener('DOMContentLoaded', function(){

  let rangeMin = 1;
  const range = document.querySelector(".range-selected");
  const rangeInput = document.querySelectorAll(".range-input input");
  const rangePrice = document.querySelectorAll(".range-price input");

  range.style.left = (rangePrice[0].value / rangeInput[0].max) * 100 + "%";
  range.style.right = 100 - (rangePrice[1].value / rangeInput[1].max) * 100 + "%";

  rangeInput.forEach((input) => {
      input.addEventListener("input", (e) => {
        let minRange = parseInt(rangeInput[0].value);
        let maxRange = parseInt(rangeInput[1].value);
        if (maxRange - minRange < rangeMin) {     
          if (e.target.className === "min") {
            rangeInput[0].value = maxRange - rangeMin;        
          } else {
            rangeInput[1].value = minRange + rangeMin;        
          }
        } else {
          rangePrice[0].value = minRange;
          rangePrice[1].value = maxRange;
          range.style.left = (minRange / rangeInput[0].max) * 100 + "%";
          range.style.right = 100 - (maxRange / rangeInput[1].max) * 100 + "%";
        }
        
      });
    });

  rangePrice.forEach((input) => {
    input.addEventListener("input", (e) => {
      let minPrice = rangePrice[0].value;
      let maxPrice = rangePrice[1].value;
      if (maxPrice - minPrice >= rangeMin && maxPrice <= rangeInput[1].max) {
        if (e.target.className === "min") {
          rangeInput[0].value = minPrice;
          range.style.left = (minPrice / rangeInput[0].max) * 100 + "%";
        } else {
          rangeInput[1].value = maxPrice;
          range.style.right = 100 - (maxPrice / rangeInput[1].max) * 100 + "%";
        }
      }
    });
  });

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

});

$( function() {
    $( "#checkIn" ).datepicker({ dateFormat: 'dd-mm-yy' });
    $( "#checkOut" ).datepicker({ dateFormat: 'dd-mm-yy' });
} );

//Used to submit logoutform with a tag
function submit() {
  
  let form = document.getElementById("logoutForm");
  form.submit();  
}



// When the user clicks on the button, scroll to the top of the document
function goToTop() {
  document.body.scrollTop = 0; // For Safari
  document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
}