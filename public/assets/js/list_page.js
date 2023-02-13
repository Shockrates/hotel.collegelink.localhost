document.addEventListener('DOMContentLoaded', function(){

    /**
     * PRICE SLIDER JS CODE START
     */
    let rangeMin = 1;
    //Get the slider element
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
    /**
     * PRICE SLIDER JS CODE END
     */
  
  
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
  
  /**
   * SETS DATEPICKER TO INPUT DATE TEXT FIELDS
   */
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
  
  
  // When the user clicks on the button, scroll to the top of the document
  function goToTop() {
    document.body.scrollTop = 0; // For Safari
    document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
  }

  /**
   * RELOADS SEARCH RESULTS LIST WHEN FORM IS SUBMITED USING AJAX REQUESTS
   */
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
            history.pushState({}, '', 'http://hotel.collegelink.localhost/list_page.php?'+serializedData);
        });
    
});


/**
 * LOADS SEARCH RESULTS LIST WHEN list_page LOADS USING AJAX REQUESTS
 */
$(document).ready(() => {
    
    var urlParams = window.location.href.slice(window.location.href.indexOf('?') + 1);

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