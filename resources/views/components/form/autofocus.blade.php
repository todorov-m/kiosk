@props(['name', 'class', 'type', 'title', 'inputClass', 'labelClass'])

<div class="{{$class}}">
    <label for="{{$name}}" class="{{$labelClass}}">{{$title}}</label>
    <input class="{{$inputClass}}"
           name="{{$name}}"
           id="{{$name}}"
           type="{{$type}}"
           required
           autofocus
           >
    <div class="invalid-feedback">
        Valid first name is required.
    </div>
</div>
