/*
 * Bones Scripts File
 * Author: Eddie Machado
 *
 * This file should contain any js scripts you want to add to the site.
 * Instead of calling it in the header or throwing it inside wp_head()
 * this file will be called automatically in the footer so as not to
 * slow the page load.
 *
 * There are a lot of example functions and tools in here. If you don't
 * need any of it, just remove it. They are meant to be helpers and are
 * not required. It's your world baby, you can do whatever you want.
*/


/*
 * Get Viewport Dimensions
 * returns object with viewport dimensions to match css in width and height properties
 * ( source: http://andylangton.co.uk/blog/development/get-viewport-size-width-and-height-javascript )
*/
function updateViewportDimensions() {
	var w=window,d=document,e=d.documentElement,g=d.getElementsByTagName('body')[0],x=w.innerWidth||e.clientWidth||g.clientWidth,y=w.innerHeight||e.clientHeight||g.clientHeight;
	return { width:x,height:y };
}
// setting the viewport width
var viewport = updateViewportDimensions();


/*
 * Throttle Resize-triggered Events
 * Wrap your actions in this function to throttle the frequency of firing them off, for better performance, esp. on mobile.
 * ( source: http://stackoverflow.com/questions/2854407/javascript-jquery-window-resize-how-to-fire-after-the-resize-is-completed )
*/
var waitForFinalEvent = (function () {
	var timers = {};
	return function (callback, ms, uniqueId) {
		if (!uniqueId) { uniqueId = "Don't call this twice without a uniqueId"; }
		if (timers[uniqueId]) { clearTimeout (timers[uniqueId]); }
		timers[uniqueId] = setTimeout(callback, ms);
	};
})();

// how long to wait before deciding the resize has stopped, in ms. Around 50-100 should work ok.
var timeToWaitForLast = 100;


/*
 * Here's an example so you can see how we're using the above function
 *
 * This is commented out so it won't work, but you can copy it and
 * remove the comments.
 *
 *
 *
 * If we want to only do it on a certain page, we can setup checks so we do it
 * as efficient as possible.
 *
 * if( typeof is_home === "undefined" ) var is_home = $('body').hasClass('home');
 *
 * This once checks to see if you're on the home page based on the body class
 * We can then use that check to perform actions on the home page only
 *
 * When the window is resized, we perform this function
 * $(window).resize(function () {
 *
 *    // if we're on the home page, we wait the set amount (in function above) then fire the function
 *    if( is_home ) { waitForFinalEvent( function() {
 *
 *	// update the viewport, in case the window size has changed
 *	viewport = updateViewportDimensions();
 *
 *      // if we're above or equal to 768 fire this off
 *      if( viewport.width >= 768 ) {
 *        console.log('On home page and window sized to 768 width or more.');
 *      } else {
 *        // otherwise, let's do this instead
 *        console.log('Not on home page, or window sized to less than 768.');
 *      }
 *
 *    }, timeToWaitForLast, "your-function-identifier-string"); }
 * });
 *
 * Pretty cool huh? You can create functions like this to conditionally load
 * content and other stuff dependent on the viewport.
 * Remember that mobile devices and javascript aren't the best of friends.
 * Keep it light and always make sure the larger viewports are doing the heavy lifting.
 *
*/

/*
 * We're going to swap out the gravatars.
 * In the functions.php file, you can see we're not loading the gravatar
 * images on mobile to save bandwidth. Once we hit an acceptable viewport
 * then we can swap out those images since they are located in a data attribute.
*/
function loadGravatars() {
  // set the viewport using the function above
  viewport = updateViewportDimensions();
  // if the viewport is tablet or larger, we load in the gravatars
  if (viewport.width >= 768) {
  jQuery('.comment img[data-gravatar]').each(function(){
    jQuery(this).attr('src',jQuery(this).attr('data-gravatar'));
  });
	}
} // end function

// The YouTube Iframe API function has to be in the global scope, so it's out here outside of jQuery document.reaady
// Using jQuery deferred objects to be able to run jQuery when the function runs
// http://stackoverflow.com/questions/17753525/onyoutubeiframeapiready-inside-jquerydocument-ready
// var YouTubeDeferred = jQuery.Deferred();
// window.onYouTubeIframeAPIReady = function(){
//	YouTubeDeferred.resolve(window.YT);
// }


