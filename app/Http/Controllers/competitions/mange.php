<?php

namespace App\Http\Controllers\competitions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Contest;
use App\Models\ContestUser;
use App\Models\Score;
use App\Models\Team;
use App\Models\ContestTeam;
use App\Models\TeamUser;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;

class mange extends Controller
{
    
    public function removecompetitor($name, $id)
    {
        $cname = str_replace("_", " ", $name);
        $contest = Contest::where('name', $cname)->where('status', '=', 1)->firstOrFail();
        if ($contest) {

            if (Gate::allows('OrganizerOrAdmin', $contest->id))
            {
                $user= User::find($id);

                if($user)
                {

                    //check if team or not
                    if($contest->participation == 'solo')
                    {
                        $this->RemovScore($contest->id, $user->id);
                        $this->RemovFromCompetition($contest->id, $user->id);

                        return redirect()->route('competition-manage-participants', ['name' => $name ])->with(session()->flash('alert-success', 'The competitor has been removed'));
                    }
                    else
                    {
                        $this->RemovScore($contest->id, $user->id);
                        $this->RemovFromCompetition($contest->id, $user->id);
                        $this->RemovFromTeamOrAllTeam($contest->id, $user->id , $user->username);

                        return redirect()->route('competition-manage-participants', ['name' => $name ])->with(session()->flash('alert-success', 'The competitor has been removed'));
                    }




                }else
        {abort(404);}



            }
            else
        {abort(404);}
        }
        else
        {abort(404);}
    }

    public function removeorganizers($name, $id)
    {
        $cname = str_replace("_", " ", $name);
        $contest = Contest::where('name', $cname)->where('status', '=', 1)->firstOrFail();
        if ($contest) {

            if (Gate::allows('AdminOrManger', $contest->id))
            {
                $user= User::find($id);

                if($user)
                {
                        $this->RemovFromCompetition($contest->id, $user->id);

                        return redirect()->route('competition-manage-organizers', ['name' => $name ])->with(session()->flash('alert-success', 'The organizer has been removed'));
                 
                }else
        {abort(404);}



            }
            else
        {abort(404);}
        }
        else
        {abort(404);}
    }

    public function registrationorganizers(Request $request){

        $this->validate($request, [
            'organizer.*.email' => ['required', 'string', 'email', 'max:255'],
            'contestid' => ['required'],
        ],
        [   
            'organizer.*.email.required'    => 'Please Provide Email Address',
            'organizer.*.email.string'      => 'Please Provide Email Address',
            'organizer.*.email.email' => 'Please Provide Email Address',
            'organizer.*.email.max:255'      => 'Email Address cant be more than 255 charcater',
        ]);
        

        //Check the permissions
        if(Gate::allows('AdminOrManger', $request->contestid))
        {
            
//Make sure of the competition
$contest = Contest::find($request->contestid);
        if ($contest) {
                //Check emails
                $dataSet = [];
                foreach ($request->organizer as $sup) {

                    $user = User::where('email' , $sup['email'])->first();
                    
                    
                    if(!is_null($user))
                    {
                        //check if sup before
                        if($this->IsNotOrganizer($contest->id , $user->id))
                    {
                        $dataSet[] = [
                            'user_id'  => $user->id,
                            'contest_id'    => $contest->id,
                            'role'       => 'organizer',
                            'created_at' =>  \Carbon\Carbon::now(), # new \Datetime()
                            'updated_at' => \Carbon\Carbon::now(),  # new \Datetime()
                        ];
                    }
                    else
                    {
                        return [
                            'status' => 402,
                            'description' => "There is an error, This email is ".$sup['email']." already registered in the competition",
                        ];

                    }
                        
                    }
                    else{
                        return [
                            'status' => 402,
                            'description' => "There is an error, make sure that this email ".$sup['email']." is linked to an account",
                        ];

                        
                    }
                    
                   
                }

                //All Done
                $saved = DB::table('contest_user')->insert($dataSet);
                if($saved)
                {
                return [
                    'status' => 200,
                    'description' => "Organizer have been successfully registered",
                ];}
                else
                {return [
                    'status' => 404,
                    'description' => "Something went wrong!!",
                ];}



            }
            else{ 
                return [
                    'status' => 404,
                    'description' => "Something went wrong!!",
                ];
            }

    }
    else
        {
            return [

                'status' => 401,
                'description' => "You do not have permission to add organizer",
            ];

        }
    
}


    public function RemovFromCompetition($compid , $userid){
        ContestUser::where('contest_id',$compid)->where('user_id',$userid)->delete();
       // $ContestUser->delete();
    }
    public function RemovScore($compid , $userid){
        Score::where('contest_id',$compid)->where('user_id',$userid)->delete();
    }
    public function RemovFromTeamOrAllTeam($compid , $userid , $username){
        //if leader

        $leader = FALSE ;
        $teamid = null;

        //get all team on comp
        $Contesteam = Contest::with('teams')->find($compid);

        foreach($Contesteam->teams as $team)
        {
            if($team->leader == $username )
            {$leader=True;
            $teamid = $team->id;}

        }

        if($leader)
        {

            ContestTeam::where("team_id" , $teamid)->delete();
            TeamUser::where("team_id" , $teamid)->delete();
            Team::find($teamid)->delete();

        }
        else{
            TeamUser::where("user_id" , $userid)->delete();
        }
        



    }

    public function IsNotOrganizer($id,$userid)
    {
        $contestuser = ContestUser::where('user_id' , $userid)->where('contest_id' , $id )->first();

        if(is_null($contestuser))
        return TRUE;
        else
        return FALSE;


    }


}