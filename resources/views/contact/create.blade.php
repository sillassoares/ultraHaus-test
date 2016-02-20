@extends('layout')

@section('content')

    <div class="container">

        <ul class="nav nav-pills top-menu">
            <li role="presentation" class="btn-default"><a href="{{ url('contact') }}" class="btn btn-default">{{ trans('contact.list') }}</a></li>
        </ul>
        <div class="panel panel-default">
            <div class="panel-heading">{{ trans('contact.new') }}</div>
            <div class="panel-body">
                <form class="form-horizontal" role="form" id="form_contact" method="POST" action="{{ url('/contact') }}">
                    {!! csrf_field() !!}

                    @if(session('success'))

                        <div class="alert alert-success">
                            <ul>
                                <li>{{ session('success') }}</li>
                            </ul>
                        </div>

                    @endif

                    <div id="display-error" class="hide"></div>

                        @if (count($errors) > 0)

                            <div class="alert alert-danger" id="display-error-backend">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>

                        @endif

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="name">* {{ trans('contact.name') }}:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="name" name="name" placeholder="{{ trans('contact.form_name') }}" value="{{ old('name') }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="email">* {{ trans('contact.email') }}:</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" id="email" name="email" placeholder="{{ trans('contact.form_email') }}" value="{{ old('email') }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="phone">{{ trans('contact.phone') }}:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control phone" id="phone" name="phone" placeholder="{{ trans('contact.form_phone') }}" value="{{ old('phone') }}" >
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="cpf">* {{ trans('contact.cpf') }}:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control cpf" id="cpf" name="cpf" placeholder="{{ trans('contact.form_cpf') }}" value="{{ old('cpf') }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="message">{{ trans('contact.message') }}:</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" id="message"  name="message">{{ old('message') }}</textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-btn fa-floppy-o"></i>{{ trans('contact.save') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script src="/js/contact.js" ></script>
@endsection