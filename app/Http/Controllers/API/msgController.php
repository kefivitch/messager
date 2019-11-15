<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\User;
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
        $msgs = array();
        foreach ($messages as $message) {
            $msgObj = new \stdClass;
            $msgObj->read_at = $message->read_at;
            $msgObj->deleted_at = $message->deleted_at;
            $msgObj->is_seen = $message->is_seen;
            $msgObj->is_sender = $message->is_sender;
            $msgObj->body = $message->body;
            $msgObj->type = $message->type;
            $msgObj->created_at = $message->created_at;
            $msgs[$message->message_id] = $msgObj;
        }
        return $msgs ;
    }

}
