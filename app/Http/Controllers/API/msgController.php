<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use \Chat;
class msgController extends Controller
{
    public function allUsers()
    {
        return User::all();
    }

    public function getConversations($user_id)
    {
        $participantModel = User::findOrfail($user_id);
        $user_conversations = Chat::conversations()
            ->setParticipant($participantModel)
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
            $conversationObj->updated_at = $conversation->conversation->updated_at;
            $conversationObj->diff = Carbon::parse($conversation->conversation->last_message->created_at)->diffForHumans();
            $conv->conversation = $conversationObj;
            $participations=  $conversation->conversation->getParticipants();
            //return $conversation->conversation;
            foreach ($participations as $participant ) {
                $particips = array();
                if($participant != $user_id) {
                    $particips[] = $participant;
                }
            }
            $conv->participants = $particips;

            $convs[$conversation->conversation->id] = $conv;
        }
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
            $msgObj->body = $message->body;
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
    
}
