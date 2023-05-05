<script type="text/javascript">
    
    function importExportData(event){
        $.ajax({
        url: '{{ url("/import_export_data") }}',
        method: 'GET',
        cache: false,
        success: function(html){
            $('.main-d').html(html);
            }
        });   
    }

    function importSubscriptionData(event){
        $.ajax({
        url: '{{ url("/import_subscription") }}',
        method: 'GET',
        cache: false,
        success: function(html){
            $('.main-d').html(html);
            }
        });   
    }

</script>