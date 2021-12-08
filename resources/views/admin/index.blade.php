@extends('layouts.admin')

@section('title','Панель')

@section('content')

<div class="page-content">

                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-xl-8">
                                <div class="row">
                                    <div class="col-lg-12">
                                    <h2>{{Auth::user()->role_id==1 ? 'Адиминистратор' :  'Модератор'}}</h2>
                                    </div><div class="col-lg-12">
                                    <h4>{{$ministry}}</h4>
                                    </div>
                                    <!-- <h4>{{Auth::user()->role_id==1 ? 'Адиминистратор' :  'Модератор'}}</h4>     -->
                                    <!-- <div class="col-md-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="media">
                                                    <div class="media-body overflow-hidden">
                                                        <p class="text-truncate font-size-14 mb-2">Number of Sales</p>
                                                        <h4 class="mb-0">1452</h4>
                                                    </div>
                                                    <div class="text-primary">
                                                        <i class="ri-stack-line font-size-24"></i>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="card-body border-top py-3">
                                                <div class="text-truncate">
                                                    <span class="badge badge-soft-success font-size-11"><i class="mdi mdi-menu-up"> </i> 2.4% </span>
                                                    <span class="text-muted ml-2">From previous period</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="media">
                                                    <div class="media-body overflow-hidden">
                                                        <p class="text-truncate font-size-14 mb-2">Sales Revenue</p>
                                                        <h4 class="mb-0">$ 38452</h4>
                                                    </div>
                                                    <div class="text-primary">
                                                        <i class="ri-store-2-line font-size-24"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body border-top py-3">
                                                <div class="text-truncate">
                                                    <span class="badge badge-soft-success font-size-11"><i class="mdi mdi-menu-up"> </i> 2.4% </span>
                                                    <span class="text-muted ml-2">From previous period</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="media">
                                                    <div class="media-body overflow-hidden">
                                                        <p class="text-truncate font-size-14 mb-2">Average Price</p>
                                                        <h4 class="mb-0">$ 15.4</h4>
                                                    </div>
                                                    <div class="text-primary">
                                                        <i class="ri-briefcase-4-line font-size-24"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body border-top py-3">
                                                <div class="text-truncate">
                                                    <span class="badge badge-soft-success font-size-11"><i class="mdi mdi-menu-up"> </i> 2.4% </span>
                                                    <span class="text-muted ml-2">From previous period</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div> -->
                                </div>
                                <!-- end row -->

                            </div>


                        </div>


                    </div> <!-- container-fluid -->
                </div>
@endsection
