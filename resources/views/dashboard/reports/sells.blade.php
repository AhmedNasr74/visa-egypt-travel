@extends('layouts.dashboard.app')

@section('content')
    <div class="page-body">
        <!-- Container-fluid starts-->
        <x-dashboard.partials.breadcrumb title="Report Of Sells">
        </x-dashboard.partials.breadcrumb>
        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <x-dashboard.partials.message-alert />
                    <div class="card">
                        <div class="container">
                            <div class="date">
                                <form action="{{route('dashboard.sells')}}" method="get">
                                    @csrf
                                    <label for="from_date">From:</label>
                                    <input name="from_date" type="date" id="from_date">

                                    <label for="to_date">To:</label>
                                    <input name="to_date" type="date" id="to_date">

                                    <button class="btn btn-success" id="Date">Apply Filter</button>
                                </form>
                                </div>
                                <div>
                                    @if ($data)
                                    <h4>Total Sells</h4>
                                    <p>From:{{$data['from_date']}}   To::{{$data['to_date']}}</p>
                                    @else
                                    <h4>Total Sells</h4>
                                    @endif
                                </div>

                                    <div class="row">
                                        <h3>Total Amount</h3>
                                        <x-dashboard.partials.box-card permission="" title="Sells In AED" :count="$aedSum" icon="dollar-sign"
                                        color="warning" />
                                        <x-dashboard.partials.box-card permission="" title="Sells In EGP" :count="$egpSum" icon="dollar-sign"
                                        color="warning" />
                                    </div>
                                    <div class="row">
                                        <h3>Remaining Amount</h3>
                                        <x-dashboard.partials.box-card permission="" title="Remaining Amount In EGP" :count="$remain_egpSum" icon="dollar-sign"
                                        color="primary" />
                                        <x-dashboard.partials.box-card permission="" title="Remaining Amount In AED" :count="$remain_aedSum" icon="dollar-sign"
                                        color="primary" />
                                    </div>
                        </div>
                        </div>
                        {{-- <div class="">
                            {!! $dataTable->table(['class'=>'display']) !!}
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid Ends-->
    </div>
@endsection
@push('js')
<script>
$(document).ready(function () {
    $('#Date').click(function () {
        var fromDate = $('#from_date').val();
        var toDate = $('#to_date').val();
        console.log(fromDate , toDate)
        $('#data-table').DataTable().columns('date:name').search(fromDate + ',' + toDate).draw();
    });
});

</script>

@endpush
