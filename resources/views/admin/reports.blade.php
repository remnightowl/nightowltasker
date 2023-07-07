@include('admin.header')
@include('admin.navbar')

<div class="pcoded-content">
	<div class="pcoded-inner-content">
		<div class="main-body">
			<div class="page-wrapper">
				<div class="page-header">
					<div class="row align-items-end">
						<div class="col-lg-8">
							<div class="page-header-title">
								<div class="d-inline">
									<h4>Reports</h4>
									<span>Daily or monthly reports per branch/loan coordinators</span>
								</div>
							</div>
						</div>
						<div class="col-lg-4">
							{{-- <button class="btn btn-success btn-square float-right">Extract to Excel</button>
								<button class="btn btn-danger btn-square float-right" style="margin-right:1%">Extract to PDF</button> --}}
						</div>
					</div>
				</div>
    
				<div class="page-body">
					<div class="row">
						<div class="col-md-12 col-lg-10">
							<div class="card">
								<div class="card-header">
                                    <div class="row">
                                        <div class="col-md-4 col-lg-8">
                                            <h5>Tasks completed for the month of xx for xx branch</h5>
                                        </div>
                                        <div class="col-md-2 col-lg-2">
                                            <select name="select" class="form-control" id="months">
                                                <option value="01">January</option>
                                                <option value="02">February</option>
                                                <option value="03">March</option>
                                                <option value="04">April</option>
                                                <option value="05">May</option>
                                                <option value="06">June</option>
                                                <option value="07">July</option>
                                                <option value="08">August</option>
                                                <option value="09">September</option>
                                                <option value="10">October</option>
                                                <option value="11">November</option>
                                                <option value="12">December</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2 col-lg-2">
                                            <select name="select" class="form-control" id="branchreport">
                                                @foreach ($data as $branch)
                                                <option value="{{$branch->id}}">{{$branch->branch_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
								</div>
								<div>
									<canvas id="myChart"></canvas>
								</div>
							</div>
						</div>
						<div class="col-md-12 col-lg-10">
							<div class="card">
								<div class="card-header">
									<h5>Doughnut chart</h5>
									<span>lorem ipsum dolor sit amet, consectetur adipisicing elit</span>
								</div>
								<div>
									<canvas id="myChart1"></canvas>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>
</div>


@include('admin.footer')

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    const ctx = document.getElementById('myChart');
    
    const myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Scrub', 'Disclosure', 'File Setup', 'Appraisal', 'FasTrack Disclosure', 'FasTrack Submission'],
            datasets: [{
                label: 'Number of files processed ',
                data: [12, 19, 3, 5, 2, 3],
                borderWidth: 1
            }]
        },
        options: {
            indexAxis: 'y',
            scales: {
            x: {
                beginAtZero: true
            }
            }
        }
    });
    
    const ctx1 = document.getElementById('myChart1');
    
    new Chart(ctx1, {
        type: 'bar',
        data: {
            labels: ['EOI', 'Collection Payoff', 'Credit Supplement', 'Flood Insurance', 'Master Insurance', 'Mortgage Payoff', 'Payment VOM', 'Title Docs', 'Tax Transcript', 'VVOE', 'Pest Inspection'],
            datasets: [{
                label: 'Number of files processed ',
                data: [12, 19, 3, 5, 2, 3],
                borderWidth: 1
            }]
        },
        options: {
            indexAxis: 'x',
            scales: {
            y: {
                beginAtZero: true
            }
            }
        }
    });

    $('#months').change(function(e){
        e.preventDefault();

        var month = $('#months').find(":selected").val();
        var branch = $('#branchreport').find(":selected").val();

        $.ajax({
            url: '/branchandtasksmonthly',
            type: 'POST',
            data: {
                branch: branch,
                month: month
            },
            dataType: 'JSON',
            success: function(response){

                alert(response);
                myChart.data.datasets[0].data = response;
                myChart.update();
            }
        });
    })

    $('#branchreport').change(function(e){
        e.preventDefault();

        var month = $('#months').find(":selected").val();
        var branch = $('#branchreport').find(":selected").val();

        $.ajax({
            url: '/branchandtasksmonthly',
            type: 'POST',
            data: {
                branch: branch,
                month: month
            },
            dataType: 'JSON',
            success: function(response){

                alert(response);
                myChart.data.datasets[0].data = response;
                myChart.update();
            }
        });
    })
    
</script>