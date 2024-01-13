<div class="floatingButtonWrap">
    <div class="floatingButtonInner">
        <a href="<?= base_url('chat/0') ?>" class="floatingButton">
            <i class="fa fa-comments icon-default"></i>
        </a>
    </div>
</div>
<!-- <div class="drawer-container">
    <div class="drawer">
        <p>Drawer Content</p>
        <div class="small-drawer">
            <p>Small Drawer Content</p>
        </div>
        <div class="large-drawer">
            <p>Large Drawer Content</p>
        </div>
    </div>
</div>
<button type="button" class="btn btn-default btn-circle btn-xl" id="toggleDrawer"><i class="fa fa-arrow-left"></i> </button> -->
<!-- <button class="btn-circle btn-xl" id="toggleDrawer">&#9776;</button>  -->


<script>
    $(document).ready(function() {
        $('#toggleDrawer').on('click', function() {
            var drawer = $('.drawer');

            // Toggle the drawer's position
            if (drawer.css('left') === '-300px' || drawer.css('left') === '0px') {
                drawer.animate({
                    left: '0'
                }, 400);
            } else {
                drawer.animate({
                    left: '-300px'
                }, 400);
            }
        });
    });
</script>