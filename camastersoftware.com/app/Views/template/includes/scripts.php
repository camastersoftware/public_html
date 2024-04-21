<!-- Vendor JS -->

<script src="<?php echo base_url('assets/icons/feather-icons/feather.min.js'); ?>"></script>

<?php if(in_array('bootstrap-select', $jsArr)): ?>
    <script src="<?php echo base_url('assets/vendor_components/bootstrap-select/dist/js/bootstrap-select.js'); ?>"></script>
<?php endif; ?>

<?php if(in_array('select2.full', $jsArr)): ?>
    <script src="<?php echo base_url('assets/vendor_components/select2/dist/js/select2.full.js'); ?>"></script>
<?php endif; ?>

<?php if(in_array('apexcharts', $jsArr)): ?>
    <script src="<?php echo base_url('assets/vendor_components/apexcharts-bundle/dist/apexcharts.js'); ?>"></script>
<?php endif; ?>

<?php if(in_array('progressbar', $jsArr)): ?>
    <script src="<?php echo base_url('assets/vendor_components/progressbar.js-master/dist/progressbar.js'); ?>"></script>
<?php endif; ?>

<?php if(in_array('datatables.min', $jsArr)): ?>
    <script src="<?php echo base_url('assets/vendor_components/datatable/datatables.min.js'); ?>"></script>
<?php endif; ?>

<?php if(in_array('sweetalert.min', $jsArr)): ?>
    <script src="<?php echo base_url('assets/vendor_components/sweetalert/sweetalert.min.js'); ?>"></script>
<?php endif; ?>

<?php if(in_array('timepicker', $jsArr)): ?>
    <script src="<?php echo base_url('assets/vendor_plugins/timepicker/bootstrap-timepicker.min.js'); ?>"></script>
<?php endif; ?>

<?php if(in_array('jquery-ui', $jsArr)): ?>
    <script src="<?php echo base_url('assets/vendor_components/jquery-ui/jquery-ui.min.js'); ?>"></script>
<?php endif; ?>

<?php if(in_array('perfect-scrollbar-master', $jsArr)): ?>
    <script src="<?php echo base_url('assets/vendor_components/perfect-scrollbar-master/perfect-scrollbar.jquery.min.js'); ?>"></script>
<?php endif; ?>

<?php if(in_array('fullcalendar', $jsArr)): ?>
    <script src="<?php echo base_url('assets/vendor_components/fullcalendar/lib/moment.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/vendor_components/fullcalendar/fullcalendar.min.js'); ?>"></script>
<?php endif; ?>

<!-- Florence Admin App -->
<script src="<?php echo base_url('assets/js/template.js?v='.date('Ymd')); ?>"></script>

<?php if(in_array('dashboard', $jsArr)): ?>
    <script src="<?php echo base_url('assets/js/pages/dashboard.js'); ?>"></script>
<?php endif; ?>

<script src="<?php echo base_url('assets/js/demo.js'); ?>"></script>

<?php if(in_array('data-table', $jsArr)): ?>
    <script src="<?php echo base_url('assets/js/pages/data-table.js'); ?>"></script>
<?php endif; ?>

<?php if(in_array('calendar', $jsArr)): ?>
    <script src="<?php echo base_url('assets/js/pages/calendar.js'); ?>"></script>
<?php endif; ?>

<?php if(in_array('jquery.steps', $jsArr)): ?>
    <script src="<?php echo base_url('assets/vendor_components/jquery-steps-master/build/jquery.steps.js'); ?>"></script>
<?php endif; ?>

<?php if(in_array('steps', $jsArr)): ?>
    <script src="<?php echo base_url('assets/js/pages/steps.js'); ?>"></script>
<?php endif; ?>

