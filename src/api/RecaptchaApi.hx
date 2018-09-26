package api;
using ufront.MVC;
using tink.CoreApi;
  
typedef RecaptchaVerificationResult = {
	var success:Bool;
	var challenge_ts:String; //Date
	var hostname:String;
	@optional var errorCodes:Array<Dynamic>;//this is not parsing because google returns key "error-codes"
}
class RecaptchaApi extends UFApi
{
	public function verify(response:String):Surprise<String, Error> {
		ufTrace("verifying..."+response);
		var theSecret:String="";
		//this is not included in the git repository obviously:
		var path = "../googleRecaptchaSecret.txt";
		#if server
			if(sys.FileSystem.exists(path)){
				theSecret = sys.io.File.getContent(path);
			}
		#end
		return request("https://www.google.com/recaptcha/api/siteverify", true, {
			response: response,
			secret: theSecret
		});

	}
	function request(url:String, ?post:Bool, ?params:Dynamic<String>):Surprise<String, Error>
		return Future.async(function (yield) {
			
			var h = new haxe.Http(url);  
			
			if (params != null)
			for (f in Reflect.fields(params))
				h.addParameter(f, Reflect.field(params, f));

			h.onData = function (s) yield(Success(s));
			h.onError = function (s) yield(Failure(new Error(504, s)));
			
			h.request(post);
		});

}


// UFAsyncApi will do the magic, converting all the api calls to remoting calls for the client
class AsyncRecaptchaApi extends UFAsyncApi<TestApi> {}