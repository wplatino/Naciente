/**
 * Disqus Lazy Load by Scott Vinkle
 * Source Code: http://codepen.io/svinkle/pen/mAfes
 *
 * This version has been modified by José SAYAGO from L'Elite
 */
(function () {
	'use strict';
	// Global object
	var App = {};  

	if( document.getElementById('article-comments') != null ) {

		// Create button
		App.commentsButton = document.createElement('button');
		App.commentsButton.setAttribute('class', 'comments-button');
		App.commentsButton.setAttribute('data-js', 'comments-button');
		// Get Domain
		var myDomain = window.location.host;
		switch( myDomain ) {
			case '8elite.com':
				App.commentsButton.innerHTML = 'Show Comments';
				break;
			case 'es.8elite.com':
				App.commentsButton.innerHTML = 'Mostrar Comentarios';
				break;
			case 'en.8elite.com':
				App.commentsButton.innerHTML = 'Show Comments';
				break;
			case 'fr.8elite.com':
				App.commentsButton.innerHTML = 'Afficher Commentaires';
				break;
			default:
				App.commentsButton.innerHTML = 'Show Comments';
				break;
		}
		// Append button to body
		document.getElementById('article-comments').appendChild( App.commentsButton );

		// Click event handler
		App.commentsButton.onclick = function () {
			// Remove button on click
			this.parentNode.removeChild(this);
			// Create comments container
			App.disqusContainer = document.createElement('div');
			App.disqusContainer.setAttribute('id', 'disqus_thread');
			// Append container to body
			document.getElementById('article-comments').appendChild( App.disqusContainer );
			// Get Domain
			var myDomain = window.location.host;
			switch( myDomain ) {
				case '8elite.com':
					// Disqus Shortname
					App.disqus_shortname = '8elite';
					break;
				case 'es.8elite.com':
					// Disqus Shortname
					App.disqus_shortname = '8eliteenespanol';
					break;
				case 'en.8elite.com':
					// Disqus Shortname
					App.disqus_shortname = '8eliteinenglish';
					break;
				case 'fr.8elite.com':
					// Disqus Shortname
					App.disqus_shortname = '8eliteenfrancais';
					break;
				default:
					// Disqus Shortname
					App.disqus_shortname = '8elite';
					break;
			}
			// Embed Disqus
			var dsq = document.createElement('script');
			dsq.type = 'text/javascript';
			dsq.async = true;
			dsq.src = '//' + App.disqus_shortname + '.disqus.com/embed.js';
			(document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
		};
	}
})();