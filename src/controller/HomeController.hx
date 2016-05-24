package controller;

import api.TestApi;

//import tink.core.Future;
using ufront.MVC;

class HomeController extends Controller
{
	@inject
	public var testApi:AsyncTestApi;
	
	@:route(GET, "/")
	public function main(?args:{param:String})
	{
		return testApi.test(args.param) >>
			function(result:String) return new ViewResult({
				title: "Confidant Communications : Graphic Design, HTML5 Games, Flash Programming and Joomla Developer in Saskatoon, Saskatchewan",
				message: 'Result: $result', // print the result of the API call
				renderedBy: #if server 'Server' #else 'Client' #end, // let us know if this page is rendered by client or server
			});
	}
	
	//@:route(GET, "/portfolio/*")
	//public var portfolioController:PortfolioController;
	//@:route(GET, "/portfolio/*")
	@:route(GET, "/about")

	public function about(?args:{param:String})
	{
		return testApi.test(args.param) >>
			function(result:String) return new ViewResult({
				title: "Confidant Communications : About Us",
				header1:"About Us",
				message: 'Result: $result', // print the result of the API call
				renderedBy: #if server 'Server' #else 'Client' #end, // let us know if this page is rendered by client or server
			});
	}
	@:route(GET, "/contact")

	public function contact(?args:{param:String})
	{
		/*return testApi.test(args.param) >>
			function(result:String) return new ViewResult({
				title: "Confidant Communications : Portfolio",
				header1:"Contact Us",
				message: 'Result: $result', // print the result of the API call
				renderedBy: #if server 'Server' #else 'Client' #end, // let us know if this page is rendered by client or server
			});*/
		return new ViewResult({ 
			title:'Contact Us'
		});
	}
	
	@:route(GET, "/portfolio")

	public function portfolio(?args:{id:String})
	{
		/*return testApi.test(args.param) >>
			function(result:String) return new ViewResult({
				title: "Confidant Communications : Portfolio",
				message: 'Result: $result', // print the result of the API call
				renderedBy: #if server 'Server' #else 'Client' #end, // let us know if this page is rendered by client or server
			});*/
		//	untyped __js__('alert("yes")');
		
		//ufLog('Custom id ${args.id} entered');
		var ni = [
"Interactive Development","Overview","ThinkSask.ca","Wapos Bay Flash Site","PotashCorp Slideshow Player","Shelterbelt Design Tool","Lentil Hunter Map",
"Print / Miscellaneous","Book Cover Designs","T-Shirt Design","Product Packaging","Logo Designs",
"Websites","Agtron","Faith River","All-West Dental","Mable Elliott Guest Ranch","J.B. Black Estates","ICR Commercial Real Estate","Transforming Teachers"];

		
		
		
		return new ViewResult({ 
			title:"Portfolio",
			random:Math.random()+" willikers", //'Portfolio '+args.id,
			content:'The Content',
			subcontent:'The Subcontent',
			navItems:ni
		})
		.addPartial("portfolioNavPartial","portfolioNavPartial.html");
		//.withLayout("layout.html",TemplatingEngines.haxe); //this line not necessary
		
		/*
		return new ViewResult({
			title: "Blog Admin",
			description: "Take care of all the things",
			posts: ni
		})
		.addPartial( "nav", "nav.html", TemplatingEngines.erazorHtml );*/
		//.withLayout("layoutE.html",TemplatingEngines.erazorHtml)
		//.addPartialString( "btn", "<a href='::link::' class='btn'>::name::</a>", TemplatingEngines.haxe );

	}
	@:route(GET, "/portfolio/$id")
	public function portfolioNavPartialShell(?args:{id:String})
	{
		return new PartialViewResult({
			title:"PorfolioNav",
			random:"not really random"
			
		});
		
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