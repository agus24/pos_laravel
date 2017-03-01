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
                
        {!! Form::open(['url' => '/barang', 'class' => '', 'files' => true]) !!}

            @include('master.barang.form',["password"=>''])

        {!! Form::close() !!}
    </div>
</div>
@endsection

@section('script')
<script>


// $('#harga').change(berubah());
// $('#category').change(berubah());
// $('#subcategory').change(berubah());


function berubah(){
    var harga = $('#harga option:selected').text();
    var category = $('#category').val();
    var subcategory = $('#subcategory').val();
    var lastID = {{ $lastID[0]['id']+1 }};

    if(category < 10){
        category = '00'+category;
    }
    else if(category <100){
        category = '0'+category;
    }

    if(subcategory < 10){
        subcategory = '00'+subcategory;
    }
    else if(subcategory <100){
        subcategory = '0'+subcategory;
    }

    if(lastID < 10){
        lastID = '00'+lastID;
    }
    else if(lastID <100){
        lastID = '0'+lastID;
    }

    console.log('category : '+category);
    console.log('subcategory : '+subcategory);
    console.log('harga : '+harga);
    console.log('lastID : '+lastID);

    var hasil = harga+category+subcategory+lastID;
    $('#kode').val(hasil);
}


</script>
@endsection