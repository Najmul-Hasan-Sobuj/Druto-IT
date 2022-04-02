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
                <a href="{{ route('service.create') }}" type="button" value="Add" class="btn btn-success float-right">Add</a>
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
                        @if ($service)
                            @foreach ($service as $key => $value)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $value->title }}</td>
                                <td><img src="{{ asset('uploads/' . $value->image) }}" alt="" class="p-2" id="previewImg" height="50px" width="50px"></td>
                                <td>
                                    <div class="form-group">
                                        <textarea class="form-control-sm w-100" disabled rows="3">{{ $value->description }}</textarea>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('service.edit', [$value->id]) }}" class="btn btn-app-sm bg-primary">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('service.destroy', [$value->id]) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        {{-- <a href="#" class="btn btn-app-sm bg-danger">
                                            <i class="fas fa-trash"></i> Delete
                                        </a> --}}
                                        <button type="submit" class="btn btn-app-sm bg-danger"> <i class="fas fa-trash"></i> Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        @endif
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
