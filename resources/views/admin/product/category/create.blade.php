@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Category</h1>
        </div>
        <div class="card card-primary">
            <div class="card-header">
                <h4>Create Category</h4>

            </div>
            <div class="card-body">
                <form action="{{ route('admin.category.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf


                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Show At Home</label>
                        <select name="show_at_home" class="form-control" id="">
                            <option value="1">Yes</option> {{-- in value field put true or false for postgres, 1 or 0 for mysql --}}
                            <option selected value="0">No</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>STATUS</label>
                        <select name="status" class="form-control" id="">
                            <option value="1">Active</option> {{-- in value field put true or false for postgres, 1 or 0 for mysql --}}
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Create</button>
                </form>
            </div>
        </div>

    </section>
@endsection
