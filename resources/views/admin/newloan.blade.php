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
                                    <h4>New Loan</h4>
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
                                    <form action="/addloan" method="POST">
                                        @csrf
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Loan Number</label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" name="loannumber" value="{{old('loannumber')}}">
                                            </div>
                                            <label class="col-sm-2 col-form-label">Branch</label>
                                            <div class="col-sm-4">
                                                <select name="branch" id="branch" class="form-control" >
                                                    <option></option>
                                                    @foreach ($branches as $branch)
                                                        <option value="{{ $branch->id }}">{{ $branch->branch_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Requestor</label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" name="requestor" value="{{old('requestor')}}">
                                            </div>
                                            <label class="col-sm-2 col-form-label">Assigned Loan Coordinator</label>
                                            <div class="col-sm-4">
                                                <select class="js-example-basic-multiple col-sm-12 select2-hidden-accessible" name="coordinator[]" id="coordinator" multiple="" tabindex="-1" aria-hidden="true" disabled>
                                                    <option value="" disabled></option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Borrower's Name</label>
                                            <div class="col-sm-4">
                                                <input type="text" name="borrower" value="{{old('borrower')}}" class="form-control">
                                            </div>
                                            <label class="col-sm-2 col-form-label">Remarks</label>
                                            <div class="col-sm-4">
                                                <textarea rows="2" cols="5" name="loanremarks" value="{{old('remarks')}}" class="form-control" placeholder="Remarks"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <div class="form-group row">
                                                    <label class="col-lg-2 col-md-8 col-sm-2 col-form-label">Scrub</label>
                                                    <div class="col-lg-2 col-md-8 col-sm-10">
                                                        <button class="btn btn-md btn-success btn-round" id="scrubstart" style="padding: 10px 40px;" type="button">START</button>
                                                    </div>
                                                    <div class="col-lg-3 col-md-12 col-sm-10">
                                                        <input type="datetime-local" name="scrubstart" id="datetimescrubstart" class="form-control" step="any">
                                                    </div>
                                                    <div class="col-lg-2 col-md-8 col-sm-10">
                                                        <button class="btn btn-md btn-danger btn-round" id="scrubend" style="padding: 10px 40px;" type="button">END</button>
                                                    </div>
                                                    <div class="col-lg-3 col-md-12 col-sm-10">
                                                        <input type="datetime-local" name="scrubend" id="datetimescrubend" class="form-control" step="any">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group row">
                                                    <label class="col-lg-2 col-md-8 col-sm-2 col-form-label">File Setup</label>
                                                    <div class="col-lg-2 col-md-8 col-sm-10">
                                                        <button class="btn btn-md btn-success btn-round" id="filesetupstart" style="padding: 10px 40px;" type="button">START</button>
                                                    </div>
                                                    <div class="col-lg-3 col-md-12 col-sm-10">
                                                        <input type="datetime-local" name="filesetupstart" id="datetimefilesetupstart" class="form-control" step="any">
                                                    </div>
                                                    <div class="col-lg-2 col-md-8 col-sm-10">
                                                        <button class="btn btn-md btn-danger btn-round" id="filesetupend" style="padding: 10px 40px;" type="button">END</button>
                                                    </div>
                                                    <div class="col-lg-3 col-md-12 col-sm-10">
                                                        <input type="datetime-local" name="filesetupend" id="datetimefilesetupend"  class="form-control" step="any">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <div class="form-group row">
                                                    <label class="col-lg-2 col-md-8 col-sm-2 col-form-label">Disclosure</label>
                                                    <div class="col-lg-2 col-md-8 col-sm-10">
                                                        <button class="btn btn-md btn-success btn-round" id="disclosurestart" style="padding: 10px 40px;" type="button">START</button>
                                                    </div>
                                                    <div class="col-lg-3 col-md-12 col-sm-10">
                                                        <input type="datetime-local" name="disclosurestart" id="datetimedisclosurestart" class="form-control" step="any">
                                                    </div>
                                                    <div class="col-lg-2 col-md-8 col-sm-10">
                                                        <button class="btn btn-md btn-danger btn-round" id="disclosureend" style="padding: 10px 40px;" type="button">END</button>
                                                    </div>
                                                    <div class="col-lg-3 col-md-12 col-sm-10">
                                                        <input type="datetime-local" name="disclosureend" id="datetimedisclosureend" class="form-control" step="any">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group row">
                                                    <label class="col-lg-2 col-md-8 col-sm-2 col-form-label">Appraisal</label>
                                                    <div class="col-lg-2 col-md-8 col-sm-10">
                                                        <button class="btn btn-md btn-success btn-round" id="appraisalstart" style="padding: 10px 40px;" type="button">START</button>
                                                    </div>
                                                    <div class="col-lg-3 col-md-12 col-sm-10">
                                                        <input type="datetime-local" name="appraisalstart" id="datetimeappraisalstart" class="form-control" step="any">
                                                    </div>
                                                    <div class="col-lg-2 col-md-8 col-sm-10">
                                                        <button class="btn btn-md btn-danger btn-round" id="appraisalend" style="padding: 10px 40px;" type="button">END</button>
                                                    </div>
                                                    <div class="col-lg-3 col-md-12 col-sm-10">
                                                        <input type="datetime-local" name="appraisalend" id="datetimeappraisalend" class="form-control" step="any">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <div class="form-group row">
                                                    <label class="col-lg-2 col-md-8 col-sm-2 col-form-label">FasTrack Disclosure</label>
                                                    <div class="col-lg-2 col-md-8 col-sm-10">
                                                        <button class="btn btn-md btn-success btn-round" id="fastrackdisclosurestart" style="padding: 10px 40px;" type="button">START</button>
                                                    </div>
                                                    <div class="col-lg-3 col-md-12 col-sm-10">
                                                        <input type="datetime-local" name="fastrackdisclosurestart" id="datetimeftdisclosurestart" class="form-control" step="any">
                                                    </div>
                                                    <div class="col-lg-2 col-md-8 col-sm-10">
                                                        <button class="btn btn-md btn-danger btn-round" id="fastrackdisclosureend" style="padding: 10px 40px;" type="button">END</button>
                                                    </div>
                                                    <div class="col-lg-3 col-md-12 col-sm-10">
                                                        <input type="datetime-local" name="fastrackdisclosureend" id="datetimeftdisclosureend" class="form-control" step="any">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group row">
                                                    <label class="col-lg-2 col-md-8 col-sm-2 col-form-label">FasTrack Submission</label>
                                                    <div class="col-lg-2 col-md-8 col-sm-10">
                                                        <button class="btn btn-md btn-success btn-round" id="fastracksubmissionstart" style="padding: 10px 40px;" type="button">START</button>
                                                    </div>
                                                    <div class="col-lg-3 col-md-12 col-sm-10">
                                                        <input type="datetime-local" name="fastracksubmissionstart" id="datetimeftsubmissionstart" class="form-control" step="any">
                                                    </div>
                                                    <div class="col-lg-2 col-md-8 col-sm-10">
                                                        <button class="btn btn-md btn-danger btn-round" id="fastracksubmissionend" style="padding: 10px 40px;" type="button">END</button>
                                                    </div>
                                                    <div class="col-lg-3 col-md-12 col-sm-10">
                                                        <input type="datetime-local" name="fastracksubmissionend" id="datetimeftsubmissionend" class="form-control" step="any">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <label class=" col-form-label">EOI</label>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <span class="input-group-addon" id="basic-addon1">1st</span>
                                                                <input type="datetime-local" name="eoifirst" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <span class="input-group-addon" id="basic-addon1">2nd</span>
                                                                <input type="datetime-local" name="eoisecond" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <span class="input-group-addon" id="basic-addon1">3rd</span>
                                                                <input type="datetime-local" name="eoithird" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <select name="eoistatus" class="form-control">
                                                                    <option value="" disabled selected>Please select status here</option>
                                                                    <option value="Completed">Completed</option>
                                                                    <option value="Ordered">Ordered</option>
                                                                    <option value="Pending">Pending</option>
                                                                    <option value="Waiting on Processor">Waiting on Processor</option>
                                                                    <option value="Waiting on Borrower">Waiting on Borrower</option>
                                                                    <option value="Cancelled">Cancelled</option>
                                                                    <option value="Withdrawn">Withdrawn</option>
                                                                    <option value="Closing Stage">Closing Stage</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="input-group">
                                                                <div class="input-group">
                                                                    <textarea rows="2" cols="5" name="eoiremarks" class="form-control" placeholder="Remarks"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <label class=" col-form-label">Master Insurance</label>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <span class="input-group-addon" id="basic-addon1">1st</span>
                                                                <input type="datetime-local" name="masterfirst" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <span class="input-group-addon" id="basic-addon1">2nd</span>
                                                                <input type="datetime-local" name="mastersecond" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <span class="input-group-addon" id="basic-addon1">3rd</span>
                                                                <input type="datetime-local" name="masterthird" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <select name="masterstatus" class="form-control">
                                                                    <option value="" disabled selected>Please select status here</option>
                                                                    <option value="Completed">Completed</option>
                                                                    <option value="Ordered">Ordered</option>
                                                                    <option value="Pending">Pending</option>
                                                                    <option value="Waiting on Processor">Waiting on Processor</option>
                                                                    <option value="Waiting on Borrower">Waiting on Borrower</option>
                                                                    <option value="Cancelled">Cancelled</option>
                                                                    <option value="Withdrawn">Withdrawn</option>
                                                                    <option value="Closing Stage">Closing Stage</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="input-group">
                                                                <div class="input-group">
                                                                    <textarea rows="2" cols="5" name="masterremarks" class="form-control" placeholder="Remarks"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <label class=" col-form-label">Flood Insurance</label>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <span class="input-group-addon" id="basic-addon1">1st</span>
                                                                <input type="datetime-local" name="floodfirst" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <span class="input-group-addon" id="basic-addon1">2nd</span>
                                                                <input type="datetime-local" name="floodsecond" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <span class="input-group-addon" id="basic-addon1">3rd</span>
                                                                <input type="datetime-local" name="floodthird" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <select name="floodstatus" class="form-control">
                                                                    <option value="" disabled selected>Please select status here</option>
                                                                    <option value="Completed">Completed</option>
                                                                    <option value="Ordered">Ordered</option>
                                                                    <option value="Pending">Pending</option>
                                                                    <option value="Waiting on Processor">Waiting on Processor</option>
                                                                    <option value="Waiting on Borrower">Waiting on Borrower</option>
                                                                    <option value="Cancelled">Cancelled</option>
                                                                    <option value="Withdrawn">Withdrawn</option>
                                                                    <option value="Closing Stage">Closing Stage</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="input-group">
                                                                <div class="input-group">
                                                                    <textarea rows="2" cols="5" name="floodremarks" class="form-control" placeholder="Remarks"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <label class=" col-form-label">Mortgage Payoff</label>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <span class="input-group-addon" id="basic-addon1">1st</span>
                                                                <input type="datetime-local" name="mortgagefirst" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <span class="input-group-addon" id="basic-addon1">2nd</span>
                                                                <input type="datetime-local" name="mortgagesecond" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <span class="input-group-addon" id="basic-addon1">3rd</span>
                                                                <input type="datetime-local" name="mortgagethird" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <select name="mortgagestatus" class="form-control">
                                                                    <option value="" disabled selected>Please select status here</option>
                                                                    <option value="Completed">Completed</option>
                                                                    <option value="Ordered">Ordered</option>
                                                                    <option value="Pending">Pending</option>
                                                                    <option value="Waiting on Processor">Waiting on Processor</option>
                                                                    <option value="Waiting on Borrower">Waiting on Borrower</option>
                                                                    <option value="Cancelled">Cancelled</option>
                                                                    <option value="Withdrawn">Withdrawn</option>
                                                                    <option value="Closing Stage">Closing Stage</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="input-group">
                                                                <div class="input-group">
                                                                    <textarea rows="2" cols="5" name="mortgageremarks" class="form-control" placeholder="Remarks"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <label class=" col-form-label">Collection Payoff</label>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <span class="input-group-addon" id="basic-addon1">1st</span>
                                                                <input type="datetime-local" name="collectionfirst" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <span class="input-group-addon" id="basic-addon1">2nd</span>
                                                                <input type="datetime-local" name="collectionsecond" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <span class="input-group-addon" id="basic-addon1">3rd</span>
                                                                <input type="datetime-local" name="collectionthird" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <select name="collectionstatus" class="form-control">
                                                                    <option value="" disabled selected>Please select status here</option>
                                                                    <option value="Completed">Completed</option>
                                                                    <option value="Ordered">Ordered</option>
                                                                    <option value="Pending">Pending</option>
                                                                    <option value="Waiting on Processor">Waiting on Processor</option>
                                                                    <option value="Waiting on Borrower">Waiting on Borrower</option>
                                                                    <option value="Cancelled">Cancelled</option>
                                                                    <option value="Withdrawn">Withdrawn</option>
                                                                    <option value="Closing Stage">Closing Stage</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="input-group">
                                                                <div class="input-group">
                                                                    <textarea rows="2" cols="5" name="collectionremarks" class="form-control" placeholder="Remarks"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <label class=" col-form-label">Credit Supplement</label>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <span class="input-group-addon" id="basic-addon1">1st</span>
                                                                <input type="datetime-local" name="creditfirst" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <span class="input-group-addon" id="basic-addon1">2nd</span>
                                                                <input type="datetime-local" name="creditsecond" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <span class="input-group-addon" id="basic-addon1">3rd</span>
                                                                <input type="datetime-local" name="creditthird" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <select name="creditstatus" class="form-control">
                                                                    <option value="" disabled selected>Please select status here</option>
                                                                    <option value="Completed">Completed</option>
                                                                    <option value="Ordered">Ordered</option>
                                                                    <option value="Pending">Pending</option>
                                                                    <option value="Waiting on Processor">Waiting on Processor</option>
                                                                    <option value="Waiting on Borrower">Waiting on Borrower</option>
                                                                    <option value="Cancelled">Cancelled</option>
                                                                    <option value="Withdrawn">Withdrawn</option>
                                                                    <option value="Closing Stage">Closing Stage</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="input-group">
                                                                <div class="input-group">
                                                                    <textarea rows="2" cols="5" name="creditremarks" class="form-control" placeholder="Remarks"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <label class=" col-form-label">VVOE</label>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <span class="input-group-addon" id="basic-addon1">1st</span>
                                                                <input type="datetime-local" name="vvoefirst" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <span class="input-group-addon" id="basic-addon1">2nd</span>
                                                                <input type="datetime-local" name="vvoesecond" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <span class="input-group-addon" id="basic-addon1">3rd</span>
                                                                <input type="datetime-local" name="vvoethird" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <select name="vvoestatus" class="form-control">
                                                                    <option value="" disabled selected>Please select status here</option>
                                                                    <option value="Completed">Completed</option>
                                                                    <option value="Ordered">Ordered</option>
                                                                    <option value="Pending">Pending</option>
                                                                    <option value="Waiting on Processor">Waiting on Processor</option>
                                                                    <option value="Waiting on Borrower">Waiting on Borrower</option>
                                                                    <option value="Cancelled">Cancelled</option>
                                                                    <option value="Withdrawn">Withdrawn</option>
                                                                    <option value="Closing Stage">Closing Stage</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="input-group">
                                                                <div class="input-group">
                                                                    <textarea rows="2" cols="5" name="vvoeremarks" class="form-control" placeholder="Remarks"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <label class=" col-form-label">WVOE Borrower 1</label>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <span class="input-group-addon" id="basic-addon1">1st</span>
                                                                <input type="datetime-local" name="wvoeb1first" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <span class="input-group-addon" id="basic-addon1">2nd</span>
                                                                <input type="datetime-local" name="wvoeb1second" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <span class="input-group-addon" id="basic-addon1">3rd</span>
                                                                <input type="datetime-local" name="wvoeb1third" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <select name="wvoeb1status" class="form-control">
                                                                    <option value="" disabled selected>Please select status here</option>
                                                                    <option value="Completed">Completed</option>
                                                                    <option value="Ordered">Ordered</option>
                                                                    <option value="Pending">Pending</option>
                                                                    <option value="Waiting on Processor">Waiting on Processor</option>
                                                                    <option value="Waiting on Borrower">Waiting on Borrower</option>
                                                                    <option value="Cancelled">Cancelled</option>
                                                                    <option value="Withdrawn">Withdrawn</option>
                                                                    <option value="Closing Stage">Closing Stage</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="input-group">
                                                                <div class="input-group">
                                                                    <textarea rows="2" cols="5" name="wvoeb1remarks" class="form-control" placeholder="Remarks"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <label class=" col-form-label">WVOE Borrower 2</label>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <span class="input-group-addon" id="basic-addon1">1st</span>
                                                                <input type="datetime-local" name="wvoeb2first" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <span class="input-group-addon" id="basic-addon1">2nd</span>
                                                                <input type="datetime-local" name="wvoeb2second" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <span class="input-group-addon" id="basic-addon1">3rd</span>
                                                                <input type="datetime-local" name="wvoeb2third" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <select name="wvoeb2status" class="form-control">
                                                                    <option value="" disabled selected>Please select status here</option>
                                                                    <option value="Completed">Completed</option>
                                                                    <option value="Ordered">Ordered</option>
                                                                    <option value="Pending">Pending</option>
                                                                    <option value="Waiting on Processor">Waiting on Processor</option>
                                                                    <option value="Waiting on Borrower">Waiting on Borrower</option>
                                                                    <option value="Cancelled">Cancelled</option>
                                                                    <option value="Withdrawn">Withdrawn</option>
                                                                    <option value="Closing Stage">Closing Stage</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="input-group">
                                                                <div class="input-group">
                                                                    <textarea rows="2" cols="5" name="wvoeb2remarks" class="form-control" placeholder="Remarks"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <label class=" col-form-label">WVOE Borrower 3</label>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <span class="input-group-addon" id="basic-addon1">1st</span>
                                                                <input type="datetime-local" name="wvoeb3first" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <span class="input-group-addon" id="basic-addon1">2nd</span>
                                                                <input type="datetime-local" name="wvoeb3second" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <span class="input-group-addon" id="basic-addon1">3rd</span>
                                                                <input type="datetime-local" name="wvoeb3third" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <select name="wvoeb3status" class="form-control">
                                                                    <option value="" disabled selected>Please select status here</option>
                                                                    <option value="Completed">Completed</option>
                                                                    <option value="Ordered">Ordered</option>
                                                                    <option value="Pending">Pending</option>
                                                                    <option value="Waiting on Processor">Waiting on Processor</option>
                                                                    <option value="Waiting on Borrower">Waiting on Borrower</option>
                                                                    <option value="Cancelled">Cancelled</option>
                                                                    <option value="Withdrawn">Withdrawn</option>
                                                                    <option value="Closing Stage">Closing Stage</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="input-group">
                                                                <div class="input-group">
                                                                    <textarea rows="2" cols="5" name="wvoeb3remarks" class="form-control" placeholder="Remarks"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <label class=" col-form-label">WVOE Co-borrower 1</label>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <span class="input-group-addon" id="basic-addon1">1st</span>
                                                                <input type="datetime-local" name="wvoecb1first" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <span class="input-group-addon" id="basic-addon1">2nd</span>
                                                                <input type="datetime-local" name="wvoecb1second" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <span class="input-group-addon" id="basic-addon1">3rd</span>
                                                                <input type="datetime-local" name="wvoecb1third" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <select name="wvoecb1status" class="form-control">
                                                                    <option value="" disabled selected>Please select status here</option>
                                                                    <option value="Completed">Completed</option>
                                                                    <option value="Ordered">Ordered</option>
                                                                    <option value="Pending">Pending</option>
                                                                    <option value="Waiting on Processor">Waiting on Processor</option>
                                                                    <option value="Waiting on Borrower">Waiting on Borrower</option>
                                                                    <option value="Cancelled">Cancelled</option>
                                                                    <option value="Withdrawn">Withdrawn</option>
                                                                    <option value="Closing Stage">Closing Stage</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="input-group">
                                                                <div class="input-group">
                                                                    <textarea rows="2" cols="5" name="wvoecb1remarks" class="form-control" placeholder="Remarks"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <label class=" col-form-label">WVOE Co-borrower 2</label>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <span class="input-group-addon" id="basic-addon1">1st</span>
                                                                <input type="datetime-local" name="wvoecb2first" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <span class="input-group-addon" id="basic-addon1">2nd</span>
                                                                <input type="datetime-local" name="wvoecb2second" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <span class="input-group-addon" id="basic-addon1">3rd</span>
                                                                <input type="datetime-local" name="wvoecb2third" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <select name="wvoecb3status" class="form-control">
                                                                    <option value="" disabled selected>Please select status here</option>
                                                                    <option value="Completed">Completed</option>
                                                                    <option value="Ordered">Ordered</option>
                                                                    <option value="Pending">Pending</option>
                                                                    <option value="Waiting on Processor">Waiting on Processor</option>
                                                                    <option value="Waiting on Borrower">Waiting on Borrower</option>
                                                                    <option value="Cancelled">Cancelled</option>
                                                                    <option value="Withdrawn">Withdrawn</option>
                                                                    <option value="Closing Stage">Closing Stage</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="input-group">
                                                                <div class="input-group">
                                                                    <textarea rows="2" cols="5" name="wvoecb2remarks" class="form-control" placeholder="Remarks"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <label class=" col-form-label">WVOE Co-borrower 3</label>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <span class="input-group-addon" id="basic-addon1">1st</span>
                                                                <input type="datetime-local" name="wvoecb3first" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <span class="input-group-addon" id="basic-addon1">2nd</span>
                                                                <input type="datetime-local" name="wvoecb3second" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <span class="input-group-addon" id="basic-addon1">3rd</span>
                                                                <input type="datetime-local" name="wvoecb3third" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <select name="wvoecb2status" class="form-control">
                                                                    <option value="" disabled selected>Please select status here</option>
                                                                    <option value="Completed">Completed</option>
                                                                    <option value="Ordered">Ordered</option>
                                                                    <option value="Pending">Pending</option>
                                                                    <option value="Waiting on Processor">Waiting on Processor</option>
                                                                    <option value="Waiting on Borrower">Waiting on Borrower</option>
                                                                    <option value="Cancelled">Cancelled</option>
                                                                    <option value="Withdrawn">Withdrawn</option>
                                                                    <option value="Closing Stage">Closing Stage</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="input-group">
                                                                <div class="input-group">
                                                                    <textarea rows="2" cols="5" name="wvoecb3remarks" class="form-control" placeholder="Remarks"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <label class=" col-form-label">Tax Transcript</label>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <span class="input-group-addon" id="basic-addon1">1st</span>
                                                                <input type="datetime-local" name="taxfirst" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <span class="input-group-addon" id="basic-addon1">2nd</span>
                                                                <input type="datetime-local" name="taxsecond" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <span class="input-group-addon" id="basic-addon1">3rd</span>
                                                                <input type="datetime-local" name="taxthird" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <select name="taxstatus" class="form-control">
                                                                    <option value="" disabled selected>Please select status here</option>
                                                                    <option value="Completed">Completed</option>
                                                                    <option value="Ordered">Ordered</option>
                                                                    <option value="Pending">Pending</option>
                                                                    <option value="Waiting on Processor">Waiting on Processor</option>
                                                                    <option value="Waiting on Borrower">Waiting on Borrower</option>
                                                                    <option value="Cancelled">Cancelled</option>
                                                                    <option value="Withdrawn">Withdrawn</option>
                                                                    <option value="Closing Stage">Closing Stage</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="input-group">
                                                                <div class="input-group">
                                                                    <textarea rows="2" cols="5" name="taxremarks" class="form-control" placeholder="Remarks"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <label class=" col-form-label">Pest Inspection</label>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <span class="input-group-addon" id="basic-addon1">1st</span>
                                                                <input type="datetime-local" name="pestfirst" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <span class="input-group-addon" id="basic-addon1">2nd</span>
                                                                <input type="datetime-local" name="pestsecond" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <span class="input-group-addon" id="basic-addon1">3rd</span>
                                                                <input type="datetime-local" name="pestthird" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <select name="peststatus" class="form-control">
                                                                    <option value="" disabled selected>Please select status here</option>
                                                                    <option value="Completed">Completed</option>
                                                                    <option value="Ordered">Ordered</option>
                                                                    <option value="Pending">Pending</option>
                                                                    <option value="Waiting on Processor">Waiting on Processor</option>
                                                                    <option value="Waiting on Borrower">Waiting on Borrower</option>
                                                                    <option value="Cancelled">Cancelled</option>
                                                                    <option value="Withdrawn">Withdrawn</option>
                                                                    <option value="Closing Stage">Closing Stage</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="input-group">
                                                                <div class="input-group">
                                                                    <textarea rows="2" cols="5" name="pestremarks" class="form-control" placeholder="Remarks"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <label class=" col-form-label">24 Payment-VOM</label>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <span class="input-group-addon" id="basic-addon1">1st</span>
                                                                <input type="datetime-local" name="vomfirst" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <span class="input-group-addon" id="basic-addon1">2nd</span>
                                                                <input type="datetime-local" name="vomsecond" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <span class="input-group-addon" id="basic-addon1">3rd</span>
                                                                <input type="datetime-local" name="vomthird" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <select name="vomstatus" class="form-control">
                                                                    <option value="" disabled selected>Please select status here</option>
                                                                    <option value="Completed">Completed</option>
                                                                    <option value="Ordered">Ordered</option>
                                                                    <option value="Pending">Pending</option>
                                                                    <option value="Waiting on Processor">Waiting on Processor</option>
                                                                    <option value="Waiting on Borrower">Waiting on Borrower</option>
                                                                    <option value="Cancelled">Cancelled</option>
                                                                    <option value="Withdrawn">Withdrawn</option>
                                                                    <option value="Closing Stage">Closing Stage</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="input-group">
                                                                <div class="input-group">
                                                                    <textarea rows="2" cols="5" name="vomremarks" class="form-control" placeholder="Remarks"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <label class=" col-form-label">Title Docs</label>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <span class="input-group-addon" id="basic-addon1">1st</span>
                                                                <input type="datetime-local" name="titledocsfirst" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <span class="input-group-addon" id="basic-addon1">2nd</span>
                                                                <input type="datetime-local" name="titledocssecond" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <span class="input-group-addon" id="basic-addon1">3rd</span>
                                                                <input type="datetime-local" name="titledocsthird" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <select name="titledocsstatus" class="form-control">
                                                                    <option value="" disabled selected>Please select status here</option>
                                                                    <option value="Completed">Completed</option>
                                                                    <option value="Ordered">Ordered</option>
                                                                    <option value="Pending">Pending</option>
                                                                    <option value="Waiting on Processor">Waiting on Processor</option>
                                                                    <option value="Waiting on Borrower">Waiting on Borrower</option>
                                                                    <option value="Cancelled">Cancelled</option>
                                                                    <option value="Withdrawn">Withdrawn</option>
                                                                    <option value="Closing Stage">Closing Stage</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="input-group">
                                                                <div class="input-group">
                                                                    <textarea rows="2" cols="5" name="titledocsremarks" class="form-control" placeholder="Remarks"></textarea>
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
                                                            <input type="radio" name="demotech" value="1" checked="checked">
                                                                <i class="helper"></i>Yes
                                                        </label>
                                                    </div>
                                                    <div class="radio radio-inline">
                                                        <label>
                                                            <input type="radio" name="demotech" value="0">
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
                                                            <input type="radio" name="floodcert" value="1" checked="checked">
                                                                <i class="helper"></i>Yes
                                                        </label>
                                                    </div>
                                                    <div class="radio radio-inline">
                                                        <label>
                                                            <input type="radio" name="floodcert" value="0">
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
                                                            <input type="radio" name="pulldrive" value="1" checked="checked">
                                                                <i class="helper"></i>Yes
                                                        </label>
                                                    </div>
                                                    <div class="radio radio-inline">
                                                        <label>
                                                            <input type="radio" name="pulldrive" value="0">
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
                                                            <input type="radio" name="agentapproval" value="1" checked="checked">
                                                                <i class="helper"></i>Yes
                                                        </label>
                                                    </div>
                                                    <div class="radio radio-inline">
                                                        <label>
                                                            <input type="radio" name="agentapproval" value="0">
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
                                                            <input type="radio" name="screenupdated" value="1" checked="checked">
                                                                <i class="helper"></i>Yes
                                                        </label>
                                                    </div>
                                                    <div class="radio radio-inline">
                                                        <label>
                                                            <input type="radio" name="screenupdated" value="0">
                                                            <i class="helper"></i>No
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-5"></div>
                                            <div class="col-sm-7">
                                                <button class="btn btn-md btn-success btn-round" style="padding: 10px 40px;" type="submit">Submit</button>
                                                <button class="btn btn-md btn-danger btn-round" style="padding: 10px 40px;"><a href="/dashboard" style="color: white">Cancel</a></button>
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
