@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Skincaare & Cosmetics</h1>
        </div>

        <div class="card card-primary">
            <div class="card-header">
                <h4>Create Skincaare & Cosmetics</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label>Image</label>
                        <div id="image-preview" class="image-preview" >
                            <label for="image-upload" id="image-label">Choose File</label>
                            <input type="file" name="image" value="{{ old('image') }}" id="image-upload" />
                        </div>
                    </div>
                    {{-- //use old when got any kind of error of fields it will not remove old input --}}
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                    </div>

                    <div class="form-group">
                        <label>Category</label>
                        <select name="category" class="form-control select2">
                            <option>select</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Price</label>
                        <input type="text" class="form-control" name="price" value="{{ old('price') }}">
                    </div>

                    <div class="form-group">
                        <label>Offer Price</label>
                        <input type="text" class="form-control" name="offer_price" value="{{ old('offer_price') }}">
                    </div>

                    <div class="form-group">
                        <label>Quantity</label>
                        <input type="text" class="form-control" name="quantity" value="{{ old('quantity') }}">
                    </div>

                    <div class="form-group">
                        <label>Short Description</label>
                        <textarea class="form-control" name="short_description">{{ old('short_description') }}</textarea>
                    </div>

                    <div class="form-group">
                        <label>Long Description</label>
                        <textarea class="form-control summernote" name="long_description">{{ old('long_description') }}</textarea>
                    </div>

                    {{--<div class="form-group">
                        <label>Sku</label>
                        <input type="text" class="form-control" name="sku" value="{{ old('sku') }}">
                    </div>--}}

                    {{--<div class="form-group">
                        <label>Seo Title</label>
                        <input type="text" class="form-control" name="seo_title" value="{{ old('seo_title') }}">
                    </div>--}}

                   {{--   <div class="form-group">
                        <label>Seo Description</label>
                        <textarea class="form-control" name="seo_description">{{ old('seo_description') }}</textarea>
                    </div>--}}

                    <div class="form-group">
                        <label>Show at Home</label>
                        <select name="show_at_home" class="form-control">
                            <option value="1">Yes</option>
                            <option selected value="0">No</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Create</button>

                </form>
            </div>
        </div>


    </section>
@endsection
