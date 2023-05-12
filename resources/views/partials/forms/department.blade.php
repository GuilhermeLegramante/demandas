<div class="row">
    @include('partials.inputs.text', [
    'columnSize' => 12,
    'label' => 'Nome*',
    'model' => 'name',
    ])
</div>
<div class="row">
    @include('partials.inputs.textarea', [
    'columnSize' => 12,
    'label' => 'Descrição detalhada',
    'model' => 'note',
    'rows' => 6,
    'maxLength' => 5000,
    ])
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label>Status</label>
            <div class="input-group">
                <h3 wire:click="$emit('showMultipleStatusModal')" class="cursor-pointer form-control input-custom  {{ $errors->has('filter.selectedStatus') ? 'is-invalid' : '' }}">
                    @isset($filter['statusDescriptions'])
                    @foreach ($filter['statusDescriptions'] as $status)
                    <small class="badge mt-1">{{ $status }}</small>
                    @endforeach
                    @endisset
                </h3>
                <span class="input-group-append">
                    <button type="button" class="btn btn-primary" title="Pesquisar" wire:click="$emit('showMultipleLocaleModal')">
                        <i class="fas fa-search"></i>
                    </button>
                </span>
            </div>
            @error('filter.selectedStatus')
            <h3 class="text-danger">
                <strong>{{ $message }}</strong>
            </h3>
            @enderror
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label>Usuários</label>
            <div class="input-group">
                <h3 wire:click="$emit('showMultipleUserModal')" class="cursor-pointer form-control input-custom  {{ $errors->has('filter.selectedUsers') ? 'is-invalid' : '' }}">
                    @isset($filter['usersDescriptions'])
                    @foreach ($filter['usersDescriptions'] as $user)
                    <small class="badge badge-primary mt-1">{{ $user }}</small>
                    @endforeach
                    @endisset
                </h3>
                <span class="input-group-append">
                    <button type="button" class="btn btn-primary" title="Pesquisar" wire:click="$emit('showMultipleUserModal')">
                        <i class="fas fa-search"></i>
                    </button>
                </span>
            </div>
            @error('filter.selectedUsers')
            <h3 class="text-danger">
                <strong>{{ $message }}</strong>
            </h3>
            @enderror
        </div>
    </div>
</div>
<p><small>*campos obrigatórios</small></p>
