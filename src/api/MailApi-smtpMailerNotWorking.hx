package api;
using ufront.MVC;
using tink.CoreApi;

#if server
import smtpmailer.SmtpMailer;
#end

class MailApi extends UFApi
{
	public function doMail(email:String,name:String,message:String):Surprise<String, Error> {
		var result:String='Default';
		var mailer = new SmtpMailer({
			host: 'mail.confidant.ca',
			port: 26,//,//465,//587,
			auth: {
				username: '',
				password: ''
			}
		});
		mailer.send({
			subject: 'Confidant web form submission',
			from: { address: email, displayName: name },
			to: ['your@email.com'],
			content: {
				text: message
				// html: '<font color="red">hello</font>'
			}
			// attachments: ['image.png']
		}).handle(function(res) {
			switch res {
				case Success(_):
					result='Email sent!';
				case Failure(e): {
					result='Something went wrong: '+e;
				}
			}
		});
		
		return result.asGoodSurprise();
		// just shorthand to `Future.sync(Success(param))`
	}

	
}


// UFAsyncApi will do the magic, converting all the api calls to remoting calls for the client
class AsyncMailApi extends UFAsyncApi<MailApi> {}