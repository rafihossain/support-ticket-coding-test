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

<body>
    <div class="container content_part_full">
    <div class="row justify-content-center">
        <div class="col-md-10 content_part mt-5">
            <div class="row custom_bread_part">
                <div class="col-md-12 bread">
                    <ul>
                        <li><a href="#"><i class="fa fa-home"></i> Support</a></li>
                        <li><a href="#"><i class="fa fa-angle-double-right"></i> Tickets</a></li>
                    </ul>
                </div>
            </div>

            @if(session()->has('msg'))
                <div class="alert alert-{{session('type')}}">
                    {!! session('msg') !!}
                </div>
            @endif

            <div class="row">
                <div class="col-md-12 main_content">
                    <form method="post" action="{{ route('customer.support.ticket.store') }}">
                        @csrf
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-8">
                                        <h4 class="card_header_title"><i class="fa fa-gg-circle"></i> Create New Support Ticket</h4>
                                    </div>
                                    <div class="col-md-4 text-right">
                                        <a class="btn btn-sm btn-dark card_top_btn" href="{{ route('customer.support.ticket.all') }}"><i class="fa fa-th"></i> View All Tickets</a>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label>{{__('Title')}}</label>
                                    <input type="text" class="form-control" name="title" placeholder="{{__('Title')}}">
                                </div>
                                <div class="form-group">
                                    <label>{{__('Subject')}}</label>
                                    <input type="text" class="form-control" name="subject" placeholder="{{__('Subject')}}">
                                </div>
                                <div class="form-group mt-4">
                                    <label class="label-title">{{__('Description')}}</label>
                                    <textarea name="description" class="form-control" cols="30" rows="10" placeholder="{{__('Description')}}"></textarea>
                                </div>


                            </div>
                            <div class="card-footer text-center">
                                <button type="submit" class="btn btn-sm btn-dark submit_btn">Submit</button>
                            </div>
                        </div>
                    </form>
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