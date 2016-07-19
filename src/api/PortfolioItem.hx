package api;

class PortfolioItem {
	var html : String;
    var prevLink : String;
	var nextLink : String;
    public function new(html,prev,next) {
		this.html=html;
        this.prevLink = prev;
        this.nextLink = next;    
    }
}
