<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Mail\BasicMail;
use App\Models\SupportTicket;
use App\Models\SupportTicketMessage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class CustomerSupportTicketController extends Controller
{
   private const BASE_PATH = 'customer.';

    public function support_tickets(){
        $all_tickets = SupportTicket::where('user_id', Auth::user()->id)->orderBy('id','desc')->get();
        return view(self::BASE_PATH .'support-tickets')->with(['all_tickets' => $all_tickets ]);
    }

    public function new_ticket(){
        $all_users = User::all();
        return view(self::BASE_PATH.'new-ticket');
    }

    public function store_ticket(Request $request){
        $this->validate($request,[
            'title' => 'required|string|max:191',
            'subject' => 'required|string|max:191',
            'description' => 'required|string',
        ],[
            'title.required' => __('title required'),
            'subject.required' =>  __('subject required'),
            'description.required' => __('description required'),
        ]);

        SupportTicket::create([
            'title' => $request->title,
            'description' => $request->description,
            'subject' => $request->subject,
            'status' => 'open',
            'user_id' => Auth::guard()->user()->id,
        ]);

        $lastSupportTicketId = DB::getPdo()->lastInsertId();
        //send mail
        $sub = __('New Support Ticket');
        $message = 'Support Ticket Id: #' . $lastSupportTicketId;

        try {
            Mail::to('admin@gmail.com')->send(new BasicMail($message, $sub));
        } catch (\Exception $e) {
            $e->getMessage();
            dd($e->getMessage());
        }

        $msg = 'thanks for contact us, we will reply soon';
        return redirect()->back()->with(['msg' => $msg, 'type' => 'success']);
    }

    public function status_change(Request $request){
        $request->validate([
            'status' => 'required|string|max:191'
        ]);
        SupportTicket::findOrFail($request->id)->update([
            'status' => $request->status,
        ]);
        return response()->json('ok');
    }

    public function support_ticket_view(Request $request,$id){
        $ticket_details = SupportTicket::findOrFail($id);
        $all_messages = SupportTicketMessage::where(['support_ticket_id'=>$id])->get();
        return view(self::BASE_PATH.'view-ticket')->with([
            'ticket_details' => $ticket_details,
            'all_messages' => $all_messages,
        ]);
    }

    public function send_message(Request $request){
        $request->validate([
            'ticket_id' => 'required',
            'user_type' => 'required|string|max:191',
            'message' => 'required',
        ]);

        $ticket_info = SupportTicketMessage::create([
            'support_ticket_id' => $request->ticket_id,
            'type' => $request->user_type,
            'user_id' => Auth::guard()->user()->id,
            'message' => $request->message,
        ]);

        return redirect()->back()->with(['msg' => __('Message Send Success'), 'type' => 'success']);
    }
}
