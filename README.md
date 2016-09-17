# UFront Portfolio

## Introduction
There is some [great example code](https://github.com/kevinresol/ufront-nodejs-guide) made by @kevinresol which is dedicated to the NodeJS target. I built [my own company site](http://confidant.ca) for the PHP target with assistance from him and @postite. By offering this source code with a working real-world application I hope that it will make it easier for other Haxe developers to jump into using [UFront](https://github.com/ufront). This code should work on most PHP-supporting hosting packages.

## Why Use UFront?
* You will have the same code base on both client and server.
* It's super fast. Correctly configured, the framework will cache resources and build pages client-side, remotely loading only the data required to build the page.
* The MVC code structure makes it easy to separate your content from your other code.
* Multiple templating systems are available. I am using the default Haxe template system.

##FAQ
**Why do you have all those hxml files?**

I use FDT for Haxe development, and it will automatically use compile.hxml to compile on every save, so I combined client.hxml and server.hxml into this single file. If you are using the UFront command-line tools, the command `ufront b` will build all the hxml files in the current directory. Doing that, you won't need the compile.hxml file. 

**What else do I need?**

* I am using LESS for my styling. You will need to have a LESS compiler like [Crunch](https://getcrunch.co/) or else replace my styles with your own CSS, Stylus or SASS files.
* Be sure to create a "cache" directory within the "www" directory. Haxe PHP will use it to speed things up.