document.addEventListener("DOMContentLoaded", function() {
  var loader = document.getElementById("loader");
  
  function showLoader() {
    loader.style.display = "block";
  }
  
  function hideLoader() {
    loader.style.display = "none";
  }
  
  document.addEventListener("beforeunload", showLoader);
  document.addEventListener("load", hideLoader);
});