<script type="text/javascript">

var dCsdId = '';
var cSubId = '';
function deleteCsd(button){
    $('.alert-csd-message').show();
    dCsdId = button.getAttribute('data-csd-id');
    cSubId = button.getAttribute('data-sub-id');

    $.ajax({
        url: "{{ url('/delete_assign_csd') }}",
        method: 'POST',
        data: { 
        _token: function() {
            return "{{ csrf_token() }}"
        },
        dCsdId
        },
        cache: false,
        success:function(html){
        $('.alert-csd-message').html('<div class="container"><div class="col-md-12 alert-margin" style="margin-top: 15px;"><div class="alert alert-info"><div class="fa fa-spinner fa-spin"></div> ASSIGN CSD WAS DELETED.</div></div></div>'); 
        setTimeout(removeCsdAlert, 2000);
        }
    }); 
}

function removeCsdAlert(){
    $('.alert-csd-message').hide();
    window.location.href = '/load_csd/' + cSubId ;
}

</script>






