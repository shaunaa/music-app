$(document).ready(function(){
    $('#hideLoginForm').click(function(){
        $('#loginForm').hide();
        $('#signupForm').show();
    })

    $('#hideSignupForm').click(function(){
        $('#signupForm').hide();
        $('#loginForm').show();
    })
})

