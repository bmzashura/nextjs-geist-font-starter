<?php

namespace App\Controllers;

use App\Models\VisitorModel;
use CodeIgniter\Controller;

class VisitorController extends Controller
{
    protected $visitorModel;

    public function __construct()
    {
        $this->visitorModel = new VisitorModel();
    }

    public function index()
    {
        return view('sign_in');
    }

    public function signIn()
    {
        $data = [
            'full_name' => $this->request->getPost('full_name'),
            'institution' => $this->request->getPost('institution'),
            'department' => $this->request->getPost('department'),
            'datetime_in' => date('Y-m-d H:i:s'),
            'signature' => $this->request->getPost('signature')
        ];

        $this->visitorModel->insert($data);

        return redirect()->to('/visitor/log');
    }

    public function log()
    {
        $filters = [
            'full_name' => $this->request->getGet('full_name'),
            'institution' => $this->request->getGet('institution'),
            'department' => $this->request->getGet('department'),
            'datetime_in_start' => $this->request->getGet('datetime_in_start'),
            'datetime_in_end' => $this->request->getGet('datetime_in_end'),
            'datetime_out_start' => $this->request->getGet('datetime_out_start'),
            'datetime_out_end' => $this->request->getGet('datetime_out_end'),
        ];

        $visitors = $this->visitorModel->getVisitors($filters);

        return view('visitor_log', ['visitors' => $visitors, 'filters' => $filters]);
    }

    public function exportPdf()
    {
        $filters = [
            'full_name' => $this->request->getGet('full_name'),
            'institution' => $this->request->getGet('institution'),
            'department' => $this->request->getGet('department'),
            'datetime_in_start' => $this->request->getGet('datetime_in_start'),
            'datetime_in_end' => $this->request->getGet('datetime_in_end'),
            'datetime_out_start' => $this->request->getGet('datetime_out_start'),
            'datetime_out_end' => $this->request->getGet('datetime_out_end'),
        ];

        $visitors = $this->visitorModel->getVisitors($filters);

        // Load TCPDF library
        require_once APPPATH . 'ThirdParty/tcpdf/tcpdf.php';

        $pdf = new \TCPDF();
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('LogiVisit');
        $pdf->SetTitle('Visitor Log');
        $pdf->SetHeaderData('', 0, 'Visitor Log', '');
        $pdf->setHeaderFont(['helvetica', '', 12]);
        $pdf->setFooterFont(['helvetica', '', 8]);
        $pdf->SetDefaultMonospacedFont('courier');
        $pdf->SetMargins(15, 27, 15);
        $pdf->SetHeaderMargin(5);
        $pdf->SetFooterMargin(10);
        $pdf->SetAutoPageBreak(TRUE, 25);
        $pdf->setImageScale(1.25);
        $pdf->AddPage();

        $html = '<h2>Visitor Log</h2>';
        $html .= '<table border="1" cellpadding="4">';
        $html .= '<thead><tr style="background-color:#f2f2f2;">
            <th><b>Full Name</b></th>
            <th><b>Institution</b></th>
            <th><b>Department</b></th>
            <th><b>Date & Time In</b></th>
            <th><b>Date & Time Out</b></th>
        </tr></thead><tbody>';

        foreach ($visitors as $visitor) {
            $html .= '<tr>
                <td>' . htmlspecialchars($visitor['full_name']) . '</td>
                <td>' . htmlspecialchars($visitor['institution']) . '</td>
                <td>' . htmlspecialchars($visitor['department']) . '</td>
                <td>' . htmlspecialchars($visitor['datetime_in']) . '</td>
                <td>' . htmlspecialchars($visitor['datetime_out'] ?? '-') . '</td>
            </tr>';
        }

        $html .= '</tbody></table>';

        $pdf->writeHTML($html, true, false, true, false, '');

        $pdf->Output('visitor_log.pdf', 'D');
    }
}
