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
    @include('partials.inputs.number', [
    'columnSize' => 12,
    'label' => 'Quantidade de Posts Semanais*',
    'model' => 'weeklyPostsQuantity',
    ])
</div>
<div class="row">
    @include('partials.inputs.select', [
    'columnSize' => 3,
    'label' => 'Material Offline?*',
    'model' => 'hasOfflineMaterial',
    'options' => [['value' => 1, 'description' => 'SIM'], ['value' => 0, 'description' => 'NÃO']],
    ])
</div>
<p><small>*campos obrigatórios</small></p>
