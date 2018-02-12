# UFront Portfolio

## Introduction
There is some [great example code](https://github.com/kevinresol/ufront-nodejs-guide) made by @kevinresol which is dedicated to the NodeJS target. I built [my own company site](http://confidant.ca) for the PHP target with assistance from him and @postite. By offering this source code with a working real-world application I hope that it will make it easier for other Haxe developers to jump into using [UFront](https://github.com/ufront). This code should work on most PHP-supporting hosting packages.

## Why Use UFront?
* You will have the same code base on both client and server.
* It's super fast. Correctly configured, the framework will cache resources and build pages client-side, remotely loading only the data required to build the page.
* The MVC code structure makes it easy to separate your content from your other code.
* Multiple templating systems are available. I am using the default Haxe template system.

## Notes

* I am using LESS for my styling. You will need to have a LESS compiler like [Crunch](https://getcrunch.co/) or else replace my styles with your own CSS, Stylus or SASS files.
* Note: Be sure to create a "cache" directory within the "www" directory. Haxe PHP will use it to speed things up. Also remember that on your web server(s) you should delete files within the cache folder after recompiling, so that the server will refresh the cache to reflect any new code you created. 
* If you are using XDebug and the server generates a nesting error; be sure to edit php.ini setting "xdebug.max_nesting_level". I have mine at 512. You might be able to get by with 511. ;)