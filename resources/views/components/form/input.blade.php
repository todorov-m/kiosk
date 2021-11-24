@props(['name', 'class', 'type', 'title'])

<div class="{{$class}}">
    <label for="{{$name}}" class="form-label">{{$title}}</label>
    <input class="form-control form-control-lg"
           name="{{$name}}"
           id="{{$name}}"
           type="{{$type}}"
           required
           {{$attributes(['value'=>old($name)]) }}
    >
    <div class="invalid-feedback">
        Valid first name is required.
    </div>
</div>

