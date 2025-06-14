@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Slider</h1>
        </div>
        <div class="card card-primary">
            <div class="card-header">
                <h4>Update Slider {{ $slider->id }}: {{ $slider->title }}</h4>

            </div>
            <div class="card-body">
                <form action="{{ route('admin.slider.update', $slider->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>Image</label>
                        <div id="image-preview" class="image-preview">
                            <label for="image-upload" id="image-label">Choose File</label>
                            <input type="file" name="image" id="image-upload" />
                            {{-- <img src="{{ $slider->image }}" alt="" class="img-fluid w-100"> --}}
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Offer</label>
                        <input type="text" name="offer" class="form-control" value="{{ $slider->offer }}">
                    </div>
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" name="title" class="form-control" value="{{ $slider->title }}">
                    </div>
                    {{--<div class="form-group">
                        <label>Sub Titlte</label>
                        <input type="text" name="sub_title" class="form-control" value="{{ $slider->sub_title }}">
                    </div>--}}
                    <div class="form-group">
                        <label>Short Description</label>
                        <textarea name="short_description" class="form-control">{{ $slider->short_description }}</textarea> {{-- textarea doesnt support value="" attribute --}}

                    </div>
                    {{--  <div class="form-group">
                        <label>Button Link</label>
                        <input type="text" name="button_link" class="form-control" value="{{ $slider->button_link }}">
                    </div>--}}
                    <div class="form-group">
                        <label>STATUS</label>
                        <select name="status" class="form-control" id="">
                            <option {{ $slider->status === 1 ? 'selected' : '' }} value="1">Active</option>
                            {{-- the curly brackets basically said if the 'status' equals 1 then add a selected class
                            vice versa for below (same output different ways of writing) --}}

                            {{-- also write true or false in @selected($slider->status === 0(false)) if using postgres, write 1 or 0 if
                            using mysql. --}}
                            <option @selected($slider->status === 0) value="0">Inactive</option>
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
                'background-image': 'url({{ asset($slider->image) }})',
                'background-size': 'cover',
                'background-position': 'center center'
            })
        })
    </script>
@endpush
