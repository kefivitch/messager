<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use \Chat;
use Faker\Factory as Faker;

class msgController extends Controller
{
    public function getInbox()
    {
        $Connecteduser = User::find(2)->first();
        $user = User::find(2);
        $other = User::find(1);
        //return $user->getParticipantDetails();
        $participants = [$user, $other];
        //return $participants;

        //$conversation = Chat::createConversation($participants)->makePrivate();
        //$conversation = Chat::conversations()->getById(5);
        /*$message = Chat::message('Hello from 2 to 1')
            ->from($user)
            ->to($conversation)
            ->send();*/
        //$conversation = Chat::conversations()->between($other, $user);
        /*$participantOneConversationIds = $conversation
            ->participantConversations($user, false)
            ->pluck('id');

        $participantTwoConversationIds = $conversation
            ->participantConversations($other, false)
            ->pluck('id');
        //return $participantOneConversationIds;
        $common = array_values(array_intersect($participantOneConversationIds->toArray(), $participantTwoConversationIds->toArray()));

        return $common ;*/
        //$allConversation = Chat::conversations()->allConversationsBetween($user, $other);
        //return $allConversation;   
        //$messages = Chat::conversation($conversation)->setParticipant($other)->getMessages();

        /*return Chat::conversation($conversation)
                    ->setParticipant($user)
                    ->unreadCount();*/

        /*$messages = Chat::conversation($conversation)
            ->setParticipant($user)
            ->getMessages()->sortBy('created_at');*/
        /*foreach ($messages as $message) {
            if($message->sender->id != Auth::user()->id) {
                echo '<br><p style="color:red;">' . $message->body . '</p><br>';
            }
            else {
                echo '<br>' . $message->body . '<br>';
            }
            
        }*/
        $faker = Faker::create('en_EN');
        $user = User::find(1);
        for ($i = 10; $i < 60; $i++) {
            $other = User::find($i);
            $participants = [$user, $other];
            $conversation = Chat::createConversation($participants)->makePrivate();

            $data = [
                'title' => $faker->text(10),
                'description' => $faker->text
            ];
            $conversation->update(['data' => $data]);
            //$conversations = Chat::conversations()->common($participants);
        }
        

    }
    public function sendMsg(Request $request)
    {
        $faker = Faker::create('en_EN');
        $user = User::findOrfail(1);
        $conversation = Chat::conversations()->getById(163);
        for ($i=0; $i <150; $i++) {
            $message = Chat::message($faker->text(10))
                ->from($user)
                ->to($conversation)
                ->send();
        }
        
    }

    public function testapi()
    {
        return view('testapi');
    }
}
