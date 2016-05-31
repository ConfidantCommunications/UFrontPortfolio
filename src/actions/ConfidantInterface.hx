package actions;

import ufront.MVC;

#if js

import pushstate.PushState;
import js.html.History;
import js.Browser.document;

#end

class ConfidantInterface extends ufront.web.client.UFClientAction<{msg:String}> {


  //@expose
  public var currentLevel=1;
  public var currentPath="";

  override public function execute( context:HttpContext, ?data:Dynamic):Void {

    //ufTrace("Executing Confidant Interface");//+data.msg
    delay(listen); //ensures dom is ready after a partialViewResult
    
    
  }

  function listen():Void {
    document.querySelector("#stage").className="";//remove reversal
    var goback =document.querySelector('#goback');
    var a=PushState.currentPath.split("/");
      a.pop();
     goback.setAttribute("href","/"+a.join("/"));
     
    goback.addEventListener("click",function(){
      document.querySelector("#stage").className="reversed";
      
    });

    document.querySelector("#previous").addEventListener("click",prev);
    //document.querySelector("#next").addEventListener("click",next);
    
    PushState.addEventListener(function(url,state) {
      // The URL of the request (eg. "/uploads")
      ufTrace( 'Visiting $url and $state' );
      //untyped __js__('console.log(state);');
      
      
      updateClasses();
    } );
    
    updateClasses();
  }
  function updateClasses(){
    var a=PushState.currentPath.split("/");
    currentLevel=a.length-1;
    //add classes to correspond with depth of navigation
    ufTrace("currentLevel is "+currentLevel);
    var levels=["#panel1","#panel2","#panel3"];
    var classes=["recessed0","recessed1","recessed2","recessed3"];
    
    var newlen=(currentLevel>=0)?currentLevel+1:1;
    classes=classes.slice(0,newlen-1);    //removes unwanted items from end
    //for (i=0;i<levels.length;i++){ //loop thru levels
    for(thisLevel in levels){
      document.querySelector(thisLevel).className="";
      document.querySelector(thisLevel).className=classes.join(" ");
      classes.pop();
    }
    if (currentLevel>0){
      document.querySelector(".goback").setAttribute("style","display:block;");
    } else {
      document.querySelector(".goback").setAttribute("style","display:none;");
    }
  }
  
//  function onClick(e):Void
  //{
    //e.currentTarget.style.opacity=".5";
  //}


  // because Dom is not always ready when execute action occurs
  private function delay(fn:Void->Void){
    var tim = haxe.Timer.delay(fn,100);
  }



  function next(e:Dynamic){
    document.querySelector("#stage").className="";
    
    
    /*currentLevel++;
    //ufTrace(currentLevel);
    updateClasses();*/
  }
  function prev(e:Dynamic){
    document.querySelector("#stage").className="reversed";
    if(currentLevel>0){
      var a=PushState.currentPath.split("/");
      a.pop();
      
      PushState.push(a.join("/"));
      //currentLevel--;
    } else {
      PushState.push("/");
    }
    //ufTrace(currentLevel);
    //updateClasses();

  }

  

}