$(document).ready(function() {
    $('#signin').on('click', function (event) {
        event.preventDefault();
        
        var username = $('#name').val();
        var password = $('#word').val();
        if($.trim(username).length > 0 && $.trim(password).length > 0) {
            
            $.ajax({
                type:'POST',
                url:'login.php',
                data: {
                    'username':username,
                    'password':password,
                },
                cache:false,
                beforeSend: (function() {
                    $('#signin').val('Logging in...');
                }),
                success: (function(data){
                    if($.trim(data) == "Access granted") {
                        $('#display').html("<div class='alert alert-success'>Welcome Back</div>");
                        window.location.assign('../.').hide().fadeIn(1500);
                    } else if($.trim(data) == "Access denied") {
                        $('#signin').val('Log in');
                        $('#display').html("<div class='alert alert-danger'>Invalid username or password</div>").hide().fadeIn(1000);
                    }
                })
            }); 
        } else {
            $('#display').html("<div class='alert alert-danger'>Kindly type in your username and password</div>");
        }
    });
});
