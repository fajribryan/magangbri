<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use Illuminate\Http\Request;

class SurveyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin/survey/surveydashboard', [
            'title' => 'Survey',
            'active' => 'Survey',
            'survey' => Survey::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin/survey/surveyadd', [
            'title' => 'Create survey',
            'active' => 'Create survey',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
        public function store(Request $request)
    {
        $jenis_lokasi_atm = $request->input('jenis_lokasi_atm');

        if ($jenis_lokasi_atm == 'onsite') {
            return view('admin/survey/surveyonsite', [
                'title' => 'Survey',
                'active' => 'Survey 2',
            ]);
        } elseif ($jenis_lokasi_atm == 'offsite') {
            return view('admin/survey/surveyoffsite', [
                'title' => 'Survey',
                'active' => 'Survey 2',
            ]);
        } elseif ($jenis_lokasi_atm == 'drive_thru') {
            return view('admin/survey/drive-thru', [
                'title' => 'Survey',
                'active' => 'Survey 2',
            ]);
        }

        $data = [
            'jenis_lokasi_atm' => $jenis_lokasi_atm
        ];

        Survey::create($data);
    }

    public function surveyonsite()
    {
        return view('admin/inventaris/surveyonsite', [
            'title' => 'Survey',
            'active' => 'Survey 2',
        ]);
    }
    public function jenislokasi(Request $request)
    {
        $jenis_lokasi = $request->input('jenis_lokasi');

        if ($jenis_lokasi == 'bangunan_sendiri') {
            redirect('/bangunansendiri');
        } elseif ($jenis_lokasi == 'bangunan_sharing') {
            redirect('/bangunansharing');
        }
        
        $request->validate([
            'jenis_lokasi' => 'required',
        ]);

        Survey::create($request->all());
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
