@extends('staff.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Restaurant Table</h1>
        </div>

        <div class="card card-primary">
            <div class="card-header">
                <h4>Create Table</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('staff.table.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                    </div>

                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            <option value="1">Free</option>
                            <option value="0">Occupied</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Create</button>

                </form>
            </div>
        </div>

    </section>
@endsection
