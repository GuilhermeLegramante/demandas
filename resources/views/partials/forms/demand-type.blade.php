<div class="row">
    @include('partials.inputs.text', [
    'columnSize' => 12,
    'label' => 'Descrição*',
    'model' => 'description',
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
<p><small>*campos obrigatórios</small></p>
