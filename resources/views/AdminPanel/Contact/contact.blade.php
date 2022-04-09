@extends('AdminPanel.Master')

@section('title')
Contact
@endsection

@section('content')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><strong>Contact</strong></h1>
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
                <button type="button" class="btn btn-success float-right" data-toggle="modal"
                    data-target="#addContactModal">Add</button>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- data load with ajax --}}
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>



        {{-- store modal start --}}
        <div class="modal fade" id="addContactModal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Add Contact</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="addContactForm" enctype="multipart/form-data" method="post">
                            @csrf
                            <div class="form-row">
                                <div class="col-12 mb-3">
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        value="" name="name" placeholder="Enter Your name">
                                </div>
                                @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-row">
                                <div class="col-12 mb-3">
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        value="" name="email" placeholder="Enter Your email">
                                </div>
                                @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-row">
                                <div class="col-12 mb-3">
                                    <textarea id="des" rows="4" cols="6"
                                        class="form-control @error('description') is-invalid @enderror"
                                        name="description" placeholder="Home Description"></textarea>
                                </div>
                                @error('description')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-2">
                                <input type="submit" class="form-control btn btn-primary add_contact" name="btn"
                                    id="btn" value="Submit">
                            </div>
                        </form>
                    </div>
                    {{-- <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div> --}}
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- store modal end -->
        {{-- edit modal start --}}
        <div class="modal fade" id="editServiceModal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Add Service</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="editServiceModal" enctype="multipart/form-data" method="post">
                            @csrf
                            <div class="form-row">
                                <div class="col-12 mb-3">
                                    <input id="id" type="hidden" class="form-control @error('id') is-invalid @enderror"
                                        value="" name="id" placeholder="Enter id 1">
                                </div>
                                @error('title')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-row">
                                <div class="col-12 mb-3">
                                    <input id="title" type="text"
                                        class="form-control @error('title') is-invalid @enderror" value="" name="title"
                                        placeholder="Enter Title 1">
                                </div>
                                @error('title')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-row">
                                <div class="col-12 mb-3">
                                    <textarea id="dsc" rows="4" cols="6"
                                        class="form-control @error('description') is-invalid @enderror"
                                        name="description" placeholder="Home Description"></textarea>
                                </div>
                                @error('description')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="exampleInputFile">File input</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input id="img" type="file" name="image" class="custom-file-input"
                                            class="@error('image') is-invalid @enderror" onchange="previewFile(this);"
                                            id="exampleInputFile">
                                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                        <span class="text-danger" id="image-input-error"></span>
                                    </div>
                                </div>
                            </div>
                            @error('image')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <img src="" alt="" class="p-2" id="previewImg" height="200px" width="200px">
                            <hr>
                            <div class="col-2">
                                <input type="submit" class="form-control btn btn-primary add_service" name="btn"
                                    id="btn" value="Submit">
                            </div>
                        </form>
                    </div>
                    {{-- <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div> --}}
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- edit modal end -->
        {{-- update modal start --}}
        <div class="modal fade" id="updateServiceModal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Add Service</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="updateServiceForm" enctype="multipart/form-data" method="post">
                            @csrf
                            <div class="form-row">
                                <div class="col-12 mb-3">
                                    <input id="service_id" type="text"
                                        class="form-control @error('service_id') is-invalservice_id @enderror" value=""
                                        name="service_id" placeholder="Enter service_id 1">
                                </div>
                                @error('title')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-row">
                                <div class="col-12">
                                    <input id="title" type="text"
                                        class="form-control @error('title') is-invalid @enderror" value="" name="title"
                                        placeholder="Enter Title 1">
                                </div>
                                @error('title')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <hr>
                            <div class="form-row">
                                <div class="col-12">
                                    <textarea id="dsc" rows="4" cols="6"
                                        class="form-control @error('description') is-invalid @enderror"
                                        name="description" placeholder="Home Description"></textarea>
                                </div>
                                @error('description')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <hr>

                            <div class="form-group">
                                <label for="exampleInputFile">File input</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input id="img" type="file" name="image" class="custom-file-input"
                                            class="@error('image') is-invalid @enderror" onchange="previewFile(this);"
                                            id="exampleInputFile">
                                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                        <span class="text-danger" id="image-input-error"></span>
                                    </div>
                                </div>
                            </div>
                            @error('image')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <img src="" alt="" class="p-2" id="previewImg" height="200px" width="200px">
                            <hr>
                            <div class="col-2">
                                <input type="submit" class="form-control btn btn-primary add_service" name="btn"
                                    id="btn" value="Submit">
                            </div>
                        </form>
                    </div>
                    {{-- <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div> --}}
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- update modal end -->
    </section>
