@extends('layouts.master')
@section('title', 'This Week')

@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <?php
                            $date_time = strtotime(\Carbon\Carbon::now()->startOfWeek());
                            $not_date = date('d M y, D', $date_time);

                            $date_time_two = strtotime(\Carbon\Carbon::now()->endOfWeek());
                            $not_date_two = date('d M y, D', $date_time_two);
                        ?>
                        <h4 class="mb-sm-0 font-size-18">This Week: <span class="text-primary"> {{ $not_date }} - {{ $not_date_two }}</span></h4>
                        
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xl-4">
                    <div class="card">
                        <!-- HTML -->
                        <div id="chartdiv" data-cheque="{{ $transaction_cheque }}" data-wire="{{ $transaction_wire }}"></div>
                    </div>
                            
                </div>

                <div class="col-xl-8">
                    <div class="row" style="margin-top: -40px;">
                        <div class="col-md-4"></div>
                        <div class="col-md-4">
                            <span class="badge bg-dark font-size-12">Transaction History <i class="bx bx-caret-down"></i></span><br><br>
                        </div>
                        <div class="col-md-4"></div>
                    </div>

                    <div class="row">

                        <div class="col-md-4">
                            <div class="card mini-stats-wid">
                                <div class="card-body">
                                    <div class="media">
                                        <div class="media-body">
                                            <p class="text-muted fw-medium">All Transactions</p>
                                            <h4 class="mb-0">{{ $all_transactions->count() }}</h4>
                                        </div>

                                        <div class="mini-stat-icon avatar-sm rounded-circle bg-primary align-self-center">
                                            <span class="avatar-title">
                                                <i class="bx bx-copy-alt font-size-24"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card mini-stats-wid">
                                <div class="card-body">
                                    <div class="media">
                                        <div class="media-body">
                                            <p class="text-muted fw-medium">Cheque</p>
                                            <h4 class="mb-0">{{ $transaction_cheque }}</h4>
                                        </div>

                                        <div class="avatar-sm rounded-circle bg-primary align-self-center mini-stat-icon">
                                            <span class="avatar-title rounded-circle bg-primary">
                                                <i class="bx bx-archive-in font-size-24"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card mini-stats-wid">
                                <div class="card-body">
                                    <div class="media">
                                        <div class="media-body">
                                            <p class="text-muted fw-medium">Wire</p>
                                            <h4 class="mb-0">{{ $transaction_wire }}</h4>
                                        </div>

                                        <div class="avatar-sm rounded-circle bg-primary align-self-center mini-stat-icon">
                                            <span class="avatar-title rounded-circle bg-primary">
                                                <i class="bx bx-purchase-tag-alt font-size-24"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- end row -->
                    <div class="row">
                        <div class="col-md-4"></div>
                        <div class="col-md-4">
                            <span class="badge bg-dark font-size-12">Amount History <i class="bx bx-caret-down"></i></span><br><br>
                        </div>
                        <div class="col-md-4"></div>
                    </div>

                    <div class="row">

                        <div class="col-md-4">
                            <div class="card mini-stats-wid">
                                <div class="card-body">
                                    <div class="media">
                                        <div class="media-body">
                                            <p class="text-muted fw-medium">Total</p>
                                            <h4 class="mb-0">${{ $total_amount }}</h4>
                                        </div>

                                        <div class="mini-stat-icon avatar-sm rounded-circle bg-primary align-self-center">
                                            <span class="avatar-title">
                                                <i class="bx bx-copy-alt font-size-24"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card mini-stats-wid">
                                <div class="card-body">
                                    <div class="media">
                                        <div class="media-body">
                                            <p class="text-muted fw-medium">Cheque</p>
                                            <h4 class="mb-0">${{ $cheque_amount }}</h4>
                                        </div>

                                        <div class="avatar-sm rounded-circle bg-primary align-self-center mini-stat-icon">
                                            <span class="avatar-title rounded-circle bg-primary">
                                                <i class="bx bx-archive-in font-size-24"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card mini-stats-wid">
                                <div class="card-body">
                                    <div class="media">
                                        <div class="media-body">
                                            <p class="text-muted fw-medium">Wire</p>
                                            <h4 class="mb-0">${{ $wire_amount }}</h4>
                                        </div>

                                        <div class="avatar-sm rounded-circle bg-primary align-self-center mini-stat-icon">
                                            <span class="avatar-title rounded-circle bg-primary">
                                                <i class="bx bx-purchase-tag-alt font-size-24"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="theme_value" data-theme="{{ Auth::user()->theme }}"></div>
                    </div>

                </div>
            </div>
            <!-- end row -->


            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Transactions (This Week)</h4>
                            <div class="table-responsive">
                                <table class="table align-middle table-nowrap mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th style="width: 20px;">
                                                SL
                                            </th>
                                            <th class="align-middle">Transaction ID</th>
                                            <th class="align-middle">Date</th>
                                            <th class="align-middle">Customer Name</th>
                                            <th class="align-middle">Amount</th>
                                            <th class="align-middle">Method</th>
                                            <th class="align-middle">View Details</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        @if($latest_transactions->count() > 0)
                                            @foreach($latest_transactions as $key => $latest_transaction)
                                            <tr>
                                                <td>
                                                    {{ $key + 1 }}
                                                </td>
                                                <td><span class="text-body fw-bold">{{ $latest_transaction->transaction_id }}</span>
                                                </td>
                                                <td>
                                                    <?php
                                                        $date_time = strtotime($latest_transaction->created_at);
                                                        $not_date = date('d M, Y', $date_time);
                                                    ?>
                                                    {{ $not_date }}
                                                </td>
                                            <?php 
                                                $find_cus = \App\Models\Customer::find($latest_transaction->customer_id);
                                            ?>

                                                <td id="tooltip-container">
                                                    <span data-bs-container="#tooltip-container" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{ $find_cus->name }}">{{ substr(strip_tags($find_cus->name), 0, 12) . '...' }}</span>
                                                </td>
                                                
                                                <td>
                                                    ${{ $latest_transaction->amount }}
                                                </td>

                                                <td>
                                                    @if($latest_transaction->type == 'cheque') 
                                                        <i class="far fa-credit-card"></i> Cheque
                                                    @else
                                                        <i class="far fa-money-bill-alt"></i> Wire Money
                                                    @endif
                                                </td>
                                                <td>
                                                    <!-- Button trigger modal -->
                                                    <a href="{{ route('transaction.manage', $latest_transaction->transaction_id) }}" class="btn btn-primary btn-sm btn-rounded waves-effect waves-light">
                                                        View Details
                                                    </a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                               <td class="text-center" style="border-bottom: 0;">No transaction has been done yet! </td> 
                                            </tr>
                                            
                                        @endif  
                                    </tbody>
                                </table>
                            </div>
                            <!-- end table-responsive -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

    <!-- end main content-->
