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

        <div class="container ">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-primary">
                            <h3 class="card-title ">Home</h3>
                            <a href="{{ route('service.index') }}" type="button" value="Add"
                                class="btn btn-warning float-right">Back</a>

                            {{--                            <a href="" class="btn btn-primary float-right"><i class="fa fa-plus"></i></a>--}}
                        </div>
                        <!-- /.card-header -->


                        <div class="card-body">
                            <form id="addServiceForm" enctype="multipart/form-data" method="post">
                                @csrf
                                <div class="form-row">
                                    <div class="col-12">
                                        <input type="text" class="form-control @error('title') is-invalid @enderror"
                                            value="" name="title" placeholder="Enter Title 1">
                                    </div>
                                    @error('title')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <hr>
                                <div class="form-row">
                                    <div class="col-12">
                                        <textarea id="description" rows="4" cols="6"
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
                                            <input type="file" name="image" class="custom-file-input"
                                                class="@error('image') is-invalid @enderror"
                                                onchange="previewFile(this);" id="exampleInputFile">
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
                            <input type="submit" class="form-control btn btn-primary add_service" name="btn" id="btn"
                                value="Submit">
                        </div>
                        </form>
                    </div>

                    <!-- /.card-body -->
                </div>
            </div>
        </div>
</div>

</section>
</div>


@endsection

@section('js')
<script type="text/javascript">
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

    // $(document).ready(function () {
    //     $(document).on('click', '.add_service', function (e) {
    //         e.preventDefault();
    //         let data = {
    //             'title'      : $('input[name = "title"]').val(),
    //             'description': $('#description').val(),
    //             'image'      : $('input[name = "image"]').val(),
    //         }
    //         console.log(data);

    //         $.ajaxSetup({
    //             headers: {
    //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //             }
    //         });

    //         $.ajax({
    //             type: "POST",
    //             url: "service",
    //             data: data,
    //             dataType: "json",
    //             success: function (response) {
    //             }
    //         });
    //     });
    // });


    // $(document).ready(function () {

    //     $.ajaxSetup({
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         }
    //     });

    //     $(document).on('submit','#addServiceForm', function (e) {
    //         e.preventDefault();
    //         let formData = new FormData($('#addServiceForm')[0]);

    //         $.ajax({
    //             type: "POST",
    //             url: "service",
    //             data: formData,
    //             // dataType: "json",
    //             contentType: false,
    //             processData: false,
    //             success: function (response) {
                    
    //             }
    //         });
    //     });
    // });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

   $('#addServiceForm').submit(function(e) {
       e.preventDefault();
       let formData = new FormData(this);
       $('#image-input-error').text('');

       $.ajax({
          type:'POST',
          url: `/service`,
           data: formData,
           contentType: false,
           processData: false,
           success: (response) => {
             if (response) {
               this.reset();
               alert('Image has been uploaded successfully');
             }
           },
           error: function(response){
              console.log(response);
                $('#image-input-error').text(response.responseJSON.errors.file);
           }
       });
    });


</script>
@endsection
