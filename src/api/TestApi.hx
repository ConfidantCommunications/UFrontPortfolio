package api;

using ufront.MVC;
using tink.CoreApi;

class TestApi extends UFApi
{
	//var pJson:Dynamic;
	public function getJson(path:String):Surprise<String, Error> {
		// make sure this piece of code is compiled in the server only
		// to demonstrate that the code is actually run in the server,
		// even when the API is called form client
		var pJson="nothing";
		#if server
		if(sys.FileSystem.exists(path)){
			pJson = sys.io.File.getContent(path);
			
		}
			//param = '$param (server)';
	
		#end
		var parsed=haxe.Json.parse(pJson);
		
		var navItems:Array<String>=new Array<String>();
		var i=1;
		//navItems.push("<ul>");
		var arr:Array<Array<Dynamic>>=parsed.items;
		for (thisItem in arr){
			if((thisItem[0]==0)&&(i==1)) navItems.push('<h2>'+thisItem[1]+"</h2><ul>"); //first heading
			else if(thisItem[0]==0) navItems.push('</ul><h2>'+thisItem[1]+"</h2><ul>");//other headings
			else navItems.push('<li><a href="/portfolio/'+thisItem[2]+'/" rel="pushstate">'+thisItem[1]+"</a></li>");//listings
			i++;
		}
		navItems.push("</ul>");
		var sp=navItems.join("");
		
		return sp.asGoodSurprise();
		
		// just shorthand to `Future.sync(Success(param))`
		//return param.asGoodSurprise();
		
		
	}
	public function getItem(id:String):Surprise<String,Error>{
		//var r= "the Item!";
		//return r.asGoodSurprise();
		var path="portfolioStuff/"+id+".html";
		var result="nothing";
		#if server
		if(sys.FileSystem.exists(path)){
			result = sys.io.File.getContent(path);
			
		}
			//param = '$param (server)';
	
		#end
		
		
		
		return result.asGoodSurprise();
	}
	
	
}


// UFAsyncApi will do the magic, converting all the api calls to remoting calls for the client
class AsyncTestApi extends UFAsyncApi<TestApi> {}