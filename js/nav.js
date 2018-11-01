function mynav(){
  var x = document.getElementById("nav");
  if(x.style.display === "block"){
    x.style.display = "none";
  }else {
    x.style.display = "block";
  }
  $(window).resize(function (){
    if($(window).width() > 768) {
      x.style.display = "block";
    }
  });
}

