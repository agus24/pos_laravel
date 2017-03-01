@extends('layout.app')

@section('content')
<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption">
            <i class="icon-social-dribbble font-green"></i>
            <span class="caption-subject font-green bold uppercase">Barang</span>
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
                
        {!! Form::open(['url' => '/adjustment', 'class' => '', 'files' => true]) !!}

            @include('inventory.adjustment.form',["password"=>''])

        {!! Form::close() !!}
    </div>
</div>
@endsection

@section('script')
<script>


function barangSelected(id) {

    var qty_awal    = $('#qty_awal').val();
    var qty         = $('#qty').val();
    var qty_akhir   = $('#qty_akhir').val();

    $.ajax({
        async:false,
        data:{
            _token : "{{ csrf_token() }}",
            id_barang : id
        },
        method : "POST",
        url : '{{ url('ajax/adjustBarang') }}',
        success : function(result) {
            $('#qty_awal').val(result[0].stok);
        }
    });

}

function berubah() {

    var qty_awal    = $('#qty_awal').val();
    var qty         = $('#qty').val();
    var qty_akhir   = parseInt(qty_awal) + parseInt(qty);

    $('#qty_akhir').val(qty_akhir);

}


</script>
@endsection