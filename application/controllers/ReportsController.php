<?php

class ReportsController extends Zend_Controller_Action
{

    public function init()
    {
        $layout = $this->_helper->getHelper('layout');
        $layout->setLayout('www');
        
       $this->_helper->LoginRequired();
    }

    public function indexAction()
    {
        $this->view->title = "REPORTS : NATAU REPORTS";

    }
    public function deleteAction()
    {
         $this->view->title = "MEMBERS : DELETE MEMBER FROM THE SYSTEM"; 
    }

    public function overviewAction()
    {
         $this->view->title = "REPORTS : SUMMARY NMMS REPORT SUMMARY";
        $this->view->title = 'Welcome to the NATAU MMS';
        $this->view->headTitle('Overview' , 'APPEND');
        $company = new Application_Model_Company(array('dbh'=>  Zend_Registry::get('dbh')));
        $company->fetchTotalCompanies('');
        $this->view->TotalCompany = $company->getDataSet(); 
                
        $member = new Application_Model_Member(array('dbh'=>  Zend_Registry::get('dbh')));
        
        $member->totalFinance();
        $this->view->TotalRevenue = $member->getDataSet();
        
        
        $member->fetchTotalMembers('');
        $this->view->TotalMembers = $member->getDataSet();        
        $member->setWorking_state('Active');
        if ('success' === $member->fetchTotalPerWorkState('')){
            $this->view->TotalActive = $member->getDataSet();
        }else{
            exit($member->getErrorMessages());
        }
        $member->setWorking_state('Dismiss');
        $member->fetchTotalPerWorkState('');
        $this->view->TotalDismiss = $member->getDataSet();
        $member->setWorking_state('Lost');
        $member->fetchTotalPerWorkState('');
        $this->view->TotalLost = $member->getDataSet();
        $member->setWorking_state('Resign');
        $member->fetchTotalPerWorkState('');
        $this->view->TotalResign = $member->getDataSet();

        $member->setWorking_state('Retired');
        $member->fetchTotalPerWorkState('');
        $this->view->TotalRetired = $member->getDataSet();
        $member->setWorking_state('Retrenched');
        $member->fetchTotalPerWorkState('');
        $this->view->TotalRetrenched = $member->getDataSet()    ;
        
        $member->setGender('M');
        $member->fetchTotalPerGender('');
        $this->view->TotalMale = $member->getDataSet();
        
        $member->setGender('F');
        $member->fetchTotalPerGender('');
        $this->view->TotalFemale = $member->getDataSet();           
    }
    public function financeAction()
    {
         $this->view->title = "MEMBERS : MEMBERSHIP TERMINATION SECTION";
         $member = new Application_Model_Member(array('dbh'=>  Zend_Registry::get('dbh')));
         
         $id = filter_var($this->_request->getParam('id'), FILTER_SANITIZE_NUMBER_INT);
         $member->setId($id);
         $this->view->MemberDetails = $member->fetchOne('');
        
         //print_r($member->fetchMonths());
         $this->view->months = $member->fetchMemberFinance('');
    }
    
    public function membersAction(){
        Zend_Layout::getMvcInstance()->disableLayout();
// Get Members data.
            $this->view->title = "MEMBERS : NATAU MEMBER`S LIST";
            $member = new Application_Model_Member(array('dbh'=>  Zend_Registry::get('dbh')));
            $MembersData = $member->fetchAll();        
            
            // create new PDF document
                $pdf = new JBlac_NatauReport($MembersData , PDF_PAGE_ORIENTATION, 'pt', PDF_PAGE_FORMAT, true, 'UTF-8', false);


            // ---------------------------------------------------------

            // add a page
                $pdf->AddPage();
            // Create Report
                $pdf->CreateReport();

            // ---------------------------------------------------------

            //Close and output PDF document
            $pdf->Output('MembersReport.pdf', 'D');

            //============================================================+
            // END OF FILE
            //============================================================+          
    }
    public function membersReportAction(){
        Zend_Layout::getMvcInstance()->disableLayout();
        
        /*
         * Members Data
         */
                $report = new Application_Model_DbTable_MembersReport();
                $db = $report->getDefaultAdapter();
                $select = $db->select();
                $select->from('members_report_v');
                $reports = $db->fetchAll($select);
                
        //Zend_Debug::dump($reports);exit;
// Get Members data.

            $MembersData = $reports;        
//            exit(print_r($MembersData));
//            exit;
            // create new PDF document
                $pdf = new JBlac_NatauReport($MembersData , PDF_PAGE_ORIENTATION, 'pt', PDF_PAGE_FORMAT, true, 'UTF-8', false);


            // ---------------------------------------------------------

            // add a page
                $pdf->AddPage();
            // Create Report
                $pdf->CreateMembersReport();

            // ---------------------------------------------------------

            //Close and output PDF document
            $pdf->Output('MembersReport.pdf', 'D');

            //============================================================+
            // END OF FILE
            //============================================================+          
    }    
    public function exportxlsAction()
    {
        set_time_limit( 0 );
            $member = new Application_Model_Member(array('dbh'=>  Zend_Registry::get('dbh')));
            $MembersData = $member->fetchContributionTotal();
            
            //print_r($MembersData);
                        

        $filename = APPLICATION_PATH . "/tmp/excel-" . date( "m-d-Y" ) . ".xls";
//echo $filename;
        $realPath = realpath( $filename );
        
        //echo $realPath;
//exit($realPath);
        if ( false === $realPath )
        {
            touch( $filename );
            chmod( $filename, 0777 );
        }

        $filename = realpath( $filename );
        $handle = fopen( $filename, "w" );
        $finalData = array();
        
        foreach ( $MembersData AS $row )
        {       
            $finalData[] = array(
                utf8_decode( strtoupper($row['id']) ),
                utf8_decode( $row['member_fulname'] ), // For chars with accents.
                utf8_decode( strtoupper($row['company_name']) ),
                utf8_decode( strtoupper($row['contribution']) ),
            );
        }

        foreach ( $finalData AS $finalRow )
        {
            fputcsv( $handle, $finalRow, "\t" );
        }

        fclose( $handle );

        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender();
        $downloadFilename = date( "m-d-Y" ) . ".xls";
        $this->getResponse()->setRawHeader( "Content-Type: application/vnd.ms-excel; charset=UTF-8" )
            ->setRawHeader( "Content-Disposition: attachment; filename=NatauMembers-{$downloadFilename}" )
            ->setRawHeader( "Content-Transfer-Encoding: binary" )
            ->setRawHeader( "Expires: 0" )
            ->setRawHeader( "Cache-Control: must-revalidate, post-check=0, pre-check=0" )
            ->setRawHeader( "Pragma: public" )
            ->setRawHeader( "Content-Length: " . filesize( $filename ) )
            ->sendResponse();

        readfile( $filename ); exit();
    }    
    public function companiesAction(){
        Zend_Layout::getMvcInstance()->disableLayout();

// create new PDF document
$pdf = new JBlac_ListPdf(null , PDF_PAGE_ORIENTATION, 'pt', PDF_PAGE_FORMAT, true, 'UTF-8', false);


// ---------------------------------------------------------

// set font
$pdf->SetFont('times', 'BI', 12);

// add a page
$pdf->createReport();


// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('images/InnocentSample.pdf', 'D');

//============================================================+
// END OF FILE
//============================================================+          
    }
}