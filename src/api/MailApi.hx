package api;
using ufront.MVC;
using tink.CoreApi;

#if server
import ufront.mailer.SmtpMailer;
import ufront.mail.Email;
#end
typedef EmailConfig={
	var port:Int;
	var host:String;
	var user:String;
	var pass:String;
	var recipient:String;
}
class MailApi extends UFApi
{
	private function parseEmailJson(pJson:String):EmailConfig{
		var parsed:EmailConfig = haxe.Json.parse(pJson);
		return parsed;
	}
	public function doMail(address:String,name:String,message:String):Surprise<String, Error> {
		var result:String='Email settings not configured properly.';
		var path='../email.json';
		//load the email config from external file (not in this git repo)
		/*
		Use this for a template and save it at the path above: 
		{
			"host": "your.host.com",	
			"port": 25,	
			"user": "someuser@domain.com",	
			"pass": "your#pass#word1",
			"recipient":"your@email.com"
		}
		*/
		var errorMessage:String;
		if(name==""){errorMessage="<h4>No name?</h4>";return errorMessage.asGoodSurprise();}
		if(message==""){errorMessage="<h4>The strong, silent type eh?</h4>";return errorMessage.asGoodSurprise();}
		var theJson = null;
		#if server
			if(sys.FileSystem.exists(path)){
				theJson = sys.io.File.getContent(path);
			}
		#end
		if (theJson == null) return result.asGoodSurprise();
		var settings;
		settings = parseEmailJson(theJson);
		var mailer = new SmtpMailer(settings);
		var email:Email;
		if(message.length==0){}
		try{
			email = new Email()
			.setSubject("Confidant web form submission")
			.from(address)
			.to(settings.recipient)
			.setText("You received a message from "+name+": "+message);
			
		} catch (e:Dynamic){
			errorMessage = cast e;
			errorMessage='<h4>'+errorMessage+'</h4>';
			return errorMessage.asGoodSurprise();
		}
		mailer.send(email).handle(function(res) {
			switch res {
				case Success(_):
					result='<h4 class="formResult">Email sent!</h4>';
				case Failure(e): {
					errorMessage = cast e;
					result='<h4 class="formResult">Something went wrong: '+errorMessage+'</h4>';
				}
			}
		});
		return result.asGoodSurprise();
		// just shorthand to `Future.sync(Success(param))`
	}

	
}


// UFAsyncApi will do the magic, converting all the api calls to remoting calls for the client
class AsyncMailApi extends UFAsyncApi<MailApi> {}