@if (!empty($emailNotifs))
    <div class="table-responsive" style="margin-top: 15px;">
        <table id="email-notis" class="table table-bordered" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <td class="n-th">Subject</td>
                    <td class="n-th">When to Send</td>
                    <td class="n-th">Recipient</td>
                    <td class="n-th">Action</td>
                </tr>
                @foreach($emailNotifs as $eN)
                <tr>
                    <td>{{ $eN->subject }}</td>
                    <td>{{ $eN->when_to_send }} Days</td>
                    <td>{{ $eN->email }}</td>
                    <td style="text-align: center;">
                        <button class="btn btn-primary btn-xs" 
                        data-notif-id="{{ $eN->id }}" 
                        data-notif-subject="{{ $eN->subject }}" 
                        data-notif-message="{{ $eN->message }}" 
                        type="button" onclick="editEmailNotif(this)"><i class="fa fa-edit"></i> Edit</button>
                        @if(session()->get('GoogleName') == 'Mark Edo Escario')
                        <button class="btn btn-danger btn-xs" data-notif-id="{{ $eN->id }}" type="button" onclick="deleteEmailNotif(this)"><i class="fa fa-trash"></i> Delete</button>
                        @endif
                    </td>
                </tr>
                @endforeach
                </thead>
            </table>
        </div>  
    @endif
</div>
<style>
.n-th {
    background-color: #E83E8C;
    color: #FFFFFF;
    line-height: 0.8em;
}
</style>