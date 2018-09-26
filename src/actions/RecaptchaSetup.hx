package actions;

import ufront.MVC;

#if js

// import pushstate.PushState;
// import js.html.History;
import js.Browser.document;
import js.Browser.window;
// import js.html.svg.SVGElement;
#end

//@:expose("confidant.RecaptchaInterface") 
class RecaptchaSetup extends ufront.web.client.UFClientAction<{msg:String}> {


  override public function execute( context:HttpContext, ?data:Dynamic):Void {

	  	// trace("haxe: recaptcha interface:");
		setup();

  }

  function setup():Void {
		//this will trigger when the google script executes its callback
		// trace("haxe: recaptcha render!");
		var goog = document.getElementById("gRecaptcha");
		if (goog!=null){

			untyped __js__("grecaptcha.render('gRecaptcha', {
			'sitekey' : '6LeNI28UAAAAAAXh3OPYW23Peg3jrIrOv4kyeHHf'
			});");

		}
		
		var t = new haxe.Timer(500);
		t.run = function(){
			try{
				var response = untyped __js__("grecaptcha.getResponse();");
				// trace("haxe: response:"+response);
				var hidden = document.getElementById("gRecaptchaResponse");
				hidden.setAttribute("value",response);
			} catch (e:Any) {
				trace(e);
			}
		};
  }



}


