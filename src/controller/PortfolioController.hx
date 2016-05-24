package controller;

import api.TestApi;
import tink.core.Future;
using ufront.MVC;

class PortfolioController extends Controller
{
	@inject
	public var testApi:AsyncTestApi;
	
	
	
	@:route(GET, "/portfolio/$id")

	public function portfolio(id:String)
	{
		/*return testApi.test(args.param) >>
			function(result:String) return new ViewResult({
				title: "Confidant Communications : Portfolio",
				message: 'Result: $result', // print the result of the API call
				renderedBy: #if server 'Server' #else 'Client' #end, // let us know if this page is rendered by client or server
			});*/
		return new ViewResult({ title:'Hello $id' });
	}
	@:route(GET, "/mixed/$param1")
	public function mixed(param1:String, args:{param2:Int})
	{
		return new JsonResult({
			param1: param1,
			param2: args.param2,
		});
	}	
}