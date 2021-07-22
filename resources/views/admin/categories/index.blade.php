@extends('admin.admin_layout.main')
@section('title', 'Dashboard')
@section('customcss')
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
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
            <h2 class="title1">Forms</h2>
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
                                <span id="status_err"></span>
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
        <div class="bs-example widget-shadow" data-example-id="bordered-table"> 
			<h4>Bordered Basic Table:</h4>
			<table class="table table-bordered"> 
                <thead> 
                    <tr> 
                        <th>#</th> 
                        <th>First Name</th> 
                        <th>Last Name</th> 
                        <th>Username</th> 
                    </tr> 
                </thead> 
                <tbody> 
                    <tr> 
                        <th scope="row">1</th> 
                        <td>Mark</td> 
                        <td>Otto</td> 
                        <td>@mdo</td> 
                    </tr> 
                    <tr> 
                        <th scope="row">2</th> 
                        <td>Jacob</td> 
                        <td>Thornton</td> 
                        <td>@fat</td> 
                    </tr> 
                    <tr> 
                        <th scope="row">3</th> 
                        <td>Larry</td> 
                        <td>the Bird</td> 
                        <td>@twitter</td> 
                    </tr> 
                </tbody> 
            </table>
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
                // var oTable = $('#dataTableHover').dataTable(); 
                // oTable.fnDraw(false);
                toastr.success(returndata.success);
            }
        });
    }
})
</script>
@endsection