package actions;

import ufront.MVC;

#if js

// import pushstate.PushState;
// import js.html.History;
import js.Browser.document;
import js.Browser.window;
// import js.html.svg.SVGElement;
#end

class RecaptchaGetResponse extends ufront.web.client.UFClientAction<{}> {

  override public function execute( context:HttpContext, ?data:Dynamic):Void {

	//   trace("haxe: recaptcha getresponse");

	  try{
		  var response = untyped __js__("grecaptcha.getResponse();");
		//   trace("haxe: response:"+response);
	  } catch (e:Any) {
		  trace("haxe: No user response found.");
	  }
	  
  }


}


