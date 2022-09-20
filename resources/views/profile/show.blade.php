@extends('layouts.master')
@section('title', 'Update Profile')

@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">Update Profile</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Update Profile</li>
                            </ol>
                        </div>
                        
                    </div>
                </div>
            </div>   
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    
                    <x-app-layout>
                        <div>
                            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                                @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                                    @livewire('profile.update-profile-information-form')
                                    <x-jet-section-border />
                                @endif

                                @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                                    <div class="mt-10 sm:mt-0">
                                        @livewire('profile.update-password-form')
                                    </div>

                                    <x-jet-section-border />
                                @endif

                                <div class="mt-10 sm:mt-0">
                                    @livewire('profile.logout-other-browser-sessions-form')
                                </div>
                            </div>
                        </div>
                    </x-app-layout>
                        
                </div>
            </div>
            
        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

    <!-- end main content-->
@endsection

@if(url()->current() == url('/user/profile'))
    @section('styles')
        <style>
            .logo-lg img {
                display: initial !important;
                width: 87px !important;
                height: 17px !important;
            }
        </style>
    @endsection
@endif