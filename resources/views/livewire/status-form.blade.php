<div>
    @include('pages.status-form')
</div>
@push('scripts')
<script>
    window.livewire.on('scrollTop', () => {
        $(window).scrollTop(0);
    });

</script>
@endpush
