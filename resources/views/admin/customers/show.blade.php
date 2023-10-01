@extends('layouts.app')

@section('content')
<main id="main" class="main">

    <div class="pagetitle">
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('admin.customer.index') }}"><h1>{{ trans('cruds.customer.title') }}</h1></a></li>
          <li class="breadcrumb-item active">{{ trans('cruds.customer.title_singular') }} {{ trans('global.show') }}</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="customer-table">
        <div class="card p-2">

            <table class="table">
                <tbody>
                    <tr>
                        <th>{{ trans('global.name') }}</th>
                        <td>{{ $customer->name }}</td>
                    </tr>
                    <tr>
                    <th>{{ trans('global.email') }}</th>
                        <td>{{ $customer->email }}</td>
                    </tr>
                    <tr>
                        <th>{{ trans('global.created_at') }}</th>
                        <td>{{ $customer->created_at->format('d-m-Y') }}</td>
                    </tr>
                </tbody>
            </table>
            <div class="row">
                <div class="col-md-12">
                    <div style="float: right">
                        <a class="btn btn-secondary btn-sm float-right" href="{{ route('admin.customer.index') }}">{{ trans('global.back_to_list') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

  </main><!-- End #main -->

@endsection
