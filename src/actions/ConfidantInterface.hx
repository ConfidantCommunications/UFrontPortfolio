package actions;

import ufront.MVC;

#if js

import pushstate.PushState;
import js.html.History;
import js.Browser.document;
import js.Browser.window;
import js.html.svg.SVGElement;
#end

class ConfidantInterface extends ufront.web.client.UFClientAction<{msg:String}> {

	//TODO: add finger swipe:http://stackoverflow.com/questions/15084675/how-to-implement-swipe-gestures-for-mobile-devices
	//http://stackoverflow.com/questions/2264072/detect-a-finger-swipe-through-javascript-on-the-iphone-and-android/23230280#23230280
  //@expose
  public var currentLevel=1;
  public var currentPath="";

  override public function execute( context:HttpContext, ?data:Dynamic):Void {

    //ufTrace("Executing Confidant Interface");//+data.msg
    delay(listen); //ensures dom is ready after a partialViewResult
    
    
  }

  function listen():Void {
	//change the goback link
    var a = PushState.currentPath.split("/");
    a=a.splice(0, a.length-2);
    if(a.length<1) document.querySelector("#stage").className="";//remove reversal
	//var newHash:String="http://"+window.location.host+a.join("/")+"/"; //"http://localhost:2987"+a.join("/")+"/";
    //goback.setAttribute("href",newHash);
    var goback = document.querySelector('#goback');
    if(goback!=null){
	    goback.addEventListener("click",function(){
	      document.querySelector("#stage").className="reversed";
	      
	    });
	}
    //document.querySelector("#previous").addEventListener("click",prev);
    //document.querySelector("#next").addEventListener("click",next);
    
    PushState.addEventListener(function(url,state) {
      //ufTrace( 'Visiting $url and $state' );
      updateClasses();
    } );
    
    updateClasses();
	
	if(!supportsSVG()){
		//trace("this doesn't support SVG");
		document.querySelector("#nav").className="no-svg";
	}
	
	
	
  }
  function supportsSVG():Bool {
	#if js
	try{
		document.createElementNS;
		var n:SVGElement=cast(document.createElementNS('http://www.w3.org/2000/svg', "svg"),SVGElement);
		n.createSVGRect;
		return true;
	} catch (e:Dynamic){
		return false;
	}
	#end
	return false;
	//return !!document.createElementNS && !!document.createElementNS('http://www.w3.org/2000/svg', "svg").createSVGRect;
  }


  /*
   * This function remedies the fact that when javascript is enabled, the partials only redraw portions of the template.
   */
  function updateClasses(){
    var a=PushState.currentPath.split("/");
    currentLevel=a.length-1;
    //add classes to correspond with depth of navigation
    //ufTrace("currentLevel is "+currentLevel);
    var levels=["#panel1","#panel2","#panel3"];
    var classes=["recessed0","recessed1","recessed2","recessed3"];
    
    var newlen=(currentLevel>=0)?currentLevel+1:1;
    classes=classes.slice(0,newlen-1);    //removes unwanted items from end
    //for (i=0;i<levels.length;i++){ //loop thru levels
    for(thisLevel in levels){
      document.querySelector(thisLevel).className="";
      document.querySelector(thisLevel).className=classes.join(" ");
      classes.pop();
    }
  }
  

  // because Dom is not always ready when execute action occurs
  private function delay(fn:Void->Void){
    var tim = haxe.Timer.delay(fn,100);
  }


}