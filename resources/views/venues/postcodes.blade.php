{
"towns" : [
    @foreach($venues as $venue)
        "{{$venue->town}}",
    @endforeach
]
}
