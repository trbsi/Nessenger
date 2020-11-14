@push('js')
    <script>
        var sendMessageRoute = '{{ api_route('messages.send') }}';
        var searchMessageRoute = '{{ api_route('messages.search') }}';
        var deleteAllByUserRoute = '{{ api_route('messages.delete.all-by-user') }}';
    </script>
@endpush
