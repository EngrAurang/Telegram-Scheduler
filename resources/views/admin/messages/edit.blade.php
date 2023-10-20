@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.message.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.messages.update", [$message->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="title">{{ trans('cruds.message.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', $message->title) }}" required>
                @if($errors->has('title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.message.fields.title_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="message">{{ trans('cruds.message.fields.message') }}</label>
                <textarea class="form-control {{ $errors->has('message') ? 'is-invalid' : '' }}" name="message" id="message" required>{{ old('message', $message->message) }}</textarea>
                @if($errors->has('message'))
                    <div class="invalid-feedback">
                        {{ $errors->first('message') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.message.fields.message_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="sent_at">{{ trans('cruds.message.fields.sent_at') }}</label>
                <input class="form-control datetime {{ $errors->has('sent_at') ? 'is-invalid' : '' }}" type="text" name="sent_at" id="sent_at" value="{{ old('sent_at', $message->sent_at) }}" required>
                @if($errors->has('sent_at'))
                    <div class="invalid-feedback">
                        {{ $errors->first('sent_at') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.message.fields.sent_at_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection
