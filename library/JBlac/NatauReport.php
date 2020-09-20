<?php
Zend_Loader::loadFile('tcpdf.php', '../library/JBlac/TCPDF/', TRUE);
class JBlac_NatauReport extends TCPDF
{
        public function __construct($data , $orientation = 'L' , $unit = 'pt' , $format = 'A4' , $unicode = true , $encoding = 'UTF-8' )
        {
            parent::__construct( $orientation, $unit, $format, $unicode, $encoding , FALSE );

            $this->ListData = $data;
            $this->SetMargins(36, 128, 36, TRUE);
            
            $this->SetAutoPageBreak(TRUE, 36);

            /**
             * Setting document meta information
             */

            $this->SetCreator('PDF_CREATOR');
            $this->SetAuthor('NATAU Membership Management System (NMMS)(innocent.blacius@gmail.com)');
            $this->SetTitle('Report');
            $this->SetSubject('NATAU MEMBERS REPORT');
            $this->SetKeywords('NATAU' , 'Members','Members List','Transport','Report' , 'PDF');
            $this->setImageScale(PDF_IMAGE_SCALE_RATIO);
        }    
        public function Header() {
            global $webcolor;
            $imageScale = (128.0 / 26.0) * 14;
            $this->setJPEGQuality(90); 

            $this->Image(K_PATH_IMAGES . 'logo.png', 36, 36, 64, 0, 'PNG', 'http://php.refulz.com');
                $this->SetFont('helvetica', 'B', 15);
                $this->Cell($imageScale);

                $this->Cell(0, 132, strtoupper('Namibia Transport and Allied Worker`s Union'), 0, 1);

            $this->Cell(0, 0, '', 0, 1);
            $this->SetLineStyle(['width' => 2 ,
                                     'color' => [$webcolor['red']]]);
                                 $this->Line(36 , 36 + $imageScale , $this->getPageWidth() - 36, 36 + $imageScale);
        }

        public function Footer() {
            $this->SetY(-30);
            
            $this->SetFont(PDF_FONT_NAME_MAIN, 'I', 8);
            $this->Cell(0, 10, 'Tel: +264-61-217244, Fax: +264-61-263767 , E-mail: natau@mweb.com.na', 0, false, 'C');
        }
        
        public function CreateReport(){
            $col = 86; // Column size

            $wideCol = ($this->getPageWidth() - 72 ) / 3;  // Description Column
            $line = 18;  // Line height

            $this->SetFont( Zend_Pdf_Font::FONT_HELVETICA, 'b' , 11 );
            $this->SetY(107);
            $this->Cell( 0, $line, 'Member`s Report - ' . date('M , Y'), 0, 0, 'C' );
            $this->SetY(128);
            $this->Cell( $col, $line, 'S. No.', 1, 0, 'C' );

            $this->Cell( $wideCol, $line, 'Member`s Name', 1, 0, 'L' );

            $this->Cell( $wideCol + $col, $line, 'Company', 1, 0, 'L' );

            $this->Ln(); // Adds Line break

            // Table content beings here

            $this->SetFont( Zend_Pdf_Font::FONT_HELVETICA, '' , 10 );  // two parameters accept font-family and style. Passing blank sets default values

            $counter = 1;   // Setting counter for S. No. column

            foreach( $this->ListData as $MemberData ) {

                $this->Cell( $col, $line, $counter, 1, 0, 'C' );

                $this->Cell( $wideCol, $line, $MemberData['member_fulname'], 1, 0, 'L'  );

                $this->Cell( $wideCol + $col, $line,  strtoupper($MemberData['company_name']) , 1, 0, 'L' );

                $this->Ln();

                $counter++;

            }            
        }
        public function CreateMembersReport(){
            $col = 86; // Column size

            $wideCol = ($this->getPageWidth() - 72 ) / 3.3;  // Description Column
            $line = 18;  // Line height

            $this->SetFont( Zend_Pdf_Font::FONT_HELVETICA, 'b' , 11 );
            $this->SetY(107);
            $this->Cell( 0, $line, 'Member`s Report - ' . date('M , Y'), 0, 0, 'C' );
            $this->SetY(128);
            $this->Cell( 60, $line, 'S. No', 1, 0, 'L' );
            $this->Cell( $wideCol, $line, 'Fulname', 1, 0, 'L' );

            $this->Cell( $col, $line, 'Date of Birth', 1, 0, 'L' );
            
            $this->Cell( 60, $line, 'Gender', 1, 0, 'L' );

            $this->Cell( $wideCol, $line, 'Date Joined', 1, 0, 'L' );

            $this->Ln(); // Adds Line break

            // Table content beings here

            $this->SetFont( Zend_Pdf_Font::FONT_HELVETICA, '' , 10 );  // two parameters accept font-family and style. Passing blank sets default values

            $counter = 1;   // Setting counter for S. No. column

            foreach( $this->ListData as $MemberData ) {
                
                //echo ' - ' . $MemberData['member_name'];

                $this->Cell( 60, $line, $counter, 1, 0, 'C' );

                $this->Cell( $wideCol, $line, $MemberData['member_fulname'], 1, 0, 'L'  );
                $this->Cell( $col, $line, $MemberData['date_of_birth'], 1, 0, 'L'  );
                $this->Cell( 60, $line, $MemberData['gender'], 1, 0, 'L'  );

                $this->Cell( $wideCol, $line, $MemberData['membership_date'] , 1, 0, 'L' );

                $this->Ln();

                $counter++;

            }            
        }
}