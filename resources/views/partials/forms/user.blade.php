<div class="row">
    @include('partials.inputs.text', [
    'columnSize' => 12,
    'label' => 'Nome*',
    'model' => 'name',
    ])
</div>
<div class="row">
    @include('partials.inputs.text', [
    'columnSize' => 12,
    'label' => 'Login*',
    'model' => 'login',
    ])
</div>
<div class="row">
    @include('partials.inputs.text', [
    'columnSize' => 12,
    'label' => 'E-mail',
    'model' => 'email',
    ])
</div>
<div class="row">
    @include('partials.inputs.text', [
    'columnSize' => 12,
    'label' => 'Senha*',
    'model' => 'password',
    'isPassword' => true,
    ])
</div>
<div class="row">
    @include('partials.inputs.text', [
    'columnSize' => 12,
    'label' => 'Confirmação da Senha*',
    'model' => 'password_confirmation',
    'isPassword' => true,
    ])
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label>Setores</label>
            <div class="input-group">
                <h3 wire:click="$emit('showMultipleDepartmentModal')" class="cursor-pointer form-control input-custom  {{ $errors->has('filter.selectedDepartments') ? 'is-invalid' : '' }}">
                    @isset($filter['departmentsDescriptions'])
                    @foreach ($filter['departmentsDescriptions'] as $department)
                    <small class="badge badge-primary mt-1">{{ $department }}</small>
                    @endforeach
                    @endisset
                </h3>
                <span class="input-group-append">
                    <button type="button" class="btn btn-primary" title="Pesquisar" wire:click="$emit('showMultipleDepartmentModal')">
                        <i class="fas fa-search"></i>
                    </button>
                </span>
            </div>
            @error('filter.selectedDepartments')
            <h3 class="text-danger">
                <strong>{{ $message }}</strong>
            </h3>
            @enderror
        </div>
    </div>
</div>
<div class="row">
    @include('partials.inputs.select', [
    'columnSize' => 3,
    'label' => 'Administrador*',
    'model' => 'isAdmin',
    'options' => [['value' => 1, 'description' => 'SIM'], ['value' => 0, 'description' => 'NÃO']],
    ])
</div>
<p><small>*campos obrigatórios</small></p>
