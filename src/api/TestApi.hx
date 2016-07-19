package api;
//import api.PortfolioItem;
using ufront.MVC;
using tink.CoreApi;

//    trace(o.name); // Haxe (a string)
    // awesome (a string in an array)
  //  trace(o.tags[0]);
typedef PjItem = {
	var group:String;
	var title:String;
	var slug:String;
}
typedef PortfolioJson = {
	var items:Array<PjItem>;
	
}
  
  
class TestApi extends UFApi
{

	public function getJson(path:String):Surprise<String, Error> {
		// make sure this piece of code is compiled in the server only
		// to demonstrate that the code is actually run in the server,
		// even when the API is called form client
		var theJson="nothing";
		#if server
			if(sys.FileSystem.exists(path)){
				theJson = sys.io.File.getContent(path);
			}
		#end
		
		return theJson.asGoodSurprise();
		// just shorthand to `Future.sync(Success(param))`
	}

	public function getItem(slug:String):Surprise<PortfolioItem,Error> {
		//the id is the slug
		var path="portfolioStuff/"+slug+".html";
		var jsonPath="portfolio.json";
		var portfolioItemHtml="nothing";
		var portfolioJson="";
		#if server
			if(sys.FileSystem.exists(path)){
				portfolioItemHtml = sys.io.File.getContent(path);
			}
			if(sys.FileSystem.exists(path)){
				portfolioJson = sys.io.File.getContent(jsonPath);
			}
		#end
		
		var pj:PortfolioJson=haxe.Json.parse(portfolioJson);
		
		
		for(i in 0...pj.items.length){
			trace(i+":"+pj.items[i].slug+":"+slug);
			if(pj.items[i].slug==slug){
				var back=(i==0)?0:i-1;
				var fwd=(i>=pj.items.length-1)?i:i+1;
				var portfolioItem=new PortfolioItem(portfolioItemHtml,"/portfolio/"+pj.items[back].slug+"/","/portfolio/"+pj.items[fwd].slug+"/");
				return portfolioItem.asGoodSurprise();
				
			}
		}
		return new PortfolioItem(portfolioItemHtml,"error","error").asGoodSurprise();
		
		
		//return portfolioItemHtml.asGoodSurprise();
	}
	
	
	private function portfolioNavLink(id:String,forward:Bool=true):String{
		if(forward){
			
		} else {
			//must be a backward link
		}
		return "";
	}
}


// UFAsyncApi will do the magic, converting all the api calls to remoting calls for the client
class AsyncTestApi extends UFAsyncApi<TestApi> {}