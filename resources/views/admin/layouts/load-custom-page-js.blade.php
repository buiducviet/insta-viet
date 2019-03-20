@if(isset($content))
<?php switch ($content) {
    case 'dashboard': ?>
        <script src="{{asset('themes/admin/js/pages/index2.js')}}"></script>
        <script>$(function(){Index2.init();});</script>
        <?php break; ?>
    <?php case 'general_form': ?>
        <script src="{{asset('themes/admin/js/pages/formsGeneral.js')}}"></script>
        <script>$(function(){FormsGeneral.init();});</script>
        <?php break; ?>
<?php } ?>
@endif