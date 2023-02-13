document.addEventListener('DOMContentLoaded', function(){
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

// When the user clicks on the button, scroll to the top of the document
function goToTop() {
  document.body.scrollTop = 0; // For Safari
  document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
}

//Used to submit logoutform with a tag
function submit() {
  
    let form = document.getElementById("logoutForm");
    form.submit();  
  }