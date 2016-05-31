function log(m){try{console.log(m);}catch(e){}}

var currentLevel=0;

function next(){

	currentLevel++;
	$("#stage").removeClass("reversed");
	updateClasses();
}
function prev(){
	if(currentLevel>0)currentLevel--;
	$("#stage").addClass("reversed");
	updateClasses();

}


$(document).ready(function(){
/*	$("#next").click(
		next();
	);
	$("#previous").click(
		prev();
	);
	
	*/
	$(".goback").click(
		function(){
			if(currentLevel>0)currentLevel--;
			$("#stage").addClass("reversed");
			updateClasses();
		}
	);
	return; ////   disables the parts below
	/*$('#nav a').click(function(e){
		//e.preventDefault();
			currentLevel++;
			$("#stage").removeClass("reversed");
			updateClasses();
	});*/
	

	
});



function updateClasses(){
	//add classes to correspond with depth of navigation
	var levels=["#panel1","#panel2","#panel3"];
	var classes=["recessed0","recessed1","recessed2","recessed3"];
	
	classes.length=(currentLevel>=0)?currentLevel+1:1; //removes unwanted items from end
	for (i=0;i<levels.length;i++){ //loop thru levels
		$(levels[i]).removeClass("recessed0 recessed1 recessed2 recessed3");
		$(levels[i]).addClass(classes.join(" "));
		classes.pop();
	}
	if (currentLevel>0){
		$("#panel1 .goback").show();
	} else {
		$(".goback").hide();
	}
}