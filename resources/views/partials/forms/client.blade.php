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
<p><small>*campos obrigatórios</small></p>