<?php if(in_array('wysihtml5', $jsArr)): ?>
    <script src="<?php echo base_url('assets/vendor_plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.js'); ?>"></script>
    
    <script>
        $(document).ready(function(){
            $('.textarea').wysihtml5({
                toolbar: {
                    "link": false, //Button to insert a link. Default true
                    "image": false, //Button to insert an image. Default true
                }
            });		
            
            //  $('.textarea').css("height", "400px");
        });
    </script>
<?php endif; ?>

<?php if(in_array('ckeditor', $jsArr)): ?>
    <!--<script src="https://cdn.ckeditor.com/ckeditor5/39.0.2/classic/ckeditor.js"></script>-->
    <!--<script src="https://cdn.ckeditor.com/4.23.0-lts/standard/ckeditor.js"></script>-->
    <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
    
    <script>
    
    $(document).ready(function(){
        CKEDITOR.replace( 'ckeditor_textarea', {
        // CKEditor 4 configuration options
          on: {
            instanceReady: function (ev) {
              // Set up synchronization between CKEditor and the hidden input field
              ev.editor.on('change', function () {
                $('.textarea_input').val(ev.editor.getData());
              });
            }
          }
        });

        console.log("$('.ckeditor_textarea_elem').length", $('.ckeditor_textarea_elem').length);

        if ($('.ckeditor_textarea_elem').length > 0) {
            // Initialize CKEditor for each textarea
            $('.ckeditor_textarea_elem').each(function(index) {
                var textarea = $(this).next('.textarea_input_elem');
                CKEDITOR.replace($(this).attr('id'), {
                    on: {
                        instanceReady: function (ev) {
                            ev.editor.on('change', function () {
                                textarea.val(ev.editor.getData());
                            });
                        }
                    }
                });
            });
        }
    });

    
            // ClassicEditor
            // .create( document.querySelector( '#ckeditor_textarea' ) )
            // .then( editor => {
            //         console.log( editor );
            // } )
            // .catch( error => {
            //         console.error( error );
            // } );
                                
        // ClassicEditor
        //   .create(document.querySelector('#ckeditor_textarea'), {
        //     toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote'],
        //     // Add other configuration options as needed
        //   })
        //   .then(editor => {
        //     // Set up synchronization between CKEditor and the hidden textarea
        //     const textarea = document.getElementsByClassName('textarea_input');
        //     editor.model.document.on('change', () => {
        //         console.log("editor.getData()", editor.getData());
        //       textarea.value = editor.getData();
        //     });
        //   })
        //   .catch(error => {
        //     console.error(error);
        //   });
    </script>
<?php endif; ?>

<script src="<?php echo base_url('assets/js/pages/component-animations-css3.js'); ?>"></script>

<?php if($uri1!="superadmin" || $sessUserLoginName!=""): ?>

    <script>
    	    
        function showTime(){
            var date = new Date();
            var h = date.getHours(); // 0 - 23
            var m = date.getMinutes(); // 0 - 59
            var s = date.getSeconds(); // 0 - 59
            var session = "AM";
            
            if(h == 0){
                h = 12;
            }
            
            if(h > 12){
                h = h - 12;
                session = "PM";
            }
            
            h = (h < 10) ? "0" + h : h;
            m = (m < 10) ? "0" + m : m;
            s = (s < 10) ? "0" + s : s;
            
            var time = h + ":" + m + ":" + s + " " + session;
            
            var myEle = document.getElementById("MyClockDisplay");
            
            if(myEle){
                document.getElementById("MyClockDisplay").innerText = time;
                document.getElementById("MyClockDisplay").textContent = time;
            }
            
            setTimeout(showTime, 1000);
            
        }
        
        showTime();
        
    </script>

<?php endif; ?>

<script>
    var requestMethod = "<?php echo $requestMethod; ?>";
    console.log(requestMethod);
</script>

<script src="<?php echo base_url('assets/js/custom.js?v='.date('Ymd')); ?>"></script>
<script src="<?php echo base_url('assets/js/get-back.js?v='.date('Ymd')); ?>"></script>
