    $(document).ready(function(){
 $(window).scroll(function(){
  var h = $('body').height();
  var y = $(window).scrollTop();
  if( y > (h*.03) && y < (h) ){
   $("#header").addClass("compact fade-in-down");
  } else {
   $('#header').removeClass(' compact fade-in-down');
  }
 });
})

  // just for the demo

  $(document).ready(function(){
  
  $("header nav li a").click(function(){
    $("header nav li .active").removeClass("active");
    $(this).addClass("active");

  });
});
