/*
 * Reality Gems 2022
 * https://www.realitygems.com
 *
 * dom is initialized at bottom of this script to new DOMClass();
 * use dom.onLoad(function(){}); in place of jQuery ready function
 */

var DOMClass = function()
{
	// Public Variables

	this.body = null;
	this.header = null;

	// Public Methods

	this.init = function()
	{
		// Public Members

		if(document.getElementsByTagName('header').length > 0)
		{
			this.header = document.getElementsByTagName('header')[0];
		}
		else
		{
			this.header = null;
		}

		this.addEvents();
	}

	this.addEvents = function()
	{
		if(this.header != null)
		{
			console.log(this.header);
			console.log(this.header.classList);
			window.addEventListener("scroll", function()
			{
				if (document.body.scrollTop == 0 && document.documentElement.scrollTop == 0)
		    	{
		    		this.header.classList.remove('sticky');
		    	}
		    	else if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50)
		    	{
		    		this.header.classList.add('sticky');
		    	}
			}.bind(this));
		}
	}

	this.init();
}

var dom = new DOMClass();