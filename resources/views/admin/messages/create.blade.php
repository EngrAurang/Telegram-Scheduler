@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.message.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.messages.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="title">{{ trans('cruds.message.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', '') }}" required>
                @if($errors->has('title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.message.fields.title_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="message">{{ trans('cruds.message.fields.message') }}</label>
                <textarea class="form-control {{ $errors->has('message') ? 'is-invalid' : '' }}" name="message" id="message" required>{{ old('message') }}</textarea>
                @if($errors->has('message'))
                    <div class="invalid-feedback">
                        {{ $errors->first('message') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.message.fields.message_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="sent_at">{{ trans('cruds.message.fields.sent_at') }}</label>
                <input class="form-control datetime {{ $errors->has('sent_at') ? 'is-invalid' : '' }}" type="datetime-local" name="sent_at" id="sent_at" required>
                @if($errors->has('sent_at'))
                    <div class="invalid-feedback">
                        {{ $errors->first('sent_at') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.message.fields.sent_at_helper') }}</span>
            </div>



            <div class="form-group">
                <button class="btn btn-success text-white" type="submit">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width: 24px; height: 24px; margin-right: 2px;">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z" />
                                    </svg>
                        {{ trans('global.save') }}
                    </button>
            </div>
        </form>
    </div>
</div>



@endsection
@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Find the input field with the ID 'sent_at'
        var sentAtInput = document.getElementById('sent_at');


        // Function to format the current date and time in ISO format
        function getCurrentDateTime() {
            var currentDateTime = new Date();
            var currentYear = currentDateTime.getFullYear();
            var currentMonth = (currentDateTime.getMonth() + 1).toString().padStart(2, '0');
            var currentDay = currentDateTime.getDate().toString().padStart(2, '0');
            var currentHours = currentDateTime.getHours().toString().padStart(2, '0');
            var currentMinutes = currentDateTime.getMinutes().toString().padStart(2, '0');
            return `${currentYear}-${currentMonth}-${currentDay}T${currentHours}:${currentMinutes}`;
        }

        // Set the 'min' attribute of the input field to the current date and time
        sentAtInput.min = getCurrentDateTime();
        alert(sentAtInput..valueAsDate);
    });
</script>
@endsection
