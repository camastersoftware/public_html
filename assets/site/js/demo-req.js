
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


function sendDemoReq(dr_captcha)
{
    var reqLink = $('#demoReqForm').attr('action');
        
    var demoReqName= $('#demoReqName').val();
    var demoReqEmail= $('#demoReqEmail').val();
    var demoReqMobile= $('#demoReqMobile').val();
    
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
    
    $.ajax({
        url : reqLink,
        type : 'POST',
        data : { 'demoReqName' : demoReqName, 'demoReqEmail' : demoReqEmail, 'demoReqMobile' : demoReqMobile },
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
    
    $('.sendReqBtn').on('click', function(e){
                
        e.preventDefault();
        
        const drCaptchaCode = $('#drCaptchaCode').val();
        
        console.log(drCaptchaCode);
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
    
});