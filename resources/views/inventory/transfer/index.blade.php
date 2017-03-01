@extends('layout.app')

@section('content')
<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption">
            <i class="icon-social-dribbble font-green"></i>
            <span class="caption-subject font-green bold uppercase">transfer</span>
        </div>
        <div class="actions">
            <a class="btn btn-primary" href="{{ url('transfer/list') }}">
                <i class="icon-list"></i>
            </a>
        </div>
    </div>
    <div class="portlet-body">
        <div class="table-scrollable">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th width="5%"> # </th>
                        <th width=""> Nama Barang </th>
                        <th width="5%"> Qty Now </th>
                        <th width="5%"> Qty Transfer </th>
                        <th width="20%"> Warehouse </th>
                        <th width="20%"> Warehouse To </th>
                        <th width="5%"> Action </th>
                    </tr>
                </thead>
                <tbody>
                @foreach($stok as $key => $value)
                	<tr>
                		@if(isset($_GET['page']))
                        <td>{{ ($_GET['page'] >1) ?(($_GET['page']-1)*15)+$key+1 : $key+1 }}.</td>
                        @else
                        <td>{{$key+1}}.</td>
                        @endif
                        <td>{{ $value->nama }}</td>
                        <td>{{ $value->stok }}</td>
                        {!! Form::open([
                                    'method'=>'POST',
                                    'url' => '/transfer',
                                    'style' => 'display:inline'
                                ]) !!}
                        <td>
                            <input type="number" class="form-control" name="qty">
                            <input type="hidden" name="barang_id" value="{{ $value->id }}">
                        </td>
                        <td>{{ Auth::user()->warehouse()->get()[0]->name }}</td>
                        <td>
                            <select class="form-control" name="warehouse_id">
                                <option>Select</option>
                                @foreach($warehouse as $key => $value)
                                <option value="{{ $value->id }}">{{ $value->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                        {!! Form::button('<i class="icon-check"></i>', array(
                                            'type' => 'submit',
                                            'class' => 'btn btn-primary btn-sm',
                                            'title' => 'Transfer'
                                    )) !!}
                        {!! Form::close() !!}
                	</tr>
                @endforeach
                </tbody>
            </table>
            <div class="pagination-wrapper"> {!! $stok->render() !!} </div>
        </div>
    </div>
</div>
@endsection