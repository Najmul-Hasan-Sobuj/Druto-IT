@extends('AdminPanel.Master')

@section('title')
Service
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><strong>Service</strong></h1>
                </div>

                @if(Session::get('message'))

                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>{{Session::get('message')}}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif

            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">DataTable with default features</h3>
                <a href="#" type="button" value="Add" class="btn btn-success float-right">Add</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Title</th>
                            <th>Image</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                            {{-- data load with ajax --}}
                    </tbody>
                    {{-- <tfoot>
                <tr>
                  <th>Rendering engine</th>
                  <th>Browser</th>
                  <th>Platform(s)</th>
                  <th>Engine version</th>
                  <th>CSS grade</th>
                </tr>
                </tfoot> --}}
                </table>
            </div>
            <!-- /.card-body -->
        </div>
    </section>
</div>


@endsection

@section('js')
{{-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> --}}
<script>
    function previewFile(input) {
        var file = $("input[type=file]").get(0).files[0];

        if (file) {
            var reader = new FileReader();

            reader.onload = function () {
                $("#previewImg").attr("src", reader.result);
            }

            reader.readAsDataURL(file);
        }
    }

    $(document).ready(function () {
        fetchService();
        function fetchService() {
            $.ajax({
                type: "GET",
                url: "/fetch-service",
                dataType: "json",
                success: function (response) {
                    // console.log(response.service);
                    $('tbody').html('');
                    $.each(response.service, function (key, value) { 
                    $('tbody').append(`
                    <tr>
                        <td>${++key}</td>
                        <td>${value.title}</td>
                        <td><img src="uploads/${value.image}" alt="" class="p-2" id="previewImg" height="50px" width="50px"></td>
                        <td>
                            <div class="form-group">
                                <textarea class="form-control-sm w-100" disabled rows="3">${value.description}</textarea>
                            </div>
                        </td>
                        <td class="text-center">
                            <a href="#" class="btn btn-app-sm bg-primary">
                                <i class="fas fa-edit"></i>
                            </a>
                                <button type="submit" class="btn btn-app-sm bg-danger"> <i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                    
                    `);
                         
                    });
                }
            });
        }
    });

</script>
@endsection
