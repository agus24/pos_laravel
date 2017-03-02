@extends('layout.app')

@section('content')
<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption">
            <i class="icon-social-dribbble font-green"></i>
            <span class="caption-subject font-green bold uppercase">customer</span>
        </div>
        <div class="actions">
            <a class="btn btn-primary" href="{{ url('customer/create') }}">
                <i class="icon-plus"></i>
            </a>
        </div>
    </div>
    <div class="portlet-body">
        <div class="table-scrollable">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th width="5%"> # </th>
                        <th width=""> Name </th>
                        <th width=""> Address </th>
                        <th width=""> Email </th>
                        <th width=""> Phone </th>
                        <th width="15%"> Action </th>
                    </tr>
                </thead>
                <tbody>
                @foreach($data as $key => $value)
                	<tr>
                		@if(isset($_GET['page']))
                        <td>{{ ($_GET['page'] >1) ?(($_GET['page']-1)*15)+$key+1 : $key+1 }}.</td>
                        @else
                        <td>{{$key+1}}.</td>
                        @endif
                        <td>{{ $value->name }}</td>
                        <td>{{ $value->address }}</td>
                        <td>{{ $value->email }}</td>
                        <td>{{ $value->phone }}</td>
                		<td><a href="{{ url('customer/').'/'.$value->id."/edit" }}" class="btn btn-primary btn-sm"><i class="icon-pencil"></i>
                		</a>
                        {!! Form::open([
                                    'method'=>'DELETE',
                                    'url' => ['/customer', $value->id],
                                    'style' => 'display:inline'
                                ]) !!}
                        {!! Form::button('<i class="icon-trash"></i>', array(
                                            'type' => 'submit',
                                            'class' => 'btn btn-danger btn-sm',
                                            'title' => 'Delete',
                                            'onclick'=>'return confirm("Confirm delete?")'
                                    )) !!}
                        {!! Form::close() !!}
                	</tr>
                @endforeach
                </tbody>
            </table>
            {{-- <div class="pagination-wrapper"> {!! $data->render() !!} </div> --}}
        </div>
    </div>
</div>
@endsection