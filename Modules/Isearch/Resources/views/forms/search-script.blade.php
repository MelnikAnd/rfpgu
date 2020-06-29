<script type="text/javascript">
    function redirectForm(idsearch){
        rut = "{{url(trans('isearch::common.url'))}}";
        rut2 = rut+'?q='+document.getElementById(idsearch).value;
        location.href = rut2;
        return false;
    }
</script>