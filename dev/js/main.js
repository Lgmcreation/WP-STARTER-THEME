(function($){
  $(window).load(function() {
    var video = document.getElementById('myvideo');
    if(video){video.play();
    $('.video').addClass("active");
  }
  });
var controller = new ScrollMagic.Controller();

$('.lien_enfant a').each(function(index,elem){
    var lienE_Tl = new TimelineMax();
    lienE_Tl
       	.from($('.lien_enfant a:eq('+index+')'),.1, {autoAlpha:0,y:'50px',ease:Power0.easeNone})
    var lienE_Scroll = new ScrollMagic.Scene({
          triggerElement: elem,
          triggerHook : 0.95,
	      reverse : true
    })
    .setTween(lienE_Tl)
    .addTo(controller);
});

$('.bloc_parent').each(function(index,elem){
    var blocP_Tl = new TimelineMax();
    blocP_Tl
       	.from($('.bloc_parent:eq('+index+') .bloc_parent_content'),0.5, {autoAlpha:0,x:'50px',ease:Power0.easeNone})
        .to($('.bloc_parent:eq('+index+')'),0, {className:"+=active", delay: 0.1});
    var blocP_Scroll = new ScrollMagic.Scene({
          triggerElement: elem,
          triggerHook : .7,
	       reverse : true
    })
    .addIndicators()
    .setTween(blocP_Tl)
    .addTo(controller);
});

//logo de fond
var logo = document.querySelector(".fond_logo");
if(logo){
 var logo_Tl = new TimelineMax();
       logo_Tl
           .from(logo,1, {autoAlpha:0,ease:Power0.easeNone});
 var logo_Scroll= new ScrollMagic.Scene({
    triggerElement : logo,
    triggerHook : 0.5,
})
.setTween(logo_Tl)
.addTo(controller);
}

//solution animation
$('.solutions .bloc_solution').each(function(index,elem){
    var solutions_Tl = new TimelineMax();
    solutions_Tl
        .from($('.solutions .bloc_solution:eq('+index+')'),.8, {autoAlpha:0,y:'50px',ease:Power0.easeNone})
        .staggerFromTo($('.solutions .bloc_solution:eq('+index+') li'), 0.5, {autoAlpha:0,x:'-10px'}, {autoAlpha:1,x:'0px'}, 0.5)
           ;
    var solutions_Scroll = new ScrollMagic.Scene({
          triggerElement: elem,
          triggerHook : .7,
        reverse : true
    })
    .setTween(solutions_Tl)
    .addTo(controller);
});


	var headertext = [];
	var headers = document.querySelectorAll("thead");
	var tablebody = document.querySelectorAll("tbody");
	
	for(var i = 0; i < headers.length; i++) {
		headertext[i]=[];
		for (var j = 0, headrow; headrow = headers[i].rows[0].cells[j]; j++) {
		  var current = headrow;
		  headertext[i].push(current.textContent.replace(/\r?\n|\r/,""));
		  }
	} 	
	if (headers.length > 0) {
		for (var h = 0, tbody; tbody = tablebody[h]; h++) {
			for (var i = 0, row; row = tbody.rows[i]; i++) {
			  for (var j = 0, col; col = row.cells[j]; j++) {
			    col.setAttribute("data-th", headertext[h][j]);
			  } 
			}
		}
	}
})(jQuery);