@endsection

@section('scripts')

    <!-- Chart code -->
    <script>
        am4core.ready(function() {

            // Themes begin
            var selected_theme = $("#theme_value").attr("data-theme");
            
            if(selected_theme == 'default'){
                am4core.useTheme(am4themes_dataviz);
            } else {
                am4core.useTheme(am4themes_dark);
            }

            am4core.useTheme(am4themes_animated);
            // Themes end

            // Create chart instance
            var chart = am4core.create("chartdiv", am4charts.PieChart);

            // Add and configure Series
            var pieSeries = chart.series.push(new am4charts.PieSeries());
            pieSeries.dataFields.value = "values";
            pieSeries.dataFields.category = "key";

            // Let's cut a hole in our Pie chart the size of 30% the radius
            chart.innerRadius = am4core.percent(30);

            // Put a thick white border around each Slice
            pieSeries.slices.template.stroke = am4core.color("#fff");
            pieSeries.slices.template.strokeWidth = 2;
            pieSeries.slices.template.strokeOpacity = 1;
            pieSeries.slices.template
            // change the cursor on hover to make it apparent the object can be interacted with
            .cursorOverStyle = [
                {
                  "property": "cursor",
                  "value": "pointer"
                }
            ];

            pieSeries.alignLabels = false;
            pieSeries.labels.template.bent = true;
            pieSeries.labels.template.radius = 3;
            pieSeries.labels.template.padding(0,0,0,0);

            pieSeries.ticks.template.disabled = true;

            // Create a base filter effect (as if it's not there) for the hover to return to
            var shadow = pieSeries.slices.template.filters.push(new am4core.DropShadowFilter);
            shadow.opacity = 0;

            // Create hover state
            var hoverState = pieSeries.slices.template.states.getKey("hover"); // normally we have to create the hover state, in this case it already exists

            // Slightly shift the shadow and make it more prominent on hover
            var hoverShadow = hoverState.filters.push(new am4core.DropShadowFilter);
            hoverShadow.opacity = 0.7;
            hoverShadow.blur = 5;

            // Add a legend
            chart.legend = new am4charts.Legend();
            
            chart.data = [{
                  "key": "Wire Money",
                  "values": $("#chartdiv").attr("data-wire"),
                },{
                  "key": "Cheque",
                  "values": $("#chartdiv").attr("data-cheque"),
                },
            ];

        }); // end am4core.ready()
    </script>
@endsection
