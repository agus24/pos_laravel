@extends('layout.app')

@section('content')
<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption">
            <i class="icon-social-dribbble font-green"></i>
            <span class="caption-subject font-green bold uppercase">User</span>
        </div>
        {{-- <div class="actions">
            <a class="btn btn-primary" href="{{ url('user/create') }}">
                <i class="icon-plus"></i>
            </a>
        </div> --}}
    </div>
    <div class="portlet-body">
        <div class="row">
        <div class="col-md-6">
            {!! Form::open(['url' => '/user/'.$user->id, 'class' => '', 'files' => true]) !!}
            <table class="table table-responsive">
                <thead>
                    <th width="5%">#</th>
                    <th>Nama Menu</th>
                </thead>
                <tbody>
                    @foreach($userAccess as $key => $value)
                    <tr>
                        <td>
                            <input 
                                type="checkbox"
                                value="{{ $value->id }}"
                                name="menu_id[]" 
                                {{ ($value->id === $value->menu_id)? 'checked' : ''}}></td>
                        <td>{{ $value->name }}</td>
                    </tr>
                    @endforeach
                    <tr>
                        <center>
                            <td colspan=2>
                                <input type="submit" class="btn btn-primary btn-sm" value="Submit">
                                <a href="{{ url()->previous() }}" class="btn btn-default btn-sm"> Back</a>
                            </td>
                        </center>
                    </tr>
                </tbody>
            </table>
            {!! Form::close() !!}
        </div>
        </div>
    </div>
</div>
@endsection