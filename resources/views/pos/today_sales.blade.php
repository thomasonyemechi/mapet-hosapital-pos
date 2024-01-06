@extends('layout.app')
@section('page_title')
    Add Item
@endsection

@section('page_content')
    <div class="row">
        <div class="col-lg-3 col-md-3 col-12">
            <div class="card mb-4">
                <div class="card-body py-4">
                    <form action="" method="get">
                        <div class="form-group">
                            <label for="">Select Date</label>
                            <input type="date" name="date" class="form-control" onchange="submit()">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-12 col-12">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-3 lh-1">
                        <div>
                            <span class="fs-6 text-uppercase fw-semi-bold">Sales</span>
                        </div>
                        <div>
                            <span class=" fe fe-dollar-sign fs-3 text-primary"></span>
                        </div>
                    </div>
                    <h2 class="fw-bold mb-1">
                        {{ $total_sales }}
                    </h2>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-12 col-12">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-3 lh-1">
                        <div>
                            <span class="fs-6 text-uppercase fw-semi-bold">Today's Sales</span>
                        </div>
                        <div>
                            <span class=" fe fe-dollar-sign fs-3 text-primary"></span>
                        </div>
                    </div>
                    <h2 class="fw-bold mb-1">
                        0
                    </h2>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-md-12 col-12">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-3 lh-1">
                        <div>
                            <span class="fs-6 text-uppercase fw-semi-bold">Money In</span>
                        </div>
                        <div>
                            <span class=" fe fe-dollar-sign fs-3 text-primary"></span>
                        </div>
                    </div>
                    <h2 class="fw-bold mb-1">
                        {{ money($amount) }}
                    </h2>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <div class="card mt-3">
                <div class="card-body">
                    <h4 class="fw-bold"> <i class="fe fe-list"> </i> Sales List (<?= $day ?>)</h4>
                    <table class="table table-sm mt-2  ">
                        <tr>
                            <th>Receipt</th>
                            <th>items</th>
                            <th></th>
                            <th>Total</th>
                            <th>Customer</th>
                            <th>Date</th>
                            <th></th>
                        </tr>

                        @php
                            $balance = 0;
                            $tot = 0;
                            $ad = 0;
                        @endphp


                        @foreach ($sales as $sum)
                            @php
                                $tot += $sum['total'];
                            @endphp
                            <tr class="py-4" >
                                <td class="align-middle"> # {{ $sum->id }} </td>
                                <td colspan="2" class="align-middle">
                                    <ul style="margin-bottom: 0px;">
                                        @foreach ($sum->sales as $item)
                                            <li>
                                                {{ $item->item->name }}
                                                <span style="font-weight: bolder;">
                                                    {{ $item->quantity }} x {{ $item->price }}
                                                </span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td class="align-middle">{{ money($sum->total) }}</td>
                                <td class="align-middle">{{ $sum->customer->phone }}</td>
                                <td class="align-middle">
                                    {{ $sum->created_at }}
                                </td>
                                <td class="align-middle">
                                    <button class="btn btn-xs px-1 print_here py-0 btn-primary">
                                        <i class="fe fe-printer"> </i> </button>
                                </td>
                            </tr>
                            <tr>
                                <th colspan="3"></th>
                                <th><?= money($tot) ?></th>
                                <th colspan="2"></th>
                                <th colspan="4" ></th>
                            </tr>
                        @endforeach

                    </table>

                </div>
            </div>
        </div>
    </div>
@endsection


@push('scripts')
@endpush
