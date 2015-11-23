/**
 * Created by oluwasegunmatthew on 7/8/15.
 */
$(document).ready(function() {
    // Execute some code here
    $.ajaxSetup({cache: true});
    $.getScript('//connect.facebook.net/en_US/sdk.js', function () {
        FB.init({
            appId: '751195085006194',
            version: 'v2.3' // or v2.0, v2.1, v2.0
        });

        //$('#loginbutton,#feedbutton').removeAttr('disabled');
        FB.getLoginStatus(updateStatusCallback);
    });
});