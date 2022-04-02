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
                            {{--                            <a href="" class="btn btn-primary float-right"><i class="fa fa-plus"></i></a>--}}
                        </div>
                        <!-- /.card-header -->


                        <div class="card-body">
                            <form action="{{ route('service.update', [$service->id]) }}" enctype="multipart/form-data" method="post">
                                @csrf
                                @method('PUT')
                                <div class="form-row">
                                    <div class="col-12">
                                        <input type="text" class="form-control @error('title') is-invalid @enderror"
                                            value="{{ $service->title }}" name="title" placeholder="Enter Title 1">
                                    </div>
                                    @error('title')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <hr>
                                <div class="form-row">
                                    <div class="col-12">
                                        <textarea id="editor" rows="4" cols="6"
                                            class="form-control @error('description') is-invalid @enderror"
                                            name="description" placeholder="Home Description">{{ $service->description }}</textarea>
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
                                        </div>
                                    </div>
                                </div>
                                @error('image')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <img src="{{ asset('uploads/' . $service->image) }}" alt="" class="p-2" id="previewImg" height="200px" width="200px">
                                <hr>

                                {{--                                <div class="form-row">--}}

                                {{--                                    <select class="form-control @error('status') is-invalid @enderror" id="" name="status">--}}
                                {{--                                        <option selected>Publication Status</option>--}}
                                {{--                                        <option value="active">Active</option>--}}
                                {{--                                        <option value="inactive">Inactive</option>--}}
                                {{--                                    </select>--}}
                                {{--                                </div>--}}
                                {{--                                @error('status')--}}
                                {{--                                <div class="alert alert-danger">{{ $message }}
                        </div>--}}
                        {{--                                @enderror--}}
                        {{--                                <hr>--}}
                        {{--                                <hr>--}}
                        <div class="col-2">
                            <input type="submit" class="form-control btn btn-primary" name="btn" id="btn"
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
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
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

</script>
@endsection
