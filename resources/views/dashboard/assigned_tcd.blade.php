<div class="col-md-6">
    <label>Assigned TCDs</label>
    <ul>
    @foreach($assignedTcd as $tcd)
        <li>{{ $tcd->tcd_name }} - {{ $tcd->email }} <button alt="DELETE TCD" data-tcd-id="{{ $tcd->id }}" type="button" 
                class="btn btn-danger btn-sm" onclick="deleteTcd(this)">
        <i class="fa fa-trash"></i></button></li>
    @endforeach
    </ul>
</div>