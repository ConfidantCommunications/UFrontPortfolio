package controller;

import api.TestApi;
import api.PortfolioItem;
import actions.ConfidantInterface;
// import actions.AnalyticsAction;
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
		var t:String="Confidant Communications : Graphic Design, Website Design and Joomla Interactive Developer in Saskatoon, Saskatchewan";
		return new PartialViewResult({
				title: t,
				panel1classes:"recessed0",
				panel2classes:"",
				panel3classes:""
			})
			//.addPartial("panel2Partial","home.html")
			//.addPartial("portfolioNavPartial","portfolioNavPartial.html")
			.addClientAction(ConfidantInterface,{msg:t});
			// .addClientAction(AnalyticsAction,{});
	} 
	public function getHostName():String {
		
		#if server
			return php.Web.getHostName();
		#else
			return js.Browser.window.location.hostname;
		#end
		
	}
	
	
	//@:route(GET, "/portfolio/*")
	//public var portfolioController:PortfolioController;
	//@:route(GET, "/portfolio/*")
	@:route(GET, "/about")

	public function about()
	{
		var t:String="Confidant Communications : About Us";
		return new PartialViewResult({
				title: t,
				portfolioItem:null,
				panel1classes:"recessed0 recessed1",
				panel2classes:"recessed0",
				panel3classes:"",
				gobackLink:"http://"+getHostName()+"/"
			})
			.addClientAction(ConfidantInterface,{msg:t});
			// .addClientAction(AnalyticsAction,{});		
	}
	@:route(GET, "/contact")

	public function contact()
	{
		var t:String='Confidant Communications : Contact Us';
		return new PartialViewResult({ 
			title:t,
			portfolioItem:null,
				panel1classes:"recessed0 recessed1",
				panel2classes:"recessed0",
				panel3classes:"",
				gobackLink:"http://"+getHostName()+"/"
		})
		
		.addClientAction(ConfidantInterface,{msg:t});
		// .addClientAction(AnalyticsAction,{});
	}
	
	@:route(GET, "/portfolio")
	public function portfolio()
	{
		//ufLog('Custom id ${args.id} entered');
//		var path=context.contentDirectory+"portfolio.json";
		var t = "Confidant Communications : Portfolio of Graphic Design and Website Development Projects";
		var path="portfolio.json";	
		return testApi.getJson(path) >>
			function(result:String) return new PartialViewResult({
				title: t,
				content:processJson(result),
				portfolioItem:null,
				panel1classes:"recessed0 recessed1",
				panel2classes:"recessed0",
				panel3classes:"",
				gobackLink:"http://"+getHostName()+"/"
			})
			.addClientAction(ConfidantInterface,{msg:t});
			// .addClientAction(AnalyticsAction,{});
		//.addPartial("portfolioNavPartial","portfolioNavPartial.html")
		//.addClientAction(ConfidantInterface,{msg:"simpleAction"});
		//.withLayout("layout.html",TemplatingEngines.haxe); //this line not necessary
		//.addPartialString( "btn", "<a href='::link::' class='btn'>::name::</a>", TemplatingEngines.haxe );
	}
	@:route(GET, "/portfolio/$id")
	public function returnPortfolioItem(id:String)
	{
		var t:String = "Confidant Communications : Portfolio : "; 
		return testApi.getItem(id) >>
			function(result:PortfolioItem) return new PartialViewResult({
				title: t+result.title,
				content:new Array<MyItem>(),
				portfolioItem: result,
				panel1classes:"recessed0 recessed1 recessed2",
				panel2classes:"recessed0 recessed1",
				panel3classes:"recessed0",
				gobackLink:"/portfolio/"
				//portfolioItem: 'Result: $result'//, // print the result of the API call
				//random: #if server 'Server' #else 'Client' #end, // let us know if this page is rendered by client or server
			},"portfolio.html")
			.addClientAction(ConfidantInterface,{msg:t+result.title});
			// .addClientAction(AnalyticsAction,{});
	}

	private function processJson(pJson:String):Array<MyItem>{
		var parsed:MyData=haxe.Json.parse(pJson);
		return parsed.items;
	}
	
}