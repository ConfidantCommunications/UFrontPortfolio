package;

import api.ApiContext;
import controller.*;
import ufront.view.UFViewEngine;
//import erazor.*;
using ufront.MVC;

class Server
{
	static function main() 
	{
		
		//UFViewEngine.engines.add(new ErazorViewEngine()); // <-- Adding Erazor view engine

		var ufrontApp = new UfrontApplication({
			indexController: HomeController,
			remotingApi: ApiContext, // specify our remoting API context (interface)
			defaultLayout: "layout.html",
		});
		
		// listen for incoming connection at this port number
			#if (php || neko)
				ufrontApp.executeRequest();
			#elseif nodejs
				ufrontApp.listen(2987);
			#end
	}
}