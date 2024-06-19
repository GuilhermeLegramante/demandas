<div>
    @include('pages.department-form')

    @livewire('user-select-multiple')

    @livewire('status-select-multiple')
</div>
@push('scripts')
<script>
    window.livewire.on('showMultipleUserModal', () => {
        $('#modal-select-multiple-user').modal('show');
    });

    window.livewire.on('closeMultipleUserModal', () => {
        $('#modal-select-multiple-user').modal('hide');
    });

    window.livewire.on('showMultipleStatusModal', () => {
        $('#modal-select-multiple-status').modal('show');
    });

    window.livewire.on('closeMultipleStatusModal', () => {
        $('#modal-select-multiple-status').modal('hide');
    });

</script>
@endpush
