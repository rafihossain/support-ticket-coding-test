@extends('customer.customer-master')

@section('title') {{__('All Support Ticket')}} @endsection

@section('style')
<style>
    button.status-open {
        display: inline-block;
        background-color: #6bb17b;
        padding: 3px 10px;
        border-radius: 4px;
        color: #fff;
        text-transform: capitalize;
        border: none;
        font-weight: 600;
    }

    button.status-close {
        display: inline-block;
        background-color: #c66060;
        padding: 3px 10px;
        border-radius: 4px;
        color: #fff;
        text-transform: capitalize;
        border: none;
        font-weight: 600;
    }
</style>
@endsection

@section('content')

<div class="col-md-10 content_part">
    <div class="row custom_bread_part">
        <div class="col-md-12 bread">
            <ul>
                <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
                <li><a href="#"><i class="fa fa-angle-double-right"></i> Dashboard</a></li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 main_content">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-8">
                            <h4 class="card_header_title"><i class="fa fa-gg-circle"></i> Table All Data</h4>
                        </div>
                        <div class="col-md-4 text-right">
                            <a class="btn btn-sm btn-dark card_top_btn" href="{{ route('customer.support.ticket.new') }}"><i class="fa fa-th"></i> New Ticket</a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped table-hover custom_table">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Title</th>
                                <th scope="col">Status</th>
                                <th scope="col">View</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($all_tickets as $ticket)
                            <tr>
                                <td>{{ $ticket->title }}</td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="status-{{$ticket->status}} dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            {{$ticket->status}}
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item status_change" data-id="{{$ticket->id}}" data-val="open" href="#">{{__('Open')}}</a>
                                            <a class="dropdown-item status_change" data-id="{{$ticket->id}}" data-val="close" href="#">{{__('Close')}}</a>
                                        </div>
                                    </div>

                                </td>
                                <td>
                                    <a href="{{ route('customer.support.ticket.view',['id' => $ticket->id]) }}"><i class="fa fa-eye fa-lg"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer text-center">
                    .
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')

@endsection