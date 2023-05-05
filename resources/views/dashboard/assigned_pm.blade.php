<div class="col-md-6">
    <label>Assigned PMs</label>
    <ul>
    @if(!empty($assignedPm))
    @foreach($assignedPm as $pm)
        <li>{{ $pm->pm_name }} - {{ $pm->email }} <button alt="DELETE PM" data-pm-id="{{ $pm->id }}" type="button" 
                class="btn btn-danger btn-sm" onclick="deletePm(this)">
        <i class="fa fa-trash"></i></button></li>
    @endforeach
    </ul>
    @else
    <p>No PM</p>
    @endif
</div>