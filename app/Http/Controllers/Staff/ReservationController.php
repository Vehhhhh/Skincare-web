<?php

namespace App\Http\Controllers\Staff;

use App\DataTables\ReservationDataTable;
use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class ReservationController extends Controller
{
    function index(ReservationDataTable $dataTable): View|JsonResponse
    {
        return $dataTable->render('staff.reservation.index');
    }

    function update(Request $request): Response
    {
        //dd($request->all());
        $reservation = Reservation::findOrFail($request->id);
        $reservation->status = $request->status;
        $reservation->save();
        return response(['status' => 'success', 'message' => 'updated successfully']);
    }

    function destroy(string $id): Response
    {
        try {
            $reservation = Reservation::findOrFail($id);
            $reservation->delete();
            return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
        } catch (\Exception $e) {
            return response(['status' => 'error', 'message' => 'Something went wrong!']);
        }
    }
}
