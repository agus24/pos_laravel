@extends('layout.app')

@section('content')
<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption">
            <i class="icon-social-dribbble font-green"></i>
            <span class="caption-subject font-green bold uppercase">transfer</span>
        </div>
        <div class="actions">
            <a class="btn btn-primary" href="{{ url()->previous() }}">
                Back
            </a>
        </div>
    </div>
    <div class="portlet-body">
        <div class="table-scrollable">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th width="5%"> # </th>
                        <th width=""> Tanggal </th>
                        <th width="5%"> Barang </th>
                        <th width="5%"> Qty </th>
                        <th width="20%"> From </th>
                        <th width="20%"> To </th>
                    </tr>
                </thead>
                <tbody>
                @foreach($transfer as $key => $value)
                	<tr>
                		@if(isset($_GET['page']))
                        <td>{{ ($_GET['page'] >1) ?(($_GET['page']-1)*15)+$key+1 : $key+1 }}.</td>
                        @else
                        <td>{{$key+1}}.</td>
                        @endif
                        <td>{{ $value->date }}</td>
                        <td>{{ $value->nama_barang }}</td>
                        <td>{{ $value->qty }}</td>
                        <td>{{ $value->from }}</td>
                        <td>{{ $value->to }}</td>
                	</tr>
                @endforeach
                </tbody>
            </table>
            <div class="pagination-wrapper"> {!! $transfer->render() !!} </div>
        </div>
    </div>
</div>
@endsection