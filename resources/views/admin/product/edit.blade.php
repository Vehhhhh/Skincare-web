@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Product</h1>
        </div>

        <div class="card card-primary">
            <div class="card-header">
                <h4>Update Product</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>Image</label>
                        <div id="image-preview" class="image-preview">
                            <label for="image-upload" id="image-label">Choose File</label>
                            <input type="file" name="image" value="{{ old('image') }}" id="image-upload" />
                        </div>
                    </div>
                    {{-- //use old when got any kind of error of fields it will not remove old input --}}
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name" value="{{ $product->name }}">
                    </div>

                    <div class="form-group">
                        <label>Category</label>
                        <select name="category" class="form-control select2">
                            <option>select</option>
                            @foreach ($categories as $category)
                                <option @selected($product->category_id === $category->id) value="{{ $category->id }}">
                                    {{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Price</label>
                        <input type="text" class="form-control" name="price" value="{{ $product->price }}">
                    </div>

                    <div class="form-group">
                        <label>Offer Price</label>
                        <input type="text" class="form-control" name="offer_price" value="{{ $product->offer_price }}">
                    </div>

                    <div class="form-group">
                        <label>Quantity</label>
                        <input type="text" class="form-control" name="quantity" value="{{ $product->quantity }}">
                    </div>

                    <div class="form-group">
                        <label>Short Description</label>
                        <textarea class="form-control" name="short_description" id="">{!! $product->short_description !!}</textarea>
                    </div>

                    <div class="form-group">
                        <label>Long Description</label>
                        <textarea class="form-control summernote" name="long_description" id="">{!! $product->long_description !!}</textarea>
                    </div>

                    {{--<div class="form-group">
                        <label>Sku</label>
                        <input type="text" class="form-control" name="sku" value="{{ $product->sku }}">
                    </div>--}}

                    {{--<div class="form-group">
                        <label>Seo Title</label>
                        <input type="text" class="form-control" name="seo_title" value="{{ $product->seo_title }}">
                    </div>--}}

                    {{--<div class="form-group">
                        <label>Seo Description</label>
                        <textarea class="form-control" name="seo_description">{{ $product->seo_description }}</textarea>
                    </div>--}}

                    <div class="form-group">
                        <label>Show at Home</label>
                        <select name="show_at_home" class="form-control">
                            <option @selected($product->show_at_home) value="1">Yes</option>
                            <option @selected($product->show_at_home) value="0">No</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            <option @selected($product->status === 1) value="1">Active</option>
                            <option @selected($product->status === 0) value="0">Inactive</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>

                </form>
            </div>
        </div>


    </section>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.image-preview').css({
                'background-image': 'url({{ asset($product->thumbnail) }})',
                'background-size': 'cover',
                'background-position': 'center center'
            })
        })
    </script>
@endpush
