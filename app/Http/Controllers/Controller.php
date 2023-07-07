<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Branch;
use App\Models\User;
use App\Models\Loans;
use App\Models\OrderOuts;
use App\Models\Tasks;
use Illuminate\Support\Carbon;

use Illuminate\Support\Facades\Auth;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function adduser(Request $data){

        if(!empty($data['avatar'])){
            $file = $data->file('avatar');
            $file->move(base_path('\images'), $file->getClientOriginalName());
        }

        $data->validate([
            'first_name' => 'required|regex:/^[\pL\s\-]+$/u',
            'last_name' => 'required|regex:/^[\pL\s\-]+$/u',
            'branch' => 'required',
            'email' => 'required|email|unique:user,email',
            'password' => 'required|confirmed|min:8',
            'password_confirmation' => 'required|min:8',
            'userrole' => 'required',
        ],
        [
            'first_name.required' => 'First Name is required',
            'last_name.required' => 'Last Name is required',
            'branch.required' => 'Branch is required',
            'email.required' => 'Email Address is required',
            'email.email' => 'Please input a valid email address',
            'email.unique' => 'Email address: '.$data['email'].' already exist in the database. Please choose a different email',
            'password.required' => 'Password is required',
            'password_confirmation.required' => 'Confirm password is required',
            'userrole.required' => 'User Role is required'
        ]);

        User::AddUser($data);

        return redirect('/newuser')->with('message','User Successfully Added!');
    }

    public function addbranch(Request $data){

        $data->validate([
            'branchName' => 'required|unique:branch,branch_name|max:255',
            'addressName' => 'required',
            'contact_number' => 'required|numeric',
            'overdue_interval' => 'required|numeric',
        ],[
            'branchName.required' => 'Branch Name is required',
            'addressName.required' => 'Editress is required',
            'contact_number.required' => 'Contact Number is required',
            'branchName.unique' => 'Branch '.$data['branchName'].' already exist in the database.',
            'contact_number.numeric' => 'Contact Number should be numeric',
            'overdue_interval.required' => 'Overdue Interval is required',
            'overdue_interval.numeric' => 'Overdue Interval should be number',
        ]);

        Branch::AddBranch($data);

        return redirect('/newbranch')->with('message','Branch Successfully Added!');
    }

    public function branchedit($id){

        $data = Branch::where('id',$id)->first();

        return view('admin.branchedit', compact('data'));

    }

    public function editbranch(Request $data){

        $data->validate([
            'branchName' => 'required',
            'addressName' => 'required',
            'contact_number' => 'required|numeric',
        ],[
            'branchName.required' => 'Branch Name is required',
            'addressName.required' => 'Editress is required',
            'contact_number.required' => 'Contact Number is required',
            'contact_number.numeric' => 'Contact Number should be numeric'
        ]);

        Branch::EditBranch($data);

        return redirect('/branchlist')->with('message','Branch Successfully Edited!');
    }

    public function newuser(){

        if(session('user_type') != 0){
            return redirect('/dashboard');
        }
        else{
            $collection = Branch::all();
            return view('admin.newuser', compact('collection'));
        }
    }

    public function Edituser(Request $data){

      
            $data->validate([
                'first_name' => 'required|regex:/^[\pL\s\-]+$/u',
                'last_name' => 'required|regex:/^[\pL\s\-]+$/u',
                'email' => 'required|email',
                'branch' => 'required',
                'userrole' => 'required'
            ],
            [
                'first_name.required' => 'First Name is required',
                'last_name.required' => 'Last Name is required',
                'first_name.alpha' => 'First Name should be alphabets only',
                'last_name.alpha' => 'Last Name should be alphabets only',
                'email.required' => 'Email address is required',
                'email.email' => 'Please input a valid email Editress',
                'userrole.required' => 'User Role is required'
            ]);

            User::EditUser($data);

            return redirect('/userlist')->with('message','User Successfully Edited!');
        }
        
    public function branchlist(){

        $collection = Branch::all();
        return view('admin.branchlist', compact('collection'));

    }

    public function userlist(){

        $collection = DB::table('user')
                    ->join('branch', 'user.branch', '=', 'branch.id')
                    ->select('user.*', 'branch.branch_name')
                    ->where('user.user_type', '!=' , 0)
                    ->get();

        return view('admin.userlist', compact('collection'));
        
    }

    public function newloan(){

        $branches = Branch::all();

        $coordinators = DB::table('user')
                        ->select('*')
                        ->where('user_type', '=', 1)
                        ->get();
        
        $requestors = DB::table('user')
                        ->select('*')
                        ->where('user_type', '=', 2)
                        ->get();
        
        $tasks = Tasks::all();
        $orderouts = OrderOuts::all();

        return view('admin.newloan', compact('branches','coordinators','requestors','tasks','orderouts'));


    }


    public function RequestorAndCoordinator(Request $data){

        $result = DB::table('user')
                    ->select('*')
                    ->where('branch', '=', $data->branch)
                    ->where('user_type', '!=', 0)
                    ->get();

        return response()->json($result);
    }

    public function addloan (Request $data){

        $data->validate([
            'loannumber' => 'required|unique:loans,loan_number',
            'branch' => 'required',
            'borrower' => 'required',
            'requestor' => 'required',
            'coordinator' => 'required',
        ],
        [
            'loannumber.required' => 'Loan Number is required',
            'loannumber.unique' => 'Loan Number already exists',
            'branch.required' => 'Branch is required',
            'borrower.required' => 'Borrower name is required',
            'requestor.required' => 'Requestor is required',
            'coordinator.required' => 'Coordinator is required'
        ]);

        $loan_id = Loans::AddLoan($data);

        $tasks = ['scrub','filesetup','disclosure','appraisal','fastrackdisclosure','fastracksubmission'];
        $tasksNames = ['Scrub', 'File Setup' , 'Disclosure', 'Appraisal', 'FasTrack Disclosure', 'FasTrack Submission'];

        for($x = 0; $x < count($tasks); $x++){

            if(!empty($data[$tasks[$x].'start'])){

                $newtask = ([
                    'loanid' => $loan_id,
                    'task_name' => $tasksNames[$x],
                    'start' => $data[$tasks[$x].'start'],
                    'end' => $data[$tasks[$x].'end']
                ]);

                Tasks::newtask($newtask);
            }
        }

        $orderOuts = ['eoi','master','flood','mortgage','collection','credit','vvoe','wvoeb1','wvoeb2','wvoeb3','wvoecb1','wvoecb2','wvoecb3','tax','pest','vom','titledocs'];

        $orderOuts_names = ['EOI','Master Insurance','Flood Insurance','Mortgage Payoff','Collection Payoff','Credit Supplement','VVOE','WVOE Borrower 1','WVOE Borrower 2','WVOE Borrower 3','WVOE Co-borrower 1','WVOE Co-borrower 2','WVOE Co-borrower 3','Tax Transcript','Pest Inspection','24 Payment-VOM','Title Docs'];

        for($i = 0; $i < count($orderOuts); $i++){

            if(!empty($data[$orderOuts[$i].'first']) || !empty($data[$orderOuts[$i].'second']) || !empty($data[$orderOuts[$i].'third'])){
                
                $newOrderOut = ([
                    'loan' => $loan_id,
                    'orderouts_name' => $orderOuts_names[$i],
                    'first' => $data[$orderOuts[$i].'first'],
                    'second' => $data[$orderOuts[$i].'second'],
                    'third' => $data[$orderOuts[$i].'third'],
                    'status' => $data[$orderOuts[$i].'status'],
                    'remarks' => $data[$orderOuts[$i].'remarks']
                ]);

                OrderOuts::neworderout($newOrderOut);
            }
        }


        return redirect('/newloan')->with('message','Loan Successfully Added!');
    }

    public function loanlist(){

        $loans = DB::table('loans')
                    ->join('branch', 'loans.branch', '=', 'branch.id')
                    ->join('user', 'loans.requestor', '=', 'user.id')
                    ->select('user.*', 'branch.*', 'loans.*')
                    ->get();

        $coordinators = array();

        #Some loans have multiple coordinators, block of code below explodes the loan coordinator and gets the user information of that coordinator. It is stored in an array.
        foreach($loans as $loan){

            $temp = array();
            $loan_coordinators = explode(',', $loan->loan_coordinator);

            for($x = 0; $x < count($loan_coordinators); $x++){
                $temp_coord = DB::table('user')
                                    ->select('*')
                                    ->where('id', '=', $loan_coordinators[$x])
                                    ->first();
                array_push($temp, $temp_coord->first_name." ".$temp_coord->last_name);
            }

            $coord = implode(', ',$temp);

            array_push($coordinators, $coord);

        }
        
        return view('admin.loanlist', compact('loans','coordinators'));
    }

    public function loaninformation($id){

        $loan = DB::table('loans')
                    ->select('*')
                    ->where('id', '=', $id)
                    ->first();

        $branches = Branch::all();
        $requestors = DB::table('user')
                        ->select('*')
                        ->where('branch', '=', $loan->branch)
                        ->where('user_type', '=', 2)
                        ->get();

        $loancoordinators = DB::table('user')
                        ->select('*')
                        ->where('branch', '=', $loan->branch)
                        ->where('user_type', '=', 1)
                        ->get();

        $tasks = Tasks::where('loan',$id)->get();
        $orderouts = OrderOuts::where('loan',$id)->get();

        
        return view('admin.loaninfo', compact('loan','loancoordinators','requestors','branches','tasks','orderouts'));
    }

    public function loanedit(Request $data){

        $data->validate([
            'loannumber' => 'required',
            'branch' => 'required',
            'borrower' => 'required',
            'requestor' => 'required',
            'coordinator' => 'required',
        ],
        [
            'loannumber.required' => 'Loan Number is required',
            'branch.required' => 'Branch is required',
            'borrower.required' => 'Borrower name is required',
            'requestor.required' => 'Requestor is required',
            'coordinator.required' => 'Coordinator is required'
        ]);

        Loans::EditLoan($data);

        $loan_id = $data['loanid'];

        $tasks = ['scrub','filesetup','disclosure','appraisal','fastrackdisclosure','fastracksubmission'];
        $tasksNames = ['Scrub', 'File Setup' , 'Disclosure', 'Appraisal', 'FasTrack Disclosure', 'FasTrack Submission'];

        for($x = 0; $x < count($tasks); $x++){

            if(!empty($data[$tasks[$x].'start'])){

                $newtask = ([
                    'loanid' => $loan_id,
                    'task_name' => $tasksNames[$x],
                    'start' => $data[$tasks[$x].'start'],
                    'end' => $data[$tasks[$x].'end']
                ]);

                Tasks::updateorcreatetask($newtask);
            }
        }

        $orderOuts = ['eoi','master','flood','mortgage','collection','credit','vvoe','wvoeb1','wvoeb2','wvoeb3','wvoecb1','wvoecb2','wvoecb3','tax','pest','vom','titledocs'];

        $orderOuts_names = ['EOI','Master Insurance','Flood Insurance','Mortgage Payoff','Collection Payoff','Credit Supplement','VVOE','WVOE Borrower 1','WVOE Borrower 2','WVOE Borrower 3','WVOE Co-borrower 1','WVOE Co-borrower 2','WVOE Co-borrower 3','Tax Transcript','Pest Inspection','24 Payment-VOM','Title Docs'];

        for($i = 0; $i < count($orderOuts); $i++){

            if(!empty($data[$orderOuts[$i].'first']) || !empty($data[$orderOuts[$i].'second']) || !empty($data[$orderOuts[$i].'third'])){
                
                $newOrderOut = ([
                    'loan' => $loan_id,
                    'orderouts_name' => $orderOuts_names[$i],
                    'first' => $data[$orderOuts[$i].'first'],
                    'second' => $data[$orderOuts[$i].'second'],
                    'third' => $data[$orderOuts[$i].'third'],
                    'status' => $data[$orderOuts[$i].'status'],
                    'remarks' => $data[$orderOuts[$i].'remarks']
                ]);

                OrderOuts::updateorcreateorderout($newOrderOut);
            }
        }


        return redirect('/loaninformation/'.$data['loanid'])->with('message','Loan Successfully Edited!');

    }

    public function deleteuser(Request $data){

        User::DeleteUser($data);
        return response()->json($data);
        
    }

    public function deletebranch(Request $data){

        Branch::DeleteBranch($data);
        return response()->json($data);
        
    }

    public function logout(Request $data){

        auth()->logout();

        $data->session()->invalidate();
        $data->session()->regenerateToken();

        return redirect('/')->with('message', 'Logout Successful');
    }

    public function login(Request $data){

        if (Auth::attempt(['email' => $data['email'], 'password' => $data['password'], 'status' => 1])) {
            $data->session()->regenerate();
            

            $request = User::where('email',$data['email'])->first();
            $data->session()->put('user_type', $request->user_type);

            return redirect('/dashboard')->with('message', 'Welcome!');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');


    }

    public function useredit($id){

        $data = User::where('id',$id)->first();
        $branches = Branch::all();

        return view('admin.useredit', compact('data','branches'));

    }

    public function dashboard(){

        $users = DB::table('user')->count();
        $loans = DB::table('loans')->count();
        $branches = DB::table('branch')->count();
        $overduetasks = DB::table('tasks')
                            ->join('loans', 'tasks.loan', '=', 'loans.id')
                            ->join('branch', 'loans.branch', '=', 'branch.id')
                            ->select('tasks.*', 'branch.branch_name','branch.overdue_interval', 'loans.*')
                            ->whereRaw("DATEDIFF(NOW(), start) >= `overdue_interval`")
                            ->whereNull('tasks.end')
                            ->count();
        $overdueorderouts = DB::table('orderouts')
                    ->join('loans', 'orderouts.loan', '=', 'loans.id')
                    ->join('branch', 'loans.branch', '=', 'branch.id')
                    ->select('orderouts.*', 'branch.branch_name','branch.overdue_interval', 'loans.*')
                    ->whereRaw(
                        "CASE
                            WHEN third IS NOT NULL THEN DATEDIFF(NOW(), third) >= `overdue_interval`
                            WHEN second IS NOT NULL THEN DATEDIFF(NOW(), second) >= `overdue_interval`
                            ELSE DATEDIFF(NOW(), first) >= `overdue_interval`
                        END
                        "
                    )
                    ->where('status', '!=', 'Completed')
                    ->count();

        $data = ([
            'users' => $users,
            'loans' => $loans,
            'branches' => $branches,
            'overduetasks' => $overduetasks,
            'overdueorderouts' => $overdueorderouts
        ]);

        return view('admin.dashboard', compact('data'));
    }

    public function overduetasks(){

        $data = DB::table('tasks')
                    ->join('loans', 'tasks.loan', '=', 'loans.id')
                    ->join('branch', 'loans.branch', '=', 'branch.id')
                    ->select('tasks.*', 'branch.branch_name','branch.overdue_interval', 'loans.*')
                    ->whereRaw("DATEDIFF(NOW(), start) >= `overdue_interval`")
                    ->whereNull('tasks.end')
                    ->get();
        
        $users = User::all();

        $loancoordinators = [];
        $coordinatorslist = [];
        $coordinatorname = "";

        foreach($data as $coordinators){
            array_push($loancoordinators,$coordinators->loan_coordinator);
        }

        for($x = 0; $x < count($loancoordinators); $x++){

            $loan_coordinators = explode(',', $loancoordinators[$x]);

            for($i = 0; $i < count($loan_coordinators); $i++){
                foreach($users as $user){
                    if($user->id == $loan_coordinators[$i]){
                        if($i == 0){
                            $coordinatorname = $user->first_name." ".$user->last_name;
                            // array_push($coordinatorslist,$user->first_name." ".$user->last_name);
                        }
                        else{
                            $coordinatorname = $coordinatorname.", ".$user->first_name." ".$user->last_name;
                        }
                    }
                }
                
            }
            array_push($coordinatorslist,$coordinatorname);
        }

        return view('admin.overduetasks', compact('data','coordinatorslist','users'));
    }


    public function overdueorderouts(){

        $data = DB::table('orderouts')
                    ->join('loans', 'orderouts.loan', '=', 'loans.id')
                    ->join('branch', 'loans.branch', '=', 'branch.id')
                    ->select('orderouts.*', 'branch.branch_name','branch.overdue_interval', 'loans.*')
                    ->whereRaw(
                        "CASE
                            WHEN third IS NOT NULL THEN DATEDIFF(NOW(), third) >= `overdue_interval`
                            WHEN second IS NOT NULL THEN DATEDIFF(NOW(), second) >= `overdue_interval`
                            ELSE DATEDIFF(NOW(), first) >= `overdue_interval`
                        END
                        "
                    )
                    ->where('status', '!=', 'Completed')
                    ->get();

        $users = User::all();

        $loancoordinators = [];
        $coordinatorslist = [];
        $coordinatorname = "";
            
        foreach($data as $coordinators){
            array_push($loancoordinators,$coordinators->loan_coordinator);
        }

        for($x = 0; $x < count($loancoordinators); $x++){

            $loan_coordinators = explode(',', $loancoordinators[$x]);

            for($i = 0; $i < count($loan_coordinators); $i++){
                foreach($users as $user){
                    if($user->id == $loan_coordinators[$i]){
                        if($i == 0){
                            $coordinatorname = $user->first_name." ".$user->last_name;
                            // array_push($coordinatorslist,$user->first_name." ".$user->last_name);
                        }
                        else{
                            $coordinatorname = $coordinatorname.", ".$user->first_name." ".$user->last_name;
                        }
                    }
                }
                
            }
            array_push($coordinatorslist,$coordinatorname);
        }

        return view('admin.overdueorderouts', compact('data','coordinatorslist','users'));

    }

    public function reports(){

        $data = Branch::all();

        $test = DB::table('tasks')
                    ->select('*')
                    ->whereMonth('end', '=' , '07')
                    ->get();

        return view('admin.reports',compact('data'));
    }

    public function branchandtasksmonthly(Request $data){

        $scrub = $filesetup = $disclosure = $appraisal = $fastrackdisclosure = $fastracksubmission = 0;

        $test = DB::table('tasks')
                ->join('loans','loans.id', '=', 'tasks.loan')
                ->join('branch','branch.id', '=', 'loans.branch')
                ->select('tasks.*','loans.*','branch.*')
                ->where('loans.branch', '=', $data->branch)
                ->whereMonth('end', '=' , $data->month)
                ->get();
        
        $finalresult = [];
        
        foreach($test as $results){
            switch($results->task_name){
                case('Scrub'):
                    $scrub = $scrub + 1;
                break;

                case('Appraisal'):
                    $appraisal = $appraisal + 1;
                break;

                case('File Setup'):
                    $filesetup = $filesetup + 1;
                break;

                case('Disclosure'):
                    $disclosure = $disclosure + 1;
                break;

                case('FasTrack Disclosure'):
                    $fastrackdisclosure = $fastrackdisclosure + 1;
                break;

                case('FasTrack Submission'):
                    $fastracksubmission = $fastracksubmission + 1;
                break;
            }
        }


        array_push($finalresult,$scrub);
        array_push($finalresult,$disclosure);
        array_push($finalresult,$filesetup);
        array_push($finalresult,$appraisal);
        array_push($finalresult,$fastrackdisclosure);
        array_push($finalresult,$fastracksubmission);

        return response()->json($finalresult);
    }

    
}
