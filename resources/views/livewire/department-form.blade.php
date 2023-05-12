<div>
    @include('pages.department-form')

    @livewire('user-select-multiple')
</div>
@push('scripts')
<script>
    window.livewire.on('scrollTop', () => {
        $(window).scrollTop(0);
    });

    window.livewire.on('showMultipleUserModal', () => {
        $('#modal-select-multiple-user').modal('show');
    });
    window.livewire.on('closeMultipleUserModal', () => {
        $('#modal-select-multiple-user').modal('hide');
    });

</script>
@endpush
