<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>Admin Panel</title>
</head>

<style>
    /* support ticket  */
    .reply-message-wrap {
        padding: 40px;
        /* background-color: #fbf9f9; */
    }

    .gig-message-start-wrap {
        margin-top: 60px;
        margin-bottom: 60px;
        /* background-color: #fbf9f9; */
        padding: 40px;
    }

    .single-message-item {
        background-color: #e7ebec;
        padding: 20px;
        border-radius: 10px;
        margin-bottom: 20px;
        margin-right: 80px;
    }


    .single-message-item .thumb .title {
        font-size: 16px;
        font-weight: 600;
        text-transform: uppercase;
        width: 40px;
        height: 40px;
        line-height: 40px;
        background-color: #c7e5ec;
        display: inline-block;
        border-radius: 5px;
        text-align: center;
    }

    .single-message-item .title {
        font-size: 16px;
        line-height: 20px;
        margin: 10px 0 0px 0;
    }

    .single-message-item .time {
        display: block;
        font-size: 13px;
        margin-bottom: 20px;
        font-weight: 500;
        font-style: italic;
    }

    .single-message-item .thumb i {
        display: block;
        width: 100%;
    }


    .single-message-item .top-part {
        display: flex;
        margin-bottom: 25px;
    }

    .single-message-item .top-part .content {
        flex: 1;
        margin-left: 15px;
    }
</style>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <div class="support-ticket-summery-warp">
                            <div class="gig-chat-message-heading">
                                <div class="header-wrap d-flex justify-content-between">
                                    <h4 class="header-title">{{__('Support Ticket Details')}}</h4>
                                    <a href="{{route('customer.support.ticket.all')}}"
                                        class="btn btn-info">{{__('All Tickets')}}</a>
                                </div>
                                <div class="gig-order-info">
                                    <ul>
                                        <li><strong>{{__('Ticket ID:')}}</strong> #{{$ticket_details->id}}</li>
                                        <li><strong>{{__('Title:')}}</strong> {{$ticket_details->title}}</li>
                                        <li><strong>{{__('Subject:')}}</strong> {{$ticket_details->subject}} </li>
                                        <li><strong>{{__('Status:')}}</strong>{{__($ticket_details->status)}}</li>
                                        <li><strong>{{__('Description:')}}</strong> {{$ticket_details->description}}</li>
                                    </ul>
                                </div>
                                <div class="gig-message-start-wrap">
                                    <h2 class="title">{{__('All Conversation')}}</h2>
                                    <div class="all-message-wrap msg-row-reverse">
                                        @forelse($all_messages as $msg)
                                        <div class="single-message-item">
                                            <div class="top-part">
                                                <div class="thumb">
                                                    <span class="title">
                                                        {{substr($msg->user_info()->name ?? __('Unknown'),0,1)}}
                                                    </span>
                                                </div>
                                                <div class="content">
                                                    <h6 class="title">
                                                        {{$msg->user_info()->name ?? __('Unknown')}}
                                                    </h6>
                                                    <span class="time">{{date_format($msg->created_at,'d M Y H:i:s')}} | {{$msg->created_at->diffForHumans()}}</span>
                                                </div>
                                            </div>
                                            <div class="content">
                                                <div class="message-content">
                                                    {!! $msg->message !!}
                                                </div>
                                            </div>
                                        </div>
                                        @empty
                                        <p class="alert alert-warning">{{__('no message found')}}</p>
                                        @endforelse
                                    </div>
                                </div>

                                @if($ticket_details->status != 'close')
                                <div class="reply-message-wrap ">
                                    <h5 class="title">{{__('Replay To Message')}}</h5>
                                    
                                    @if(session()->has('msg'))
                                        <div class="alert alert-{{session('type')}}">
                                            {!! session('msg') !!}
                                        </div>
                                    @endif

                                    <form action="{{route('customer.support.ticket.send.message')}}" method="post">
                                        @csrf
                                        <input type="hidden" value="{{$ticket_details->id}}" name="ticket_id">
                                        <input type="hidden" value="customer" name="user_type">
                                        <div class="form-group">
                                            <label for="">{{__('Message')}}</label>
                                            <textarea name="message" class="form-control" cols="30" rows="5"></textarea>
                                        </div>
                                        <div class="text-end">
                                            <button class="btn-primary btn btn-md mt-3" type="submit">{{__('Send Message')}}</button>
                                        </div>
                                    </form>
                                </div>
                                @else
                                <div class="reply-message-wrap ">
                                    <h5 class="title text-center m-0">{{__('The ticket is closed')}}</h5>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
</body>

</html>