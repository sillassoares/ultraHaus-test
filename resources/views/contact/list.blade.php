@extends('layout')

@section('content')

    <div class="container">

        <ul class="nav nav-pills top-menu">
            <li role="presentation" class="active pull-right"><a href="{{ url('contact/create') }}" class="btn btn-default">{{ trans('contact.new') }}</a></li>
        </ul>

        @if(session('success'))

            <div class="alert alert-success">
                <ul>
                    <li>{{ session('success') }}</li>
                </ul>
            </div>

        @endif

        @if (count($errors) > 0)

            <div class="alert alert-danger" id="display-error-backend">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>

        @endif

        <div class="panel panel-default">

            <!-- Default panel contents -->
            <div class="panel-heading">{{ trans('contact.panel_heading') }}</div>

            <!-- Table -->
            <table class="table table-hover table-condensed">
                <thead>
                <tr>
                    <th>{{ trans('contact.name') }}</th>
                    <th>{{ trans('contact.email') }}</th>
                    <th>{{ trans('contact.phone') }}</th>
                    <th>{{ trans('contact.cpf') }}</th>
                    <th>{{ trans('contact.message') }}</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>

                @if(count($contacts) > 0)
                    @foreach($contacts as $contact)
                        <tr>
                            <td>{{ $contact->name }}</td>
                            <td>{{ $contact->email }}</td>
                            <td>{{ $contact->phone }}</td>
                            <td>{{ $contact->cpf }}</td>
                            <td>{{ \Illuminate\Support\Str::limit($contact->message) }}</td>
                            <td class="text-right">
                                <a href="/contact/{{ $contact->id }}" class="btn" title="{{ trans('contact.show') }}"><span class="glyphicon glyphicon-zoom-in"></span></a>
                                <a href="/contact/{{ $contact->id }}/edit" class="btn" title="{{ trans('contact.edit') }}"><span class="glyphicon glyphicon-edit"></span></a>
                                <a onClick="return callConfirmDestroy()" href="/contact/{{ $contact->id }}/destroy" class="btn" title="{{ trans('contact.destroy') }}" ><span class="glyphicon glyphicon-remove-circle"></span></a>
                            </td>
                        </tr>
                    @endforeach
                    <td>
                    <td colspan="6">{!! $contacts->render() !!}</td>
                    </td>

                @else
                    <tr>
                        <td colspan="6">{{ trans('contact.no_result') }}</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>


@endsection

@section('script')

    <script>

        function callConfirmDestroy() {
            return confirm('Tem certeza que deseja deletar esse registro?');
        }

    </script>
@endsection