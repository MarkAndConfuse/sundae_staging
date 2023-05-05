<div class="modal" id="selectCustomerModal" role="dialog">
    <div class="modal-dialog modal-xl">
        <div class="modal-content pull-right">
        <div class="sModalHeader"><p class="header-label"><i class="fa fa-plus-circle"></i> SELECT CUSTOMER</p></div>
    <div class="row">
</div>
<div class="modal-body div-docs">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <div class="input-group mb-3">
                    <input id="customer-name-style" type="text" class="form-control ex" placeholder="Example: Integrated Computer System Incorporated" name="customer_name" />
                <div class="input-group-append">
            <span style="cursor: pointer;" onclick="searchCustomer(event)" class="input-group-text"><i class="fas fa-search"></i></span>
        <span id="customer-name-text" class="data-text"></span>
    </div>
</div>
<div class="card mb-4 custoTable">         
    <div class="card-header customers-h">
        <i class="fa fa-list"></i>
            LIST OF CUSTOMERS
        </div>
    <div class="row custo-spinner">
</div> 
<div class="card-body live-search-body" style="margin-top: -12px;">
<br>
<div class="table-responsive">
    <table id="live-search-table" class="table-docs table-bordered" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th class="l-th">Customer Name</th>
                <th class="l-th">Customer No.</th>
                <th class="l-th">AO</th>
                <th class="l-th">Sales Group</th>
                <th class="l-th">Action</th>
            </tr>
        </thead>
    </table>
</div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <div class="row s-btn">
        </div>
            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">
                <i class="fa fa-window-close"></i> CLOSE</button>
            </div>
        </div>
    </div>
</div>

<style>
.modal-backdrop {
    opacity:0.5 !important;
}
.sModalHeader {
    background-color: #E83E8C;
    text-transform: uppercase;
    height: 43px;
}
.header-label {
    margin-top: 10px;
    margin-left: 10px;
}
.material-desc-text {
    margin-top: -15px;
}
.alert-margin {
    margin-top: 12px;
}
.data-text {
    margin-top: -12px;
}
.customers-h {
    background-color: #BFBFBF;
}
.l-th {
    font-size: 14px;
    font-family: "Montserrat", sans-serif;
    text-transform: uppercase;
    background-color: #E83E8C;
    height: 2.3em;
    white-space: nowrap; 
}
</style>
