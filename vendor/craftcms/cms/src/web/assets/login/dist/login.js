!function(){var t={881:function(){},84:function(t,e,r){var s=r(881);s.__esModule&&(s=s.default),"string"==typeof s&&(s=[[t.id,s,""]]),s.locals&&(t.exports=s.locals),(0,r(673).Z)("81d37080",s,!0,{})},673:function(t,e,r){"use strict";function s(t,e){for(var r=[],s={},n=0;n<e.length;n++){var i=e[n],o=i[0],a={id:t+":"+n,css:i[1],media:i[2],sourceMap:i[3]};s[o]?s[o].parts.push(a):r.push(s[o]={id:o,parts:[a]})}return r}r.d(e,{Z:function(){return f}});var n="undefined"!=typeof document;if("undefined"!=typeof DEBUG&&DEBUG&&!n)throw new Error("vue-style-loader cannot be used in a non-browser environment. Use { target: 'node' } in your Webpack config to indicate a server-rendering environment.");var i={},o=n&&(document.head||document.getElementsByTagName("head")[0]),a=null,u=0,d=!1,l=function(){},p=null,h="data-vue-ssr-id",c="undefined"!=typeof navigator&&/msie [6-9]\b/.test(navigator.userAgent.toLowerCase());function f(t,e,r,n){d=r,p=n||{};var o=s(t,e);return m(o),function(e){for(var r=[],n=0;n<o.length;n++){var a=o[n];(u=i[a.id]).refs--,r.push(u)}for(e?m(o=s(t,e)):o=[],n=0;n<r.length;n++){var u;if(0===(u=r[n]).refs){for(var d=0;d<u.parts.length;d++)u.parts[d]();delete i[u.id]}}}}function m(t){for(var e=0;e<t.length;e++){var r=t[e],s=i[r.id];if(s){s.refs++;for(var n=0;n<s.parts.length;n++)s.parts[n](r.parts[n]);for(;n<r.parts.length;n++)s.parts.push(w(r.parts[n]));s.parts.length>r.parts.length&&(s.parts.length=r.parts.length)}else{var o=[];for(n=0;n<r.parts.length;n++)o.push(w(r.parts[n]));i[r.id]={id:r.id,refs:1,parts:o}}}}function v(){var t=document.createElement("style");return t.type="text/css",o.appendChild(t),t}function w(t){var e,r,s=document.querySelector("style["+h+'~="'+t.id+'"]');if(s){if(d)return l;s.parentNode.removeChild(s)}if(c){var n=u++;s=a||(a=v()),e=$.bind(null,s,n,!1),r=$.bind(null,s,n,!0)}else s=v(),e=I.bind(null,s),r=function(){s.parentNode.removeChild(s)};return e(t),function(s){if(s){if(s.css===t.css&&s.media===t.media&&s.sourceMap===t.sourceMap)return;e(t=s)}else r()}}var g,b=(g=[],function(t,e){return g[t]=e,g.filter(Boolean).join("\n")});function $(t,e,r,s){var n=r?"":s.css;if(t.styleSheet)t.styleSheet.cssText=b(e,n);else{var i=document.createTextNode(n),o=t.childNodes;o[e]&&t.removeChild(o[e]),o.length?t.insertBefore(i,o[e]):t.appendChild(i)}}function I(t,e){var r=e.css,s=e.media,n=e.sourceMap;if(s&&t.setAttribute("media",s),p.ssrId&&t.setAttribute(h,e.id),n&&(r+="\n/*# sourceURL="+n.sources[0]+" */",r+="\n/*# sourceMappingURL=data:application/json;base64,"+btoa(unescape(encodeURIComponent(JSON.stringify(n))))+" */"),t.styleSheet)t.styleSheet.cssText=r;else{for(;t.firstChild;)t.removeChild(t.firstChild);t.appendChild(document.createTextNode(r))}}}},e={};function r(s){var n=e[s];if(void 0!==n)return n.exports;var i=e[s]={id:s,exports:{}};return t[s](i,i.exports,r),i.exports}r.n=function(t){var e=t&&t.__esModule?function(){return t.default}:function(){return t};return r.d(e,{a:e}),e},r.d=function(t,e){for(var s in e)r.o(e,s)&&!r.o(t,s)&&Object.defineProperty(t,s,{enumerable:!0,get:e[s]})},r.o=function(t,e){return Object.prototype.hasOwnProperty.call(t,e)},function(){"use strict";var t,e,s;r(84),t=jQuery,e=Garnish.Base.extend({$form:null,$loginNameInput:null,$passwordInput:null,$rememberMeCheckbox:null,$forgotPasswordLink:null,$rememberPasswordLink:null,$submitBtn:null,$spinner:null,$errors:null,forgotPassword:!1,validateOnInput:!1,init:function(){var e=this;this.$form=t("#login-form"),this.$loginNameInput=t("#loginName"),this.$passwordInput=t("#password"),this.$rememberMeCheckbox=t("#rememberMe"),this.$forgotPasswordLink=t("#forgot-password"),this.$rememberPasswordLink=t("#remember-password"),this.$submitBtn=t("#submit"),this.$spinner=t("#spinner"),this.$errors=t("#login-errors"),new Craft.PasswordInput(this.$passwordInput,{onToggleInput:function(t){e.removeListener(e.$passwordInput,"input"),e.$passwordInput=t,e.addListener(e.$passwordInput,"input","onInput")}}),this.addListener(this.$loginNameInput,"input","onInput"),this.addListener(this.$passwordInput,"input","onInput"),this.addListener(this.$forgotPasswordLink,"click","onSwitchForm"),this.addListener(this.$rememberPasswordLink,"click","onSwitchForm"),this.addListener(this.$form,"submit","onSubmit"),Garnish.isMobileBrowser()||(this.$loginNameInput.val()?this.$passwordInput.focus():this.$loginNameInput.focus())},validate:function(){var t=this.$loginNameInput.val();if(0===t.length)return window.useEmailAsUsername?Craft.t("app","Invalid email."):Craft.t("app","Invalid username or email.");if(window.useEmailAsUsername&&!t.match(".+@.+..+"))return Craft.t("app","Invalid email.");if(!this.forgotPassword){var e=this.$passwordInput.val().length;if(e<window.minPasswordLength)return Craft.t("yii","{attribute} should contain at least {min, number} {min, plural, one{character} other{characters}}.",{attribute:Craft.t("app","Password"),min:window.minPasswordLength});if(e>window.maxPasswordLength)return Craft.t("yii","{attribute} should contain at most {max, number} {max, plural, one{character} other{characters}}.",{attribute:Craft.t("app","Password"),max:window.maxPasswordLength})}return!0},onInput:function(t){this.validateOnInput&&!0===this.validate()&&this.clearErrors()},onSubmit:function(t){t.preventDefault();var e=this.validate();if(!0!==e)return this.showError(e),void(this.validateOnInput=!0);this.$submitBtn.addClass("active"),this.$spinner.removeClass("hidden"),this.clearErrors(),this.forgotPassword?this.submitForgotPassword():this.submitLogin()},submitForgotPassword:function(){var t=this,e={loginName:this.$loginNameInput.val()};Craft.postActionRequest("users/send-password-reset-email",e,(function(e,r){"success"===r&&(e.success?new s:t.showError(e.error)),t.onSubmitResponse()}))},submitLogin:function(){var t=this,e={loginName:this.$loginNameInput.val(),password:this.$passwordInput.val(),rememberMe:this.$rememberMeCheckbox.prop("checked")?"y":""};return Craft.postActionRequest("users/login",e,(function(e,r){"success"===r?e.success?window.location.href=e.returnUrl:(Garnish.shake(t.$form),t.onSubmitResponse(),t.showError(e.error)):t.onSubmitResponse()})),!1},onSubmitResponse:function(){this.$submitBtn.removeClass("active"),this.$spinner.addClass("hidden")},showError:function(e){this.clearErrors(),t('<p style="display: none;">'+e+"</p>").appendTo(this.$errors).velocity("fadeIn")},clearErrors:function(){this.$errors.empty()},onSwitchForm:function(t){Garnish.isMobileBrowser()||this.$loginNameInput.trigger("focus"),this.clearErrors(),this.forgotPassword=!this.forgotPassword,this.$form.toggleClass("reset-password",this.forgotPassword),this.$submitBtn.text(Craft.t("app",this.forgotPassword?"Reset Password":"Login"))}}),s=Garnish.Modal.extend({init:function(){var e=t('<div class="modal fitted email-sent"><div class="body">'+Craft.t("app","Check your email for instructions to reset your password.")+"</div></div>").appendTo(Garnish.$bod);this.base(e)},hide:function(){}}),new e}()}();
//# sourceMappingURL=login.js.map