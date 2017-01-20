<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <div class="form-body">
            <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                <label>Name</label>
                {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
                {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
            </div>
            <div class="form-group {{ $errors->has('alamat') ? 'has-error' : ''}}">
                <label>Alamat</label>
                {!! Form::textarea('alamat', null, ['class' => 'form-control', 'required' => 'required']) !!}
                {!! $errors->first('alamat', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-actions">
            {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
            <a type="button" class="btn default" href="{{ url()->previous() }}">Cancel</a>
        </div>
    </div>
</div>