/*
 * Put all your regular jQuery in here.
*/
jQuery(document).ready(function($) {
	loadGravatars();
	var win = $(window);
	var html = $('html');
	var body = $('body');
	
	// Check what page we're on
	if (typeof isHome === "undefined") var isHome = body.hasClass('home');
	
	win.resize(function() {
		waitForFinalEvent( function() {
			headerHeight();
			if (isHome) {
				checkSponsorSliderWidth('resize');
			}
		}, timeToWaitForLast, 'resizeWindow');
	});
	
	win.scroll(function() {
		headerHeight();
	});
	
	// Control mobile main nav
	$('.TRIGGER_NAV').click(function(e) {
		e.preventDefault();
		$(this).add('.MAIN_NAV').toggleClass('active');
		html.toggleClass('mobile-nav-active');
	});
	
	function headerHeight() {
		var scrollTrigger = 0;
		if (win.scrollTop() > scrollTrigger) {
			html.addClass('scrolled');
		} else {
			html.removeClass('scrolled');
		}
	}
	// Overlay functions
	function ovOpen(ov,noHistoryPush,loc) {
		ov.addClass('active');
		ovCheckHeight(ov);
		$('html').addClass('ov-active');
		if (!noHistoryPush) {
			var stateObj = { ovClassName:ov[0].className  };
			window.history.pushState(stateObj, 'overlay', loc);
		}
	}
	function ovClose(ov,player) {
		ov.removeClass('active');
		console.log(ov.attr('class'));
		if (ov.hasClass('VID_PLAYER_OV') && player) {
			player.pause();
		}
		if ($('.ov.active').length < 1) {
			$('html').removeClass('ov-active');
		}
	}
	function ovCheckHeight(ov) {
		var ovChild = ov.children().first();
		if (ovChild.outerHeight() > ov.height()) {
			ov.addClass('too-tall');
		} else {
			ov.removeClass('too-tall');
		}
	}
	// parse YouTube ID from URL
	function youtube_parser(url) {
		var ID = '';
		url = url.replace(/(>|<)/gi,'').split(/(vi\/|v=|\/v\/|youtu\.be\/|\/embed\/)/);
		if(url[2] !== undefined) {
			ID = url[2].split(/[^0-9a-z_\-]/i);
			ID = ID[0];
		}
		else {
			ID = url;
		}
		return ID;
	}
	console.log(Vimeo);
	var player;
	function loadVimeoPlayer(ID,autoPlay) {
		var vidContainer = $('.vid-player-container');
		console.log('currentID: '+vidContainer.data('currentID'));
		console.log('newID: '+ID);
		if (vidContainer.data('currentID') && vidContainer.data('currentID') != ID) {
			player.destroy();
		}
		vidContainer.data('currentID',ID);
		player = new Vimeo.Player('video_player',{
			id:ID,
			height:720,
			width:1280
		});
		ovOpen(vidContainer);
		if (autoPlay) {
			player.play();
		}
	}
	$('body').on('click', '.VIDEO_PLAY,.PLAYLIST_PLAY', function(e) {
		e.preventDefault();
		loadVimeoPlayer($(this).attr('data-video-id'),true);
	});
	/*var player;
	YouTubeDeferred.done(function(YT) {
		player = new YT.Player('video_player', {
			width:1280,
			height:720,
			events: {
				onReady: function() {
					if (isSingleShow) {
						var queryString = getQueryString();
						if (queryString['autoplay']) {
							$('.TRIGGER_VIDEO').click();
						}
					}
				},
				onStateChange : function(e) {
					if (e.data == 1 && !mobileDeviceType()) {
						videoIntervalCheck() ;
					} else {
						clearVideoIntervalCheck();
					}
				}
			},
			playerVars: {
				//'modestbranding':1,
				'rel':0,
				'showinfo':0
			}
		});
	});
	function playOrCueVideo(vid,isPlaylist) {
		if (vid.ID == vid.currentVidIDInput.val()) {
			console.log('these match');
			player.playVideo();
		} else if (isPlaylist) {
			player.cuePlaylist({
				listType:'playlist',
				list:vid.ID
			});
		} else {
			vid.currentVidIDInput.val(vid.ID);
			player.cueVideoById(vid.ID);
			vid.ov.find('.action-donate').attr('href', vid.donateURL);
			vid.ov.find('.action-join').attr('href', vid.joinURL);
		}
	}
	$('body').on('click', '.VIDEO_PLAY,.PLAYLIST_PLAY', function(e) {
		e.preventDefault();
		var vid = {};
		if ($(this).hasClass('PLAYLIST_PLAY')) { vid.isPlaylist = true; }
		vid.URL = $(this).data('video-url') || $(this).attr('data-video-url');
		//console.log('vid.URL = '+vid.URL);
		vid.pageUrl = $(this).attr('href') || window.location.href;
		
		vid.ov = $('.VID_PLAYER_OV');
		vid.player = $('#video_player');
		vid.currentVidIDInput = vid.ov.find('.VID_PLAYER_CURRENT_ID');
		vid.ID = vid.isPlaylist ? $(this).attr('data-playlist-ID') : youtube_parser($(this).attr('data-video-id'));
		console.log('vid.ID = '+vid.ID);
		console.log(vid);
		console.log(player);
		ovOpen(vid.ov,false,vid.pageUrl);
		if (vid.ID == vid.currentVidIDInput.val()) {
			console.log('IDs match');
			player.playVideo();
		} else if (vid.isPlaylist) {
			console.log('is playlist');
			vid.currentVidIDInput.val(vid.ID);
			vid.ov.addClass('vid-player-container-simple');
			player.cuePlaylist({
				listType:'playlist',
				list:vid.ID
			});
		} else {
			console.log('is video');
			vid.currentVidIDInput.val(vid.ID);
			player.cueVideoById(vid.ID);
			console.log(vid);
			if (vid.donateURL || vid.joinURL) {
				vid.ov.removeClass('vid-player-container-simple');
				vid.ov.find('.action-donate').attr('href', vid.donateURL);
				vid.ov.find('.action-join').attr('href', vid.joinURL);
			} else {
				vid.ov.addClass('vid-player-container-simple');
			}
		}
	})/*.on('click', '.PLAYLIST_PLAY', function(e) {
		e.preventDefault();
		var vid = {};
		vid.ov = $('.VID_PLAYER_OV');
		vid.currentVidIDInput = vid.ov.find('.VID_PLAYER_CURRENT_ID');
		ovOpen(vid.ov,true);
		playOrCueVideo(vid,true)
	});*/
	$('.OV_CLOSE').click(function(e) {
		e.preventDefault();
		ovClose($(this).parents('.OV'),(player ? player : false));
	});
	$('.VID_PLAYER_OV').click(function(e) {
		if (e.target !== this) { return; }
		ovClose($(this),(player ? player : false));
	});
	win.keyup(function(e) {
		if (e.keyCode == 27 || e.which == 27) {
			ovClose($('.OV.active'),(player ? player : false));
		}
	});
}); /* end of as page load scripts */
