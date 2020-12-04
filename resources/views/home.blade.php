@extends('layouts.app')
@section('css')
    <style>

    </style>
@endsection
@section('content')
<div class="container">

    
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4 wow fadeInLeft">
          <div class=" border-left-primary shadow h-100 py-2 grey_border_class">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Anonymus Links</div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800">{{App\Share::all()->count()}}</div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-link fa-2x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4 wow fadeIn">
          <div class=" border-left-success shadow h-100 py-2 grey_border_class">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Clients</div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800">{{App\User::where('userrole_id','2')->get()->count()}}</div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-user-tie fa-2x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4 wow fadeIn">
          <div class="border-left-info shadow h-100 py-2 grey_border_class">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Projects</div>
                  <div class="row no-gutters align-items-center">
                    <div class="col-auto">
                      <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{App\Project::all()->count()}}</div>
                    </div>
                    {{-- <div class="col">
                      <div class="progress progress-sm mr-2">
                        <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                    </div> --}}
                  </div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-tasks fa-2x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4 wow fadeInRight">
          <div class="border-left-warning shadow h-100 py-2 grey_border_class">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Leads</div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800">{{App\Review::all()->count()}}</div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-comments fa-2x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      
    {{-- <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div> --}}
</div>
@endsection
