<script type="text/javascript">

var dTcdId = '';
var tSubId = '';
function deleteTcd(button){
    $('.alert-tcd-message').show();
    dTcdId = button.getAttribute('data-tcd-id');
    tSubId = button.getAttribute('data-sub-id');
    $.ajax({
        url: "{{ url('/delete_assign_tcd') }}",
        method: 'POST',
        data: { 
        _token: function() {
            return "{{ csrf_token() }}"
        },
        dTcdId
        },
        cache: false,
        success:function(html){
        $('.alert-tcd-message').html('<div class="container"><div class="col-md-12 alert-margin" style="margin-top: 15px;"><div class="alert alert-info"><div class="fa fa-spinner fa-spin"></div> ASSIGN TCD WAS DELETED.</div></div></div>'); 
        setTimeout(removeTcdAlert, 2000);
        }
    }); 
}

function removeTcdAlert(){
    $('.alert-tcd-message').hide();
    window.location.href = '/load_tcd/' + tSubId ;
}

</script>






