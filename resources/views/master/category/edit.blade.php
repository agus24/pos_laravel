@extends('layout.app')

@section('content')
<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption">
            <i class="icon-social-dribbble font-green"></i>
            <span class="caption-subject font-green bold uppercase">User</span>
        </div>
        <div class="actions">
            {{-- <a class="btn btn-primary" href="{{ url('user/add') }}">
                <i class="icon-plus"></i>
            </a> --}}
        </div>
    </div>
    <div class="portlet-body">
        {{-- Content --}}

        {!! Form::model($category, [
            'method' => 'PATCH',
            'url' => ['/category', $category->id],
            'files' => true
        ]) !!}

            @include('master.category.form',['submitButtonText' => 'Update',"password" => "disabled=disabled"])

        {!! Form::close() !!}
    </div>
</div>
@endsection