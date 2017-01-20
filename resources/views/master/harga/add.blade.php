@extends('layout.app')

@section('content')
<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption">
            <i class="icon-social-dribbble font-green"></i>
            <span class="caption-subject font-green bold uppercase">Harga</span>
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
                
        {!! Form::open(['url' => '/harga', 'class' => '', 'files' => true]) !!}

            @include('master.harga.form',["password"=>''])

        {!! Form::close() !!}
    </div>
</div>
@endsection