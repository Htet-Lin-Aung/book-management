@extends('layouts.app')

@section('content')
<main id="main" class="main">

    <div class="pagetitle">
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('admin.book.index') }}"><h1>{{ trans('cruds.book.title') }}</h1></a></li>
          <li class="breadcrumb-item active">{{ trans('cruds.book.title_singular') }} {{ trans('global.update') }}</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="book-table">
        <div class="card p-2">
            <div class="card-body p-2">
                <form action="{{ route('admin.book.update', $book) }}" method="post">
                    @method('PUT')
                    @csrf
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12 col-sm-12 mb-2">
                            <div class="form-group">
                                <label class="required" for="name">{{ trans('global.name') }}</label>
                                <input type="text" name="name" id="name" value="{{ old('name', $book->name) }}" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}">
                                @if($errors->has('name'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('name') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12 col-sm-12 mb-2">
                            <div class="form-group">
                                <label class="required" for="author">{{ trans('cruds.book.author') }}</label>
                                <input type="text" name="author" id="author" value="{{ old('author', $book->author) }}" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}">
                                @if($errors->has('author'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('author') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12 col-sm-12 mb-2">
                            <div class="form-group">
                                <label class="required" for="category_id">{{ trans('cruds.category.title') }}</label>
                                <select name="category_id" id="category_id" class="form-control {{ $errors->has('category_id') ? 'is-invalid' : '' }}">
                                    <option value="" disabled>{{ trans('global.please_select') }}</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"{{$category->id == $book->category_id ? 'selected' : ''}}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('category_id'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('category_id') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12 col-sm-12 mb-2">
                            <div class="form-group">
                                <label class="required" for="price">{{ trans('cruds.book.price') }}</label>
                                <input type="number" name="price" id="price" value="{{ $book->price }}" class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}">
                                @if($errors->has('price'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('price') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div style="float: right">
                                <a class="btn btn-secondary btn-sm float-right" href="{{ route('admin.book.index') }}">{{ trans('global.cancel') }}</a>
                                <button type="submit" class="btn btn-success btn-sm float-right">{{ trans('global.update') }}</button>
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
        $('#category_id').select2({
            placeholder: '{{ trans('global.please_select') }}', // Placeholder text
            allowClear: true, // Allow clearing the selection
            width: '100%', // Set the width as needed
        });
    });
</script>
@endsection