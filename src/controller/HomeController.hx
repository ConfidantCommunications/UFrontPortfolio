package controller;

import api.TestApi;
import actions.ConfidantInterface;
//import tink.core.Future;
using ufront.MVC;
using ufront.web.result.AddClientActionResult;


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
			})
			//.addPartial("panel2Partial","home.html")
			//.addPartial("portfolioNavPartial","portfolioNavPartial.html")
			.addClientAction(ConfidantInterface,{msg:"simpleAction"});
	}
	
	//@:route(GET, "/portfolio/*")
	//public var portfolioController:PortfolioController;
	//@:route(GET, "/portfolio/*")
	@:route(GET, "/about")

	public function about(?args:{param:String})
	{
		return testApi.test(args.param) >>
			function(result:String) return new PartialViewResult({
				title: "Confidant Communications : About Us",
				message: 'Result: $result', // print the result of the API call
				renderedBy: #if server 'Server' #else 'Client' #end, // let us know if this page is rendered by client or server
			})
			.addClientAction(ConfidantInterface,{msg:"simpleAction"});
			
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
		return new PartialViewResult({ 
			title:'Contact Us'
		})
		
		.addClientAction(ConfidantInterface,{msg:"simpleAction"});
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
		
		var navItems:Array<String>=new Array<String>();
		var i=1;
		navItems.push("<ul>");
		for (thisItem in ni){
			navItems.push('<li><a href="/portfolio/$i/">'+thisItem+"</a></li>");
			i++;
		}
		navItems.push("</ul>");
		return new PartialViewResult({ 
			title:"Portfolio",
			content:navItems.join("")
		})
		//.addPartial("portfolioNavPartial","portfolioNavPartial.html")
		.addClientAction(ConfidantInterface,{msg:"simpleAction"});
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
			title:"Portfolio Item",
			random:"not really random"
		})
		
		.addClientAction(ConfidantInterface,{msg:"simpleAction"});
		
	}
	
	
}