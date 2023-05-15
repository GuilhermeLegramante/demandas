<div>
    @include('pages.plan-form')
</div>
@push('scripts')
<script>
    window.livewire.on('scrollTop', () => {
        $(window).scrollTop(0);
    });

</script>
@endpush
