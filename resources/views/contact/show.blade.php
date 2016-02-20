@extends('layout')

@section('content')

    <div class="container">

        <ul class="nav nav-pills top-menu">
            <li role="presentation" class="btn-default"><a href="{{ url('contact') }}" class="btn btn-default">{{ trans('contact.list') }}</a></li>
        </ul>
        <div class="panel panel-default">
            <div class="panel-heading">{{ trans('contact.show') }}</div>
            <div class="panel-body">

                <div class="list-group">
                    <button type="button" class="list-group-item">{{ $contact->id }}</button>
                    <button type="button" class="list-group-item">{{ $contact->name }}</button>
                    <button type="button" class="list-group-item">{{ $contact->email }}</button>
                    <button type="button" class="list-group-item">{{ $contact->phone }}</button>
                    <button type="button" class="list-group-item">{{ $contact->cpf }}</button>
                    <button type="button" class="list-group-item">{{ $contact->message }}</button>
                </div>
            </div>
        </div>
    </div>

@endsection
