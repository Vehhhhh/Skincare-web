@extends('staff.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Table</h1>
        </div>

        <div class="card card-primary">
            <div class="card-header">
                <h4>Update Table {{ $table->name }}</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('staff.table.update', $table->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name" value="{{ $table->name }}">
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            <option @selected($table->status === 1) value="1">Free</option>
                            <option @selected($table->status === 0) value="0">Occupied</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>

                </form>
            </div>
        </div>


    </section>
@endsection
