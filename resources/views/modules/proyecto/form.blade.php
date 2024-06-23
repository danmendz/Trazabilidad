<div class="row padding-1 p-1">
    <div class="col-md-12">
        <div class="form-group mb-2 mb20">
            <label for="codigo_proyecto" class="form-label">{{ __('Código Proyecto') }}</label>
            <input type="text" name="codigo_proyecto" class="form-control @error('codigo_proyecto') is-invalid @enderror" value="{{ old('codigo_proyecto', $proyecto->codigo_proyecto ?? '') }}" id="codigo_proyecto" placeholder="Código Proyecto">
            {!! $errors->first('codigo_proyecto', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="empresa" class="form-label">{{ __('Empresa') }}</label>
            <input type="text" name="empresa" class="form-control @error('empresa') is-invalid @enderror" value="{{ old('empresa', $proyecto->empresa ?? '') }}" id="empresa" placeholder="Empresa">
            {!! $errors->first('empresa', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="estatus" class="form-label">{{ __('Estatus') }}</label>
            <select name="estatus" id="estatus" class="form-control @error('estatus') is-invalid @enderror">
                <option value="">{{ __('Seleccione un estatus') }}</option>
                @foreach($estatusOptions as $estatus)
                    <option value="{{ $estatus }}" {{ old('estatus', $proyecto->estatus ?? '') == $estatus ? 'selected' : '' }}>{{ $estatus }}</option>
                @endforeach
            </select>
            {!! $errors->first('estatus', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="imagen" class="form-label">{{ __('Imagen') }}</label>
            <input type="file" name="imagen" class="form-control @error('imagen') is-invalid @enderror" id="imagen">
            {!! $errors->first('imagen', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Enviar') }}</button>
    </div>
</div>
