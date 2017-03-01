<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <div class="form-body">
            <div class="form-group {{ $errors->has('kode') ? 'has-error' : ''}}">
                <label>Kode</label>
                {!! Form::text('kode', null, ['class' => 'form-control', 'required' => 'required','readonly' => 'true','id' => 'kode']) !!}
                {!! $errors->first('kode', '<p class="help-block">:message</p>') !!}
            </div>
            <div class="form-group {{ $errors->has('nama') ? 'has-error' : ''}}">
                <label>Nama</label>
                {!! Form::text('nama', null, ['class' => 'form-control', 'required' => 'required']) !!}
                {!! $errors->first('nama', '<p class="help-block">:message</p>') !!}
            </div>
            <div class="form-group {{ $errors->has('harga') ? 'has-error' : ''}}">
                <label>Kode Harga</label>
                {!! Form::select('id_harga',$harga, null, ['class' => 'form-control', 'required' => 'required','id'=>'harga','onchange'=>'berubah()']) !!}
                {!! $errors->first('harga', '<p class="help-block">:message</p>') !!}
            </div>
            <div class="form-group {{ $errors->has('category') ? 'has-error' : ''}}">
                <label>Category</label>
                {!! Form::select('id_category',$category, null, ['class' => 'form-control', 'required' => 'required','id'=>'category','onchange'=>'berubah()']) !!}
                {!! $errors->first('category', '<p class="help-block">:message</p>') !!}
            </div>
            <div class="form-group {{ $errors->has('subcategory') ? 'has-error' : ''}}">
                <label>Sub Category</label>
                {!! Form::select('id_subcategory',$subCategory, null, ['class' => 'form-control', 'required' => 'required','id'=>'subcategory','onchange'=>'berubah()']) !!}
                {!! $errors->first('subcategory', '<p class="help-block">:message</p>') !!}
            </div>
            <div class="form-group {{ $errors->has('harga') ? 'has-error' : ''}}">
                <label>Harga Jual</label>
                {!! Form::number('id_harga', null, ['class' => 'form-control', 'required' => 'required','id'=>'harga']) !!}
                {!! $errors->first('harga', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-actions">
            {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
            <a type="button" class="btn default" href="{{ url()->previous() }}">Cancel</a>
        </div>
    </div>
</div>

