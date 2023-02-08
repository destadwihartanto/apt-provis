<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Baa extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        check_login();
        $this->load->library('Pdf');
    }

    public function index()
    {
    }

    public function print($site_id = null)
    {
        $query = $this->get_detail($site_id);
        $this->setup_page($query);
    }

    private function get_detail($encode_id = null)
    {
        $id = base64_decode($encode_id);
        $query = $this->site_model->print(['s.id' => $id]);
        if (count($query) == 0) {
            $this->session->set_flashdata('alert_icon', 'warning');
            $this->session->set_flashdata('alert_message', 'Data site tidak ditemukan');
            redirect('site/index');
        } else {
            $att = $query[0];
            $approved_at = isset($att['approved_at']) ? date('j F Y', strtotime($att['approved_at'])) : '-';

            $data[] = [
                'Doc No' => 'xxxxxxxxx',
                'Penyedia Ground Segmen' => $att['company'],
                'Site ID/Terminal ID' => $att['sid'],
                'Nama Lokasi' => $att['nama_site'],
                'Koordinat' => 'Lat: ' . $att['latitude'] . ' Long: ' . $att['longitude'],
                'Beam' => $att['spotbeam_name'],
                'NOC Name' => $att['username'],
            ];

            $data[] = [
                'Create Terminal' => isset($att['registered_at']) ? date('j F Y', strtotime($att['registered_at'])) : '-',
                'Modem Commisioning (measured ES/No & Expected Es/No)' => $approved_at,
                'CPI Level Check' => $approved_at,
                'Modcod Check' => $approved_at,
                'Internet Test-Lokal' => $approved_at,
                'Internet Test-Internasional' => $approved_at,
                'Tanggal On Air' => $approved_at,
            ];

            $url = base_url() . 'uploads/';
            $data[] = [
                'Plang Instansi' => $url . $att['url_img_plang'],
                'Antena' => $url . $att['url_img_antenna'],
                'Capture Validation Result / SQF Level' => $url . $att['url_img_xpole'],
                'Capture AirMac Modem/CPI Test' => $url . $att['url_img_xpole'],
            ];

            $data[] = [
                'Capture Config & Statistic/Modcod' => $url . $att['url_img_ethernet'],
                'Capture Internet (detik.com)' => $url . $att['url_img_first_modem'],
                'Capture Internet (google.com)' => $url . $att['url_img_second_modem'],
                'Capture Speed Test (speedtest.net)' => $url . $att['url_img_speedtest'],
            ];

            $data[] = 'Dengan ditanda-tanganinya Berita Acara Integrasi Hub dan Aktivasi ini, maka layanan telah ter-integrasi ke Hub dan Internet, dan siap digunakan oleh Badan Aksesibilitas Telekomunikasi dan Informasi (BAKTI) untuk keperluan pengguna sah yang telah melalui proses pengujian dan dinyatakan baik sesuai dengan Standard Layanan Minimum Leased Capacity';

            return $data;
        }
    }

    private function set_title_pic($pdf, $data = [])
    {
        $i = 0;
        foreach ($data as $key => $value) {
            $pdf->MultiCell(45, 10, $key, 1, 'C', 0, $i == 3 ? 1 : 0, '', '', true, 0, false, true, 10, 'M');
            $i++;
        }
    }

    private function set_picture($pdf, $data = [])
    {
        // Image($file, $x='', $y='', $w=0, $h=0, $type='', $link='', $align='', $resize=false, $dpi=300, $palign='', $ismask=false, $imgmask=false, $border=0, $fitbox=false, $hidden=false, $fitonpage=false)
        $x = 10;
        foreach ($data as $key => $value) {
            $pdf->Image($value, $x, '', 45, 35, 'JPG', $value, '', true, 150, '', false, false, 1, false, false, false);
            $x += 45;
        }
    }

    private function setup_page($data = [])
    {
        $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetTitle('Print BAA');
        $pdf->SetTopMargin(10);
        $pdf->setFooterMargin(10);
        $pdf->SetAutoPageBreak(true);
        $pdf->SetAuthor('Author');
        $pdf->SetDisplayMode('real', 'default');
        $pdf->AddPage();
        $pdf->Ln();

        $pdf->SetFillColor(224, 235, 255); // Color and font restoration
        $pdf->SetTextColor(0);
        $pdf->SetFont('helvetica', '', 14);
        $h = 10;
        $pdf->Image(site_url('assets/img/apt_logo.jpeg'),159,5,40);
        $pdf->Ln(2);
        $pdf->MultiCell(180, $h, 'BERITA ACARA INTEGRASI HUB & AKTIVASI', 0, 'C', 0, 1, '', '', true, 0, false, true, $h, 'M');

        $pdf->SetFont('helvetica', '', 8);
        $pdf->Ln(2);
        $fill = 0;
        $w = array(50, 80,);
        foreach ($data[0] as $row => $value) {
            $pdf->Cell($w[0], 6, $row, 1, 0, 'L', $fill);
            $pdf->Cell($w[1], 6, $value, 1, 0, 'L', $fill);
            $pdf->Ln();
        }
        $pdf->Cell(array_sum($w), 0, '', 'T');
        $pdf->Ln(5);

        $h = 5;
        $second_width = [80, 40, 10];
        foreach ($data[1] as $row => $value) {
            $pdf->MultiCell($second_width[0], $h, $row, 1, 'L', 0, 0, '', '', true, 0, false, true, $h, 'M');
            $pdf->MultiCell($second_width[1], $h, $value, 1, 'C', 0, 0, '', '', true, 0, false, true, $h, 'M');
            $pdf->MultiCell($second_width[2], $h, 'OK', 1, 'C', 0, 1, '', '', true, 0, false, true, $h, 'M');
        }
        $pdf->Ln(5);
        // MultiCell($w, $h, $txt, $border=0, $align='J', $fill=0, $ln=1, $x='', $y='', $reseth=true, $stretch=0, $ishtml=false, $autopadding=true, $maxh=0)

        $pdf->MultiCell(180, 5, $data[4], 1, 'L', 0, 1, '', '', true);
        $pdf->Ln(5);

        $this->set_title_pic($pdf, $data[2]);
        $this->set_picture($pdf, $data[2]);
        $pdf->Ln(35);

        $this->set_title_pic($pdf, $data[3]);
        $this->set_picture($pdf, $data[3]);

        $w = 45;
        $h = 25;
        $pdf->MultiCell($w, $h, ' ', 1, 'C', 0, 0, '', '', true, 0, false, true, $h, 'M');
        $pdf->MultiCell($w, $h, ' ', 1, 'C', 0, 0, '', '', true, 0, false, true, $h, 'M');
        $pdf->MultiCell($w, $h, ' ', 1, 'C', 0, 0, '', '', true);
        $pdf->MultiCell($w, $h, ' ', 1, 'C', 0, 1, '', '', true);

        $pdf->Ln(20);
        $w = 90;
        $h = 5;
        $pdf->MultiCell($w, $h, 'Diajukan Oleh', 1, 'C', 0, 0, '', '', true, 0, false, true, $h, 'M');
        $pdf->MultiCell($w, $h, 'Disetujui Oleh', 1, 'C', 0, 1, '', '', true, 0, false, true, $h, 'M');

        $h = 20;
        $pdf->MultiCell($w, $h, '', 1, 'C', 0, 0, '', '', true, 0, false, true, $h, 'M');
        $pdf->MultiCell($w, $h, '', 1, 'C', 0, 1, '', '', true, 0, false, true, $h, 'M');
        $h = 5;
        $pdf->MultiCell($w, $h, 'Ground Segment', 1, 'C', 0, 0, '', '', true, 0, false, true, $h, 'M');
        $pdf->MultiCell($w, $h, 'Network Operator', 1, 'C', 0, 1, '', '', true, 0, false, true, $h, 'M');
        $pdf->MultiCell($w, $h, $data[0]['Penyedia Ground Segmen'], 1, 'C', 0, 0, '', '', true, 0, false, true, $h, 'M');
        $pdf->MultiCell($w, $h, 'PT. Angkasa Prima', 1, 'C', 0, 1, '', '', true, 0, false, true, $h, 'M');

        $pdf->Output();
    }
}
