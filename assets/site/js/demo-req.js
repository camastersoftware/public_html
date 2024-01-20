
function drRefreshCaptcha()
{
    const dr_captcha=drCaptachFunc();
    
    dr_captcha.refresh();
    $('#drCaptchaCodeErr').text('');
    $('#drCaptchaCode').val('');
    
}

function drRefreshCaptchaObj(dr_captcha)
{
    dr_captcha.refresh();
    $('#drCaptchaCodeErr').text('');
    $('#drCaptchaCode').val('');
    
}

function drCaptachFunc()
{
    const dr_captcha = new Captcha($('#drCanvas'),{
        length: 6,
        width: 200
    });
    
    return dr_captcha;
}

var countdownInterval;

function startCountdown() {
    // Set reverse countdown for 1 minute (60 seconds)
    var reverseCountdown = 60; // 60 seconds

    // Initialize the countdown display
    updateCountdownDisplay(reverseCountdown);

    // Update the countdown every second
    countdownInterval = setInterval(function() {
        reverseCountdown--;

        if (reverseCountdown >= 0) {
            // Update the countdown display
            updateCountdownDisplay(reverseCountdown);
        } else {
            // Call your event function when the countdown reaches zero
            clearInterval(countdownInterval); // Stop the countdown
            $('#countdownSpan').hide();
            $('#reSendOtpBtnID').show();
        }
    }, 1000);
}

function updateCountdownDisplay(seconds) {
    var minutes = Math.floor(seconds / 60);
    var remainingSeconds = seconds % 60;
    
    // Format the minutes and seconds with leading zeros
    var formattedTime = 
        (minutes < 10 ? "0" : "") + minutes + ":" + 
        (remainingSeconds < 10 ? "0" : "") + remainingSeconds;
    
    $("#countdownSpan").text(formattedTime);
}

function sendDemoReq(dr_captcha)
{
    var reqLink = $('#demoReqForm').attr('action');
        
    var demoReqName= $('#demoReqName').val();
    var demoReqEmail= $('#demoReqEmail').val();
    var demoReqMobile= $('#demoReqMobile').val();
    var demoMobileOTP= $('#demoMobileOTP').val();
    
    if(demoReqName=='')
    {
        drRefreshCaptchaObj(dr_captcha);
        Swal.fire('Warning!', 'Your name is required', 'warning')
        return false;
    }
    
    if(demoReqMobile=='')
    {
        drRefreshCaptchaObj(dr_captcha);
        Swal.fire('Warning!', 'Your mobile number is required', 'warning')
        return false;
    }

    if(demoMobileOTP=='')
    {
        drRefreshCaptchaObj(dr_captcha);
        Swal.fire('Warning!', 'Please enter OTP', 'warning')
        return false;
    }
    
    $.ajax({
        url : reqLink,
        type : 'POST',
        data : { 'demoReqName' : demoReqName, 'demoReqEmail' : demoReqEmail, 'demoReqMobile' : demoReqMobile, 'demoMobileOTP' : demoMobileOTP },
        dataType: 'json',
        success : function(data) {     
            
            var resStatus = data.status;
            var resMsg = data.msg;
            
            drRefreshCaptchaObj(dr_captcha);
            
            if(resStatus==true)
            {      
                Swal.fire('Thank you for your demo request', 'We will get back to you soon', 'success');
            }
            else
            {
                Swal.fire('Error', resMsg, 'error');
            }
            
            $('#demoReqName').val("");
            $('#demoReqEmail').val("");
            $('#demoReqMobile').val("");
            $('#demoMobileOTP').val("");

            $('#countdownSpan').hide();
            $('#reSendOtpBtnID').hide();
            $('#sendOtpBtnID').show();
            clearInterval(countdownInterval);
            
            $('#myModaldemo').modal('hide');
        
        },
        error : function(request, error)
        {
            drRefreshCaptchaObj(dr_captcha);
        }
    });
}

$(document).ready(function(){

    const dr_captcha=drCaptachFunc();

    $('#reSendOtpBtnID').hide();
    $('#countdownSpan').hide();
    
    $('.sendReqBtn').on('click', function(e){
                
        e.preventDefault();
        
        const drCaptchaCode = $('#drCaptchaCode').val();
        
        const drCaptchaCodeVal = dr_captcha.valid(drCaptchaCode);
        
        console.log(drCaptchaCodeVal);
        
        if(drCaptchaCode!="") {
            if(drCaptchaCodeVal==true){
                sendDemoReq(dr_captcha);
            }else{
                
                $('#drCaptchaCodeErr').text('Captcha does not match');
                dr_captcha.refresh();
                return false;
            }
        }else{
            $('#drCaptchaCodeErr').text('Please enter Captcha code');
            dr_captcha.refresh();
            return false;
        }
        
    })

    $('.sendOtpBtn').on('click', function(e){
                
        e.preventDefault();
        
        var sendOtpUrl = $('#sendOtpUrl').val();
        
        var demoReqMobile= $('#demoReqMobile').val();
        
        if(demoReqMobile=='')
        {
            Swal.fire('Warning!', 'Your mobile number is required', 'warning')
            return false;
        }

        $('#sendOtpBtnID').hide();
        $('#countdownSpan').show();
        startCountdown();
        
        $.ajax({
            url : sendOtpUrl,
            type : 'POST',
            data : { 'demoReqMobile' : demoReqMobile },
            dataType: 'json',
            success : function(data) {     
                
                var resStatus = data.status;
                var resMsg = data.msg;
                
                if(resStatus==true)
                {      
                    Swal.fire('OTP Sent', '', 'success');
                }
                else
                {
                    Swal.fire('Error', resMsg, 'error');
                }
            
            },
            error : function(request, error)
            {
                drRefreshCaptchaObj(dr_captcha);
            }
        });
        
    })
    
});