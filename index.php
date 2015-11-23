<?php 
include_once ('lib/config.php');
include_once ('lib/user.php');
include_once("header.php");
?>
<div id="home" class="head">
    <div class="header-section">
		<div class="siteHeader"></div>
		<div class="container">
		<div class="row">
		<div class="col-lg-6 cntr">
			<div class="tp-bg">
				<h1>Welcome to "I Love Nigeria Competition"</h1>
				<p class="features"><font size="5">How well do you know Nigeria ?</font></p>
				<p class="features"><font size="5">Whose face is on the N10.00 ? </font></p>
				<p class="features"><font size="5">Who was the first President ? </font></p>
				<a href="javascript:void(0);" onclick="FB_Login();" class="callHome" data-toggle="modal">Play Now</a>
			</div>
		</div>
		</div>
		</div>
	</div>
</div>
<div id="fb-root" class=" fb_reset">
         <div style="position: absolute; top: -10000px; height: 0px; width: 0px;">
            <div><iframe name="fb_xdm_frame_http" frameborder="0" allowtransparency="true" allowfullscreen="true" scrolling="no" id="fb_xdm_frame_http" aria-hidden="true" title="Facebook Cross Domain Communication Frame" tabindex="-1" src="http://static.ak.facebook.com/connect/xd_arbiter/44OwK74u0Ie.js?version=41#channel=f12ebd058&amp;origin=http%3A%2F%2Fterragonmedia.com" style="border: none;"></iframe><iframe name="fb_xdm_frame_https" frameborder="0" allowtransparency="true" allowfullscreen="true" scrolling="no" id="fb_xdm_frame_https" aria-hidden="true" title="Facebook Cross Domain Communication Frame" tabindex="-1" src="https://s-static.ak.facebook.com/connect/xd_arbiter/44OwK74u0Ie.js?version=41#channel=f12ebd058&amp;origin=http%3A%2F%2Fterragonmedia.com" style="border: none;"></iframe></div>
         </div>
         <div style="position: absolute; top: -10000px; height: 0px; width: 0px;">
            <div></div>
         </div>
      </div>
	</head>	  
<?php include_once 'footer.php'; ?>