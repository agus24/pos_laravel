@extends('layout.app')

@section('content')
<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption">
            <i class="icon-social-dribbble font-green"></i>
            <span class="caption-subject font-green bold uppercase">adjustment</span>
        </div>
        <div class="actions">
            <a class="btn btn-primary" href="{{ url('adjustment/create') }}">
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
                        <th width=""> No. Adjust </th>
                        <th width=""> Tanggal </th>
                        <th width=""> Barang </th>
                        <th width=""> Qty Awal </th>
                        <th width=""> Qty Adjust </th>
                        <th width=""> Qty Akhir </th>
                        <th width=""> Warehouse </th>
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
                        <td>{{ $value->no_adjust }}</td>
                        <td>{{ $value->date }}</td>
                        <td>{{ $value->nama_barang }}</td>
                        <td>{{ $value->qty_awal }}</td>
                        <td>{{ $value->qty }}</td>
                        <td>{{ $value->qty_akhir }}</td>
                        <td>{{ $value->nama_warehouse }}</td>
                		<td>
                        {{-- <a href="{{ url('adjustment/').'/'.$value->id."/edit" }}" class="btn btn-primary btn-sm"><i class="icon-pencil"></i>
                		</a> --}}
                        {!! Form::open([
                                    'method'=>'DELETE',
                                    'url' => ['/adjustment', $value->id],
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