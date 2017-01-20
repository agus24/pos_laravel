<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <div class="form-body">
            <div class="form-group {{ $errors->has('kode') ? 'has-error' : ''}}">
                <label>Kode</label>
                {!! Form::text('kode', null, ['class' => 'form-control', 'required' => 'required']) !!}
                {!! $errors->first('kode', '<p class="help-block">:message</p>') !!}
            </div>
            <div class="form-group {{ $errors->has('harga') ? 'has-error' : ''}}">
                <label>Harga</label>
                {!! Form::number('harga', null, ['class' => 'form-control', 'required' => 'required']) !!}
                {!! $errors->first('harga', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-actions">
            {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
            <a type="button" class="btn default" href="{{ url()->previous() }}">Cancel</a>
        </div>
    </div>
</div>

