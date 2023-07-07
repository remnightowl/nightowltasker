@include('admin/header')
@include('admin/navbar')

<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">
                <div class="page-header">
                    <div class="row align-items-end">
                        <div class="col-lg-8">
                            <div class="page-header-title">
                                <div class="d-inline">
                                    <h4>Edit Loan Information</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="page-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-block">
                                    <h4 class="sub-title">Loan Information</h4>
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <form method="POST" id="editloanform" action="/loanedit">
                                        @csrf
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Loan Number</label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" name="loannumber" value="{{$loan->loan_number}}">
                                                <input type="hidden" class="form-control" name="loanid" value="{{$loan->id}}">
                                            </div>
                                            <label class="col-sm-2 col-form-label">Branch</label>
                                            <div class="col-sm-4">

                                                <?php 
                                                    
                                                $coordinators = explode(",", $loan->loan_coordinator)
                                                    
                                                ?>
                                                <select name="branch" id="branch" class="form-control" >   
                                                    @foreach($branches as $branch)
                                                        <option @if($branch->id == $loan->branch) selected @endif value="{{$branch->id}}">{{$branch->branch_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Requestor</label>
                                            <div class="col-sm-4">
                                                <select name="requestor" id="requestor" class="form-control">
                                                    @foreach($requestors as $requestor)
                                                        <option @if($requestor->id == $loan->requestor) selected @endif value="{{$requestor->id}}">{{$requestor->first_name}} {{$requestor->first_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <label class="col-sm-2 col-form-label">Assigned Loan Coordinator</label>
                                            <div class="col-sm-4">
                                                <select class="js-example-basic-multiple col-sm-12 select2-hidden-accessible" name="coordinator[]" id="coordinator" multiple="" tabindex="-1" aria-hidden="true">
                                                    @foreach($loancoordinators as $loancoordinator)
                                                        <option value="{{$loancoordinator->id}}" @for($x=0; $x < count($coordinators); $x++) @if($loancoordinator->id == $coordinators[$x]) selected @endif @endfor>{{$loancoordinator->first_name}} {{$loancoordinator->last_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Borrower's Name</label>
                                            <div class="col-sm-4">
                                                <input type="text" name="borrower" value="{{$loan->borrower}}" class="form-control">
                                            </div>
                                            <label class="col-sm-2 col-form-label">Remarks</label>
                                            <div class="col-sm-4">
                                                <div class="input-group">
                                                    <textarea rows="2" cols="5" name="loanremarks" class="form-control" placeholder="Remarks">{{$loan->remarks}}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <div class="form-group row">
                                                    @php
                                                       $start = ""; 
                                                       $end = ""; 
                                                    @endphp
                                                    @foreach ($tasks as $task)
                                                        @if ($task->task_name == "Scrub")
                                                            @php
                                                                $start = $task->start;
                                                                $end = $task->end;
                                                            @endphp
                                                        @endif
                                                    @endforeach
                                                    <label class="col-lg-2 col-md-8 col-sm-2 col-form-label">Scrub</label>
                                                    <div class="col-lg-2 col-md-8 col-sm-10">
                                                        <button class="btn btn-md btn-success btn-round" id="scrubstart" style="padding: 10px 40px;" type="button">START</button>
                                                    </div>
                                                    <div class="col-lg-3 col-md-12 col-sm-10">
                                                        <input type="datetime-local" name="scrubstart" value="{{ $start }}" id="datetimescrubstart" class="form-control">
                                                    </div>
                                                    <div class="col-lg-2 col-md-8 col-sm-10">
                                                        <button class="btn btn-md btn-danger btn-round" id="scrubend" style="padding: 10px 40px;" type="button">END</button>
                                                    </div>
                                                    <div class="col-lg-3 col-md-12 col-sm-10">
                                                        <input type="datetime-local" name="scrubend" value="{{ $end }}" id="datetimescrubend" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group row">
                                                    @php
                                                       $start = ""; 
                                                       $end = ""; 
                                                    @endphp
                                                    @foreach ($tasks as $task)
                                                        @if ($task->task_name == "File Setup")
                                                            @php
                                                                $start = $task->start;
                                                                $end = $task->end;
                                                            @endphp
                                                        @endif
                                                    @endforeach
                                                    <label class="col-lg-2 col-md-8 col-sm-2 col-form-label">File Setup</label>
                                                    <div class="col-lg-2 col-md-8 col-sm-10">
                                                        <button class="btn btn-md btn-success btn-round" id="filesetupstart" style="padding: 10px 40px;" type="button">START</button>
                                                    </div>
                                                    <div class="col-lg-3 col-md-12 col-sm-10">
                                                        <input type="datetime-local" name="filesetupstart" value="{{ $start }}" id="datetimefilesetupstart" class="form-control">
                                                    </div>
                                                    <div class="col-lg-2 col-md-8 col-sm-10">
                                                        <button class="btn btn-md btn-danger btn-round" id="filesetupend" style="padding: 10px 40px;" type="button">END</button>
                                                    </div>
                                                    <div class="col-lg-3 col-md-12 col-sm-10">
                                                        <input type="datetime-local" name="filesetupend" id="datetimefilesetupend" value="{{ $end }}"  class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <div class="form-group row">
                                                    @php
                                                       $start = ""; 
                                                       $end = ""; 
                                                    @endphp
                                                    @foreach ($tasks as $task)
                                                        @if ($task->task_name == "Disclosure")
                                                            @php
                                                                $start = $task->start;
                                                                $end = $task->end;
                                                            @endphp
                                                        @endif
                                                    @endforeach
                                                    <label class="col-lg-2 col-md-8 col-sm-2 col-form-label">Disclosure</label>
                                                    <div class="col-lg-2 col-md-8 col-sm-10">
                                                        <button class="btn btn-md btn-success btn-round" id="disclosurestart" style="padding: 10px 40px;" type="button">START</button>
                                                    </div>
                                                    <div class="col-lg-3 col-md-12 col-sm-10">
                                                        <input type="datetime-local" name="disclosurestart" id="datetimedisclosurestart" value="{{ $start }}" class="form-control">
                                                    </div>
                                                    <div class="col-lg-2 col-md-8 col-sm-10">
                                                        <button class="btn btn-md btn-danger btn-round" id="disclosureend" style="padding: 10px 40px;" type="button">END</button>
                                                    </div>
                                                    <div class="col-lg-3 col-md-12 col-sm-10">
                                                        <input type="datetime-local" name="disclosureend" id="datetimedisclosureend" value="{{ $end }}" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group row">
                                                    @php
                                                       $start = ""; 
                                                       $end = ""; 
                                                    @endphp
                                                    @foreach ($tasks as $task)
                                                        @if ($task->task_name == "Appraisal")
                                                            @php
                                                                $start = $task->start;
                                                                $end = $task->end;
                                                            @endphp
                                                        @endif
                                                    @endforeach
                                                    <label class="col-lg-2 col-md-8 col-sm-2 col-form-label">Appraisal</label>
                                                    <div class="col-lg-2 col-md-8 col-sm-10">
                                                        <button class="btn btn-md btn-success btn-round" id="appraisalstart" style="padding: 10px 40px;" type="button">START</button>
                                                    </div>
                                                    <div class="col-lg-3 col-md-12 col-sm-10">
                                                        <input type="datetime-local" name="appraisalstart" id="datetimeappraisalstart" value="{{ $start }}" class="form-control">
                                                    </div>
                                                    <div class="col-lg-2 col-md-8 col-sm-10">
                                                        <button class="btn btn-md btn-danger btn-round" id="appraisalend" style="padding: 10px 40px;" type="button">END</button>
                                                    </div>
                                                    <div class="col-lg-3 col-md-12 col-sm-10">
                                                        <input type="datetime-local" name="appraisalend" id="datetimeappraisalend" value="{{ $end }}" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <div class="form-group row">
                                                    @php
                                                       $start = ""; 
                                                       $end = ""; 
                                                    @endphp
                                                    @foreach ($tasks as $task)
                                                        @if ($task->task_name == "FasTrack Disclosure")
                                                            @php
                                                                $start = $task->start;
                                                                $end = $task->end;
                                                            @endphp
                                                        @endif
                                                    @endforeach
                                                    <label class="col-lg-2 col-md-8 col-sm-2 col-form-label">FasTrack Disclosure</label>
                                                    <div class="col-lg-2 col-md-8 col-sm-10">
                                                        <button class="btn btn-md btn-success btn-round" id="fastrackdisclosurestart" style="padding: 10px 40px;" type="button">START</button>
                                                    </div>
                                                    <div class="col-lg-3 col-md-12 col-sm-10">
                                                        <input type="datetime-local" name="fastractdisclosurestart" id="datetimeftdisclosurestart" value="{{ $start }}" class="form-control">
                                                    </div>
                                                    <div class="col-lg-2 col-md-8 col-sm-10">
                                                        <button class="btn btn-md btn-danger btn-round" id="fastrackdisclosureend" style="padding: 10px 40px;" type="button">END</button>
                                                    </div>
                                                    <div class="col-lg-3 col-md-12 col-sm-10">
                                                        <input type="datetime-local" name="fastractdisclosureend" id="datetimeftdisclosureend" value="{{ $end }}" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group row">
                                                    @php
                                                       $start = ""; 
                                                       $end = ""; 
                                                    @endphp
                                                    @foreach ($tasks as $task)
                                                        @if ($task->task_name == "FasTrack Submission")
                                                            @php
                                                                $start = $task->start;
                                                                $end = $task->end;
                                                            @endphp
                                                        @endif
                                                    @endforeach
                                                    <label class="col-lg-2 col-md-8 col-sm-2 col-form-label">FasTrack Submission</label>
                                                    <div class="col-lg-2 col-md-8 col-sm-10">
                                                        <button class="btn btn-md btn-success btn-round" id="fastracksubmissionstart" style="padding: 10px 40px;" type="button">START</button>
                                                    </div>
                                                    <div class="col-lg-3 col-md-12 col-sm-10">
                                                        <input type="datetime-local" name="fastractsubmissionstart" id="datetimeftsubmissionstart" value="{{ $start }}" class="form-control">
                                                    </div>
                                                    <div class="col-lg-2 col-md-8 col-sm-10">
                                                        <button class="btn btn-md btn-danger btn-round" id="fastracksubmissionend" style="padding: 10px 40px;" type="button">END</button>
                                                    </div>
                                                    <div class="col-lg-3 col-md-12 col-sm-10">
                                                        <input type="datetime-local" name="fastractsubmissionend" id="datetimeftsubmissionend" value="{{ $end }}" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                @php
                                                    $first = ""; 
                                                    $second = ""; 
                                                    $third = ""; 
                                                    $status = ""; 
                                                    $remarks = "";
                                                @endphp
                                                @foreach ($orderouts as $orderout)
                                                    @if ($orderout->orderouts_name == "EOI")
                                                        @php
                                                            $first = $orderout->first; 
                                                            $second = $orderout->second;
                                                            $third = $orderout->third;
                                                            $status = $orderout->status;
                                                            $remarks = $orderout->remarks;
                                                        @endphp
                                                    @endif
                                                @endforeach
                                                <label class=" col-form-label">EOI</label>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <span class="input-group-addon" id="basic-addon1">1st</span>
                                                                <input type="datetime-local" name="eoifirst" value="{{ $first }}" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <span class="input-group-addon" id="basic-addon1">2nd</span>
                                                                <input type="datetime-local" name="eoisecond" value="{{ $second }}" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <span class="input-group-addon" id="basic-addon1">3rd</span>
                                                                <input type="datetime-local" name="eoithird" value="{{ $third }}" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <select name="eoistatus" class="form-control">
                                                                    <option value="" disabled selected>Please select status here</option>
                                                                    <option value="Completed" @if($status == 'Completed') selected @endif>Completed</option>
                                                                    <option value="Ordered" @if($status == 'Ordered') selected @endif>Ordered</option>
                                                                    <option value="Pending" @if($status == 'Pending') selected @endif>Pending</option>
                                                                    <option value="Waiting on Processor" @if($status == 'Waiting on Processor') selected @endif>Waiting on Processor</option>
                                                                    <option value="Waiting on Borrower" @if($status == 'Waiting on Borrower') selected @endif>Waiting on Borrower</option>
                                                                    <option value="Cancelled" @if($status == 'Cancelled') selected @endif>Cancelled</option>
                                                                    <option value="Withdrawn" @if($status == 'Withdrawn') selected @endif> Withdrawn</option>
                                                                    <option value="Closing Stage" @if($status == 'Closing Stage') selected @endif>Closing Stage</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="input-group">
                                                                <div class="input-group">
                                                                    <textarea rows="2" cols="5" name="eoiremarks" class="form-control" placeholder="Remarks">{{ $remarks }}</textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                @php
                                                    $first = ""; 
                                                    $second = ""; 
                                                    $third = ""; 
                                                    $status = ""; 
                                                    $remarks = "";
                                                @endphp
                                                @foreach ($orderouts as $orderout)
                                                    @if ($orderout->orderouts_name == "Master Insurance")
                                                        @php
                                                            $first = $orderout->first; 
                                                            $second = $orderout->second;
                                                            $third = $orderout->third;
                                                            $status = $orderout->status;
                                                            $remarks = $orderout->remarks;
                                                        @endphp
                                                    @endif
                                                @endforeach
                                                <label class=" col-form-label">Master Insurance</label>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <span class="input-group-addon" id="basic-addon1">1st</span>
                                                                <input type="datetime-local" name="masterfirst" value="{{ $first }}" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <span class="input-group-addon" id="basic-addon1">2nd</span>
                                                                <input type="datetime-local" name="mastersecond" value="{{ $second }}" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <span class="input-group-addon" id="basic-addon1">3rd</span>
                                                                <input type="datetime-local" name="masterthird" value="{{ $third }}" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <select name="masterstatus" class="form-control">
                                                                    <option value="" disabled selected>Please select status here</option>
                                                                    <option value="Completed" @if($status == 'Completed') selected @endif>Completed</option>
                                                                    <option value="Ordered" @if($status == 'Ordered') selected @endif>Ordered</option>
                                                                    <option value="Pending" @if($status == 'Pending') selected @endif>Pending</option>
                                                                    <option value="Waiting on Processor" @if($status == 'Waiting on Processor') selected @endif>Waiting on Processor</option>
                                                                    <option value="Waiting on Borrower" @if($status == 'Waiting on Borrower') selected @endif>Waiting on Borrower</option>
                                                                    <option value="Cancelled" @if($status == 'Cancelled') selected @endif>Cancelled</option>
                                                                    <option value="Withdrawn" @if($status == 'Withdrawn') selected @endif> Withdrawn</option>
                                                                    <option value="Closing Stage" @if($status == 'Closing Stage') selected @endif>Closing Stage</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="input-group">
                                                                <div class="input-group">
                                                                    <textarea rows="2" cols="5" name="masterremarks" class="form-control" placeholder="Remarks">{{ $remarks }}</textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                @php
                                                    $first = ""; 
                                                    $second = ""; 
                                                    $third = ""; 
                                                    $status = ""; 
                                                    $remarks = "";
                                                @endphp
                                                @foreach ($orderouts as $orderout)
                                                    @if ($orderout->orderouts_name == "Flood Insurance")
                                                        @php
                                                            $first = $orderout->first; 
                                                            $second = $orderout->second;
                                                            $third = $orderout->third;
                                                            $status = $orderout->status;
                                                            $remarks = $orderout->remarks;
                                                        @endphp
                                                    @endif
                                                @endforeach
                                                <label class=" col-form-label">Flood Insurance</label>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <span class="input-group-addon" id="basic-addon1">1st</span>
                                                                <input type="datetime-local" name="floodfirst" value="{{ $first }}" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <span class="input-group-addon" id="basic-addon1">2nd</span>
                                                                <input type="datetime-local" name="floodsecond" value="{{ $second }}" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <span class="input-group-addon" id="basic-addon1">3rd</span>
                                                                <input type="datetime-local" name="floodthird" value="{{ $third }}" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <select name="floodstatus" class="form-control">
                                                                    <option value="" disabled selected>Please select status here</option>
                                                                    <option value="Completed" @if($status == 'Completed') selected @endif>Completed</option>
                                                                    <option value="Ordered" @if($status == 'Ordered') selected @endif>Ordered</option>
                                                                    <option value="Pending" @if($status == 'Pending') selected @endif>Pending</option>
                                                                    <option value="Waiting on Processor" @if($status == 'Waiting on Processor') selected @endif>Waiting on Processor</option>
                                                                    <option value="Waiting on Borrower" @if($status == 'Waiting on Borrower') selected @endif>Waiting on Borrower</option>
                                                                    <option value="Cancelled" @if($status == 'Cancelled') selected @endif>Cancelled</option>
                                                                    <option value="Withdrawn" @if($status == 'Withdrawn') selected @endif> Withdrawn</option>
                                                                    <option value="Closing Stage" @if($status == 'Closing Stage') selected @endif>Closing Stage</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="input-group">
                                                                <div class="input-group">
                                                                    <textarea rows="2" cols="5" name="floodremarks" class="form-control" placeholder="Remarks">{{ $remarks }}</textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                @php
                                                    $first = ""; 
                                                    $second = ""; 
                                                    $third = ""; 
                                                    $status = ""; 
                                                    $remarks = "";
                                                @endphp
                                                @foreach ($orderouts as $orderout)
                                                    @if ($orderout->orderouts_name == "Mortgage Payoff")
                                                        @php
                                                            $first = $orderout->first; 
                                                            $second = $orderout->second;
                                                            $third = $orderout->third;
                                                            $status = $orderout->status;
                                                            $remarks = $orderout->remarks;
                                                        @endphp
                                                    @endif
                                                @endforeach
                                                <label class=" col-form-label">Mortgage Payoff</label>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <span class="input-group-addon" id="basic-addon1">1st</span>
                                                                <input type="datetime-local" name="mortgagefirst" value="{{ $first }}" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <span class="input-group-addon" id="basic-addon1">2nd</span>
                                                                <input type="datetime-local" name="mortgagesecond" value="{{ $second }}" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <span class="input-group-addon" id="basic-addon1">3rd</span>
                                                                <input type="datetime-local" name="mortgagethird" value="{{ $third }}" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <select name="mortgagestatus" class="form-control">
                                                                    <option value="" disabled selected>Please select status here</option>
                                                                    <option value="Completed" @if($status == 'Completed') selected @endif>Completed</option>
                                                                    <option value="Ordered" @if($status == 'Ordered') selected @endif>Ordered</option>
                                                                    <option value="Pending" @if($status == 'Pending') selected @endif>Pending</option>
                                                                    <option value="Waiting on Processor" @if($status == 'Waiting on Processor') selected @endif>Waiting on Processor</option>
                                                                    <option value="Waiting on Borrower" @if($status == 'Waiting on Borrower') selected @endif>Waiting on Borrower</option>
                                                                    <option value="Cancelled" @if($status == 'Cancelled') selected @endif>Cancelled</option>
                                                                    <option value="Withdrawn" @if($status == 'Withdrawn') selected @endif> Withdrawn</option>
                                                                    <option value="Closing Stage" @if($status == 'Closing Stage') selected @endif>Closing Stage</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="input-group">
                                                                <div class="input-group">
                                                                    <textarea rows="2" cols="5" name="mortgageremarks" class="form-control" placeholder="Remarks">{{ $remarks }}</textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                @php
                                                    $first = ""; 
                                                    $second = ""; 
                                                    $third = ""; 
                                                    $status = ""; 
                                                    $remarks = "";
                                                @endphp
                                                @foreach ($orderouts as $orderout)
                                                    @if ($orderout->orderouts_name == "Collection Payoff")
                                                        @php
                                                            $first = $orderout->first; 
                                                            $second = $orderout->second;
                                                            $third = $orderout->third;
                                                            $status = $orderout->status;
                                                            $remarks = $orderout->remarks;
                                                        @endphp
                                                    @endif
                                                @endforeach
                                                <label class=" col-form-label">Collection Payoff</label>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <span class="input-group-addon" id="basic-addon1">1st</span>
                                                                <input type="datetime-local" name="collectionfirst" value="{{ $first }}" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <span class="input-group-addon" id="basic-addon1">2nd</span>
                                                                <input type="datetime-local" name="collectionsecond" value="{{ $second }}" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <span class="input-group-addon" id="basic-addon1">3rd</span>
                                                                <input type="datetime-local" name="collectionthird" value="{{ $third }}" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <select name="collectionstatus" class="form-control">
                                                                    <option value="" disabled selected>Please select status here</option>
                                                                    <option value="Completed" @if($status == 'Completed') selected @endif>Completed</option>
                                                                    <option value="Ordered" @if($status == 'Ordered') selected @endif>Ordered</option>
                                                                    <option value="Pending" @if($status == 'Pending') selected @endif>Pending</option>
                                                                    <option value="Waiting on Processor" @if($status == 'Waiting on Processor') selected @endif>Waiting on Processor</option>
                                                                    <option value="Waiting on Borrower" @if($status == 'Waiting on Borrower') selected @endif>Waiting on Borrower</option>
                                                                    <option value="Cancelled" @if($status == 'Cancelled') selected @endif>Cancelled</option>
                                                                    <option value="Withdrawn" @if($status == 'Withdrawn') selected @endif> Withdrawn</option>
                                                                    <option value="Closing Stage" @if($status == 'Closing Stage') selected @endif>Closing Stage</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="input-group">
                                                                <div class="input-group">
                                                                    <textarea rows="2" cols="5" name="collectionremarks" class="form-control" placeholder="Remarks"> {{ $remarks }}</textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                @php
                                                    $first = ""; 
                                                    $second = ""; 
                                                    $third = ""; 
                                                    $status = ""; 
                                                    $remarks = "";
                                                @endphp
                                                @foreach ($orderouts as $orderout)
                                                    @if ($orderout->orderouts_name == "Credit Supplement")
                                                        @php
                                                            $first = $orderout->first; 
                                                            $second = $orderout->second;
                                                            $third = $orderout->third;
                                                            $status = $orderout->status;
                                                            $remarks = $orderout->remarks;
                                                        @endphp
                                                    @endif
                                                @endforeach
                                                <label class=" col-form-label">Credit Supplement</label>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <span class="input-group-addon" id="basic-addon1">1st</span>
                                                                <input type="datetime-local" name="creditfirst" value="{{ $first }}" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <span class="input-group-addon" id="basic-addon1">2nd</span>
                                                                <input type="datetime-local" name="creditsecond" value="{{ $second }}" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <span class="input-group-addon" id="basic-addon1">3rd</span>
                                                                <input type="datetime-local" name="creditthird" value="{{ $third }}" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <select name="creditstatus" class="form-control">
                                                                    <option value="" disabled selected>Please select status here</option>
                                                                    <option value="Completed" @if($status == 'Completed') selected @endif>Completed</option>
                                                                    <option value="Ordered" @if($status == 'Ordered') selected @endif>Ordered</option>
                                                                    <option value="Pending" @if($status == 'Pending') selected @endif>Pending</option>
                                                                    <option value="Waiting on Processor" @if($status == 'Waiting on Processor') selected @endif>Waiting on Processor</option>
                                                                    <option value="Waiting on Borrower" @if($status == 'Waiting on Borrower') selected @endif>Waiting on Borrower</option>
                                                                    <option value="Cancelled" @if($status == 'Cancelled') selected @endif>Cancelled</option>
                                                                    <option value="Withdrawn" @if($status == 'Withdrawn') selected @endif> Withdrawn</option>
                                                                    <option value="Closing Stage" @if($status == 'Closing Stage') selected @endif>Closing Stage</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="input-group">
                                                                <div class="input-group">
                                                                    <textarea rows="2" cols="5" name="creditremarks" class="form-control" placeholder="Remarks">{{ $remarks }}</textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                @php
                                                    $first = ""; 
                                                    $second = ""; 
                                                    $third = ""; 
                                                    $status = ""; 
                                                    $remarks = "";
                                                @endphp
                                                @foreach ($orderouts as $orderout)
                                                    @if ($orderout->orderouts_name == "VVOE")
                                                        @php
                                                            $first = $orderout->first; 
                                                            $second = $orderout->second;
                                                            $third = $orderout->third;
                                                            $status = $orderout->status;
                                                            $remarks = $orderout->remarks;
                                                        @endphp
                                                    @endif
                                                @endforeach
                                                <label class=" col-form-label">Vvoe</label>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <span class="input-group-addon" id="basic-addon1">1st</span>
                                                                <input type="datetime-local" name="vvoefirst" value="{{ $first }}" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <span class="input-group-addon" id="basic-addon1">2nd</span>
                                                                <input type="datetime-local" name="vvoesecond" value="{{ $second }}" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <span class="input-group-addon" id="basic-addon1">3rd</span>
                                                                <input type="datetime-local" name="vvoethird" value="{{ $third }}" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <select name="vvoestatus" class="form-control">
                                                                    <option value="" disabled selected>Please select status here</option>
                                                                    <option value="Completed" @if($status == 'Completed') selected @endif>Completed</option>
                                                                    <option value="Ordered" @if($status == 'Ordered') selected @endif>Ordered</option>
                                                                    <option value="Pending" @if($status == 'Pending') selected @endif>Pending</option>
                                                                    <option value="Waiting on Processor" @if($status == 'Waiting on Processor') selected @endif>Waiting on Processor</option>
                                                                    <option value="Waiting on Borrower" @if($status == 'Waiting on Borrower') selected @endif>Waiting on Borrower</option>
                                                                    <option value="Cancelled" @if($status == 'Cancelled') selected @endif>Cancelled</option>
                                                                    <option value="Withdrawn" @if($status == 'Withdrawn') selected @endif> Withdrawn</option>
                                                                    <option value="Closing Stage" @if($status == 'Closing Stage') selected @endif>Closing Stage</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="input-group">
                                                                <div class="input-group">
                                                                    <textarea rows="2" cols="5" name="vvoeremarks" class="form-control" placeholder="Remarks"> {{ $remarks }}</textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                @php
                                                    $first = ""; 
                                                    $second = ""; 
                                                    $third = ""; 
                                                    $status = ""; 
                                                    $remarks = "";
                                                @endphp
                                                @foreach ($orderouts as $orderout)
                                                    @if ($orderout->orderouts_name == "WVOE Borrower 1")
                                                        @php
                                                            $first = $orderout->first; 
                                                            $second = $orderout->second;
                                                            $third = $orderout->third;
                                                            $status = $orderout->status;
                                                            $remarks = $orderout->remarks;
                                                        @endphp
                                                    @endif
                                                @endforeach
                                                <label class=" col-form-label">Wvoe Borrower 1</label>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <span class="input-group-addon" id="basic-addon1">1st</span>
                                                                <input type="datetime-local" name="wvoeb1first" value="{{ $first }}" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <span class="input-group-addon" id="basic-addon1">2nd</span>
                                                                <input type="datetime-local" name="wvoeb1second" value="{{ $second }}" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <span class="input-group-addon" id="basic-addon1">3rd</span>
                                                                <input type="datetime-local" name="wvoeb1third" value="{{ $third }}" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <select name="wvoeb1status" class="form-control">
                                                                    <option value="" disabled selected>Please select status here</option>
                                                                    <option value="Completed" @if($status == 'Completed') selected @endif>Completed</option>
                                                                    <option value="Ordered" @if($status == 'Ordered') selected @endif>Ordered</option>
                                                                    <option value="Pending" @if($status == 'Pending') selected @endif>Pending</option>
                                                                    <option value="Waiting on Processor" @if($status == 'Waiting on Processor') selected @endif>Waiting on Processor</option>
                                                                    <option value="Waiting on Borrower" @if($status == 'Waiting on Borrower') selected @endif>Waiting on Borrower</option>
                                                                    <option value="Cancelled" @if($status == 'Cancelled') selected @endif>Cancelled</option>
                                                                    <option value="Withdrawn" @if($status == 'Withdrawn') selected @endif> Withdrawn</option>
                                                                    <option value="Closing Stage" @if($status == 'Closing Stage') selected @endif>Closing Stage</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="input-group">
                                                                <div class="input-group">
                                                                    <textarea rows="2" cols="5" name="wvoeb1remarks" class="form-control" placeholder="Remarks"> {{ $remarks }}</textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                @php
                                                    $first = ""; 
                                                    $second = ""; 
                                                    $third = ""; 
                                                    $status = ""; 
                                                    $remarks = "";
                                                @endphp
                                                @foreach ($orderouts as $orderout)
                                                    @if ($orderout->orderouts_name == "WVOE Borrower 2")
                                                        @php
                                                            $first = $orderout->first; 
                                                            $second = $orderout->second;
                                                            $third = $orderout->third;
                                                            $status = $orderout->status;
                                                            $remarks = $orderout->remarks;
                                                        @endphp
                                                    @endif
                                                @endforeach
                                                <label class=" col-form-label">Wvoe Borrower 2</label>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <span class="input-group-addon" id="basic-addon1">1st</span>
                                                                <input type="datetime-local" name="wvoeb2first" value="{{ $first }}" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <span class="input-group-addon" id="basic-addon1">2nd</span>
                                                                <input type="datetime-local" name="wvoeb2second" value="{{ $second }}" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <span class="input-group-addon" id="basic-addon1">3rd</span>
                                                                <input type="datetime-local" name="wvoeb2third" value="{{ $third }}" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <select name="wvoeb2status" class="form-control">
                                                                    <option value="" disabled selected>Please select status here</option>
                                                                    <option value="Completed" @if($status == 'Completed') selected @endif>Completed</option>
                                                                    <option value="Ordered" @if($status == 'Ordered') selected @endif>Ordered</option>
                                                                    <option value="Pending" @if($status == 'Pending') selected @endif>Pending</option>
                                                                    <option value="Waiting on Processor" @if($status == 'Waiting on Processor') selected @endif>Waiting on Processor</option>
                                                                    <option value="Waiting on Borrower" @if($status == 'Waiting on Borrower') selected @endif>Waiting on Borrower</option>
                                                                    <option value="Cancelled" @if($status == 'Cancelled') selected @endif>Cancelled</option>
                                                                    <option value="Withdrawn" @if($status == 'Withdrawn') selected @endif> Withdrawn</option>
                                                                    <option value="Closing Stage" @if($status == 'Closing Stage') selected @endif>Closing Stage</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="input-group">
                                                                <div class="input-group">
                                                                    <textarea rows="2" cols="5" name="wvoeb2remarks" class="form-control" placeholder="Remarks"> {{ $remarks }}</textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                @php
                                                    $first = ""; 
                                                    $second = ""; 
                                                    $third = ""; 
                                                    $status = ""; 
                                                    $remarks = "";
                                                @endphp
                                                @foreach ($orderouts as $orderout)
                                                    @if ($orderout->orderouts_name == "WVOE Borrower 3")
                                                        @php
                                                            $first = $orderout->first; 
                                                            $second = $orderout->second;
                                                            $third = $orderout->third;
                                                            $status = $orderout->status;
                                                            $remarks = $orderout->remarks;
                                                        @endphp
                                                    @endif
                                                @endforeach
                                                <label class=" col-form-label">Wvoe Borrower 3</label>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <span class="input-group-addon" id="basic-addon1">1st</span>
                                                                <input type="datetime-local" name="wvoeb3first" value="{{ $first }}" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <span class="input-group-addon" id="basic-addon1">2nd</span>
                                                                <input type="datetime-local" name="wvoeb3second" value="{{ $second }}" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <span class="input-group-addon" id="basic-addon1">3rd</span>
                                                                <input type="datetime-local" name="wvoeb3third" value="{{ $third }}" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <select name="wvoeb3status" class="form-control">
                                                                    <option value="" disabled selected>Please select status here</option>
                                                                    <option value="Completed" @if($status == 'Completed') selected @endif>Completed</option>
                                                                    <option value="Ordered" @if($status == 'Ordered') selected @endif>Ordered</option>
                                                                    <option value="Pending" @if($status == 'Pending') selected @endif>Pending</option>
                                                                    <option value="Waiting on Processor" @if($status == 'Waiting on Processor') selected @endif>Waiting on Processor</option>
                                                                    <option value="Waiting on Borrower" @if($status == 'Waiting on Borrower') selected @endif>Waiting on Borrower</option>
                                                                    <option value="Cancelled" @if($status == 'Cancelled') selected @endif>Cancelled</option>
                                                                    <option value="Withdrawn" @if($status == 'Withdrawn') selected @endif> Withdrawn</option>
                                                                    <option value="Closing Stage" @if($status == 'Closing Stage') selected @endif>Closing Stage</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="input-group">
                                                                <div class="input-group">
                                                                    <textarea rows="2" cols="5" name="wvoeb3remarks" class="form-control" placeholder="Remarks"> {{ $remarks }}</textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                @php
                                                    $first = ""; 
                                                    $second = ""; 
                                                    $third = ""; 
                                                    $status = ""; 
                                                    $remarks = "";
                                                @endphp
                                                @foreach ($orderouts as $orderout)
                                                    @if ($orderout->orderouts_name == "WVOE Co-borrower 1")
                                                        @php
                                                            $first = $orderout->first; 
                                                            $second = $orderout->second;
                                                            $third = $orderout->third;
                                                            $status = $orderout->status;
                                                            $remarks = $orderout->remarks;
                                                        @endphp
                                                    @endif
                                                @endforeach
                                                <label class=" col-form-label">Wvoe Co-borrower 1</label>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <span class="input-group-addon" id="basic-addon1">1st</span>
                                                                <input type="datetime-local" name="wvoecb1first" value="{{ $first }}" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <span class="input-group-addon" id="basic-addon1">2nd</span>
                                                                <input type="datetime-local" name="wvoecb1second" value="{{ $second }}" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <span class="input-group-addon" id="basic-addon1">3rd</span>
                                                                <input type="datetime-local" name="wvoecb1third" value="{{ $third }}" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <select name="wvoecb1status" class="form-control">
                                                                    <option value="" disabled selected>Please select status here</option>
                                                                    <option value="Completed" @if($status == 'Completed') selected @endif>Completed</option>
                                                                    <option value="Ordered" @if($status == 'Ordered') selected @endif>Ordered</option>
                                                                    <option value="Pending" @if($status == 'Pending') selected @endif>Pending</option>
                                                                    <option value="Waiting on Processor" @if($status == 'Waiting on Processor') selected @endif>Waiting on Processor</option>
                                                                    <option value="Waiting on Borrower" @if($status == 'Waiting on Borrower') selected @endif>Waiting on Borrower</option>
                                                                    <option value="Cancelled" @if($status == 'Cancelled') selected @endif>Cancelled</option>
                                                                    <option value="Withdrawn" @if($status == 'Withdrawn') selected @endif> Withdrawn</option>
                                                                    <option value="Closing Stage" @if($status == 'Closing Stage') selected @endif>Closing Stage</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="input-group">
                                                                <div class="input-group">
                                                                    <textarea rows="2" cols="5" name="wvoecb1remarks" class="form-control" placeholder="Remarks"> {{ $remarks }}</textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                @php
                                                    $first = ""; 
                                                    $second = ""; 
                                                    $third = ""; 
                                                    $status = ""; 
                                                    $remarks = "";
                                                @endphp
                                                @foreach ($orderouts as $orderout)
                                                    @if ($orderout->orderouts_name == "WVOE Co-borrower 2")
                                                        @php
                                                            $first = $orderout->first; 
                                                            $second = $orderout->second;
                                                            $third = $orderout->third;
                                                            $status = $orderout->status;
                                                            $remarks = $orderout->remarks;
                                                        @endphp
                                                    @endif
                                                @endforeach
                                                <label class=" col-form-label">Wvoe Co-borrower 2</label>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <span class="input-group-addon" id="basic-addon1">1st</span>
                                                                <input type="datetime-local" name="wvoecb2first" value="{{ $first }}" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <span class="input-group-addon" id="basic-addon1">2nd</span>
                                                                <input type="datetime-local" name="wvoecb2second" value="{{ $second }}" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <span class="input-group-addon" id="basic-addon1">3rd</span>
                                                                <input type="datetime-local" name="wvoecb2third" value="{{ $third }}" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <select name="wvoecb2status" class="form-control">
                                                                    <option value="" disabled selected>Please select status here</option>
                                                                    <option value="Completed" @if($status == 'Completed') selected @endif>Completed</option>
                                                                    <option value="Ordered" @if($status == 'Ordered') selected @endif>Ordered</option>
                                                                    <option value="Pending" @if($status == 'Pending') selected @endif>Pending</option>
                                                                    <option value="Waiting on Processor" @if($status == 'Waiting on Processor') selected @endif>Waiting on Processor</option>
                                                                    <option value="Waiting on Borrower" @if($status == 'Waiting on Borrower') selected @endif>Waiting on Borrower</option>
                                                                    <option value="Cancelled" @if($status == 'Cancelled') selected @endif>Cancelled</option>
                                                                    <option value="Withdrawn" @if($status == 'Withdrawn') selected @endif> Withdrawn</option>
                                                                    <option value="Closing Stage" @if($status == 'Closing Stage') selected @endif>Closing Stage</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="input-group">
                                                                <div class="input-group">
                                                                    <textarea rows="2" cols="5" name="wvoecb2remarks" class="form-control" placeholder="Remarks"> {{ $remarks }}</textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                @php
                                                    $first = ""; 
                                                    $second = ""; 
                                                    $third = ""; 
                                                    $status = ""; 
                                                    $remarks = "";
                                                @endphp
                                                @foreach ($orderouts as $orderout)
                                                    @if ($orderout->orderouts_name == "WVOE Co-borrower 3")
                                                        @php
                                                            $first = $orderout->first; 
                                                            $second = $orderout->second;
                                                            $third = $orderout->third;
                                                            $status = $orderout->status;
                                                            $remarks = $orderout->remarks;
                                                        @endphp
                                                    @endif
                                                @endforeach
                                                <label class=" col-form-label">Wvoe Co-borrower 3</label>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <span class="input-group-addon" id="basic-addon1">1st</span>
                                                                <input type="datetime-local" name="wvoecb3first" value="{{ $first }}" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <span class="input-group-addon" id="basic-addon1">2nd</span>
                                                                <input type="datetime-local" name="wvoecb3second" value="{{ $second }}" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <span class="input-group-addon" id="basic-addon1">3rd</span>
                                                                <input type="datetime-local" name="wvoecb3third" value="{{ $third }}" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <select name="wvoecb3status" class="form-control">
                                                                    <option value="" disabled selected>Please select status here</option>
                                                                    <option value="Completed" @if($status == 'Completed') selected @endif>Completed</option>
                                                                    <option value="Ordered" @if($status == 'Ordered') selected @endif>Ordered</option>
                                                                    <option value="Pending" @if($status == 'Pending') selected @endif>Pending</option>
                                                                    <option value="Waiting on Processor" @if($status == 'Waiting on Processor') selected @endif>Waiting on Processor</option>
                                                                    <option value="Waiting on Borrower" @if($status == 'Waiting on Borrower') selected @endif>Waiting on Borrower</option>
                                                                    <option value="Cancelled" @if($status == 'Cancelled') selected @endif>Cancelled</option>
                                                                    <option value="Withdrawn" @if($status == 'Withdrawn') selected @endif> Withdrawn</option>
                                                                    <option value="Closing Stage" @if($status == 'Closing Stage') selected @endif>Closing Stage</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="input-group">
                                                                <div class="input-group">
                                                                    <textarea rows="2" cols="5" name="wvoecb3remarks" class="form-control" placeholder="Remarks"> {{ $remarks }}</textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                @php
                                                    $first = ""; 
                                                    $second = ""; 
                                                    $third = ""; 
                                                    $status = ""; 
                                                    $remarks = "";
                                                @endphp
                                                @foreach ($orderouts as $orderout)
                                                    @if ($orderout->orderouts_name == "Tax Transcript")
                                                        @php
                                                            $first = $orderout->first; 
                                                            $second = $orderout->second;
                                                            $third = $orderout->third;
                                                            $status = $orderout->status;
                                                            $remarks = $orderout->remarks;
                                                        @endphp
                                                    @endif
                                                @endforeach
                                                <label class=" col-form-label">Tax Transcript</label>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <span class="input-group-addon" id="basic-addon1">1st</span>
                                                                <input type="datetime-local" name="taxfirst" value="{{ $first }}" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <span class="input-group-addon" id="basic-addon1">2nd</span>
                                                                <input type="datetime-local" name="taxsecond" value="{{ $second }}" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <span class="input-group-addon" id="basic-addon1">3rd</span>
                                                                <input type="datetime-local" name="taxthird" value="{{ $third }}" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <select name="taxstatus" class="form-control">
                                                                    <option value="" disabled selected>Please select status here</option>
                                                                    <option value="Completed" @if($status == 'Completed') selected @endif>Completed</option>
                                                                    <option value="Ordered" @if($status == 'Ordered') selected @endif>Ordered</option>
                                                                    <option value="Pending" @if($status == 'Pending') selected @endif>Pending</option>
                                                                    <option value="Waiting on Processor" @if($status == 'Waiting on Processor') selected @endif>Waiting on Processor</option>
                                                                    <option value="Waiting on Borrower" @if($status == 'Waiting on Borrower') selected @endif>Waiting on Borrower</option>
                                                                    <option value="Cancelled" @if($status == 'Cancelled') selected @endif>Cancelled</option>
                                                                    <option value="Withdrawn" @if($status == 'Withdrawn') selected @endif> Withdrawn</option>
                                                                    <option value="Closing Stage" @if($status == 'Closing Stage') selected @endif>Closing Stage</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="input-group">
                                                                <div class="input-group">
                                                                    <textarea rows="2" cols="5" name="taxremarks" class="form-control" placeholder="Remarks">{{ $remarks }}</textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                @php
                                                    $first = ""; 
                                                    $second = ""; 
                                                    $third = ""; 
                                                    $status = ""; 
                                                    $remarks = "";
                                                @endphp
                                                @foreach ($orderouts as $orderout)
                                                    @if ($orderout->orderouts_name == "Pest Inspection")
                                                        @php
                                                            $first = $orderout->first; 
                                                            $second = $orderout->second;
                                                            $third = $orderout->third;
                                                            $status = $orderout->status;
                                                            $remarks = $orderout->remarks;
                                                        @endphp
                                                    @endif
                                                @endforeach
                                                <label class=" col-form-label">Pest Inspection</label>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <span class="input-group-addon" id="basic-addon1">1st</span>
                                                                <input type="datetime-local" name="pestfirst" value="{{ $first }}" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <span class="input-group-addon" id="basic-addon1">2nd</span>
                                                                <input type="datetime-local" name="pestsecond" value="{{ $second }}" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <span class="input-group-addon" id="basic-addon1">3rd</span>
                                                                <input type="datetime-local" name="pestthird" value="{{ $third }}" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <select name="peststatus" class="form-control">
                                                                    <option value="" disabled selected>Please select status here</option>
                                                                    <option value="Completed" @if($status == 'Completed') selected @endif>Completed</option>
                                                                    <option value="Ordered" @if($status == 'Ordered') selected @endif>Ordered</option>
                                                                    <option value="Pending" @if($status == 'Pending') selected @endif>Pending</option>
                                                                    <option value="Waiting on Processor" @if($status == 'Waiting on Processor') selected @endif>Waiting on Processor</option>
                                                                    <option value="Waiting on Borrower" @if($status == 'Waiting on Borrower') selected @endif>Waiting on Borrower</option>
                                                                    <option value="Cancelled" @if($status == 'Cancelled') selected @endif>Cancelled</option>
                                                                    <option value="Withdrawn" @if($status == 'Withdrawn') selected @endif> Withdrawn</option>
                                                                    <option value="Closing Stage" @if($status == 'Closing Stage') selected @endif>Closing Stage</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="input-group">
                                                                <div class="input-group">
                                                                    <textarea rows="2" cols="5" name="pestremarks" class="form-control" placeholder="Remarks">{{ $remarks }}</textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                @php
                                                    $first = ""; 
                                                    $second = ""; 
                                                    $third = ""; 
                                                    $status = ""; 
                                                    $remarks = "";
                                                @endphp
                                                @foreach ($orderouts as $orderout)
                                                    @if ($orderout->orderouts_name == "24 Payment-VOM")
                                                        @php
                                                            $first = $orderout->first; 
                                                            $second = $orderout->second;
                                                            $third = $orderout->third;
                                                            $status = $orderout->status;
                                                            $remarks = $orderout->remarks;
                                                        @endphp
                                                    @endif
                                                @endforeach
                                                <label class=" col-form-label">24 Payment-VOM</label>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <span class="input-group-addon" id="basic-addon1">1st</span>
                                                                <input type="datetime-local" name="vomfirst" value="{{ $first }}" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <span class="input-group-addon" id="basic-addon1">2nd</span>
                                                                <input type="datetime-local" name="vomsecond" value="{{ $second }}" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <span class="input-group-addon" id="basic-addon1">3rd</span>
                                                                <input type="datetime-local" name="vomthird" value="{{ $third }}" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <select name="vomstatus" class="form-control">
                                                                    <option value="" disabled selected>Please select status here</option>
                                                                    <option value="Completed" @if($status == 'Completed') selected @endif>Completed</option>
                                                                    <option value="Ordered" @if($status == 'Ordered') selected @endif>Ordered</option>
                                                                    <option value="Pending" @if($status == 'Pending') selected @endif>Pending</option>
                                                                    <option value="Waiting on Processor" @if($status == 'Waiting on Processor') selected @endif>Waiting on Processor</option>
                                                                    <option value="Waiting on Borrower" @if($status == 'Waiting on Borrower') selected @endif>Waiting on Borrower</option>
                                                                    <option value="Cancelled" @if($status == 'Cancelled') selected @endif>Cancelled</option>
                                                                    <option value="Withdrawn" @if($status == 'Withdrawn') selected @endif> Withdrawn</option>
                                                                    <option value="Closing Stage" @if($status == 'Closing Stage') selected @endif>Closing Stage</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="input-group">
                                                                <div class="input-group">
                                                                    <textarea rows="2" cols="5" name="vomremarks" class="form-control" placeholder="Remarks">{{ $remarks }}</textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                @php
                                                    $first = ""; 
                                                    $second = ""; 
                                                    $third = ""; 
                                                    $status = ""; 
                                                    $remarks = "";
                                                @endphp
                                                @foreach ($orderouts as $orderout)
                                                    @if ($orderout->orderouts_name == "Title Docs")
                                                        @php
                                                            $first = $orderout->first; 
                                                            $second = $orderout->second;
                                                            $third = $orderout->third;
                                                            $status = $orderout->status;
                                                            $remarks = $orderout->remarks;
                                                        @endphp
                                                    @endif
                                                @endforeach
                                                <label class=" col-form-label">Title Docs</label>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <span class="input-group-addon" id="basic-addon1">1st</span>
                                                                <input type="datetime-local" name="titledocsfirst" value="{{ $first }}" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <span class="input-group-addon" id="basic-addon1">2nd</span>
                                                                <input type="datetime-local" name="titledocssecond" value="{{ $second }}" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <span class="input-group-addon" id="basic-addon1">3rd</span>
                                                                <input type="datetime-local" name="titledocsthird" value="{{ $third }}" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <select name="titledocsstatus" class="form-control">
                                                                    <option value="" disabled selected>Please select status here</option>
                                                                    <option value="Completed" @if($status == 'Completed') selected @endif>Completed</option>
                                                                    <option value="Ordered" @if($status == 'Ordered') selected @endif>Ordered</option>
                                                                    <option value="Pending" @if($status == 'Pending') selected @endif>Pending</option>
                                                                    <option value="Waiting on Processor" @if($status == 'Waiting on Processor') selected @endif>Waiting on Processor</option>
                                                                    <option value="Waiting on Borrower" @if($status == 'Waiting on Borrower') selected @endif>Waiting on Borrower</option>
                                                                    <option value="Cancelled" @if($status == 'Cancelled') selected @endif>Cancelled</option>
                                                                    <option value="Withdrawn" @if($status == 'Withdrawn') selected @endif> Withdrawn</option>
                                                                    <option value="Closing Stage" @if($status == 'Closing Stage') selected @endif>Closing Stage</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="input-group">
                                                                <div class="input-group">
                                                                    <textarea rows="2" cols="5" name="titledocsremarks" class="form-control" placeholder="Remarks">{{ $remarks }}</textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-12 col-md-6 col-xl-3 m-b-30">
                                                <h4 class="sub-title">Run Demotech</h4>
                                                <div class="form-radio">
                                                    <div class="radio radio-inline">
                                                        <label>
                                                            <input type="radio" name="demotech" value="1" @if($loan->demotech == 1) checked @endif>
                                                                <i class="helper"></i>Yes
                                                        </label>
                                                    </div>
                                                    <div class="radio radio-inline">
                                                        <label>
                                                            <input type="radio" name="demotech" value="0" @if($loan->demotech == 0) checked @endif>
                                                            <i class="helper"></i>No
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-6 col-xl-3 m-b-30">
                                                <h4 class="sub-title">Complete Flood Certification</h4>
                                                <div class="form-radio">
                                                    <div class="radio radio-inline">
                                                        <label>
                                                            <input type="radio" name="floodcert" value="1" @if($loan->floodcert == 1) checked @endif>
                                                                <i class="helper"></i>Yes
                                                        </label>
                                                    </div>
                                                    <div class="radio radio-inline">
                                                        <label>
                                                            <input type="radio" name="floodcert" value="0" @if($loan->floodcert == 0) checked @endif>
                                                            <i class="helper"></i>No
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-6 col-xl-3 m-b-30">
                                                <h4 class="sub-title">Pull Drive (Fraud Report)</h4>
                                                <div class="form-radio">
                                                    <div class="radio radio-inline">
                                                        <label>
                                                            <input type="radio" name="pulldrive" value="1" @if($loan->pulldrive == 1) checked @endif>
                                                                <i class="helper"></i>Yes
                                                        </label>
                                                    </div>
                                                    <div class="radio radio-inline">
                                                        <label>
                                                            <input type="radio" name="pulldrive" value="0" @if($loan->pulldrive == 0) checked @endif>
                                                            <i class="helper"></i>No
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-6 col-xl-3 m-b-30">
                                                <h4 class="sub-title">Complete Closing Agent Approval List</h4>
                                                <div class="form-radio">
                                                    <div class="radio radio-inline">
                                                        <label>
                                                            <input type="radio" name="agentapproval" value="1" @if($loan->agentapproval == 1) checked @endif>
                                                                <i class="helper"></i>Yes
                                                        </label>
                                                    </div>
                                                    <div class="radio radio-inline">
                                                        <label>
                                                            <input type="radio" name="agentapproval" value="0" @if($loan->agentapproval == 0) checked @endif>
                                                            <i class="helper"></i>No
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-12 col-md-6 col-xl-3 m-b-30">
                                                <h4 class="sub-title">Processing for Order Outs or 2036 Screen Updated?</h4>
                                                <div class="form-radio">
                                                    <div class="radio radio-inline">
                                                        <label>
                                                            <input type="radio" name="screenupdated" value="1" @if($loan->screenupdated == 1) checked @endif>
                                                                <i class="helper"></i>Yes
                                                        </label>
                                                    </div>
                                                    <div class="radio radio-inline">
                                                        <label>
                                                            <input type="radio" name="screenupdated" value="0" @if($loan->screenupdated == 0) checked @endif>
                                                            <i class="helper"></i>No
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-5"></div>
                                            <div class="col-sm-7">
                                                <button class="btn btn-md btn-success btn-round" style="padding: 10px 40px;" type="button" id="editloanbtn">Submit</button>
                                                <button class="btn btn-md btn-danger btn-round" style="padding: 10px 40px;"><a href="/dashboard" style="color: white">Cancel</a></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('admin/footer')
