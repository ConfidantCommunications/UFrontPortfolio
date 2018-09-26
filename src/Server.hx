package;

import api.ApiContext;
import controller.*;
import ufront.view.UFViewEngine;
import overrides.CustomErrorPageHandler;
//import erazor.*;
using ufront.MVC;


class Server
{
	static function main() 
	{
		//lines below resolve a problem with not finding the DefaultResolver class, a new problem since upgrading to Haxe 3.4.2
		#if php
		untyped __php__("require 'haxe/_Unserializer/DefaultResolver.class.php'; ");
		
		/*untyped __php__("
		$headerCSP = \"Content-Security-Policy:connect-src 'self' ;		default-src 'self' www.google-analytics.com www.gstatic.com www.google.com fonts.gstatic.com; 		frame-ancestors 'self' ;		frame-src 'none' www.google.com;		media-src 'self' ;		object-src 'none'; 		script-src 'self' 'unsafe-inline' www.google-analytics.com www.google.com www.gstatic.com; 		style-src 'self' 'unsafe-inline' fonts.googleapis.com ;\";
		
		header($headerCSP);
		");
*/
		
		#end
		//UFViewEngine.engines.add(new ErazorViewEngine()); // <-- Adding Erazor view engine

		var ufrontApp = new UfrontApplication({
			indexController: HomeController,
			remotingApi: ApiContext, // specify our remoting API context (interface)
			defaultLayout: "layout.html",
			errorHandlers: [ new CustomErrorPageHandler() ]
		});
		// listen for incoming connection at this port number
			#if (php || neko)
				ufrontApp.executeRequest();
			#elseif nodejs
				ufrontApp.listen(2987);
			#end
	}
}