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
    'label' => 'E-mail',
    'model' => 'email',
    ])
</div>
<div class="row">
    @include('partials.inputs.text', [
    'columnSize' => 12,
    'label' => 'Telefone',
    'model' => 'phone',
    ])
</div>
<div class="row">
    @include('partials.inputs.select', [
    'columnSize' => 12,
    'label' => 'Plano',
    'model' => 'planId',
    'options' => $plans,
    ])
</div>
<div class="row">
    @include('partials.inputs.select', [
    'columnSize' => 12,
    'label' => 'Responsável',
    'model' => 'responsibleId',
    'options' => $users,
    ])
</div>
<div class="row">
    @include('partials.inputs.textarea', [
    'columnSize' => 12,
    'label' => 'Observação',
    'model' => 'note',
    'rows' => 6,
    'maxLength' => 5000,
    ])
</div>
<p><small>*campos obrigatórios</small></p>
