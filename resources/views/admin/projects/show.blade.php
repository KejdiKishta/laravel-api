@extends('layouts.admin')

@section('content')
    <div class="container p-5">
        <h1>{{ $project->title }}</h1>
        <h4>Type: {{ $project->type?->name }}</h4>
        <p class="text-secondary">Owner: {{ $project->owner }}</p>
        @if ($project->tecnologies->isNotEmpty())
            <span>Tags: </span>
            @foreach ($project->tecnologies as $tecnology)
                <span class="badge" style="background-color: {{ $tecnology->color }}">{{ $tecnology->name }}</span>
            @endforeach
        @endif
        <hr class="my-3">
        <p>{{ $project->description }}</p>
    </div>
@endsection