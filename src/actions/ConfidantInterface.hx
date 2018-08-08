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

		// trace("hash:"+document.location.hash);
		var msg = data.msg;

		//detect a campaign redirect and notify analytics
		if (document.location.hash == "#r") msg = "campaignRedirect";

		untyped __js__('window.ga("set", {page: {0}, title: {1}, location:{2}});',PushState.currentPath,msg,document.location);

		untyped __js__('window.ga("send", "pageview");');
		//lines below for most recent analytics. Generates error.
		//untyped __js__('gtag("config", "UA-104215086-1", {"page_title" : {1}, "page_location" : {2}, "page_path": {0}});', PushState.currentPath, data.msg, document.location);

		delay(listen,500); //ensures dom is ready after a partialViewResult //don't go lower than this—it's too quick for iOS Safari.
  }

  function listen():Void {
		//reset scrolling of content divs:
		document.querySelector("#panel2").scrollTop=0;
		document.querySelector("#panel3").scrollTop=0;
		//change the goback link
		document.querySelector("#loader").className="";
			var a = PushState.currentPath.split("/");
			a=a.splice(0, a.length-2);
			if(a.length<1) document.querySelector("#stage").className="";//remove reversal
		
		var goback = document.querySelector('#goback');
			if(goback!=null){
				goback.addEventListener("click",function(){
					document.querySelector("#stage").className="reversed";
					
				});
		}
			
		PushState.addEventListener(function(url,state) {
			updateClasses();
		} );
		
		updateClasses();
		
		if(!supportsSVG()){
			//trace("this doesn't support SVG");
			document.querySelector("#nav").className="no-svg";
		}
		//add action to all links to show loader
		var list=document.querySelectorAll("a.summonLoader");
		
		for (thisLink in list){
			thisLink.addEventListener("click",function(){
				document.querySelector("#loader").className="show";
			});
		}
  }
  function supportsSVG():Bool {
	try{
		// document.createElementNS;
		var n:SVGElement=cast(document.createElementNS('http://www.w3.org/2000/svg', "svg"),SVGElement);
		n.createSVGRect;
		return true;
	} catch (e:Dynamic){
		return false;
	}
	return false;
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
		
    for(thisLevel in levels){
		document.querySelector(thisLevel).className="";
		document.querySelector(thisLevel).className=classes.join(" ");
		classes.pop();
    }
  }
  

  // because Dom is not always ready when execute action occurs
  private function delay(fn:Void->Void,d:Int){
    var tim = haxe.Timer.delay(fn,d); 
  }


}