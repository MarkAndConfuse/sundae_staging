<div>
    <div class="container">
        <div class="card bg-light mt-3">
            <div class="card-header" style="background-color: #BFBFBF;">
                IMPORT DATA
            </div>
            <div class="card-body">
                <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="file" class="form-control" style="height: 3em;" />
                    <br>
                    <button class="btn btn-success"><i class="fa fa-download" aria-hidden="true"></i> Import</button>
                <!-- <a class="btn btn-warning" href="/export">Export Data</a> -->
            </form>
        </div>
    </div>
</div>
 

