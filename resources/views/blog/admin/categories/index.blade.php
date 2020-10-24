@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="card">
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Категория</th>
                            <th>Родитель</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($paginator as $item)
                            @php /** @var \App\Models\BlogCategory  $item */@endphp
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>
                                    <a href="{{route('blog.admin.categories.edit', $item->id)}}">
                                        {{$item->title}}
                                    </a>
                                </td>
                                <td>{{$item->parent_id}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div style="text-align: center">
                    <a class="btn btn-primary" href="{{route('blog.admin.categories.create')}}">Добавить</a>
                        @if ($paginator->total() > $paginator->count())
                            <br> <br>{{$paginator->links("pagination::bootstrap-4")}}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
