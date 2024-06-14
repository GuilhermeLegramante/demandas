@if(isset($demand['files']))
<div wire:ignore.self class="modal fade z-index-99999" id="modal-demand-files" role="dialog" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <p><strong>Anexos</strong></p>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    @foreach ($demand['files'] as $file)
                    <div class="col-sm-3">
                        <div class="card text-center">
                            <div class="card-body">
                                <a target="_blank" href="{{ Storage::disk('s3')->url($file['path']) }}"><img onerror="this.onerror=null; this.src='img/no-preview.jpg'" src="{{ Storage::disk('s3')->url($file['path']) }}" alt="Anexo" class="img-fluid mb-2">
                                </a>
                                @isset($file['filename'])
                                <p>{{ $file['filename'] }}</p>
                                @endisset
                            </div>
                            <div class="card-footer">
                                <button wire:click.prevent="deleteFile({{ $file['id'] }}, {{ $file['demandId'] }})" title="Excluir o anexo" class="btn btn-light btn-sm" wire:loading.attr="disabled">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endif
