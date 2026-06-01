@extends('layouts.dashboard.app')

@section('content')
    <div class="page-body">
        <!-- Container-fluid starts-->
        <x-dashboard.partials.breadcrumb title="Report Of Top Selling">
        </x-dashboard.partials.breadcrumb>
        <!-- Container-fluid Ends-->

        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <x-dashboard.partials.message-alert />
                    <div class="card">
                       <div class="row">

                              <form action="{{route('dashboard.tours-search')}}" method="get">
                                @csrf
                                <label for="from_date">From:</label>
                                <input name="from_date" type="date" id="from_date">

                                <label for="to_date">To:</label>
                                <input name="to_date" type="date" id="to_date">

                                <button class="btn btn-success" id="Date">Apply Filter</button>
                                <select name="tourType">
                                    <option value="tour" selected>Tour</option>
                                    <option value="tourCategory">Tour Category</option>
                                </select>
                            </form>
                            @if ($tours)


                        <div class="col-xl-12 xl-100">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Top Selling Tours</h5>
                                </div>
                                <div class="card-body">
                                    <div class="user-status table-responsive latest-order-table">
                                        <table class="table table-bordernone">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Name</th>
                                                    <th scope="col">Start From Price</th>
                                                    <th scope="col">Count</th>
                                                    <th scope="col">Created At</th>
                                                    @can('tours.show')
                                                        <th scope="col"></th>
                                                    @endcan
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($tours as $tour)
                                                    <tr>
                                                        <td>{{ $tour->title }}</td>
                                                        <td class="digits">{{ number_format($tour->start_from_price, 2) }}</td>
                                                        <td class="digits">{{ $tour_count[$tour->id] }}</td>
                                                        @if ($tour->created_at)
                                                            <td class="digits">{{ $tour->created_at->format('M Y, d') }}</td>
                                                        @endif

                                                        @can('tours.show')
                                                            <td class="digits"><a
                                                                    href="{{  route('site.tour_details', $tour->slug)}}">View</a>
                                                            </td>
                                                        @endcan
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="4">No tours Found</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>

                                        <a href="{{ route('dashboard.tours.index') }}" class="btn btn-primary mt-4">View All
                                            tours</a>
                                    </div>

                                </div>
                            </div>
                        </div>
                        @endif
@if ($categories)

                <div class="col-xl-12 xl-100">
                    <div class="card">
                        <div class="card-header">
                            <h5>Top Selling Categories</h5>
                        </div>
                        <div class="card-body">
                            <div class="user-status table-responsive latest-order-table">
                                <table class="table table-bordernone">
                                    <thead>
                                        <tr>
                                            <th scope="col">Name</th>
                                            <th scope="col">Featured Image</th>
                                            <th scope="col">Count</th>
                                            <th scope="col">Created At</th>
                                            @can('bookings.show')
                                                <th scope="col"></th>
                                            @endcan
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @forelse($categories as $category)
                                            <tr>
                                                <td>{{ $category->title }}</td>
                                                <td class="digits">
                                                    <div style="width: 50px; height:50px">
                                                        <img src="{{$category->featured_image}}" alt="">
                                                    </div>
                                                </td>
                                                <td class="digits">{{ $cat_count[$category->id] }}</td>
                                                @if ($category->created_at)
                                                    <td class="digits">{{ $category->created_at->format('M Y, d') }}</td>
                                                @endif
                                                    <td class="digits"><a
                                                            href="{{ route('dashboard.categories.edit', $category->id) }}">View</a>
                                                    </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4">No Categories Found</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>

                                <a href="{{ route('dashboard.categories.index') }}" class="btn btn-primary mt-4">View All
                                    categories</a>
                            </div>

                        </div>
                    </div>
                </div>
                @endif

                       </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid Ends-->
    </div>
@endsection
