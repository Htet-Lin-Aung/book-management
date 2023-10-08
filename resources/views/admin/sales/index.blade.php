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
      <h1>{{ trans('cruds.sale.title') }}</h1>
    </div><!-- End Page Title -->

    <section class="sale-table">
        <div class="card p-2">

                <div class="row mb-2">
                    <div class="col-md-4">
                        <form action="{{ route('admin.sale.search') }}" method="GET">
                            <div class="input-group">
                               <input type="text" id="search" name="search" class="form-control" placeholder="Search Sale" value="{{ $key ?? '' }}" />
                                <button class="btn btn-outline-primary" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-8">
                        <div class="d-flex" style="float:right">
                            @can('sale_create')
                            <a class="btn btn-primary" href="{{ route('admin.sale.create') }}">
                                <i class="fa-solid fa-plus"></i> {{ trans('global.add') }} {{ trans('global.new') }} {{ trans('cruds.sale.title_singular') }}
                            </a>
                            @endcan
                        </div>
                    </div>
                </div>

            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                    <th>{{ trans('global.no') }}</th>
                    <th>{{ trans('cruds.customer.title_singular') }}</th>
                    <th>{{ trans('cruds.book.title_singular') }}</th>
                    <th>{{ trans('cruds.sale.quantity') }}</th>
                    <th>{{ trans('cruds.sale.discount') }}</th>
                    <th>{{ trans('cruds.sale.paid') }}</th>
                    <th>{{ trans('cruds.sale.total') }}</th>
                    <th>{{ trans('cruds.sale.due') }}</th>
                    <th>{{ trans('global.actions') }}</th>
                    </thead>
                    <tbody>
                        @forelse ($sales as $index => $sale)
                            <tr id="row{{ $sale->id }}">
                                <td>{{ $index+1 }}</td>
                                <td>{{ $sale->customer->name }}</td>
                                <td>{{ $sale->book->name }}</td>
                                <td>{{ $sale->quantity }}</td>
                                <td>{{ $sale->discount }}</td>
                                <td>{{ $sale->paid }}</td>
                                <td>{{ $sale->total }}</td>
                                <td>{{ $sale->created_at->format('d-m-Y | h:i:s A') }}</td>
                                <td>
                                    <div class="d-flex">
                                        @can('sale_show')
                                            <a href="{{ route('admin.sale.show', $sale) }}" class="pe-3" title="Sale Details">
                                                <i class="fa-regular fa-eye"></i>
                                            </a>
                                        @endcan
                                        @can('sale_edit')
                                            <a href="{{ route('admin.sale.edit', $sale) }}" class="pe-3" title="Edit Sale Details">
                                                <i class="fa-regular fa-pen-to-square text-success"></i>
                                            </a>
                                        @endcan
                                        @can('sale_delete')
                                        <form action="{{ route('admin.sale.destroy', $sale) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <a class="pe-3 delete text-danger" title="Delete Sale">
                                                <i class="fa-solid fa-trash"></i>
                                            </a>
                                        </form>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center">
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
                        {{ $sales->appends(request()->input())->links() }}
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
