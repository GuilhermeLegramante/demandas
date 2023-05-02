<div class="col-md-{{ $columnSize }}">
    <div class="form-group">
        <label>{{ $label }}</label>
        <div class="input-group">
            <input wire:model="{{ $model }}" {{ isset($multiple) && $multiple == true ? 'multiple' : '' }} type="file" class="form-control input-custom {{ $errors->has($model) ? 'is-invalid' : '' }}">
        </div>
        @error($model)
        <h3 class="text-danger">
            <strong>{{ $message }}</strong>
        </h3>
        @enderror
    </div>
</div>
