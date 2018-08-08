package controller;

import api.TestApi;
import api.MailApi;
import api.PortfolioItem;
import actions.ConfidantInterface;
using ufront.MVC;
using ufront.web.result.AddClientActionResult;
using ufront.web.result.CallJavascriptResult;

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

	@inject
	public var mailApi:MailApi;
	
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
			.addPartialString("subcontent","",TemplatingEngines.haxe)
			.addClientAction(ConfidantInterface,{msg:t});
	} 
	public function getHostName():String {
		
		#if neko
			return neko.Web.getHostName();
		#elseif php
			return php.Web.getHostName();
		#else
			return js.Browser.window.location.hostname;
		#end
		
	}
	
	
	//@:route(GET, "/portfolio/*")
	//public var portfolioController:PortfolioController;

	@:route(GET, "/about")
	public function about()
	{
		var t:String="About Us : Confidant Communications";
		return new PartialViewResult({
				title: t,
				portfolioItem:null,
				panel1classes:"recessed0 recessed1",
				panel2classes:"recessed0",
				panel3classes:"",
				gobackLink:"http://"+getHostName()+"/"
			})
			.addPartialString("subcontent","",TemplatingEngines.haxe)
			.addClientAction(ConfidantInterface,{msg:t});
			//.addJsScriptToResult("/js/x3dom.js");
			//.addInlineJsToResult( "document.onload = function() {document.getElementById('specialties').style.display='none';}" );
	}


	@:route(GET, "/about/graphic-design-saskatoon")
	@template("/home/about.html") //returns same template content as above, but with a portfolio item 
	//also see documentation notes for ViewResult class
	
	public function graphic()
	{
 		var t:String="Graphic Design in Saskatoon : Confidant Communications";

		return new PartialViewResult({ 
			title:t,
			portfolioItem:"",
			panel1classes:"recessed0 recessed1 recessed2",
			panel2classes:"recessed0 recessed1",
			panel3classes:"recessed0",
			gobackLink:"/about/"
		})
		.addPartial("subcontent","/about/graphic.html") //if it generates a nesting error; be sure to edit php.ini
		//also, call it as a helper from the template
		.addClientAction(ConfidantInterface,{msg:t});
	}

	@:route(GET, "/about/joomla-development-saskatoon")
	@template("/home/about.html")
	
	public function joomla()
	{
 		var t:String="Joomla! Development and Training in Saskatoon : Confidant Communications";

		return new PartialViewResult({ 
			title:t,
			portfolioItem:"",
			panel1classes:"recessed0 recessed1 recessed2",
			panel2classes:"recessed0 recessed1",
			panel3classes:"recessed0",
			gobackLink:"/about/"
		})
		.addPartial("subcontent","/about/joomla.html")
		.addClientAction(ConfidantInterface,{msg:t});
	}


	@:route(GET, "/about/book-design-saskatoon")
	@template("/home/about.html") 
	
	public function books()
	{
 		var t:String="Book Design, Book Marketing, and Book Publishing in Saskatoon : Confidant Communications";

		return new PartialViewResult({ 
			title:t,
			portfolioItem:"",
			panel1classes:"recessed0 recessed1 recessed2",
			panel2classes:"recessed0 recessed1",
			panel3classes:"recessed0",
			gobackLink:"/about/"
		})
		.addPartial("subcontent","/about/books.html")
		.addClientAction(ConfidantInterface,{msg:t});
	}
	@:route(GET, "/about/web-design-saskatoon")
	@template("/home/about.html")
	
	public function web()
	{
 		var t:String="Web Design in Saskatoon : Confidant Communications";

		return new PartialViewResult({ 
			title:t,
			portfolioItem:"",
			panel1classes:"recessed0 recessed1 recessed2",
			panel2classes:"recessed0 recessed1",
			panel3classes:"recessed0",
			gobackLink:"/about/"
		})
		.addPartial("subcontent","/about/web.html")
		.addClientAction(ConfidantInterface,{msg:t});
	}

	@:route(GET, "/about/interactive-developer-saskatoon")
	@template("/home/about.html")
	
	public function interactive()
	{
 		var t:String="Interactive Development in Saskatoon : Confidant Communications";

		return new PartialViewResult({ 
			title:t,
			portfolioItem:"",
			panel1classes:"recessed0 recessed1 recessed2",
			panel2classes:"recessed0 recessed1",
			panel3classes:"recessed0",
			gobackLink:"/about/"
		})
		.addPartial("subcontent","/about/interactive.html")
		.addClientAction(ConfidantInterface,{msg:t});
	}

	@:route(GET, "/contact")
	public function contact()
	{
		var t:String='Contact Us : Confidant Communications';
		return new PartialViewResult({ 
			title:t,
			portfolioItem:null,
			panel1classes:"recessed0 recessed1",
			panel2classes:"recessed0",
			panel3classes:"",
			gobackLink:"http://"+getHostName()+"/"
		})
		.addPartialString("subcontent","",TemplatingEngines.haxe)
		.addClientAction(ConfidantInterface,{msg:t});
	}
	
	@:route(GET, "/portfolio")
	public function portfolio()
	{
		//ufLog('Custom id ${args.id} entered');
//		var path=context.contentDirectory+"portfolio.json";
		var t = "Portfolio of Graphic Design and Website Development Projects : Confidant Communications";
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
			.addPartialString("subcontent","",TemplatingEngines.haxe)
			.addClientAction(ConfidantInterface,{msg:t});
		//.addPartial("portfolioNavPartial","portfolioNavPartial.html")
		//.addClientAction(ConfidantInterface,{msg:"simpleAction"});
		//.withLayout("layout.html",TemplatingEngines.haxe); //this line not necessary
		//.addPartialString( "btn", "<a href='::link::' class='btn'>::name::</a>", TemplatingEngines.haxe );
	}
	@:route(GET, "/portfolio/$id")
	public function returnPortfolioItem(id:String)
	{
		var t = "Portfolio : "; 
		var t2 = " : Confidant Communications";
		return testApi.getItem(id) >>
			function(result:PortfolioItem) return new PartialViewResult({
				title: t+result.title+t2,
				content:new Array<MyItem>(),
				portfolioItem: result,
				panel1classes:"recessed0 recessed1 recessed2",
				panel2classes:"recessed0 recessed1",
				panel3classes:"recessed0",
				gobackLink:"/portfolio/"
				//portfolioItem: 'Result: $result'//, // print the result of the API call
				//random: #if server 'Server' #else 'Client' #end, // let us know if this page is rendered by client or server
			},"portfolio.html")

			.addPartialString("subcontent","",TemplatingEngines.haxe)
			.addClientAction(ConfidantInterface,{msg:t+result.title});
	}

	private function processJson(pJson:String):Array<MyItem>{
		var parsed:MyData=haxe.Json.parse(pJson);
		return parsed.items;
	}
	
	@:route(POST, "/contact/send/")
	@template("/home/contact.html")
	public function contactResult(args:{ email:String, name:String, message:String })
	{
		var t:String = "Contact : Confidant Communications"; 
		var returnHome:String = '<p style="text-align:center;"><a href="/" rel="pushstate">Go back home now?</a></p>';
		return mailApi.doMail(args.email, args.name, args.message) >>
			function(result:String) return new PartialViewResult({
				title: t,
				portfolioItem: null,
				panel1classes:"recessed0 recessed1 recessed2",
				panel2classes:"recessed0 recessed1",
				panel3classes:"recessed0",
				gobackLink:"/contact/"
			})
			.addPartialString("subcontent",result+returnHome,TemplatingEngines.haxe)
			.addClientAction(ConfidantInterface,{msg:t+result});
	}
}