@extends('staff.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Reservation Times</h1>
        </div>
    </section>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4>All Times</h4>
                <div class="card-header-action">
                    <a href="{{ route('staff.reservation-time.create') }}" class="btn btn-primary">
                        Create New
                    </a>
                </div>
            </div>
            <div class="card-body">
                {{ $dataTable->table() }}
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush
