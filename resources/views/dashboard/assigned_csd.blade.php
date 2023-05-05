<div class="col-md-6">
    <label>Assigned CSDs</label>
    <ul>
    @foreach($assignedCsd as $csd)
        <li>{{ $csd->csd_name }} - {{ $csd->email }} <button alt="DELETE CSD" data-csd-id="{{ $csd->id }}" type="button" 
                class="btn btn-danger btn-sm" onclick="deleteCsd(this)">
        <i class="fa fa-trash"></i></button></li>
    @endforeach
    </ul>
</div>