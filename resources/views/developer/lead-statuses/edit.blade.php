{{--@extends('developer.layouts.app')--}}

{{--@section('content')--}}
{{--    <div>--}}
{{--        <h1>{{ isset($leadStatus) ? 'Edit' : 'Create' }} Lead Status</h1>--}}

{{--        <form action="{{ isset($leadStatus) ? route('developer.lead-status.update', $leadStatus->id) : route('lead-statuses.store') }}" method="POST">--}}
{{--            @csrf--}}

{{--            <label for="name">Name</label>--}}
{{--            <input type="text" id="name" name="name" value="{{ $leadStatus->name ?? '' }}" required>--}}

{{--            <label for="color">Color</label>--}}
{{--            <input type="text" id="color" name="color" value="{{ $leadStatus->color ?? '' }}">--}}

{{--            <button type="submit">{{ isset($leadStatus) ? 'Update' : 'Create' }}</button>--}}
{{--        </form>--}}
{{--    </div>--}}
{{--@endsection--}}
