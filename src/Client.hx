package;

import controller.HomeController;
import ufront.view.UFViewEngine;
#if js

import pushstate.PushState;
import js.Browser.document;

#end
using ufront.MVC;

using ufront.web.result.AddClientActionResult;
class Client
{
	static function main() 
	{
		//UFViewEngine.engines.add(new erazor.Template()); // <-- Adding Erazor view engine
		
		/*var ufrontApp = new ClientJsApplication({
			indexController: HomeController,
			defaultLayout: "layout.html",
		});*/ 
		
		PushState.init();
		var ufrontApp = new ClientJsApplication({ 
			indexController: HomeController, 
			//templatingEngines: [TemplatingEngines.erazor], 
			defaultLayout: "layout.html", 
			//requestMiddleware:[new BrowserFileUploadMiddleware(),new middleware.SignalMiddleWare()], 
			//responseMiddleware:[new middleware.SignalMiddleWare()], 
			clientActions:[actions.ConfidantInterface ]
			//authImplementation:YesBossAuthHandler, 
		});
		// Listen to any history changes using PushState, and process each request.
		ufrontApp.listen();
		
		//ufrontApp.injector.map(String,"blob").toValue("blopoli");
        //ufrontApp.executeRequest();
	}
}