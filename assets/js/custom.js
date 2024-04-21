

    function validateChar(evt) {
		var theEvent = evt || window.event;
		var key = theEvent.keyCode || theEvent.which;
		key = String.fromCharCode( key );
		var regex = /[0-9]|\./;
		if( regex.test(key) ) {
			theEvent.returnValue = false;
			if(theEvent.preventDefault) theEvent.preventDefault();
		}
	}

	function validateNum(evt) {
		var theEvent = evt || window.event;
		var key = theEvent.keyCode || theEvent.which;
		key = String.fromCharCode( key );
		var regex = /[0-9\.-]/;
		if( !regex.test(key) ) {
			theEvent.returnValue = false;
			if(theEvent.preventDefault) theEvent.preventDefault();
		}
	}
	
	$('.validateFloat').keypress(function(event) {
        if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
            event.preventDefault();
        }
        
        var floatNum = $(this).val();
        
        if(floatNum!="")
        {
            $(this).val((floatNum.indexOf(".") >= 0) ? (floatNum.substr(0, floatNum.indexOf(".")) + floatNum.substr(floatNum.indexOf("."), 2)) : floatNum);
        }
    });
    
    
    $(".wrapper").hide();
    $("div.spanner").addClass("show");
    $("div.overlay").addClass("show");
    
    function setHeaderName(headerNameWidth)
    {
        $.fn.center = function ()
        {
            this.css("position","fixed");
            this.css("top", '0');
            this.css("left", ($(window).width() / 2)-(headerNameWidth/2));
            
            return this;
        }
        
        $('.centerClass').center();
        
        $(window).resize(function(){
           $('.centerClass').center();
        });
        
        $('.centerClassOther').center();
        $(window).resize(function(){
           $('.centerClassOther').center();
        });
    }
    
    $(document).ready(function () {
        
        setTimeout(function () {
            $("div.spanner").hide();
            $("div.overlay").hide();
            $(".wrapper").show();
            $(".wrapper").attr('style', 'display: block !important;');
            
            var headerNameWidth=$(".centerClass").width();
            
            if(headerNameWidth==0)
            {
                // $(window).load(function() {
                //     var headerNameWidth=$(".centerClass").width();
                // });
                
                var headerNameWidth=524;
            }
            
            setHeaderName(headerNameWidth);
        }, 1000);
        
        $('.fc-scroller').css('height','auto');
        $('.fc-scroller').css('overflow','hidden');
        
        if($('.select2').length!="")
        {
            $('.select2').select2();
        }
        
        if($('.modalSelect2').length!="")
        {
            $('.modalSelect2').select2();
        }

        $('.fc-icon, .fc-button').on('click', function () {
            $('.fc-scroller').css('height','auto');
            $('.fc-scroller').css('overflow','hidden');
        });

        $('.external-event').removeClass('ui-draggable');
        $('.external-event').removeClass('ui-draggable-handle');
        
        var base_url = '<?php echo base_url(); ?>';
        var lndryThemeCookie = "<?php echo $lndryThemeCookie; ?>";
        
        $(".switch_btn").click(function(){
            $.ajax({
                url : base_url+'/remote/utility/changeTheme',
                type : 'POST',
                data : '',
                dataType: 'json',
                success : function(data) {     
                    
                },
                error : function(request, error)
                {
                    // alert("Request: "+JSON.stringify(request));
                }
            });
        });

        if($('.timepicker').length!="0")
        {
            $('.timepicker').timepicker({
                showInputs: false
            });
        }

        $('.nav_bar').on('click', function(){
            if($(this).siblings('.drop_fileds').hasClass('show'))
            {
                $(this).siblings('.drop_fileds').toggleClass('hide');
            }
            else
            {
                $(this).siblings('.drop_fileds').toggleClass('show');
            }
        });
        
        /* Anything that gets to the document will hide the dropdown */
        $(document).click(function(){
            // $(".drop_fileds").toggleClass('show');
            
            $(".drop_fileds").each(function(dI, dV){
                
                if($(dV).hasClass('hide'))
                {
                    
                }
                else
                {
                    $(dV).toggleClass('hide');
                    // console.log($(dV));
                }
            });
        });
    
        /* Clicks within the dropdown won't make it past the dropdown itself */
        $(".drop_fileds").click(function(e){
            e.stopPropagation();
        });
        
        $('body').on('click', '.steps > ul > li.current', function(){
            
            $(this).css('color', '#fff');
            
        });
        
        $('.openLink').on('click', function(){
            window.location.href=$(this).data('href');
        });

        $('[data-toggle="tooltip"]').tooltip();
        
        $('.animateInHeader').show();
        $('.animateOutHeader').hide();
        
        setInterval(function () {
            $('.animateHeader').trigger('click');
        }, 10000);
        
        $('.switchDueDateYearBtn').on('click', function(){
            $('#switchDueDateYear').modal('show');
        });
        
        $('.switchDueDateYearSuperAdminBtn').on('click', function(){
            $('#switchDueDateYearSuperAdmin').modal('show');
        });
        
        $('.btn-submit').on('hover', function(){
            $(this).css('background-color', '#005495');
            $(this).css('color', '#fff');
        });
        
        $('.checkMinMax').on('input', function(){
            var value = $(this).val();
            var minVal = parseInt($(this).attr('min'));
            var maxVal = parseInt($(this).attr('max'));
            
            if(value>=minVal && value<=maxVal)
            {
                return true;
            }
            else
            {
                $(this).val(maxVal);
            }
        });
        
    });