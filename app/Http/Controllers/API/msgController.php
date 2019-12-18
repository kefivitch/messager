<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use \Chat;
use Illuminate\Support\Facades\Crypt;
use Pusher\Pusher;
use App\Events\MyEvent;
use Illuminate\Support\Facades\Auth;

class msgController extends Controller
{
    public function allUsers()
    {
        return User::all();
    }
    function cmp($a, $b)
    {
        return !strcmp($a->conversation->last_message->created_at, $b->conversation->last_message->created_at);
    }
    public function getConversations($user_id)
    {
        $participantModel = User::findOrfail($user_id);
        $user_conversations = Chat::conversations()
            ->setParticipant($participantModel)
            ->setPaginationParams(['sorting' => 'asc'])
            ->get();
        //return $participantModel->participations();
        $convs = array();
        foreach ($user_conversations as $conversation ) {
            $conversationObj = new \stdClass;
            $conv = new \stdClass;
            $conversationObj->id = $conversation->conversation->id;
            $conversationObj->private = $conversation->conversation->private;
            $conversationObj->direct_message = $conversation->conversation->direct_message;
            $conversationObj->data = $conversation->conversation->data;
            $conversationObj->last_message = $conversation->conversation->last_message;
            $conversationObj->last_message->body = Crypt::decryptString($conversation->conversation->last_message->body);
            $conversationObj->updated_at = $conversation->conversation->updated_at;
            $conversationObj->diff = Carbon::parse($conversation->conversation->last_message->created_at)->diffForHumans();
            $conv->conversation = $conversationObj;
            $participations=  $conversation->conversation->getParticipants();
            //return $conversation->conversation;
            $particips = array();
            foreach ($participations as $participant ) {
                
                if($participant->id != $user_id) {
                    $particips[] = $participant;
                }
            }
            $conv->participants = $particips;

            $convs[$conversation->conversation->id] = $conv;
        }
        uasort($convs, array($this, "cmp"));
        
        return $convs;
        //return json_encode($convs["163"]->participants[0]->name) ;
    }

    public function getMessages($user_id,$conversation_id)
    {
        $participantModel = User::findOrfail($user_id);
        $conversation = Chat::conversations()->getById($conversation_id);
        $messages = Chat::conversation($conversation)->setParticipant($participantModel)
                                                        ->setPaginationParams(['sorting' => "desc"])
                                                        ->getMessages();
        //return $messages;
        $msgs = array();
        foreach ($messages as $message) {
            $msgObj = new \stdClass;
            $sender = new \stdClass;
            $msgObj->read_at = $message->read_at;
            $msgObj->deleted_at = $message->deleted_at;
            $msgObj->is_seen = $message->is_seen;
            if($user_id == $message->sender->id){
                $msgObj->is_sender = $message->is_sender;
            }
            else {
                $msgObj->is_sender = 0;
            }
            $msgObj->body = Crypt::decryptString($message->body);
            $msgObj->type = $message->type;
            $msgObj->created_at = $message->created_at;
            $sender->id =  $message->sender->id;
            $sender->name =  $message->sender->name;
            $sender->email =  $message->sender->email;
            $msgObj->sender = $sender;
            $msgObj->diff = Carbon::parse($message->created_at)->diffForHumans();
            $msgs[$message->message_id] = $msgObj;
        }
        return $msgs ;
    }

    public function readConversation($user_id,$conversation_id)
    {
        $participantModel = User::findOrfail($user_id);
        $conversation = Chat::conversations()->getById($conversation_id);
        Chat::conversation($conversation)->setParticipant($participantModel)->readAll();

    }
    
    public function sendMessage($user_id,$conversation_id,Request $request)
    {
        
        $participantModel = User::findOrfail($user_id);
        $conversation = Chat::conversations()->getById($conversation_id);
        if(strlen($request->data["message"])){
        $message = Chat::message(Crypt::encryptString($request->data["message"]))
            ->from($participantModel)
            ->to($conversation)
            ->send();
            event(new MyEvent('hello world'));
        }
        //return $message;
        

    }

    public function createConv(Request $request)
    {
        //return $request;
        $user = User::find($request->user_id);
        $conversation = Chat::createConversation(
            array(
                User::find($request->users[0]),
                User::find($request->user_id)
                )
            )->makePrivate();

        Chat::message(Crypt::encryptString($user->name.' wants to talk about '.$request->subject.' with you !'))
            ->from($user)
            ->to($conversation)
            ->send();

        Chat::message(Crypt::encryptString($request->message))
            ->from($user)
            ->to($conversation)
            ->send();
        return redirect('/inbox');
    }
}
