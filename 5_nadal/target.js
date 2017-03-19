window.onload = function() {
    var ring = document.getElementById("content");
	
	ring.onclick=function(){
	
	ring.style.left=(Math.random()*100)+"%";
	ring.style.top=(Math.random()*100)+"%";
	}
}