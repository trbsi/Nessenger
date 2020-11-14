@push('js')
    <script>
        var userId = '{{ auth()->id() }}';
    </script>
@endpush
