<div>
    @include('pages.demand-table')
</div>
@push('scripts')
<script>
    window.livewire.on('showDemandFormModal', () => {
        $('#modal-demand-form').modal('show');
    });

    window.livewire.on('hideDemandFormModal', () => {
        $('#modal-demand-form').modal('hide');
    });

    window.livewire.on('showDemandFilesModal', () => {
        $('#modal-demand-files').modal('show');
    });

    window.livewire.on('hideDemandFilesModal', () => {
        $('#modal-demand-files').modal('hide');
    });

    window.livewire.on('close', () => {
        $('#modal-demand-files').modal('hide');
        $('#modal-demand-form').modal('hide');
        $('#modal-delete').modal('hide');
    });

    window.livewire.on('scrollTop', () => {
        $(window).scrollTop(0);
    });

</script>
@endpush
