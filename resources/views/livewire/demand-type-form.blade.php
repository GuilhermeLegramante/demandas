<div>
    @include('pages.demand-type-form')
</div>
@push('scripts')
<script>
    window.livewire.on('scrollTop', () => {
        $(window).scrollTop(0);
    });

</script>
@endpush
