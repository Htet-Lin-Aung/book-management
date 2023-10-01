@extends('layouts.app')

@section('styles')
{{-- sweet alert --}}
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css" rel="stylesheet">
<style>
.delete{
    cursor: pointer;
}
</style>
@endsection
@section('content')
<main id="main" class="main">

    <div class="pagetitle">
      <h1>{{ trans('cruds.customer.title') }}</h1>
    </div><!-- End Page Title -->

    <section class="customer-table">
        <div class="card p-2">

                <div class="row mb-2">
                    <div class="col-md-4">
                        <form action="{{ route('admin.customer.search') }}" method="GET">
                            <div class="input-group">
                               <input type="text" id="search" name="search" class="form-control" placeholder="Search Customer" value="{{ $key ?? '' }}" />
                                <button class="btn btn-outline-primary" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-8">
                        <div class="d-flex" style="float:right">
                            @can('customer_create')
                            <a class="btn btn-primary" href="{{ route('admin.customer.create') }}">
                                <i class="fa-solid fa-plus"></i> {{ trans('global.add') }} {{ trans('global.new') }} {{ trans('cruds.customer.title_singular') }}
                            </a>
                            @endcan
                        </div>
                    </div>
                </div>

            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                    <th>{{ trans('global.no') }}</th>
                    <th>{{ trans('global.name') }}</th>
                    <th>{{ trans('global.email') }}</th>
                    <th>{{ trans('global.created_at') }}</th>
                    <th>{{ trans('global.actions') }}</th>
                    </thead>
                    <tbody>
                        @forelse ($customers as $index => $customer)
                            <tr id="row{{ $customer->id }}">
                                <td>{{ $index+1 }}</td>
                                <td>{{ $customer->name }}</td>
                                <td>{{ $customer->email }}</td>
                                <td>{{ $customer->created_at->format('d-m-Y | h:i:s') }}</td>
                                <td>
                                    <div class="d-flex">
                                        @can('customer_show')
                                            <a href="{{ route('admin.customer.show', $customer) }}" class="pe-3" title="Customer Details">
                                                <i class="fa-regular fa-eye"></i>
                                            </a>
                                        @endcan
                                        @can('customer_edit')
                                            <a href="{{ route('admin.customer.edit', $customer) }}" class="pe-3" title="Edit Customer Details">
                                                <i class="fa-regular fa-pen-to-square text-success"></i>
                                            </a>
                                        @endcan
                                        @can('customer_delete')
                                        <form action="{{ route('admin.customer.destroy', $customer) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <a class="pe-3 delete text-danger" title="Delete Customer">
                                                <i class="fa-solid fa-trash"></i>
                                            </a>
                                        </form>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">
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
                        {{ $customers->appends(request()->input())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>

  </main><!-- End #main -->

@endsection

@section('scripts')
{{-- sweet alert --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js"></script>
<script>
$('.delete').on('click', function(){
    Swal.fire({
        title: 'Warning!',
        text: 'Do you really want to delete?',
        icon: 'warning',
        confirmButtonText: 'Yes',
        showCancelButton: true,
    }).then((result) => {
        if(result.isConfirmed){
            $(this).parent().submit()
        }
    })
})
</script>
@endsection
