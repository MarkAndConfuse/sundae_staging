<div class="col-md-6">
    <label>Email Notification Schedules</label>
        <ul>
            @foreach($emailNotifs as $email)
                <li>{{ $email->subject }} - {{ $email->message }} : {{ $email->when_to_send }} <button alt="DELETE NOTIF" data-csd-id="{{ $email->id }}" type="button" 
                    class="btn btn-danger btn-sm" onclick="deleteEmailNotif(this)">
                <i class="fa fa-trash"></i></button></li>
            @endforeach
    </ul>
</div>