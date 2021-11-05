<x-layout>
    @foreach($contents as $content)
        {{$content->ean}}
    @endforeach
</x-layout>
