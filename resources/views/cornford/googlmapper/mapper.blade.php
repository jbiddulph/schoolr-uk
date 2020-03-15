
@include('googlmapper::javascript')

@foreach ($items as $id => $item)

    {!! $item->render($id, $view) !!}

    @if ($options['async'])
        @push('custom-scripts')
        <script type="text/javascript">

            initialize_items.push({
                method: initialize_{!! $id !!}
            });

        </script>
        @endpush
    @endif

@endforeach
