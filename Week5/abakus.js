window.onload = function() {
	var mumm = document.getElementsByClassName("bead");
	for (var i = 0; i < mumm.length; i++){
		mumm[i].onclick=function(){
			var floatvalue = getComputedStyle(this,null).getPropertyValue("float");
			if (floatvalue=="left"){
			this.style.cssFloat="right";
			}
			else {this.style.cssFloat="left";
			}
		}
	}
}