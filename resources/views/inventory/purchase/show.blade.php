@extends('layout.app')

@section('content')
<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption">
            <i class="icon-social-dribbble font-green"></i>
            <span class="caption-subject font-green bold uppercase">Show</span>
        </div>
    </div>
    <div class="portlet-body">
        <div class="table-scrollable">
            <table class="table table-responsive">
                <tr>
                    <td width="30%"><b>No Purchase</b></td>
                    <td>:{{ $data->no_purchase }}</td>
                </tr>
                <tr>
                    <td><b>Tanggal</b></td>
                    <td>:{{ $data->tanggal }}</td>
                </tr>
            </table>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th width="5%"> # </th>
                        <th width=""> Nama Barang </th>
                        <th width=""> Qty </th>
                    </tr>
                </thead>
                <tbody>
                @foreach($detail as $key => $value)
                	<tr>
                        <td>{{$key+1}}.</td>
                        <td>{{ $value->nama_barang }}</td>
                        <td>{{ $value->qty }}</td>
                	</tr>
                @endforeach
                </tbody>
            </table>
            <a href="{{ url()->previous() }}" class="btn btn-default">Back</a>
        </div>
    </div>
</div>
@endsection