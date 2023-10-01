@extends('layouts.app')

@section('content')
<main id="main" class="main">

    <div class="pagetitle">
      <h1>{{ trans('cruds.report.title') }}</h1>
    </div><!-- End Page Title -->

    <section class="report-table">
        <div class="card p-2">

                <div class="row mb-2">
                    <div class="col-md-4">
                        <form action="{{ route('admin.report.search') }}" method="GET">
                            <div class="input-group">
                               <input type="text" id="search" name="search" class="form-control" placeholder="Search report" value="{{ $key ?? '' }}" />
                                <button class="btn btn-outline-primary" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                            </div>
                        </form>
                    </div>
                </div>

            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                    <th>{{ trans('global.no') }}</th>
                    <th>{{ trans('cruds.customer.title_singular') }}</th>
                    <th>{{ trans('cruds.sale.quantity') }}</th>
                    <th>{{ trans('cruds.sale.discount') }}</th>
                    <th>{{ trans('cruds.sale.total') }}</th>
                    <th>{{ trans('cruds.sale.paid') }}</th>
                    </thead>
                    <tbody>
                        @forelse ($reports as $index => $report)
                            <tr id="row{{ $report->id }}">
                                <td>{{ $index+1 }}</td>
                                <td>{{ $report->customer->name }}</td>
                                <td>{{ $report->quantity }}</td>
                                <td>{{ $report->discount }}</td>
                                <td>{{ $report->total }}</td>
                                <td>{{ $report->paid }}</td>
                            </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">
                                {{ trans('global.no_data_found') }}
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="row mt-2">
                <div class="col-md-12">
                    <div style="float:right">
                        {{ $reports->appends(request()->input())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>

  </main><!-- End #main -->

@endsection
