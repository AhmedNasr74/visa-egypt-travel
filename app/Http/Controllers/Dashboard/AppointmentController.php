<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Appointment;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\AppointmentRequest;
use App\DataTables\AppointmentDataTable;

class AppointmentController extends Controller
{

    public function index(AppointmentDataTable $dataTable)
    {
        return $dataTable->render('dashboard.appointments.index');
    }

    public function show(Appointment $appointment)
    {
        return view('dashboard.appointments.show', compact('appointment'));
    }
}
