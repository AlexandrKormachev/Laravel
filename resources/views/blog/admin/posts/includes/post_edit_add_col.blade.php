@php
/** @var App\Models\BlogPost $item */
@endphp
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <button type="submit" class="btn btn-primary">Сохранить</button>
            </div>
        </div>
    </div>
</div><br>
@if($item->exists)
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <ul class="list-unstyled">
                    <li>ID: {{$item->id}}</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">

                <div class="form-group">
                    <label for="created">Создано</label>
                    <input id="created" type="text" value="{{$item->created_at}}" class="form-group" disabled>
                </div>

                <div class="form-group">
                    <label for="updated">Изменено</label>
                    <input id="updated" type="text" value="{{$item->updated_at}}" class="form-group" disabled>
                </div>
                @if($item->is_published)
                <div class="form-group">
                    <label for="deleted">Опубликовано</label>
                    <input id="deleted" type="text" value="{{$item->published_at}}" class="form-group" disabled>
                </div>
                @endif

            </div>
        </div>
    </div>
</div>

@endif
