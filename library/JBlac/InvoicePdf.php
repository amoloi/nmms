<?php
/**
 * Description of JBlac_Pdf
 *
 * @author Innocent
 */
/**
 * Load the TCPDF library
 */
Zend_Loader::loadFile('tcpdf.php', '../library/JBlac/TCPDF', TRUE);
class JBlac_InvoicePdf extends TCPDF{
        function __construct( $data, $orientation, $unit, $format ) {
                        parent::__construct( $orientation, $unit, $format, true, 'UTF-8', false );
                $this->invoiceData = $data;
                # Set the page margins: 72pt on each side, 36pt on top/bottom.
                $this->SetMargins( 72, 36, 72, true );
                $this->SetAutoPageBreak( true, 36 );
                # Set document meta-information
                $this->SetCreator( PDF_CREATOR );
                $this->SetAuthor( 'Chris Herborth (chrish@pobox.com)' );
                $this->SetTitle( 'Invoice for INNOCENT' );
                $this->SetSubject( "A simple invoice example for 'Creating PDFs on
                the fly with TCPDF' on IBM's developerWorks" );
                $this->SetKeywords( 'PHP, sample, invoice, PDF, TCPDF' );
                //set image scale factor
                $this->setImageScale(PDF_IMAGE_SCALE_RATIO);
                //set some language-dependent strings
                global $l;
                $this->setLanguageArray($l);
        }

public function Header() {
        global $webcolor;
        # The image is this much larger than the company name text.
        $bigFont = 14;
        $imageScale = ( 100.0 / 26.0 ) * $bigFont;
        $smallFont = ( 16.0 / 26.0 ) * $bigFont;
        $this->ImagePngAlpha(K_PATH_IMAGES .'logo.png', 72, 36, 128, 128,$imageScale, $imageScale, 'PNG', null, 'T', false, 72, 'L' );

        $this->SetFont('times', 'b', $bigFont );
        $this->Cell( 0, 0, 'Namibia Transport and Allied Worker`s Union', 0, 1 );
        $this->SetFont('times', 'i', $smallFont );
        $this->Cell( $imageScale );
        $this->Cell( 0, 0, '', 0, 1 );
        $this->Cell( $imageScale );
        $this->Cell( 0, 0, 'P.O. Box 7516, Windhoek, Namibia,', 0, 1 );
        $this->Cell( $imageScale );
        $this->Cell( 0, 0, 'Tel: +264-61-217244, Fax: +264-61-263767, E-mail: natau@mweb.com.na', 0, 1 );
        $this->SetY( 5 * 72, true );
        $this->SetLineStyle( array( 'width' => 2, 'color' =>
                                                    array( $webcolor['black'] ) ) );
                                                    $this->Line( 72, 36 + $imageScale, $this->getPageWidth() - 72, 36 + $imageScale );
}

public function Footer() {
        global $webcolor;
        $this->SetLineStyle( array( 'width' => 2, 'color' =>
        array( $webcolor['black'] ) ) );
        $this->Line( 72, $this->getPageHeight() - 1.5 * 72 - 2,
        $this->getPageWidth() - 72, $this->getPageHeight() - 1.5 * 72 - 2 );
        $this->SetFont( 'times', '', 8 );
        $this->SetY( -1.5 * 72, true );
        $this->Cell( 72, 0, 'Invoice prepared for ' . 'Innocent' . ' on ' . Zend_Date::YEAR );
}

public function CreateInvoice() {
        $this->AddPage();
        $this->SetFont( 'helvetica', '', 11 );
        $this->SetY( 144, true );
        # Table parameters
        #
        # Column size, wide (description) column, table indent, row height.
        $col = 72;
        $wideCol = 2 * $col;
        $indent = ( $this->getPageWidth() - 2 * 72 - $wideCol - 3 * $col ) / 2;
        $line = 18;
        # Table header
        $this->SetFont( '', 'b' );
        $this->Cell( $indent );
        $this->Cell( $wideCol, $line, 'Member`s Name', 1, 0, 'L' );
        $this->Cell( $wideCol, $line, 'Employer', 1, 0, 'L' );
        $this->Cell( $col, $line, 'Number', 1, 0, 'L' );

        $this->Ln();
        # Table content rows
        $this->SetFont( '', '' );

        foreach( $this->invoiceData as $member ) {
        $this->Cell( $indent );
        $this->Cell( $wideCol, $line, $member['member_fulname'], 1, 0, 'L' );
        $this->Cell( $wideCol, $line, $member['company_name'], 1, 0, 'L' );
        $this->Cell( $col, $line, $member['id'], 1, 0, 'L' );
        $this->Ln();
        }
        # Table Total row
//        $this->SetFont( '', 'b' );
//        $this->Cell( $indent );
//        $this->Cell( $wideCol + $col * 2, $line, 'Total:', 1, 0, 'R' );
//        $this->SetFont( '', '' );
//        $this->Cell( $col, $line, $this->invoiceData['total'], 1, 0, 'R' );
}
}