</div>
@endsection

@section('js')
<script type="text/javascript">
    

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function () {
        // insert service data start
        $(document).on('click','.add_contact', function (e) {
            e.preventDefault();

            let data = {
                'name'       : $('input[name = "name"]').val(),
                'email'      : $('input[name = "email"]').val(),
                'description': $('#des').val(),
            }
            $.ajax({
                type: "POST",
                url: "contact",
                data: data,
                dataType: "json",
                success: function (response) {
                    fetchContact();
                    console.log(response);
                }
            });
        });
        // insert service data end

        // view service data start
        fetchContact();

        function fetchContact() {
            $.ajax({
                type: "GET",
                url: "/fetch-contact",
                dataType: "json",
                success: function (response) {
                    // console.log(response.service);
                    $('tbody').html('');
                    $.each(response.contact, function (key, value) {
                        $('tbody').append(`
                    <tr>
                        <td>${++key}</td>
                        <td>${value.name}</td>
                        <td>${value.email}</td>
                        <td>
                            <div class="form-group">
                                <textarea class="form-control-sm w-100" disabled rows="3">${value.description}</textarea>
                            </div>
                        </td>
                        <td class="text-center">
                                <button class="btn btn-app-sm bg-primary edit_btn" value="${value.id}"> <i class="fas fa-edit"></i></button>
                                <button class="btn btn-app-sm bg-danger delete_btn" value="${value.id}"> <i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                    
                    `);

                    });
                }
            });
        }
        // view service data end

        // edit service data start

        $(document).on('click', '.edit_btn', function (e) {
            e.preventDefault();

            let icon_id = $(this).val();
            $('#editServiceModal').modal('show');

            $.ajax({
                type: "GET",
                url: "service/" + icon_id + "/edit",
                success: function (response) {

                    if (response.status == 404) {
                        swal("Error", "", "danger");
                        $('#editServiceModal').modal('hide');
                    } else {
                        $('#id').val(response.service.id);
                        $('#title').val(response.service.title);
                        $('#dsc').val(response.service.description);
                        // $('#img').val(response.service.image);
                    }

                }
            });
        });
        // edit service data end

        // update service data start
        $(document).on('submit', '#updateServiceForm', function (e) {
            e.preventDefault();

            let service_id = $('#service_id').val();
            let editFormData = new FormData($('#updateServiceForm')[0]);
            $.ajax({
                type: "POST",
                url: "service/" + service_id,
                data: editFormData,
                contentType: false,
                processData: false,
                success: function (response) {
                    // if (response.status == 200) {
                    //     $('#updateServiceForm').find('input').val('');
                    //     $('#updateServiceForm').modal('hide');
                    fetchContact();
                    swal("Successfully", "Data Updated!", "success");
                    // }
                }
            });
        });
        // update service data end

        // delete service data start
        $(document).on('click', '.delete_btn', function (e) {
            e.preventDefault();

            let icon_id = $(this).val();
            swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this data!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            type: "DELETE",
                            url: "contact/" + icon_id,
                            success: function (response) {
                                fetchContact();
                                swal("Poof! Your imaginary file has been deleted!", {
                                    icon: "success",
                                });
                            }
                        })

                    } else {
                        swal("Your data is safe!");
                    }
                });
        });


        // delete service data end


    });

</script>
@endsection
