package api;
using ufront.MVC;
using tink.CoreApi;


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
			//trace(i+":"+pj.items[i].slug+":"+slug);
			if(pj.items[i].slug==slug){
				var prevLink:String;
				var nextLink:String;
				var pll:String;
				var nll:String;
				if(i==0){
					prevLink="#";
					pll="You are at the first item in the portfolio.";
				} else {
					prevLink="/portfolio/"+pj.items[i-1].slug+"/";
					pll=pj.items[i-1].title;
				}
				if (i>=pj.items.length-1){
					nextLink="#";
					nll="You are at the last item in the portfolio.";
				} else {
					nextLink="/portfolio/"+pj.items[i+1].slug+"/";
					nll=pj.items[i+1].title;
				}
				var portfolioItem=new PortfolioItem(portfolioItemHtml,pj.items[i].title,prevLink,nextLink,pll,nll);
				return portfolioItem.asGoodSurprise();
				
			}
		}
		return new PortfolioItem(portfolioItemHtml,"error","error","error","error","error").asGoodSurprise();
		
		
		//return portfolioItemHtml.asGoodSurprise();
	}
}


// UFAsyncApi will do the magic, converting all the api calls to remoting calls for the client
class AsyncTestApi extends UFAsyncApi<TestApi> {}