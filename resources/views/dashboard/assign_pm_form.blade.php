<main class="subs">
    <div class="container-fluid">
<div class="row charts-docs">
    <div class="col-xl-12 ">
        <div class="card mb-4">         
<div class="card-header subscription-h">
    <i class="fa fa-plus-circle"></i>
        ASSIGN PM
</div>
<div class="row alert-m">
</div> 
<div class="card-body">
    <div class="row">
        <div class="col-md-8">
            <label><b>Customer Name</b></label>
                <input id="so-style" type="text" class="form-control so_no_val" name="so_no" />
                    <input type="hidden" class="form-control" value="{{ session()->get('GoogleName') }}" name="created_by" />
                    <span id="u-so-no-text"></span>
                    </div>  
                </div>
            <div>
        </div>    
    <hr>
</div>

<div class="cdbaccounts">
</div>
<div class="card-body cdb-body">
</div>

<div class="modal-footer">
    <div class="row s-btn">
        </div>
            <button id="create-btn" type="button" 
                class="btn btn-success btn-sm" onclick="submitAddPMForm()">
                <i class="fa fa-save"></i> SUBMIT</button>
            </div>
        </div>
    </div>
            </div>
        
<style>
    .subscription-h {
        background-color: #BFBFBF;
        margin-top: -10px;
    }
</style>










