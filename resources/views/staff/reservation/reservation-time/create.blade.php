@extends('staff.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Reservation Times</h1>
        </div>
        <div class="card card-primary">
            <div class="card-header">
                <h4>Create Times</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('staff.reservation-time.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Start Time</label>
                        <input type="text" name="start_time" class="form-control timepicker">
                    </div>
                    <div class="form-group">
                        <label>End Time</label>
                        <input type="text" name="end_time" class="form-control timepicker">
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control" id="">
                            <option value="1">Yes</option> {{-- in value field put true or false for postgres, 1 or 0 for mysql --}}
                            <option value="0">No</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Create</button>
                </form>
            </div>
        </div>

    </section>
@endsection
