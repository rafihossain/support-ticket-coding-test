@extends('admin.admin-master')

@section('title') {{__('All Support Ticket')}} @endsection

@section('style')
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.1/dist/sweetalert2.min.css" rel="stylesheet">
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
                            <h4 class="card_header_title"><i class="fa fa-gg-circle"></i> All Support Tickets</h4>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped table-hover custom_table">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Title</th>
                                <th scope="col">User</th>
                                <th scope="col">Status</th>
                                <th scope="col">View</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($all_tickets as $ticket)
                            <tr>
                                <td>{{ $ticket->id }}</td>
                                <td>{{ $ticket->title }}</td>
                                <td>{{optional($ticket->user)->name ?? __('anonymous')}}</td>
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
                                    <div class="d-flex justify-content-around">
                                        <a href="{{ route('admin.support.ticket.view',['id' => $ticket->id]) }}"><i class="fa fa-eye fa-lg"></i></a>
                                        <a href="{{ route('admin.support.ticket.delete',['id' => $ticket->id]) }}" id="swal_status_change" data-id="{{ $ticket->id }}"><i class="fa fa-trash fa-lg"></i></a>
                                    </div>
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.1/dist/sweetalert2.all.min.js"></script>
<script>
    $(document).ready(function() {
        $(document).on('click', '.status_change', function(e) {
            e.preventDefault();
            //get value
            var status = $(this).data('val');
            var id = $(this).data('id');
            var currentStatus = $(this).parent().prev('button').text();
            currentStatus = currentStatus.trim();
            $(this).parent().prev('button').removeClass('status-' + currentStatus).addClass('status-' + status).text(status);
            //ajax call
            $.ajax({
                'type': 'post',
                'url': "{{route('admin.support.ticket.status.change')}}",
                'data': {
                    _token: "{{csrf_token()}}",
                    status: status,
                    id: id,
                },
                success: function(data) {
                    $(this).parent().prev('button').removeClass(currentStatus).addClass(status).text(status);
                }
            })
        });
        $(document).on('click', '#swal_status_change', function(e) {
            e.preventDefault();
            var href = $(this).attr('href');
            console.log(href);

            Swal.fire({
                title: '{{__("Are you sure to change status?")}}',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#1F51FF',
                cancelButtonColor: '#D2042D',
                confirmButtonText: 'Yes, change it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = href;
                }
            });
        });
    });
</script>
@endsection