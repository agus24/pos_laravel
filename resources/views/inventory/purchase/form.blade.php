<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <div class="form-body">
            <div class="form-group {{ $errors->has('no_purchase') ? 'has-error' : ''}}">
                <label>No. Purchase</label>
                {!! Form::text('no_purchase', $no_purchase, ['class' => 'form-control', 'required' => 'required','readonly' => 'true','id' => 'no_purchase']) !!}
                {!! $errors->first('no_purchase', '<p class="help-block">:message</p>') !!}
            </div>
            <div class="form-group {{ $errors->has('tanggal') ? 'has-error' : ''}}">
                <label>Tanggal</label>
                {!! Form::date('tanggal', Carbon\Carbon::now(), ['class' => 'form-control', 'required' => 'required']) !!}
                {!! $errors->first('tanggal', '<p class="help-block">:message</p>') !!}
            </div>
            <div class="form-group {{ $errors->has('grand_total') ? 'has-error' : ''}}">
                <label>Grand Total</label>
                {!! Form::number('grand_total', null, ['class' => 'form-control',"readonly"=>"readonly", 'required' => 'required','id'=>'grand_total']) !!}
                {!! $errors->first('grand_total', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="col-md-4">
            Cari Barang :<input type="text" class="form-control" id="crBrg">
        </div>
        <table class="table table-responsive" id="tblDet">
            <thead>
                <th>Nama Barang</th>
                <th width="20%">Harga</th>
                <th width="20%">Jumlah</th>
                <th width="5%">#</th>
            </thead>
            <tbody>
                <td><span>Asdf</span></td>
                <td><span><input type="number" class="form-control"></span></td>
                <td><span><input type="number" class="form-control"></span></td>
                <td><button class="btn btn-danger btn-sm" onclick="removeRow(this)"><i class="icon-trash"></i></button></td>
            </tbody>
        </table>
        <center>
            <div class="form-actions">
                {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
                <a type="button" class="btn default" href="{{ url()->previous() }}">Cancel</a>
            </div>
        </center>
    </div>
</div>

