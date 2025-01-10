@extends('layouts.admin')

@section('content')

<div class="xs-pd-20-10 pd-ltr-20">
				<div class="title pb-20">
          @if(session('message'))
					<h2 class="h3 mb-0">{{ session('message')}},</h2>
          @endif
				</div>

				<div class="row pb-10">
					<div class="col-xl-3 col-lg-3 col-md-6 mb-20">
						<div class="card-box height-100-p widget-style3">
							<div class="d-flex flex-wrap">
								<div class="widget-data">
									<div class="weight-700 font-24 text-dark">{{ $todayOrder }}</div>
									<div class="font-14 text-secondary weight-500">
										Today Order
									</div>
								</div>
								<div class="widget-icon">
										<div class="icon" data-color="#00eccf">
											<i class="bi bi-calendar-event"></i>
										</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-3 col-lg-3 col-md-6 mb-20">
						<div class="card-box height-100-p widget-style3">
							<div class="d-flex flex-wrap">
								<div class="widget-data">
									<div class="weight-700 font-24 text-dark">{{ $thisMonthOrder }}</div>
									<div class="font-14 text-secondary weight-500">
										Month Order
									</div>
								</div>
								<div class="widget-icon">
									<div class="icon" data-color="#00FFFF">
										<span class="bi bi-moon"></span>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-3 col-lg-3 col-md-6 mb-20">
						<div class="card-box height-100-p widget-style3">
							<div class="d-flex flex-wrap">
								<div class="widget-data">
									<div class="weight-700 font-24 text-dark">{{ $thisYearOrder }}</div>
									<div class="font-14 text-secondary weight-500">
										Year Order
									</div>
								</div>
								<div class="widget-icon">
									<div class="icon">
										<i
											class="bi bi-calendar"
											aria-hidden="true"
										></i>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-3 col-lg-3 col-md-6 mb-20">
						<div class="card-box height-100-p widget-style3">
							<div class="d-flex flex-wrap">
								<div class="widget-data">
									<div class="weight-700 font-24 text-dark">{{ $totalOrder }}</div>
									<div class="font-14 text-secondary weight-500">Total Order</div>
								</div>
								<div class="widget-icon">
									<div class="icon" data-color="#09cc06">
										<i class="icon-copy fa fa-calculator" aria-hidden="true"></i>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="row pb-10">
					<div class="col-md-12 mb-20">
						<div class="card-box height-100-p pd-20">
							<div class="d-flex flex-wrap justify-content-between align-items-center pb-0 pb-md-3">
								<div class="h5 mb-md-0">Total Selling Chart</div>
							</div>
							<canvas id="sales-chart" style="width: 100%; height: 400px;"></canvas>
						</div>
					</div>
				</div>

				<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
				<script>
					document.addEventListener('DOMContentLoaded', function() {
						// Data dari controller
						const salesData = @json($salesData);

						// Format data untuk Chart.js
						const labels = Object.keys(salesData).map(month => {
							const monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
							return monthNames[month - 1];
						});
						const data = Object.values(salesData);

						// Inisialisasi chart
						const ctx = document.getElementById('sales-chart').getContext('2d');
						new Chart(ctx, {
							type: 'bar',
							data: {
								labels: labels,
								datasets: [{
									label: 'Total Sales ($)',
									data: data,
									backgroundColor: 'rgba(54, 162, 235, 0.2)',
									borderColor: 'rgba(54, 162, 235, 1)',
									borderWidth: 1
								}]
							},
							options: {
								scales: {
									y: {
										beginAtZero: true
									}
								}
							}
						});
					});
				</script>

			</div>
		</div>

@endsection