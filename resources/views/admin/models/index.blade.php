@extends('admin.admin_layout.main')
@section('title', 'Model')
@section('customcss')
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<link  href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<style>
    .error{
        color:red;
    }
</style>
@endsection
@section('content')
<div id="page-wrapper">
    <div class="main-page">
        <div class="forms">
            <h2 class="title1">Model</h2>
            <div class="inline-form widget-shadow">
                <div class="form-title">
                    <h4>Add Model</h4>
                </div>
                <div class="form-body">
                    <div data-example-id="simple-form-inline"> 
                        <form method="POST" id="submitForm"> 
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group"> 
                                        <label for="category">Category</label><span id="category_err" class="error"></span>
                                        <select class="form-control" id="category" name="category">
                                            <option value="">-Select Category-</option>
                                            @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                            @endforeach
                                        </select>
                                    </div> 
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group"> 
                                        <label for="company">Company</label><span id="company_err" class="error"></span>
                                        <select class="form-control" id="company" name="company">
                                            <option value="">-Select Company-</option>
                                            @foreach($companies as $company)
                                            <option value="{{ $company->id }}">{{ $company->company_name }}</option>
                                            @endforeach
                                        </select>
                                    </div> 
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group"> 
                                        <label for="model">Model</label><span id="model_err" class="error"></span>
                                        <input type="text" class="form-control" id="model" name="model">
                                    </div> 
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group"> 
                                        <label for="status">Status</label><span id="status_err" class="error"></span>
                                        <select class="form-control" id="status" name="status">
                                            <option value="">-Select Status-</option>
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                    </div> 
                                </div>
                                <div class="col-md-3">                          
                                    <button type="button" id="submitButton" class="btn btn-default">Submit</button>
                                </div>
                            </div>
                        </form> 
                    </div>
                </div>
            </div>
        </div>
        <div class="tables">
            <div class="bs-example widget-shadow" data-example-id="bordered-table"> 
                <h4>Bordered Basic Table:</h4>
                <table class="table table-bordered" id="dataTableHover"> 
                    <thead> 
                        <tr> 
                            <th>#</th> 
                            <th>Category</th>
                            <th>Company Name</th> 
                            <th>Model Name</th>
                            <th>Status</th> 
                            <th>Action</th> 
                        </tr> 
                    </thead> 
                    <tbody> 
                    </tbody> 
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit Model</h4>
            </div>
            <form>
                <div class="modal-body">
                    <div class="form-group"> 
                        <label for="category">Category</label><span id="e_category_err" class="error"></span>
                        <select class="form-control" id="edit_category" name="category">
                            <option value="">-Select Category-</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                            @endforeach
                        </select>
                    </div> 
                    <div class="form-group">
                        <label for="edit_company">Company <span  style="color:red" id="e_company_err"> </span></label>
                        <select class="form-control" id="edit_company" name="company">
                            <option value="">-Select Company-</option>
                            @foreach($companies as $company)
                            <option value="{{ $company->id }}">{{ $company->company_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group"> 
                        <label for="edit_model">Model</label><span id="e_model_err" class="error"></span>
                        <input type="text" class="form-control" id="edit_model" name="model">
                    </div> 
                    <div class="form-group">
                        <label for="edit_status">Status <span  style="color:red" id="e_status_err"> </span></label>
                        <select name="status" id="edit_status" class="form-control">
                            <option value="">-Select Status-</option>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id" id="id" value="">
                    <button type="button" class="btn btn-primary" id="editService" onclick="return checkSubmit()">Update</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>

    </div>
</div>
@endsection
@section('customjs')
<script>
$('body').on('click', '#submitButton', function () {
    var category = $("#category").val();
    var model = $("#model").val();
    var company = $("#company").val();
    var status = $("#status").val();
    // alert(is_parent);
    if (category=="") {
        $("#category_err").fadeIn().html("Required");
        setTimeout(function(){ $("#category_err").fadeOut(); }, 3000);
        $("#category").focus();
        return false;
    }
    if (company=="") {
        $("#company_err").fadeIn().html("Required");
        setTimeout(function(){ $("#company_err").fadeOut(); }, 3000);
        $("#company").focus();
        return false;
    }
    if (model=="") {
        $("#model_err").fadeIn().html("Required");
        setTimeout(function(){ $("#model_err").fadeOut(); }, 3000);
        $("#model").focus();
        return false;
    }
    if (status=="") {
        $("#status_err").fadeIn().html("Required");
        setTimeout(function(){ $("#status_err").fadeOut(); }, 3000);
        $("#status").focus();
        return false;
    }
    else
    { 
        var datastring="status="+status+"&company="+company+"&category="+category+"&model="+model;
        // alert(datastring);
        $.ajax({
            type:"POST",
            url:"{{ route('admin.models.store') }}",
            data:datastring,
            cache:false,        
            success:function(returndata)
            {
                document.getElementById("submitForm").reset();
                var oTable = $('#dataTableHover').dataTable(); 
                oTable.fnDraw(false);
                toastr.success(returndata.success);
            }
        });
    }
})
var SITEURL = "{{ route('admin.models.index')}}";
$('#dataTableHover').DataTable({
    processing: true,
    serverSide: true,
    ajax: {
    url: SITEURL,
    type: 'GET',
    },
    columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false,searchable: false},
            { data: 'category_id', name: 'category_id' },
            { data: 'company_id', name: 'company_id' },
            { data: 'model_name', name: 'model_name' },
            { data: 'status', name: 'status' },
            {data: 'action', name: 'action', orderable: false},
        ],
    order: [[0, 'desc']]
});

