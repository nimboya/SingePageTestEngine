/**
 * Created by oluwasegunmatthew on 7/8/15.
 */

// Load the SDK asynchronously
(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

window.fbAsyncInit = function() {
    FB.init({
        appId      : '751195085006194',
        cookie     : true,  // enable cookies to allow the server to access
                            // the session
        xfbml      : true,  // parse social plugins on this page
        version    : 'v2.2', // use version 2.2,
        status     : true,
        oauth      : true
    });

    FB.getLoginStatus(function(response) {
        //statusChangeCallback(response);
    });
};


// This is called with the results from from FB.getLoginStatus().
function statusChangeCallback(response) {
    console.log('statusChangeCallback');
    console.log(response);
    if (response.status === 'connected') {
        loadProfile();
    } else if (response.status === 'not_authorized') {
        //document.getElementById('status').innerHTML = 'Please log ' +
        //'into this app.';
    } else {
        //document.getElementById('status').innerHTML = 'Please log ' +
        //'into Facebook.';
    }
}

function checkLoginState() {
    FB.getLoginStatus(function(response) {
        statusChangeCallback(response);
    });
}


function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
        results = regex.exec(location.search);
    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}

function loadProfile() {
    var attempted = getParameterByName('attempted');
    //alert(window.location.href);
    if(attempted != true) {
        var location = 'https://terragonmedia.com/closeup/register.php';
        window.location.href = location;
    }
}

function FB_LoginVote(){
    FB.login(function(response) {
        if (response.status === 'connected') {
            loadProfileVote();
        } else {
            console.log('User cancelled login or did not fully authorize.');
        }
    }, {
        scope: 'public_profile,user_friends,email'
    });
}

function FB_Login(){
    FB.login(function(response) {
        if (response.status === 'connected') {
            loadProfile();
        } else {
            console.log('User cancelled login or did not fully authorize.');
        }
    }, {
        scope: 'public_profile,user_friends,email'
    });
}


function FB_Link_Account(){
    FB.login(function(response){
        if(response.status === 'connected'){

        }else{
            console.log('Something strange actually happened.')
        }
    });
}

function FB_Logout(){
    FB.logout(function(response) {
        // user is now logged out
        console.log(response);
    });
}