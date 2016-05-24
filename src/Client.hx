package;

import controller.HomeController;
import ufront.view.UFViewEngine;
//import erazor.*;
using ufront.MVC;

class Client
{
	static function main() 
	{
		//UFViewEngine.engines.add(new erazor.Template()); // <-- Adding Erazor view engine
		
		var ufrontApp = new ClientJsApplication({
			indexController: HomeController,
			defaultLayout: "layout.html",
		});
		
		// Listen to any history changes using PushState, and process each request.
		ufrontApp.listen();
	}
}