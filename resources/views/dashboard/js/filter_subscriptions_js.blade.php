<script type="text/javascript">

function filterBySoNumber(event){
    var soNumber = $('.so_number_val').val();
    if (soNumber.length > 0){
        window.location.href = 'https://sundae.ics.com.ph/filter_by_so_number/' + btoa(soNumber);
    }
}

</script>