<?php
namespace App\Traits;
use App\Models\User;
use App\Models\Friend;

    trait Friendable{

        public function add_friend($user_requested_id){
            if($this->id === $user_requested_id){
                return 0;
            }
            if($this->is_friends_with($user_requested_id) === 1){
                return 'Already Friends!';
            }
            if($this->has_pending_friend_request_sent_to($user_requested_id) === 1){
                return 'Already Sent a Friend Request';
            }
            if($this->has_pending_friend_request_from($user_requested_id)){
                return $this->accept_friend($user_requested_id);
            }
            $friendship= Friend::create([
                //'requester'=> $this->user_id,
                'requester'=> $this->id,
                'user_requested'=> $user_requested_id
            ]);

            if($friendship){
                return 1;
            }
            else{
                return 0;
            }
        }

        public function accept_friend($requester){
            if($this->has_pending_friend_request_from($requester) === 0){
                return 0;
            }
            else{
                $friendship= Friend::where('requester', $requester)
                    ->where('user_requested', $this->id)
                    ->first();

                if(isset($friendship) && !empty($friendship)){
                    $friendship->update([
                        'status' => 1
                    ]);
                    return 1;
                }
                else{
                    return 0;
                }
            }
        }

        public function deny_friend($requester){
            if($this->has_pending_friend_request_from($requester) === 0){
                return 0;
            }
            else{
                $friendship= Friend::where('requester', $requester)
                    ->where('user_requested', $this->id)
                    ->first();

                if(isset($friendship) && !empty($friendship)){
                    $friendship->delete();
                    return 1;
                }
                else{
                    return 0;
                }
            }
        }

        public function delete_friend($user_requested_id){
            if($this->id === $user_requested_id){
                return 0;
            }
            else{
                if($this->is_friends_with($user_requested_id) === 1){
                    $Freindship1= Friend::where('requester', $user_requested_id)
                        ->where('user_requested', $this->id)
                        ->first();
                    if($Freindship1){
                        $Freindship1->delete();
                    }
    
                    $Freindship2= Friend::where('user_requested', $user_requested_id)
                        ->where('requester', $this->id)
                        ->first();
                    if($Freindship2){
                        $Freindship2->delete();
                    }
                }
                else{
                    return 'Not Valid!';
                }
            }
        }

        public function friends(){
            $friends= array();
            $f1= Friend::where('status', 1)
                ->where('requester', $this->id)
                ->get();
                foreach($f1 as $friendship){
                    array_push($friends, User::find($friendship->user_requested));
                }

                $friends2= array();
                $f2= Friend::where('status', 1)
                    ->where('user_requested', $this->id)
                    ->get();
                foreach($f2 as $friendship){
                    array_push($friends2, User::find($friendship->requester));
                }

                return array_merge($friends, $friends2);
        }

        public function pending_friend_requests(){
            $users= array();
            $friendships= Friend::where('status', 0)
                ->where('user_requested', $this->id)
                ->get();

            if(isset($friendships) && !empty($friendships)){
                foreach($friendships as $friendship){
                    array_push($users, User::find($friendship->requester));
                }
            }
            else{
                $users=0;
            }

            return $users;
        }

        public function friends_ids(){
            return collect($this->friends())->pluck('id')->toArray();
        }

        public function is_friends_with($id){
            if(in_array($id, $this->friends_ids())){
                return 1;
            }
            else{
                return 0;
            }
        }

        public function pending_friend_requests_ids(){
            $result= collect($this->pending_friend_requests())->pluck('id')->toArray();
            return collect($this->pending_friend_requests())->pluck('id')->toArray();
        }

        public function pending_friend_requests_sent(){
            $users= array();
            $friendships= Friend::where('status', 0)
                ->where('requester', $this->id)
                ->get();

            foreach($friendships as $friendship){
                array_push($users, User::find($friendship->user_requested)->load('profile'));
            }
            return $users;
        }

        public function pending_friend_requests_sent_ids(){
            //$return = collect($this->pending_friend_requests())->pluck('id')->toArray();
            //$return = collect($this->pending_friend_requests_sent())->pluck('id')->toArray();
            return collect($this->pending_friend_requests_sent())->pluck('id')->toArray();
        }

        public function has_pending_friend_request_from($user_id){
            if(in_array($user_id, $this->pending_friend_requests_ids())){
                return 1;
            }
            else{
                return 0;
            }
        }

        public function has_pending_friend_request_sent_to($user_id){
            if(in_array($user_id, $this->pending_friend_requests_sent_ids())){
                return 1;
            }
            else{
                return 0;
            }
        }
    }
?>