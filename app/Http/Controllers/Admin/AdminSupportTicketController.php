<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\BasicMail;
use App\Models\SupportTicket;
use App\Models\SupportTicketMessage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AdminSupportTicketController extends Controller
{
   private const BASE_PATH = 'admin.';

    public function all_tickets(){
        $all_tickets = SupportTicket::orderBy('id','desc')->get();
        return view(self::BASE_PATH .'all-tickets')->with([
            'all_tickets' => $all_tickets 
        ]);
    }

    public function status_change(Request $request){
        $request->validate([
            'status' => 'required|string|max:191'
        ]);
        SupportTicket::findOrFail($request->id)->update([
            'status' => $request->status,
        ]);

        if($request->status == "close"){
            //send mail
            $ticket = SupportTicket::find($request->id);
            $sub = __('Your support ticket has been closed');
            $message = 'Support Ticket Id: #' . $ticket->id;

            try {
                Mail::to($ticket->user->email)->send(new BasicMail($message, $sub));
            } catch (\Exception $e) {
                $e->getMessage();
            }
    
            $msg = 'Ticket has been closed successfully';
            return redirect()->back()->with(['msg' => $msg, 'type' => 'success']);
        }

        return response()->json('ok');
    }

    public function delete($id){
        SupportTicket::findOrFail($id)->delete();
        SupportTicketMessage::where(['support_ticket_id'=>$id])->delete();

        $msg = 'Ticket has been deleted successfully';
        return redirect()->back()->with(['msg' => $msg, 'type' => 'success']);
    }

    public function view(Request $request,$id){
        $ticket_details = SupportTicket::findOrFail($id);
        $all_ticket_messages = SupportTicketMessage::where(['support_ticket_id'=>$id])->get();
        return view(self::BASE_PATH.'view-ticket')->with([
            'ticket_details' => $ticket_details,
            'all_ticket_messages' => $all_ticket_messages,
        ]);
    }

    public function send_message(Request $request){
        $request->validate([
            'ticket_id' => 'required',
            'user_type' => 'required|string|max:191',
            'message' => 'required',
        ]);

        SupportTicketMessage::create([
            'support_ticket_id' => $request->ticket_id,
            'type' => $request->user_type,
            'user_id' => Auth::guard()->user()->id,
            'message' => $request->message,
        ]);

        return redirect()->back()->with(['msg' => __('Message Send Success'), 'type' => 'success']);
    }

}
