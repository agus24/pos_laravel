@extends('layout.app')

@section('content')
<script>
var itemChoose = [];
</script>
<?php $submitButtonText = 'Update'; ?>
<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption">
            <i class="icon-social-dribbble font-green"></i>
            <span class="caption-subject font-green bold uppercase">Purchase</span>
        </div>
        <div class="actions">
            {{-- <a class="btn btn-primary" href="{{ url('user/add') }}">
                <i class="icon-plus"></i>
            </a> --}}
        </div>
    </div>
    <div class="portlet-body">
        {{-- Content --}}
        @if ($errors->any())
            <ul class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
                
        {!! Form::open(['url' => '/purchase'.'/'.$data['head']->id, 'class' => '', 'files' => true,'method' => 'PATCH']) !!}
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="form-body">
                        <div class="form-group {{ $errors->has('no_purchase') ? 'has-error' : ''}}">
                            <label>No. Purchase</label>
                            {!! Form::text('no_purchase', $data['head']->no_purchase, ['class' => 'form-control', 'required' => 'required','readonly' => 'true','id' => 'no_purchase']) !!}
                            {!! $errors->first('no_purchase', '<p class="help-block">:message</p>') !!}
                        </div>
                        <div class="form-group {{ $errors->has('tanggal') ? 'has-error' : ''}}">
                            <label>Tanggal</label>
                            {!! Form::date('tanggal', $data['head']->tanggal, ["readonly"=>"readonly",'class' => 'form-control', 'required' => 'required']) !!}
                            {!! $errors->first('tanggal', '<p class="help-block">:message</p>') !!}
                        </div>
                        <div class="form-group {{ $errors->has('grand_total') ? 'has-error' : ''}}">
                            {!! Form::hidden('grand_total', $data['head']->grand_total, ['class' => 'form-control',"readonly"=>"readonly", 'required' => 'required','id'=>'grand_total']) !!}
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
                            <th width="20%">Jumlah</th>
                            <th width="5%">#</th>
                        </thead>
                        <tbody>
                        @foreach($data['det'] as $detail)
                            <script>
                                itemChoose.push({{ $detail->barang_id }});
                            </script>
                            <tr>
                                <td>
                                    <input type="hidden" name="id_barang[]" value="{{ $detail->barang_id }}" class="form-control">
                                    <span>{{ $detail->nama_barang }}</span>
                                </td>
                                <td>
                                    <input type="hidden" name="harga[]" value="{{ $detail->harga }}" class="harga">
                                    <input type="number" name="qty_barang[]" class="form-control qty" value="{{ $detail->qty }}"onchange="gantiHarga()">
                                </td>
                                <td>
                                    <span class="btn btn-danger" onclick="removeRow('{{ $detail->barang_id }}',this)"><i class="icon-trash"></i></span>
                                </td>
                            </tr>
                        @endforeach
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



        {!! Form::close() !!}
    </div>
</div>
@endsection

@section('script')
{{-- <script src="{{ asset('assets/bower_components/jquery/dist/jquery.min.js') }}"></script> --}}
<script src="{{ asset('assets/bower_components/jquery-ui/jquery-ui.min.js') }}"></script>
<script src="{{ asset('assets/bower_components/requirejs/require.js') }}"></script>
<script src="{{ asset('assets/bower_components/Autocomplete/dist/autocomplete.js') }}"></script>
<script>
$('#crBrg').on('keyup',function(){
    if($(this).val().length > 3){
        var data = $(this).val();
        var dataFind = [];
        $.ajax({
            async : false,
            type : "POST",
            data : "data="+data+"&_token={{ csrf_token() }}",
            url : '{{ url('/ajax/item') }}',
            success : function(result){
                dataFind = result;
            }
        });        

        $(this).autocomplete({
            source : dataFind,
            minLength : 3,
            select : function(event,ui){
                var id_barang = ui.item.value;
                var text_barang = ui.item.label;
                var harga = ui.item.harga;
                if(!cariItem(itemChoose,id_barang))
                {
                    html = '';
                    html += '<tr>';
                    html += '<td>';
                    html += '<input type="hidden" name="id_barang[]" value="'+id_barang+'">';
                    html += '<span>'+text_barang+'</span>';
                    html += '</td>';
                    html += '<td>';
                    html += '<input type="hidden" name="harga[]" value='+harga+' class="form-control harga" onchange="gantiHarga()">';
                    html += '<input type="number" name="qty_barang[]" value=0 class="form-control qty" onchange="gantiHarga()">';
                    html += '</td>';
                    html += '<td>';
                    html += '<span class="btn btn-danger" onclick="removeRow('+id_barang+',this)"><i class="icon-trash"></i></span>';
                    html += '</td>';
                    html += '</tr>';
                    itemChoose.push(id_barang);
                    $('#tblDet >tbody').append(html);
                    $('#crBrg').val('');
                }
                else{
                    alert('item sudah ada');
                }
            }
        });
    }
});

function gantiHarga()
{
    var v = 0;
    var t = 0;
    var i = 0;
    var q = 0;
    $('.harga').each(function(){
        var q_tmp = $('.qty')[i];
        q = parseInt($(q_tmp).val());

        var hr = $('.harga')[i];
        v = parseInt($(hr).val());

        console.log("qty: ",q)
        console.log("harga: ",v)
        t += (v * q);
        i++;
    });

    console.log("Grand Total : ",t);
    $('#grand_total').val(t);
}

function cariItem(array,item){
    for (var i = array.length - 1; i >= 0; i--) {
        if(array[i] == item){
            return true;
        }
    }
    return false;
}


function cariIndexArray(array,item){
    for(var i = 0 ; i < array.length ; i++){
        if(array[i] == item){
            return i;
        }
    }
    return -1;
}

function removeRow(id_barang,e)
{
    var index = cariIndexArray(itemChoose,id_barang);
    itemChoose.splice(index,1);
    $(e).closest('tr').remove();
}

</script>
@endsection