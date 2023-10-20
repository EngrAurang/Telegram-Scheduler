@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.message.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.messages.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>

                    <tr>
                        <th>
                            {{ trans('cruds.message.fields.title') }}
                        </th>
                        <td>
                            {{ $message->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.message.fields.message') }}
                        </th>
                        <td>
                            {{ $message->message }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.message.fields.sent_at') }}
                        </th>
                        <td>
                            {{ $message->sent_at }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.message.fields.status') }}
                        </th>
                        <td>
                            {{ $message->status }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.messages.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
