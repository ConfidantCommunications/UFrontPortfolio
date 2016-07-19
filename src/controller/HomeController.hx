package controller;

import api.TestApi;
import api.PortfolioItem;
import actions.ConfidantInterface;
//import tink.core.Future;
using ufront.MVC;
using ufront.web.result.AddClientActionResult;

typedef MyItem={
	var group:Int;
	var title:String;
	var slug:String;
}

typedef MyData = {
  //var name:String;
  var items:Array<MyItem>;
}
class HomeController extends Controller
{
	@inject
	public var testApi:AsyncTestApi;
	
	@:route(GET, "/")
	public function main()
	{
		return new PartialViewResult({
				title: "Confidant Communications : Graphic Design, HTML5 Games, Flash Programming and Joomla Developer in Saskatoon, Saskatchewan"
			})
			//.addPartial("panel2Partial","home.html")
			//.addPartial("portfolioNavPartial","portfolioNavPartial.html")
			.addClientAction(ConfidantInterface,{msg:"simpleAction"});
	} 
	
	//@:route(GET, "/portfolio/*")
	//public var portfolioController:PortfolioController;
	//@:route(GET, "/portfolio/*")
	@:route(GET, "/about")

	public function about()
	{
		return new PartialViewResult({
				title: "Confidant Communications : About Us",
				portfolioItem:""
			})
			.addClientAction(ConfidantInterface,{msg:"simpleAction"});		
	}
	@:route(GET, "/contact")

	public function contact()
	{
		return new PartialViewResult({ 
			title:'Contact Us',
			portfolioItem:""
		})
		
		.addClientAction(ConfidantInterface,{msg:"simpleAction"});
	}
	
	@:route(GET, "/portfolio")
	public function portfolio()
	{
		/*return testApi.test(args.param) >>
			function(result:String) return new ViewResult({
				title: "Confidant Communications : Portfolio",
				message: 'Result: $result', // print the result of the API call
				renderedBy: #if server 'Server' #else 'Client' #end, // let us know if this page is rendered by client or server
			});*/
		//	untyped __js__('alert("yes")');
		
		//ufLog('Custom id ${args.id} entered');
//		var path=context.contentDirectory+"portfolio.json";
	
		var path="portfolio.json";	
		return testApi.getJson(path) >>
			function(result:String) return new PartialViewResult({
				title: "Portfolio",
				content:processJson(result),
				portfolioItem:"",
				random: #if server 'Server' #else 'Client' #end, // let us know if this page is rendered by client or server
			})
			.addClientAction(ConfidantInterface,{msg:"simpleAction"});
		//.addPartial("portfolioNavPartial","portfolioNavPartial.html")
		//.addClientAction(ConfidantInterface,{msg:"simpleAction"});
		//.withLayout("layout.html",TemplatingEngines.haxe); //this line not necessary
		//.addPartialString( "btn", "<a href='::link::' class='btn'>::name::</a>", TemplatingEngines.haxe );
	}
	@:route(GET, "/portfolio/$id")
	public function returnPortfolioItem(id:String)
	{
		
		return testApi.getItem(id) >>
			function(result:PortfolioItem) return new PartialViewResult({
				title: "Portfolio Item",
				content:new Array<MyItem>(),
				portfolioItem: result
				//portfolioItem: 'Result: $result'//, // print the result of the API call
				//random: #if server 'Server' #else 'Client' #end, // let us know if this page is rendered by client or server
			},"portfolio.html")
			.addClientAction(ConfidantInterface,{msg:"simpleAction"});
	}

	private function processJson(pJson:String):Array<MyItem>{
		var parsed:MyData=haxe.Json.parse(pJson);
		return parsed.items;
	}
	
}