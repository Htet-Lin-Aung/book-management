@extends('layouts.app')

@section('content')
<main id="main" class="main">

    <div class="pagetitle">
      
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('admin.sale.index') }}"><h1>{{ trans('cruds.sale.title') }}</h1></a></li>
          <li class="breadcrumb-item active">{{ trans('cruds.sale.title_singular') }} {{ trans('global.create') }}</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="sale-table">
        <div class="card p-2">
            {{-- <div class="card-header">
                <h5>{{ trans('global.create') }} {{ trans('cruds.sale.title_singular') }}</h5>
            </div> --}}
            <div class="card-body p-2">
                <form action="{{ route('admin.sale.store') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12 col-sm-12 mb-2">
                            <div class="form-group">
                                <label class="required" for="customer_id">{{ trans('cruds.customer.title') }}</label>
                                <select name="customer_id" id="customer_id" class="form-control {{ $errors->has('customer_id') ? 'is-invalid' : '' }}" >
                                    <option value="" disabled selected>{{ trans('global.please_select') }}</option>
                                    @foreach ($customers as $customer)
                                        <option value="{{ $customer->id }}"{{ old('customer_id') ? 'selected' : '' }}>{{ $customer->name }}</option>
                                    @endforeach
                                </select>

                                @if($errors->has('customer_id'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('customer_id') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12 col-sm-12 mb-2">
                            <div class="form-group">
                                <label class="required" for="book_id">{{ trans('cruds.book.title') }}</label>
                                <select name="book_id" id="book_id" class="form-control {{ $errors->has('book_id') ? 'is-invalid' : '' }}" >
                                    <option value="" disabled selected>{{ trans('global.please_select') }}</option>
                                    @foreach ($books as $book)
                                        <option value="{{ $book->id }}"{{ old('book_id') ? 'selected' : '' }} price="{{ $book->price }}">{{ $book->name }} ({{ $book->price }} MMK)</option>
                                    @endforeach
                                </select>

                                @if($errors->has('book_id'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('book_id') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <input type="hidden" id="price" name="price" />
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12 col-sm-12 mb-2">
                            <div class="form-group">
                                <label class="required" for="quantity">{{ trans('cruds.sale.quantity') }}</label>
                                <input type="number" name="quantity" id="quantity" value="{{ old('quantity') }}" class="form-control {{ $errors->has('quantity') ? 'is-invalid' : '' }}">
                                @if($errors->has('quantity'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('quantity') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12 col-sm-12 mb-2">
                            <div class="form-group">
                                <label class="required" for="discount">{{ trans('cruds.sale.discount') }}</label>
                                <input type="number" name="discount" id="discount" value="{{ old('discount') }}" class="form-control {{ $errors->has('discount') ? 'is-invalid' : '' }}">
                                @if($errors->has('discount'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('discount') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12 col-sm-12 mb-2">
                            <div class="form-group">
                                <label class="required" for="total">{{ trans('cruds.sale.total') }}</label>
                                <input type="number" name="total" value="{{old('total')}}" id="total" placeholder="price * quantity" class="form-control {{ $errors->has('total') ? 'is-invalid' : '' }}" >
                                @if($errors->has('total'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('total') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12 col-sm-12 mb-2">
                            <div class="form-group">
                                <label class="required" for="paid">{{ trans('cruds.sale.paid') }}</label>
                                <input type="number" name="paid" id="paid" value="{{old('paid')}}" class="form-control {{ $errors->has('paid') ? 'is-invalid' : '' }}" >
                                @if($errors->has('paid'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('paid') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div style="float: right">
                                <a class="btn btn-secondary btn-sm float-right" href="{{ route('admin.sale.index') }}">{{ trans('global.cancel') }}</a>
                                <button type="submit" class="btn btn-success btn-sm float-right">{{ trans('global.save') }}</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

  </main><!-- End #main -->

@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('#book_id').on('change', function() {
            $('#price').val($('#book_id option:selected').attr('price'));
            var price = document.getElementById('price').value;
            var quantity = document.getElementById('quantity').value;
            $('#total').val(price * quantity);
        });

        $('#quantity').on('input', function() {
            var price = document.getElementById('price').value;
            var quantity = document.getElementById('quantity').value;
            $('#total').val(price * quantity);
        });

        $('#discount').on('input', function() {
            var discount = document.getElementById('discount').value;
            var total = document.getElementById('total').value;
            $('#paid').val(total - discount);
        });

        $('#customer_id').select2({
            placeholder: '{{ trans('global.please_select') }}', // Placeholder text
            allowClear: true, // Allow clearing the selection
            width: '100%', // Set the width as needed
        });
        $('#book_id').select2({
            placeholder: '{{ trans('global.please_select') }}', // Placeholder text
            allowClear: true, // Allow clearing the selection
            width: '100%', // Set the width as needed
        });
    });
</script>
@endsection