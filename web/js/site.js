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
	this.mobile = {
		menu: {
			isOpen: false
		}
	};

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

	this.mobileMenuEventListener = function(e)
	{
		var menu = document.getElementById('mobile-menu');
		menu.classList.remove('open');
		document.getElementById('mobile-trigger').classList.remove('open');
		menu.removeEventListener('click', this.mobileMenuEventListener);
		dom.mobile.menu.isOpen = false;
	}

	this.addEvents = function()
	{
		if(this.header != null)
		{
			window.addEventListener("scroll", function()
			{
				if (document.body.scrollTop < 250 && document.documentElement.scrollTop < 250)
		    	{
		    		this.header.classList.remove('sticky');
		    	}
		    	else if (document.body.scrollTop > 300 || document.documentElement.scrollTop > 300)
		    	{
		    		this.header.classList.add('sticky');
		    	}
			}.bind(this));
		}

		document.getElementById('mobile-trigger').addEventListener('click', function(e)
		{
			e.preventDefault();

			dom.mobile.menu.isOpen = !dom.mobile.menu.isOpen;

			var menu = document.getElementById('mobile-menu')
			var trigger = document.getElementById('mobile-trigger');

			if(dom.mobile.menu.isOpen)
			{
				menu.classList.add('open');
				trigger.classList.add('open');
				menu.addEventListener('click', dom.mobileMenuEventListener);
			}
			else
			{
				menu.classList.remove('open');
				trigger.classList.remove('open');
				menu.removeEventListener('click', dom.mobileMenuEventListener);
			}
		});
	}

	this.init();
}

var dom = new DOMClass();