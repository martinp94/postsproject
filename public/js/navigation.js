document.addEventListener('DOMContentLoaded', () => { 
	if(document.querySelector('.menu-arrow'))
	    document.querySelector('.menu-arrow > img').addEventListener('click', () => {
	        document.querySelector('nav ul').style.visibility === 'visible' ? document.querySelector('nav ul').style.cssText = 'visibility: hidden;' : document.querySelector('nav ul').style.cssText = 'visibility: visible;';
	});
}, false);