<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <div class="form-body">
            <div class="form-group {{ $errors->has('no_adjust') ? 'has-error' : ''}}">
                <label>No Adjust</label>
                {!! Form::text('no_adjust', $no_adjust, ['class' => 'form-control', 'required' => 'required','readonly' => 'true','id' => 'no_adjust']) !!}
                {!! $errors->first('no_adjust', '<p class="help-block">:message</p>') !!}
            </div>
            <div class="form-group {{ $errors->has('date') ? 'has-error' : ''}}">
                <label>Tanggal</label>
                {!! Form::date('date',Carbon\Carbon::now(), ['class' => 'form-control', 'required' => 'required']) !!}
                {!! $errors->first('date', '<p class="help-block">:message</p>') !!}
            </div>
            <div class="form-group {{ $errors->has('barang_id') ? 'has-error' : ''}}">
                <label>Barang</label>
                {!! Form::select('barang_id',$barang, null, ['class' => 'form-control select2', 'required' => 'required','id'=>'barang_id','onchange'=>'barangSelected(this.value)']) !!}
                {!! $errors->first('barang_id', '<p class="help-block">:message</p>') !!}
            </div>
            <div class="form-group {{ $errors->has('qty') ? 'has-error' : ''}}">
                <label>Qty Awal</label>
                {!! Form::number('qty_awal', null, ['class' => 'form-control', 'required' => 'required','id'=>'qty_awal','onchange'=>'berubah()','readonly'=>'readonly']) !!}
                {!! $errors->first('qty', '<p class="help-block">:message</p>') !!}
            </div>
            <div class="form-group {{ $errors->has('qty') ? 'has-error' : ''}}">
                <label>Qty</label>
                {!! Form::number('qty', null, ['class' => 'form-control', 'required' => 'required','id'=>'qty','onchange'=>'berubah()']) !!}
                {!! $errors->first('qty', '<p class="help-block">:message</p>') !!}
            </div>
            <div class="form-group {{ $errors->has('qty_akhir') ? 'has-error' : ''}}">
                <label>Qty Akhir</label>
                {!! Form::number('qty_akhir', null, ['class' => 'form-control', 'required' => 'required','id'=>'qty_akhir','readonly'=>'readonly']) !!}
                {!! $errors->first('qty_akhir', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-actions">
            {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
            <a type="button" class="btn default" href="{{ url()->previous() }}">Cancel</a>
        </div>
    </div>
</div>

