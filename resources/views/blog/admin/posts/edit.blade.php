@extends('layouts.app')

@section('content')
    @php /** @var App\Models\BlogCategory $item */ @endphp


    <div class="container">
        @include('blog.admin.posts.includes.result_messages')
        @if ($item->exists)
            <form method="POST" action="{{ route('blog.admin.posts.update', $item->id) }}">
                @method('PATCH')
        @else
            <form method="POST" action="{{ route('blog.admin.posts.store') }}">
        @endif
                @csrf
                @php /** @var \Illuminate\Support\ViewErrorBag $errors */ @endphp

                <div class="row justify-content-center">
                    <div class="col-md-8">
                        @include('blog.admin.posts.includes.post_edit_main_col')
                    </div>
                    <div class="col-md-3">
                        @include('blog.admin.posts.includes.post_edit_add_col')
                    </div>
                </div>

            </form>
                    @if($item->exists)
                        <br>
                        <form method="POST" action="{{ route('blog.admin.posts.destroy', $item->id) }}">
                            @method('DELETE')
                            @csrf
                            <div class="justify-content-center">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-body align-items-center">
                                            <button  type="submit" class="btn badge-danger">Удалить</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </form>
        @endif
    </div>

@endsection
