package api;

class PortfolioItem {
	public var html : String;
    public var prevLink : String;
	public var nextLink : String;
	public var title : String;
    public function new(html,title,prev,next) {
		this.html=html;
		this.title=title;
        this.prevLink = prev;
        this.nextLink = next;    
    }
}
