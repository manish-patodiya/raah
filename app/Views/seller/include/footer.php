<!-- Add the sidebar's background. This div must be placed immediately after the control sidebar -->
<div class="control-sidebar-bg"></div>

<script src="<?php echo base_url("public/assets/vendor_components/PACE/pace.min.js") ?>"></script>

<script src="<?php echo base_url('public/js/vendors.min.js') ?>"></script>
<script src="<?php echo base_url('public/js/pages/chat-popup.js') ?>"></script>
<script src="<?php echo base_url('public/assets/icons/feather-icons/feather.min.js') ?>"></script>

<!-- validation -->
<script src="<?php echo base_url("public/js/pages/validation.js") ?>"></script>
<script>
let jqBootstrapValidationobj;
! function(window, document, $) {
    "use strict";
    jqBootstrapValidationobj = $("input,select,textarea").not("[type=submit]").jqBootstrapValidation();
}(window, document, jQuery); // End of use strict
</script>
<script
    src="<?php echo base_url("public/assets/vendor_components/jquery-validation-1.17.0/dist/jquery.validate.min.js") ?>">
</script>
<script
    src="<?php echo base_url("public/assets/vendor_components/jquery-validation-1.17.0/dist/additional-methods.min.js") ?>">
</script>
<script src="<?php echo base_url('public/custom/js/validation_functions.js') ?>"></script>
<!-- Deposito Admin App
-->
<script src="<?php echo base_url('public/js/template.js') ?>"></script>

<!-- sweet alert plugin -->
<script src="<?php echo base_url('public/assets/vendor_components/sweetalert/sweetalert.min.js') ?>"></script>


<script src="<?php echo base_url('public/custom/js/custom.js') ?>"></script>
<script src="<?php echo base_url('public/custom/js/common.js') ?>"></script>
<script src="<?=base_url('public/custom/js/seller/notification.js')?>"></script>

<!-- select2 -->
<script src="<?php echo base_url('public/assets/vendor_components/select2/dist/js/select2.js') ?>"></script>
<script src="<?php echo base_url('public/assets/vendor_components/jquery-toast-plugin-master/src/jquery.toast.js') ?>">
</script>


<script
    src="<?php echo base_url('public/assets/vendor_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') ?>">
</script>
<script
    src="<?php echo base_url('public/assets/vendor_components/bootstrap-duallistbox/jquery.bootstrap-duallistbox.min.js') ?>">
</script>

<!-- datatable -->
<script src="<?php echo base_url('public/assets/vendor_components/datatable/datatables.min.js') ?>"></script>

<!-- date range picker and moment js -->
<script src="<?php echo base_url('public/assets/vendor_components/moment/min/moment.min.js') ?>"></script>
<script src="<?php echo base_url('public/assets/vendor_components/bootstrap-daterangepicker/daterangepicker.js') ?>">
</script>


<script>
$(function() {
    $('.sub-menu-tab').hover(function() {
        $(this).find('.feather').removeClass('text-white');
    }, function() {
        if (!$(this).hasClass('active')) {
            $(this).find('.feather').addClass('text-white')
        }
        // out
    });
})
</script>

</body>

</html>