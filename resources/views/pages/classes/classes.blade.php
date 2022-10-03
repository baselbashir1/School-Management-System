@extends('layouts.master')
@section('css')
    @toastr_css
@endsection

@section('title')
    {{ __('classes_trans.classes') }}
@stop

@section('page-header')
    <!-- breadcrumb -->
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0" style="font-family: 'Tajawal', sans-serif;">
                    {{ __('classes_trans.classes') }}
                </h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                    <li class="breadcrumb-item active"> {{ __('classes_trans.classes') }}</li>
                </ol>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-xl-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">
                        {{ trans('classes_trans.add_class') }}
                    </button>
                    <button type="button" class="button x-small" id="btn_delete_checked">
                        {{ trans('classes_trans.delete_checked') }}
                    </button>
                    <br><br>
                    <div class="table-responsive">
                        <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                            style="text-align: center">
                            <thead>
                                <tr>
                                    <th><input name="select_all" id="select_all" type="checkbox"
                                            onclick="CheckAll('box-check', this)"></th>
                                    <th>#</th>
                                    <th>{{ trans('classes_trans.class_name') }}</th>
                                    <th>{{ trans('classes_trans.level_name') }}</th>
                                    <th>{{ trans('classes_trans.processes') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0; ?>
                                @foreach ($classes as $class)
                                    <tr>
                                        <?php $i++; ?>
                                        <td><input type="checkbox" value="{{ $class->id }}" class="box-check"></td>
                                        <td>{{ $i }}</td>
                                        <td>{{ $class->name }}</td>
                                        <td>{{ $class->level->name }}</td>
                                        <td>
                                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                                data-target="#edit{{ $class->id }}"
                                                title="{{ trans('classes_trans.edit') }}">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                data-target="#delete{{ $class->id }}"
                                                title="{{ trans('classes_trans.delete') }}">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>

                                    <!-- edit_modal_class -->
                                    <div class="modal fade" id="edit{{ $class->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 style="font-family: 'Tajawal', sans-serif;" class="modal-title"
                                                        id="exampleModalLabel">
                                                        {{ trans('classes_trans.edit_class') }}
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <!-- edit_form -->
                                                    <form action="{{ route('classrooms.update', 'test') }}" method="post">
                                                        {{ method_field('patch') }}
                                                        @csrf
                                                        <div class="row">
                                                            <div class="col">
                                                                <label
                                                                    class="mr-sm-2">{{ trans('classes_trans.class_name_ar') }}
                                                                    :</label>
                                                                <input id="name_ar" type="text" name="name_ar"
                                                                    class="form-control"
                                                                    value="{{ $class->getTranslation('name', 'ar') }}"
                                                                    required>
                                                                <input id="id" type="hidden" name="id"
                                                                    class="form-control" value="{{ $class->id }}">
                                                            </div>
                                                            <div class="col">
                                                                <label
                                                                    class="mr-sm-2">{{ trans('classes_trans.class_name_en') }}
                                                                    :</label>
                                                                <input type="text" class="form-control"
                                                                    value="{{ $class->getTranslation('name', 'en') }}"
                                                                    name="name_en" required>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="form-group">
                                                            <label>
                                                                {{ trans('classes_trans.level_name') }}
                                                                :</label>
                                                            <select class="form-control form-control-lg"
                                                                style="height: 50px" id="exampleFormControlSelect1"
                                                                name="level_id">
                                                                <option value="{{ $class->level->id }}">
                                                                    {{ $class->level->name }}
                                                                </option>
                                                                @foreach ($levels as $level)
                                                                    <option value="{{ $level->id }}">
                                                                        {{ $level->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <br><br>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">{{ trans('classes_trans.close') }}</button>
                                                            <button type="submit"
                                                                class="btn btn-success">{{ trans('classes_trans.save_data') }}</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- delete_modal_class -->
                                    <div class="modal fade" id="delete{{ $class->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 style="font-family: 'Tajawal', sans-serif;" class="modal-title"
                                                        id="exampleModalLabel">
                                                        {{ trans('classes_trans.delete_class') }}
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('classrooms.destroy', 'test') }}"
                                                        method="post">
                                                        {{ method_field('Delete') }}
                                                        @csrf
                                                        {{ trans('messages.delete?') }}
                                                        <input id="id" type="hidden" name="id"
                                                            class="form-control" value="{{ $class->id }}">
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">{{ trans('classes_trans.close') }}</button>
                                                            <button type="submit"
                                                                class="btn btn-danger">{{ trans('classes_trans.delete') }}</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- add_modal_class -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 style="font-family: 'Tajawal', sans-serif;" class="modal-title" id="exampleModalLabel">
                            {{ trans('classes_trans.add_class') }}
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class=" row mb-30" action="{{ route('classrooms.store') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="repeater">
                                    <div data-repeater-list="listClasses">
                                        <div data-repeater-item>
                                            <div class="row">
                                                <div class="col">
                                                    <label class="mr-sm-2">{{ trans('classes_trans.class_name_ar') }}
                                                        :</label>
                                                    <input class="form-control" type="text" name="class_name_ar">
                                                </div>
                                                <div class="col">
                                                    <label class="mr-sm-2">{{ trans('classes_trans.class_name_en') }}
                                                        :</label>
                                                    <input class="form-control" type="text" name="class_name_en">
                                                </div>
                                                <div class="col">
                                                    <label class="mr-sm-2">{{ trans('classes_trans.level_name') }}
                                                        :</label>
                                                    <div class="box">
                                                        <select class="fancyselect" name="level_id">
                                                            @foreach ($levels as $level)
                                                                <option value="{{ $level->id }}">{{ $level->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <label class="mr-sm-2">{{ trans('classes_trans.processes') }}
                                                        :</label>
                                                    <input class="btn btn-danger btn-block" data-repeater-delete
                                                        type="button" value="{{ trans('classes_trans.delete') }}" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-20">
                                        <div class="col-12">
                                            <input class="button" data-repeater-create type="button"
                                                value="{{ trans('classes_trans.add_row') }}">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">{{ trans('classes_trans.close') }}</button>
                                        <button type="submit"
                                            class="btn btn-success">{{ trans('classes_trans.save_data') }}</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- delete_modal_checked -->
        <div class="modal fade" id="delete_all_checked" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 style="font-family: 'Tajawal', sans-serif;" class="modal-title" id="exampleModalLabel">
                            {{ trans('classes_trans.delete_checked') }}
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('delete_all_checked') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="modal-body">
                            {{ trans('messages.delete?') }}
                            <input class="text" type="hidden" id="delete_all_id" name="delete_all_id"
                                value=''>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">{{ trans('classes_trans.close') }}</button>
                            <button type="submit" class="btn btn-danger">{{ trans('classes_trans.delete') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

    </div>

    </div>

    <!-- row closed -->
@endsection

@section('js')
    @toastr_js
    @toastr_render

    <script type="text/javascript">
        $(function() {
            $("#btn_delete_checked").click(function() {
                var selected = new Array();
                $("#datatable input[type=checkbox]:checked").each(function() {
                    selected.push(this.value);
                });
                if (selected.length > 0) {
                    $('#delete_all_checked').modal('show');
                    $('input[id="delete_all_id"]').val(selected);
                }
            });
        });
    </script>

@endsection
