@extends('layouts.admin')

@section('content')
    <div class="container p-5">
        <div class="d-flex justify-content-between mb-5">
            <h1>Projects</h1>

            @if (session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif

            <div>
                <a href="{{ route('admin.projects.create') }}">
                    <button class="btn btn-primary rounded-circle"><i class="fa-solid fa-plus"></i></button>
                </a>
            </div>
        </div>
        <table class="table table-striped">
            <thead>
                <hr>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Type</th>
                    <th scope="col">Owner</th>
                    <th scope="col">Description</th>
                    <th scope="col">Tags</th>
                    <th scope="col">Utility</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($projects as $item)
                    <tr class="ms_click" data-href="{{ route('admin.projects.show', ['project' => $item->slug]) }}">
                        {{-- <a href="{{ route('admin.projects.show', ['project' => $item->slug]) }}"> --}}
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $item->title }}</td>
                            <td>{{ $item->type?->name }}</td>
                            <td>{{ $item->owner }}</td>
                            <td>{{ $item->description }}</td>
                            <td>
                                <div class="text-center">
                                    @if ($item->tecnologies->isNotEmpty())
                                        @foreach ($item->tecnologies as $tecnology)
                                        
                                            <span class="badge" style="background-color: {{ $tecnology->color }}">{{ $tecnology->name }}</span>
                                        @endforeach
                                    @else
                                        -
                                    @endif
                                </div>
                            </td>
                            <td class="text-nowrap">
                                <a class="d-inline-block" href="{{ route('admin.projects.edit', ['project' => $item->slug]) }}">
                                    <button class="btn btn-warning text-white">
                                        <i class="fa-solid fa-pen"></i>
                                    </button>
                                </a>

                                <form class="d-inline-block" action="{{ route('admin.projects.destroy', ['project' => $item->slug]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    
                                    <button type="submit" class="btn btn-danger">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        {{-- </a> --}}
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div>{{ $projects->links() }}</div>
    </div>
@endsection
