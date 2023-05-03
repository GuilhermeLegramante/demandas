<div wire:ignore.self class="modal fade z-index-99999" id="modal-demand-form" role="dialog" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <p><strong>Incluir Demanda</strong></p>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
            <div class="modal-body">
                @include('partials.flash-messages.default')

                <div class="row">
                    @include('partials.inputs.text', [
                    'columnSize' => 12,
                    'label' => 'Título',
                    'model' => 'title',
                    'maxLenght' => 100,
                    ])
                </div>

                <div class="row">
                    @include('partials.inputs.text', [
                    'columnSize' => 12,
                    'label' => 'Informações na arte',
                    'model' => 'subtitle',
                    'maxLenght' => 100,
                    ])
                </div>

                <div class="row">
                    @include('partials.inputs.textarea', [
                    'columnSize' => 12,
                    'label' => 'Redação',
                    'model' => 'description',
                    'rows' => 6,
                    'maxLength' => 5000,
                    ])
                </div>

                <div class="row">
                    @include('partials.inputs.select', [
                    'columnSize' => 12,
                    'label' => 'Cliente',
                    'model' => 'clientId',
                    'options' => $clientsToFilter,
                    ])
                </div>

                <div class="row">
                    @include('partials.inputs.select', [
                    'columnSize' => 12,
                    'label' => 'Tipo de Demanda',
                    'model' => 'demandTypeId',
                    'options' => $demandTypesToFilter,
                    ])
                </div>

                <div class="row">
                    @include('partials.inputs.select', [
                    'columnSize' => 12,
                    'label' => 'Status',
                    'model' => 'demandStatusId',
                    'options' => $statusToFilter,
                    ])
                </div>

                <div class="row">
                    @include('partials.inputs.date', [
                    'columnSize' => 12,
                    'label' => 'Data e Hora da publicação',
                    'model' => 'publicationDate',
                    'isDatetime' => true,
                    ])
                </div>

                <div class="row">
                    @include('partials.inputs.file', [
                    'columnSize' => 12,
                    'label' => 'Anexos',
                    'model' => 'files',
                    'multiple' => true,
                    ])
                </div>

                @if($isEdition)
                <div class="row">
                    <div class="col-md-12">
                        <a href="">anexo_01.png</a><br>
                        <a href="">anexo_02.png</a><br>
                        <a href="">anexo_03.png</a><br>
                    </div>
                </div>
                @endif
            </div>


            <div class="modal-footer">
                <button type="button" class="btn btn-outline-primary btn-sm" data-dismiss="modal" wire:loading.attr="disabled">
                    <i class="fas fa-times" aria-hidden="true"></i>
                    <strong> CANCELAR &nbsp;</strong>
                </button>
                <button wire:click.prevent="confirmActionFromModal" wire:key="confirmActionFromModal" type="submit" wire:loading.attr="disabled" class="btn btn-primary btn-sm">
                    <strong> CONFIRMAR &nbsp;</strong>
                    <i class="fas fa-check" aria-hidden="true"></i>
                </button>
            </div>
        </div>
    </div>
</div>
