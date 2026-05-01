<?php

namespace App\Http\Controllers;

use App\Models\Incident;
use App\Models\TeamMember;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    public function index()
    {
        $memberStats = TeamMember::select('availability_status')
            ->selectRaw('count(*) as count')
            ->groupBy('availability_status')
            ->get();

        $incidentStats = Incident::select('status')
            ->selectRaw('count(*) as count')
            ->groupBy('status')
            ->get();

        return view('reports.index', compact('memberStats', 'incidentStats'));
    }

    public function exportIncidentsCsv()
    {
        $fileName = 'incidents_report_' . date('Y-m-d') . '.csv';
        $incidents = Incident::all();

        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $columns = ['ID', 'Title', 'Location', 'Priority', 'Status', 'Reported At'];

        $callback = function() use($incidents, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($incidents as $incident) {
                fputcsv($file, [
                    $incident->id,
                    $incident->title,
                    $incident->location,
                    $incident->priority,
                    $incident->status,
                    $incident->reported_at,
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function exportIncidentsPdf()
    {
        $incidents = Incident::all();
        $pdf = Pdf::loadView('reports.incidents_pdf', compact('incidents'));
        return $pdf->download('incidents_report_' . date('Y-m-d') . '.pdf');
    }
}