function EditModel(obj,bid)
{
    var datastring="bid="+bid;
    // alert(datastring);
    $.ajax({
        type:"POST",
        url:"{{ route('admin.get.model') }}",
        data:datastring,
        cache:false,        
        success:function(returndata)
        {
            // alert(returndata);
        if (returndata!="0") {
            $("#myModal").modal('show');
            var json = JSON.parse(returndata);
            $("#id").val(json.id);
            $("#edit_category").val(json.category_id);
            $("#edit_company").val(json.company_id);
            $("#edit_model").val(json.model_name);
            $("#edit_status").val(json.status);
        }
        }
    });
}

function checkSubmit()
{
    var id = $("#id").val();
    var category = $("#edit_category").val();
    var company = $("#edit_company").val();
    var model = $("#edit_model").val();
    var status = $("#edit_status").val();
    if (category=="") {
        $("#e_category_err").fadeIn().html("Required");
        setTimeout(function(){ $("#e_category_err").fadeOut(); }, 3000);
        $("#edit_category").focus();
        return false;
    }
    if (company=="") {
        $("#e_company_err").fadeIn().html("Required");
        setTimeout(function(){ $("#e_company_err").fadeOut(); }, 3000);
        $("#edit_company").focus();
        return false;
    }
    if (model=="") {
        $("#e_model_err").fadeIn().html("Required");
        setTimeout(function(){ $("#e_model_err").fadeOut(); }, 3000);
        $("#edit_model").focus();
        return false;
    }
    if (status=="") {
        $("#e_status_err").fadeIn().html("Required");
        setTimeout(function(){ $("#e_status_err").fadeOut(); }, 3000);
        $("#edit_status").focus();
        return false;
    }
    else
    { 
        $('#editService').attr('disabled',true);
        var datastring="status="+status+"&id="+id+"&company="+company+"&category="+category+"&model="+model;
        // alert(datastring);
        $.ajax({
            type:"POST",
            url:"{{ url('/admin/model/update') }}",
            data:datastring,
            cache:false,        
            success:function(returndata)
            {
                $('#editService').attr('disabled',false);
                $("#myModal").modal('hide');
                var oTable = $('#dataTableHover').dataTable(); 
                oTable.fnDraw(false);
                toastr.success(returndata.success);
            }
        });
    }
}

$('body').on('click', '#delete', function () {
    var id = $(this).data("id");

    if(confirm("Are You sure want to delete !")){
        $.ajax({
            type: "delete",
            url: "{{ url('admin/models') }}"+'/'+id,
            success: function (data) {
            var oTable = $('#dataTableHover').dataTable(); 
            oTable.fnDraw(false);
            toastr.success(data.success);
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    }
});
</script>
@endsection