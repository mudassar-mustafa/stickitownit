@extends('backend.layouts.app')
@section('title','Dashboard')
@push('css')
@endpush
@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">
                <!-- Left side columns -->
                <div class="col-lg-12">
                    <div class="row">

                        <!-- Order Card -->
                        <div class="col-xxl-4 col-md-6">
                        <div class="card info-card sales-card">

                            <div class="filter">
                            <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                <li class="dropdown-header text-start">
                                <h6>Filter</h6>
                                </li>

                                <li><a class="dropdown-item" href="#">Today</a></li>
                                <li><a class="dropdown-item" href="#">This Month</a></li>
                                <li><a class="dropdown-item" href="#">This Year</a></li>
                            </ul>
                            </div>

                            <div class="card-body">
                                <h5 class="card-title">Total Sale Orders <span>| Today</span></h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center"
                                        data-bs-toggle="tooltip" title="Sales Orders"
                                    >
                                        <i class="bi bi-cart"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $totalOrders }}</h6>
                                    </div>
                                </div>
                            </div>

                        </div>
                        </div><!-- Order Card -->
                        @if (auth()->user()->hasrole('Customer'))
                        <!-- Remaing Token Card -->
                        <div class="col-xxl-4 col-md-6">
                            <div class="card info-card revenue-card">

                                <div class="card-body">
                                <h5 class="card-title">Remaining Token</h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center"
                                        data-bs-toggle="tooltip" title="Package Orders"
                                    >
                                    <i class="bi bi-database-fill"></i>
                                    </div>
                                    <div class="ps-3">
                                    <h6>{{ $remaingToken }}</h6>

                                    </div>
                                </div>
                                </div>

                            </div>
                            </div><!-- End Revenue Card -->
                        @endif

                        @if (auth()->user()->hasrole('SuperAdmin|Admin|Seller'))
                        <!--Package Order Card -->
                        <div class="col-xxl-4 col-md-6">
                            <div class="card info-card sales-card">

                                <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start">
                                    <h6>Filter</h6>
                                    </li>

                                    <li><a class="dropdown-item" href="#">Today</a></li>
                                    <li><a class="dropdown-item" href="#">This Month</a></li>
                                    <li><a class="dropdown-item" href="#">This Year</a></li>
                                </ul>
                                </div>

                                <div class="card-body">
                                <h5 class="card-title">Total Package Orders <span>| Today</span></h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-cart"></i>
                                    </div>
                                    <div class="ps-3">
                                    <h6>{{ $totalPackages }}</h6>
                                    </div>
                                </div>
                                </div>

                            </div>
                            </div><!-- Order Card -->
                        <!-- Customers Card -->
                        <div class="col-xxl-4 col-xl-12">

                            <div class="card info-card customers-card">

                                <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start">
                                    <h6>Filter</h6>
                                    </li>

                                    <li><a class="dropdown-item" href="#">Today</a></li>
                                    <li><a class="dropdown-item" href="#">This Month</a></li>
                                    <li><a class="dropdown-item" href="#">This Year</a></li>
                                </ul>
                                </div>

                                <div class="card-body">
                                <h5 class="card-title">Customers <span>| Today</span></h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center"
                                        data-bs-toggle="tooltip" title="Total Customer">
                                    <i class="bi bi-people"></i>
                                    </div>
                                    <div class="ps-3">
                                    <h6>{{ $totalUsers }}</h6>

                                    </div>
                                </div>

                                </div>
                            </div>

                            </div><!-- End Customers Card -->
                        @endif

                    </div>
                </div><!-- End Left side columns -->
            </div>
        </section>
    </main>
@endsection
@push('scripts')
@endpush
