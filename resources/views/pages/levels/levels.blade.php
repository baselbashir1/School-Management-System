@extends('layouts.master')

@section('css')
    @toastr_css
@endsection

@section('title')
    {{ __('levels_trans.page_title') }}
@stop

@section('page-header')
    <!-- breadcrumb -->
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0" style="font-family: 'Tajawal', sans-serif;">
                    {{ __('levels_trans.educational_levels') }}
                </h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                    <li class="breadcrumb-item active">{{ __('levels_trans.educational_levels') }}</li>
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
                        {{ __('levels_trans.add_level') }}
                    </button>
                    <br><br>
                    <div class="table-responsive">
                        <table id="datatable" class="table table-striped table-bordered p-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('levels_trans.level_name') }}</th>
                                    <th>{{ __('levels_trans.notes') }}</th>
                                    <th>{{ __('levels_trans.proccess') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0; ?>
                                @foreach ($levels as $level)
                                    <tr>
                                        <?php $i++; ?>
                                        <td>{{ $i }}</td>
                                        <td>{{ $level->name }}</td>
                                        <td>{{ $level->notes }}</td>
                                        <td>
                                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                                data-target="#edit{{ $level->id }}"
                                                title="{{ __('levels_trans.edit') }}">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                data-target="#delete{{ $level->id }}"
                                                title="{{ __('levels_trans.delete') }}">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <!-- edit_modal_level -->
                                    <div class="modal fade" id="edit{{ $level->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 style="font-family: 'Tajawal', sans-serif;" class="modal-title"
                                                        id="exampleModalLabel">
                                                        {{ trans('levels_trans.edit_level') }}
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('levels.update', 'fail') }}" method="post">
                                                        {{ method_field('patch') }}
                                                        @csrf
                                                        <div class="row">
                                                            <div class="col">
                                                                <label
                                                                    class="mr-sm-2">{{ trans('levels_trans.level_name_ar') }}
                                                                    :</label>
                                                                <input id="name_ar" type="text" name="name_ar"
                                                                    class="form-control"
                                                                    value="{{ $level->getTranslation('name', 'ar') }}">
                                                                <input id="id" type="hidden" name="id"
                                                                    class="form-control" value="{{ $level->id }}">
                                                            </div>
                                                            <div class="col">
                                                                <label
                                                                    class="mr-sm-2">{{ trans('levels_trans.level_name_en') }}
                                                                    :</label>
                                                                <input type="text" class="form-control"
                                                                    value="{{ $level->getTranslation('name', 'en') }}"
                                                                    name="name_en">
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="form-group">
                                                            <label
                                                                for="exampleFormControlTextarea1">{{ trans('levels_trans.notes') }}
                                                                :</label>
                                                            <textarea class="form-control" name="notes" id="exampleFormControlTextarea1" rows="3">{{ $level->notes }}</textarea>
                                                        </div>
                                                        <br><br>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">{{ trans('levels_trans.close') }}</button>
                                                            <button type="submit"
                                                                class="btn btn-success">{{ trans('levels_trans.edit') }}</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- delete_modal_level -->
                                    <div class="modal fade" id="delete{{ $level->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 style="font-family: 'Tajawal', sans-serif;" class="modal-title"
                                                        id="exampleModalLabel">
                                                        {{ trans('levels_trans.delete_level') }}
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('levels.destroy', 'fail') }}" method="post">
                                                        {{ method_field('Delete') }}
                                                        @csrf
                                                        {{ trans('levels_trans.warning_delete_message') }}
                                                        <input id="id" type="hidden" name="id"
                                                            class="form-control" value="{{ $level->id }}">
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">{{ trans('levels_trans.close') }}</button>
                                                            <button type="submit"
                                                                class="btn btn-danger">{{ trans('levels_trans.delete') }}</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- add_modal_level -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 style="font-family: 'Tajawal', sans-serif;" class="modal-title" id="exampleModalLabel">
                            {{ __('levels_trans.add_level') }}
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('levels.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <label class="mr-sm-2">{{ trans('levels_trans.level_name_ar') }}
                                        :</label>
                                    <input type="text" name="name_ar" class="form-control" id="name_ar">
                                </div>
                                <div class="col">
                                    <label class="mr-sm-2">{{ trans('levels_trans.level_name_en') }}
                                        :</label>
                                    <input type="text" name="name_en" class="form-control" id="name_en">
                                </div>
                            </div>
                            <br>
                            <div class="form-group">
                                <label>{{ trans('levels_trans.notes') }}
                                    :</label>
                                <textarea class="form-control" name="notes" id="exampleFormControlTextarea1" rows="3"></textarea>
                            </div>
                            <br><br>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">{{ trans('levels_trans.close') }}</button>
                        <button type="submit" class="btn btn-success">{{ trans('levels_trans.add') }}</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection

@section('js')
    @toastr_js
    @toastr_render
@endsection
