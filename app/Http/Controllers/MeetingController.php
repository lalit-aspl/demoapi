<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\CheckMeetingSlot;
use App\Http\Resources\UserList;
use App\Http\Resources\MeetingStatus;
use App\Http\Resources\UpdateMeetingStatus;
use App\Models\Meeting;
use Validator;
use Auth;
use App\Models\User;
use App\Models\MeetingStatusModel;


class MeetingController extends Controller
{
    public function store(Request $request)
    {

        $slot = Meeting::where('meeting_time', strtotime($request->meeting_time))->where('user_id',1)->first();
        if(!empty($slot))
        {
            $request['meeting_time'] = '';
            $rules = ['meeting_time' => 'required','agenda' => 'required'];
            $messsages = array(
                'meeting_time.required'=>'Time Slot is not empty',          
            );
            
        }else{
            $rules = ['meeting_time' => 'required','agenda' => 'required'];
            $messsages = array(
                'meeting_time.required'=>'Time Slot is required',          
            );
        }

        $validator = Validator::make($request->all(), $rules,$messsages);
        if($validator->fails()){
            $errors = $validator->errors();
            //$er = implode(",", $errors->all());
            return $this->sendError($errors, [], 403);

        }else{
            $request['link'] = url('/meeting').'/'.uniqid();
            $request['user_id'] = 1;
            $request['meeting_time'] = strtotime($request->meeting_time);
            $data = Meeting::create($request->all());
            $meetingdata = Meeting::where('id', $data->id)->first();
            return (new CheckMeetingSlot($meetingdata));
        }
       
    }

    public function userList(){
      //  $data = User::where('id','!=',Auth::id())->get();
        $data = User::get();
        return (new UserList($data));
    }

    public function sendInvitation(Request $request){
       $user = MeetingStatusModel::where(['meeting_id' => $request->meeting_id, 'user_id' => $request->user_id])->first();
       if(!empty($user))
       {
        $msg = "Invitation already Send";
        return $this->sendError($msg, [], 200);
       }
       
       $invitation = MeetingStatusModel::create($request->all());
       $data       = MeetingStatusModel::where('meeting_id',$invitation->meeting_id)->where('user_id' , $request->user_id)->get();
        return (new MeetingStatus($data));
    }

    public function meetingstatus(Request $request)
    {
        MeetingStatusModel::where(['meeting_id' => $request->meeting_id,'user_id' => $request->user_id])->update($request->all());
        $data = MeetingStatusModel::where(['meeting_id' => $request->meeting_id,'user_id' => $request->user_id])->first();
        return (new UpdateMeetingStatus($data));
    }
}
