<?php
class JBlac_PdfReport extends JBlac_PdfTable
{

protected $page_title, $page_width, $page_height, $headings;
        function Header() {
            $this->SetX(-1);
            $this->page_width = $this->GetX() + 1;
            $this->SetY(-1);
            $this->page_height = $this->GetY() + 1;
            $this->SetFont('Helvetica', 'B', 10);
            $this->SetXY(0, PDF_MARGIN - 10);
            $this->MultiCell($this->page_width, 8, $this->page_title, 0, 'C');
            $this->SetY(PDF_MARGIN);
            $this->SetFont('Helvetica', 'I', 8);
            $this->RowX($this->headings, false);
        }

        function Footer() {
            $this->SetFont('Helvetica', 'I', 8);
            $y = $this->page_height - PDF_MARGIN / 2 - 8;
            $cell_width = $this->page_width - 2 * PDF_MARGIN;
            $this->SetXY(PDF_MARGIN, $y);
            $this->MultiCell($cell_width, 8, date('Y-m-d H:i:s'), 0, 'L');
            $this->SetXY(PDF_MARGIN, $y);
            $this->MultiCell($cell_width, 8, $this->PageNo() . ' of {nb}',0, 'R');
        }
        
        function set_headings($headings) {
            $this->headings = $headings;
        }

        function set_title($title) {
            $this->page_title = $title;
        }
        
        function pdf($title, $stmt, $widths = null, $headings = null,
        $orientation = 'P', $pagesize = 'letter') {
        define('HORZ_PADDING', 2);
        define('VERT_PADDING', 3);
        $dir = APPLICATION_PATH . '/docs';
        $path = "$dir/" . date('Y-m-d') . '-' . uniqid() . '.pdf';
        $url = "http://" . $_SERVER['HTTP_HOST'] .
        dirname($_SERVER['REQUEST_URI']) . "/$path";
        $pdf = new PDF_Report($orientation, 'pt', $pagesize);
        $pdf->set_title($title);
        $pdf->SetX(-1);
        $page_width = $pdf->GetX() + 1;
        $pdf->AliasNbPages();
        $pdf->SetFont('Helvetica', '' , 7);
        $pdf->SetLineWidth(.1);
        $pdf->SetMargins(PDF_MARGIN, PDF_MARGIN);
        $pdf->SetAutoPageBreak(true, PDF_MARGIN);
        $pdf->SetHorizontalPadding(HORZ_PADDING);
        $pdf->SetVerticalPadding(VERT_PADDING);
        $ncols = 3;
        if (is_null($headings)){
            $headings = [
                            'Id',
                            'Member`s Name',
                            'Company'
                        ];
        }

        $pdf->set_headings($headings);
        
        if (is_null($widths)) {
        $w = ($page_width - 2 * PDF_MARGIN) / 3;
            for ($i = 0; $i < $ncols; $i++){
                $widths[$i] = $w;
            }
        }
        if (count($widths) == $ncols - 1) {
        $n = 0;
        foreach ($widths as $w)
        $n += $w;
        $widths[$ncols - 1] = $page_width - 2 * PDF_MARGIN - $n;
        }
        $pdf->SetWidths($widths);
        $pdf->AddPage();
        while ($row = $stmt->fetch()) {
        $r = array();
        foreach ($row as $v)
        $r[] = iconv('UTF-8', 'ISO-8859-1//TRANSLIT', $v);
        $pdf->RowX($r);
        }
        $pdf->Output($path, 'I');
        }
}