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
			isOpen: false,
			listener: function(e)
			{
				dom.mobile.menu.show(false);
			},
			show: function(doShow)
			{
				var menu = document.getElementById('mobile-menu')
				var trigger = document.getElementById('mobile-trigger');

				if(doShow)
				{
					menu.classList.add('open');
					trigger.classList.add('open');
					menu.addEventListener('click', dom.mobile.menu.listener);
					document.body.style.overflow = 'hidden';

					dom.mobile.menu.isOpen = true;
				}
				else
				{
					menu.classList.remove('open');
					trigger.classList.remove('open');
					menu.removeEventListener('click', dom.mobile.menu.listener);
					document.body.style.overflow = 'auto';

					dom.mobile.menu.isOpen = false;
				}
			}
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

			dom.mobile.menu.show(!dom.mobile.menu.isOpen);
		});
	}

	this.init();
}

var dom = new DOMClass();