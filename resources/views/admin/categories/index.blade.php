@extends('admin.admin_layout.main')
@section('title', 'Category')
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
            <h2 class="title1">Category</h2>
            <div class="inline-form widget-shadow">
                <div class="form-title">
                    <h4>Add Category</h4>
                </div>
                <div class="form-body">
                    <div data-example-id="simple-form-inline"> 
                        <form class="form-inline" method="POST" id="submitForm"> 
                            <div class="form-group"> 
                                <span id="cat_err" class="error"></span>
                                <input type="text" class="form-control" id="category" name="category" placeholder="Category Name"> 
                            </div> 
                            <div class="form-group"> 
                                <span id="status_err" class="error"></span>
                                <select class="form-control" id="status" name="status">
                                    <option value="">-Select Status-</option>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                            <button type="button" id="submitButton" class="btn btn-default">Submit</button> 
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
                <h4 class="modal-title">Edit Category</h4>
            </div>
        <form>
            <div class="modal-body">
                <div class="form-group">
                    <label for="edit_category">Category <span  style="color:red" id="e_cat_err"> </span></label>
                    <input type="text" name="category" id="edit_category" class="form-control">
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
    var status = $("#status").val();
    // alert(is_parent);
    if (category=="") {
        $("#cat_err").fadeIn().html("Required");
        setTimeout(function(){ $("#cat_err").fadeOut(); }, 3000);
        $("#category").focus();
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
        var datastring="status="+status+"&category="+category;
        // alert(datastring);
        $.ajax({
            type:"POST",
            url:"{{ route('admin.categories.store') }}",
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
var SITEURL = "{{ route('admin.categories.index')}}";
$('#dataTableHover').DataTable({
    processing: true,
    serverSide: true,
    ajax: {
    url: SITEURL,
    type: 'GET',
    },
    columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false,searchable: false},
            { data: 'category_name', name: 'category_name' },
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
        url:"{{ route('admin.get.category') }}",
        data:datastring,
        cache:false,        
        success:function(returndata)
        {
            // alert(returndata);
        if (returndata!="0") {
            $("#myModal").modal('show');
            var json = JSON.parse(returndata);
            $("#id").val(json.id);
            $("#edit_category").val(json.category_name);
            $("#edit_status").val(json.status);
        }
        }
    });
}

function checkSubmit()
{
    var id = $("#id").val();
    var category = $("#edit_category").val();
    var status = $("#edit_status").val();
    if (category=="") {
        $("#e_cat_err").fadeIn().html("Required");
        setTimeout(function(){ $("#e_cat_err").fadeOut(); }, 3000);
        $("#edit_category").focus();
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
        var datastring="status="+status+"&id="+id+"&category="+category;
        // alert(datastring);
        $.ajax({
            type:"POST",
            url:"{{ url('/admin/category/update') }}",
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
            url: "{{ url('admin/categories') }}"+'/'+id,
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