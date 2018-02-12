package controller;

import api.TestApi;
import api.PortfolioItem;
import actions.ConfidantInterface;
// import actions.AnalyticsAction;
using ufront.MVC;
using ufront.web.result.AddClientActionResult;

class AboutController extends Controller
{
	

	@:route(GET, "/graphicDesign")
	
	public function graphicDesign()
	{
		//return "sandwich";
 		var t:String="Confidant Communications : Graphic Design";
		return new PartialViewResult({
				title: t,
				portfolioItem:null,
				panel1classes:"recessed0 recessed1 recessed2",
				panel2classes:"recessed0 recessed1",
				panel3classes:"recessed0",
				gobackLink:"/about/"
			})
			.addClientAction(ConfidantInterface,{msg:t}); 
	}

	
}