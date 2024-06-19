<div>
    @include('pages.user-form')

    @livewire('department-select-multiple')
</div>
@push('scripts')
<script>
    window.livewire.on('showMultipleDepartmentModal', () => {
        $('#modal-select-multiple-department').modal('show');
    });
    window.livewire.on('closeMultipleDepartmentModal', () => {
        $('#modal-select-multiple-department').modal('hide');
    });

</script>
@endpush
