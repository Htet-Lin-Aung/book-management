@extends('layouts.app')

@section('content')
<main id="main" class="main">

    <div class="pagetitle">
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('admin.sale.index') }}"><h1>{{ trans('cruds.sale.title') }}</h1></a></li>
          <li class="breadcrumb-item active">{{ trans('cruds.sale.title_singular') }} {{ trans('global.show') }}</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="sale-table">
        <div class="card p-2">
            <table class="table">
                <tbody>
                    <tr>
                        <th>{{ trans('cruds.customer.title_singular') }}</th>
                        <td>{{ $sale->customer->name }}</td>
                    </tr>
                    <tr>
                        <th>{{ trans('cruds.sale.title_singular') }}</th>
                        <td>{{ $sale->book->name }}</td>
                    </tr>
                    <tr>
                        <th>{{ trans('cruds.sale.quantity') }}</th>
                        <td>{{ $sale->quantity }}</td>
                    </tr>
                    <tr>
                    <th>{{ trans('cruds.sale.discount') }}</th>
                        <td>{{ $sale->discount }}</td>
                    </tr>
                    <tr>
                        <th>{{ trans('cruds.sale.total') }}</th>
                        <td>{{ $sale->total }}</td>
                    </tr>
                    <tr>
                        <th>{{ trans('cruds.sale.paid') }}</th>
                        <td>{{ $sale->paid }}</td>
                    </tr>
                    <tr>
                        <th>{{ trans('global.created_at') }}</th>
                        <td>{{ $sale->created_at->format('d-m-Y | h:i:s') }}</td>
                    </tr>
                </tbody>
            </table>
            <div class="row">
                <div class="col-md-12">
                    <div style="float: right">
                        <a class="btn btn-secondary btn-sm float-right" href="{{ route('admin.sale.index') }}">{{ trans('global.back_to_list') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

  </main><!-- End #main -->

@endsection
