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

			var theme = this.cookies.get('arctheme');
			if(theme != "" && this.header.classList.contains(theme) == false)
			{
				this.header.classList.remove('theme-night');
				this.header.classList.remove('theme-day');
				this.header.classList.add(theme);
			}

			if(this.header.classList.contains('video-header'))
			{
				document.getElementById('scroll-down').classList.add('show');
			}
		}
		else
		{
			this.header = null;
		}

		var team = document.getElementsByClassName('team-members');
		if(team.length)
		{
		}

		var testimonials = document.getElementsByClassName('testimonials');
		if(testimonials.length)
		{
			for(i=0; i<testimonials.length; i++)
			{
				var bQuotes = testimonials[i].getElementsByTagName('blockquote');
				for(ii=0; ii<bQuotes.length; ii++)
				{
					if(bQuotes[ii].hasAttribute('cite'))
					{
						bQuotes[ii].addEventListener('click', function(e)
						{
							e.preventDefault();
							if(this.getAttribute('cite').substring(0, 4) == 'http')
							{
								window.open(this.getAttribute('cite'), '_blank');
							}

						});
					}
				}

				testimonials[i].querySelectorAll('.prev')[0].addEventListener('click', function(e)
				{
					e.preventDefault();
					this.querySelector('.active').classList.add('inactivate')
					setTimeout(function()
					{
						var current = this.querySelector('.active');
						
						setTimeout(function()
						{
							this.classList.remove('inactivate');
						}.bind(current), 100);

						current.classList.remove('active');

						if(current.previousElementSibling == null || current.previousElementSibling.tagName.toLowerCase() != 'blockquote')
						{
							var quotes = this.getElementsByTagName('blockquote');
							quotes[quotes.length - 1].classList.add('active');
						}
						else
						{
							current.previousElementSibling.classList.add('active');
						}
					}.bind(this), 250);
				}.bind(testimonials[i]));

				testimonials[i].querySelectorAll('.next')[0].addEventListener('click', function(e)
				{
					e.preventDefault();
					this.querySelector('.active').classList.add('inactivate')
					setTimeout(function()
					{
						var current = this.querySelector('.active');

						setTimeout(function()
						{
							this.classList.remove('inactivate');
						}.bind(current), 100);

						current.classList.remove('active');

						if(current.nextElementSibling == null || current.nextElementSibling.tagName.toLowerCase() != 'blockquote')
						{
							this.getElementsByTagName('blockquote')[0].classList.add('active');
						}
						else
						{
							current.nextElementSibling.classList.add('active');
						}
					}.bind(this), 250);
				}.bind(testimonials[i]));
			}
		}

		var forms = document.getElementsByClassName('arc-form');
		if(forms.length)
		{
			this.initForms(forms);
		}

		this.addEvents();
	}

	this.addEvents = function()
	{
		let themeSwitch = document.getElementById('theme-switch');
		themeSwitch.addEventListener('click', function(e)
		{
			if(this.switch.checked)
			{
				document.documentElement.classList.remove('theme-night');
				document.documentElement.classList.add('theme-day');
				this.obj.cookies.set('arctheme', 'theme-day');
			}
			else
			{
				document.documentElement.classList.remove('theme-day');
				document.documentElement.classList.add('theme-night');
				this.obj.cookies.set('arctheme', 'theme-night');
			}
		}.bind({switch:themeSwitch, obj:this}));

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

	this.cookies = {
		get: function(cname)
		{
			var name = cname + "=";
			var decodedCookie = decodeURIComponent(document.cookie);
			var ca = decodedCookie.split(';');
			for(var i = 0; i <ca.length; i++)
			{
				var c = ca[i];
				while (c.charAt(0) == ' ')
				{
					c = c.substring(1);
				}
				if (c.indexOf(name) == 0)
				{
					return c.substring(name.length, c.length);
				}
			}
			return "";
		},
		set: function(cname, cvalue)
		{
			var exdays = 365;
			var d = new Date();
			d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
			let expires = "expires="+d.toUTCString();
			document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
		}
	}

	this.validateField = function(field)
	{
		var isValid = true;

		if(field.type != 'radio' && field.classList.contains('error'))
		{
			field.classList.remove('error');
			if(field.nextSibling != null && typeof(field.nextSibling.classList) != 'undefined' && field.nextSibling.classList.contains('error'))
			{
				field.nextSibling.remove();
			}
		}

		switch(field.dataset.validation)
		{
			case 'required':
				if(field.type == 'radio')
				{
					if(document.querySelectorAll('[name="' + field.name + '"]:checked').length == 0)
					{
						isValid = false;
					}
				}
				else if(field.value.trim().length == 0)
				{
					isValid = false;

					if(!field.classList.contains('error'))
					{
						field.classList.add('error');
						field.insertAdjacentHTML('afterend', '<span class="error">This field is required</span>');
					}
				}
				break;
			case 'email':
				if(field.value.trim().length == 0 || field.value.indexOf('@') < 0)
				{
					isValid = false;

					if(!field.classList.contains('error'))
					{
						field.classList.add('error');
						field.insertAdjacentHTML('afterend', '<span class="error">This field is required</span>');
					}
				}
				break;
		}

		return isValid;
	}

	this.initForms = function(forms)
	{
		for(i=0; i<forms.length; i++)
		{
			var formValidationFields = forms[i].querySelectorAll('[data-validation]');

			for(ii=0; ii<formValidationFields.length; ii++)
			{
				formValidationFields[ii].addEventListener('keyup', function()
				{
					this.class.validateField(this.field);
				}.bind({class:this,field:formValidationFields[ii]}));
			}

			if(forms[i].classList.contains('quiz'))
			{
				document.querySelector('.quiz-complete .repeat-course').addEventListener('click', function(e)
				{
					e.preventDefault();
					document.querySelector('.quiz-complete').classList.remove('show');
					this.form.reset();
					this.form.classList.add('show');
				}.bind({form:forms[i]}));
			}

			forms[i].addEventListener('submit', function(e)
			{
				var isValid = true;

				var validationFields = this.form.querySelectorAll('[data-validation]');

				var frm = this.form;

				for(ii=0; ii<validationFields.length; ii++)
				{
					if(!this.class.validateField(validationFields[ii]))
					{
						isValid = false;

						if(this.form.classList.contains('quiz'))
						{
							this.form.querySelector('.error').classList.remove('show');
							setTimeout(function()
							{
								this.form.querySelector('.error.validation').classList.add('show');
							}.bind(this), 350);
						}
					}
				}

				if(!isValid)
				{
					e.preventDefault();
					return false;
				}

				if(this.form.dataset.submit == 'ajax')
				{
					e.preventDefault();

					var formData = new FormData(this.form);
					var formSerialized = '';

					for (var pair of formData.entries())
					{
						if(formSerialized != '')
						{
							formSerialized += '&';
						}
						formSerialized += (pair[0] + '=' + pair[1]);
					}

					var xhr = new XMLHttpRequest();
					xhr.open("POST", this.form.action, true);
					xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
					xhr.onreadystatechange = function()
					{
					    if (this.readyState === XMLHttpRequest.DONE && this.status === 200)
					    {
					        if(frm.classList.contains('quiz'))
							{
								// console.log('done');
					   //      	console.log('score = ' + xhr.responseText);
								if(xhr.responseText == 'error')
								{
									console.log('Quiz Error');
									frm.querySelector('.error').classList.remove('show');
									frm.querySelector('.error.saving').classList.add('show');
								}
								else
								{
									if(xhr.responseText.length < 4)
									{
										let parseScore = parseInt(xhr.responseText);
										if(parseScore < 70)
										{
											document.getElementById('quiz-results').innerHTML = `You have completed this course with a score of <strong>${xhr.responseText}</strong>. You must score 70 or higher for it to be added to your progress.`;
										}
										else
										{
											document.getElementById('quiz-results').innerHTML = `Congratulations! You have passed this course with a score of <strong>${xhr.responseText}</strong>. What would you like to do next?`;
										}
									}
									else
									{
										document.getElementById('quiz-results').innerText = 'We were unable to calculate your score at this time.';
									}

									document.querySelector('.quiz').classList.remove('show');
									document.querySelector('.quiz-complete').classList.add('show');
								} 
							}
							else
							{
						        frm.classList.add('hide');
						        if(frm.previousElementSibling.classList.contains('form-response'))
						        {
						        	frm.previousElementSibling.classList.add('show')	
						        }
						    }

					    }
					}
					// console.log(formSerialized);
					xhr.send(formSerialized);

					return false;
				}
				
			}.bind({class:this,form:forms[i]}));

		}
	}

	this.init();
}

var dom = new DOMClass();