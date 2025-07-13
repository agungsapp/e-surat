<div>
		<div class="row">

				<div class="col-12">
						<div class="row">
								<div class="col-lg-3 col-md-12 col-6 mb-4">
										<div class="card">
												<div class="card-body">
														<div class="card-title d-flex align-items-start justify-content-between">
																<div class="avatar flex-shrink-0">
																		<img src="{{ asset('assets') }}/img/icons/unicons/chart-success.png" alt="chart success"
																				class="rounded" />
																</div>
																<div class="dropdown">
																		<button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown" aria-haspopup="true"
																				aria-expanded="false">
																				<i class="bx bx-dots-vertical-rounded"></i>
																		</button>
																		<div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
																				<a class="dropdown-item" href="{{ route('admin.permohonan') }}">View More</a>

																		</div>
																</div>
														</div>
														<span class="fw-semibold d-block mb-1">Jumlah Permohonan</span>
														<h3 class="card-title mb-2">{{ $permohonan }}</h3>
												</div>
										</div>
								</div>
								<div class="col-lg-3 col-md-12 col-6 mb-4">
										<div class="card">
												<div class="card-body">
														<div class="card-title d-flex align-items-start justify-content-between">
																<div class="avatar flex-shrink-0">
																		<img src="{{ asset('assets') }}/img/icons/unicons/wallet-info.png" alt="Credit Card"
																				class="rounded" />
																</div>
																<div class="dropdown">
																		<button class="btn p-0" type="button" id="cardOpt6" data-bs-toggle="dropdown" aria-haspopup="true"
																				aria-expanded="false">
																				<i class="bx bx-dots-vertical-rounded"></i>
																		</button>
																		<div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
																				<a class="dropdown-item" href="{{ route('admin.permohonan') }}">View More</a>

																		</div>
																</div>
														</div>
														<span>Status Pending</span>
														<h3 class="card-title mb-1 text-nowrap">{{ $pending }}</h3>

												</div>
										</div>

								</div>



								<div class="col-lg-3 col-md-12 col-6 mb-4">
										<div class="card">
												<div class="card-body">
														<div class="card-title d-flex align-items-start justify-content-between">
																<div class="avatar flex-shrink-0">
																		<img src="{{ asset('assets') }}/img/icons/unicons/paypal.png" alt="Credit Card" class="rounded" />
																</div>
																<div class="dropdown">
																		<button class="btn p-0" type="button" id="cardOpt4" data-bs-toggle="dropdown" aria-haspopup="true"
																				aria-expanded="false">
																				<i class="bx bx-dots-vertical-rounded"></i>
																		</button>
																		<div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt4">
																				<a class="dropdown-item" href="{{ route('admin.permohonan') }}">View More</a>

																		</div>
																</div>
														</div>
														<span class="d-block mb-1">Status Aproved</span>
														<h3 class="card-title mb-2 text-nowrap">{{ $aproved }}</h3>

												</div>
										</div>
								</div>
								<div class="col-lg-3 col-md-12 col-6 mb-4">
										<div class="card">
												<div class="card-body">
														<div class="card-title d-flex align-items-start justify-content-between">
																<div class="avatar flex-shrink-0">
																		<img src="{{ asset('assets') }}/img/icons/unicons/cc-primary.png" alt="Credit Card" class="rounded" />
																</div>
																<div class="dropdown">
																		<button class="btn p-0" type="button" id="cardOpt1" data-bs-toggle="dropdown" aria-haspopup="true"
																				aria-expanded="false">
																				<i class="bx bx-dots-vertical-rounded"></i>
																		</button>
																		<div class="dropdown-menu" aria-labelledby="cardOpt1">
																				<a class="dropdown-item" href="{{ route('admin.permohonan') }}">View More</a>

																		</div>
																</div>
														</div>
														<span class="fw-semibold d-block mb-1">Status Riject</span>
														<h3 class="card-title mb-2">{{ $riject }}</h3>

												</div>
										</div>
								</div>


						</div>
				</div>

		</div>


</div>
