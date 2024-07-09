@extends('layouts.admin')

@section('content')
    <div class="container p-5">
        <h1>Create a new project</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.projects.store') }}" enctype="multipart/form-data" method="POST">
            @csrf

            <div class="form-group py-3">
                <label class="mb-2" for="title">Title</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title"
                    value="{{ old('title') }}">
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group py-3">
                <label class="mb-2" for="type">Type</label>
                <select class="form-select" aria-label="Default select example" name="type_id">
                    <option selected></option>
                    @foreach ($types as $type)
                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group py-3">
                <label class="mb-2" for="owner">Owner</label>
                <input type="text" class="form-control @error('owner') is-invalid @enderror" id="owner"
                    name="owner" value="{{ old('owner') }}">
                @error('owner')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-2">Tags</div>
            <div class="btn-group" role="group">
                @foreach ($tags as $tag)
                    <input @checked(in_array($tag->id, old('tags', []))) name="tags[]" value="{{ $tag->id }}" type="checkbox"
                        class="btn-check @error('tags') is-invalid @enderror" id="tag-{{ $tag->id }}"
                        autocomplete="off">
                    <label class="btn btn-outline-primary" for="tag-{{ $tag->id }}">{{ $tag->name }}</label>
                @endforeach
            </div>
            @error('tags')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror

            <div class="form-group py-3">
                <label class="mb-2" for="description">Description</label>
                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                    rows="4">{{ old('description') }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group py-3">
                <label for="thumb" class="thumb">Select a thumbnail for your project</label>
                <input class="form-control" name="thumbnail" type="file" id="thumb">
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
