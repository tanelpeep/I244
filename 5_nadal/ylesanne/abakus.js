window.onload = function() {
	var beads = document.getElementsByClassName("bead");

	/*
	beads[2].onclick = function() {
		alert("see bead")
	}
	*/
	
	
	for (var i = 0; i < beads.length; i++)
     beads[i].onclick = function() { floating(this);};
 
	function floating(bead){
		if(window.getComputedStyle(bead).getPropertyValue("float") == "left")
		{
			bead.style.cssFloat = "right";
		}
		else
		{
			bead.style.cssFloat = "left";
		}
	}
}