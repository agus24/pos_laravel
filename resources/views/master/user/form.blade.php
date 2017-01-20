<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <div class="form-body">
            <div class="form-group {{ $errors->has('username') ? 'has-error' : ''}}">
                <label>Username</label>
                {!! Form::text('username', null, ['class' => 'form-control', 'required' => 'required']) !!}
                {!! $errors->first('username', '<p class="help-block">:message</p>') !!}
            </div>
            <div class="form-group {{ $errors->has('password') ? 'has-error' : ''}}">
                <label>Password</label>
                {!! Form::password('password', ['class' => 'form-control', 'required' => 'required',$password]) !!}
                {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
            </div>
           
            <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                <label>Name</label>
                {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
                {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
            </div>
              <div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
                    <label>Email</label>
                    {!! Form::email('email', null,['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
                </div>

            <div class="form-group {{ $errors->has('alamat') ? 'has-error' : ''}}">
                <label>Alamat</label>
                {!! Form::textarea('alamat', null, ['class' => 'form-control', 'required' => 'required']) !!}
                {!! $errors->first('alamat', '<p class="help-block">:message</p>') !!}
            </div>
            <div class="form-group {{ $errors->has('phone') ? 'has-error' : ''}}">
                <label>Phone</label>
                {!! Form::text('phone', null,['class' => 'form-control', 'required' => 'required']) !!}
                {!! $errors->first('phone', '<p class="help-block">:message</p>') !!}
            </div>
            <div class="form-group {{ $errors->has('ware_id') ? 'has-error' : ''}}">
                <label>Warehouse</label>
                {!! Form::select('ware_id', ["1"=>"b123"],null, ['class' => 'form-control', 'required' => 'required']) !!}
                {!! $errors->first('ware_id', '<p class="help-block">:message</p>') !!}
            </div>

            <div class="form-group {{ $errors->has('level_user') ? 'has-error' : ''}}">
                <label>Level User</label>
                {!! Form::select('level_user', ["1"=>"Owner","2"=>"Admin","3"=>"Karyawan"],null, ['class' => 'form-control', 'required' => 'required']) !!}
                {!! $errors->first('level_user', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-actions">
            {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
            <a type="button" class="btn default" href="{{ url()->previous() }}">Cancel</a>
        </div>
    </div>
</div>

