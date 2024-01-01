<?php
namespace App\Controllers;
use Dompdf\Options;

class Report extends BaseController
{
    public function __construct()
    {
        $this->data['cssPath']="template/includes/css";
        $this->data['navPath']="template/includes/nav";
        $this->data['footerPath']="template/includes/footer";
        $this->data['scriptPath']="template/includes/scripts";
        $this->data['layoutPath']="template/layouts/main_layout";

        $this->Mstate = new \App\Models\Mstate();
        $this->Mdue_date = new \App\Models\Mdue_date();
        $this->TableLib = new \App\Libraries\TableLib();

        $tableArr=$this->TableLib->get_tables();

        $this->client_tbl=$tableArr['client_tbl'];
        $this->client_act_map_tbl=$tableArr['client_act_map_tbl'];
        $this->client_group_tbl=$tableArr['client_group_tbl'];
        $this->organisation_type_tbl=$tableArr['organisation_type_tbl'];
        $this->client_document_map_tbl=$tableArr['client_document_map_tbl'];
        
        $currYear=date('Y');
        
        $this->dueYear=$currYear."-".(substr($currYear+1, 2));
        
        $this->data['dueYear']=$this->dueYear;
        
        $currMth=date('n');
        
        $this->data['currMth']=$currMth;
    }

    public function getMasterClientData()
	{
        $reportTitle="Master Client Data";

        $clientMasterData=array();

        $masterId=$this->request->getGet('masterId');

        if($masterId==1)
        {
            $clientMasterData[1]['id']=1;
            $clientMasterData[1]['name']="Company Law";
            $clientMasterData[1]['type']="org";
        }
        elseif($masterId==2)
        {
            $clientMasterData[2]['id']=2;
            $clientMasterData[2]['name']="Limited Liability Partnership";
            $clientMasterData[2]['type']="org";
        }
        elseif($masterId==3)
        {
            $clientMasterData[3]['id']=3;
            $clientMasterData[3]['name']="Partnership Firms";
            $clientMasterData[3]['type']="org";
        }
        elseif($masterId==4)
        {
            $clientMasterData[4]['id']=4;
            $clientMasterData[4]['name']="Co-operative Societies";
            $clientMasterData[4]['type']="org";
        }
        elseif($masterId==5)
        {
            $clientMasterData[5]['id']=5;
            $clientMasterData[5]['name']="Charitable Trusts/Private Trusts";
            $clientMasterData[5]['type']="org";
        }
        elseif($masterId==6)
        {
            $clientMasterData[6]['id']=6;
            $clientMasterData[6]['name']="Income Tax";
            $clientMasterData[6]['type']="act";
        }
        elseif($masterId==7)
        {
            $clientMasterData[7]['id']=7;
            $clientMasterData[7]['name']="Tax Deducted at Source";
            $clientMasterData[7]['type']="act";
        }
        elseif($masterId==8)
        {
            $clientMasterData[8]['id']=8;
            $clientMasterData[8]['name']="Goods and Services Tax";
            $clientMasterData[8]['type']="act";
        }
        elseif($masterId==9)
        {
            $clientMasterData[9]['id']=9;
            $clientMasterData[9]['name']="Profession Tax-Enrollment";
            $clientMasterData[9]['type']="act";
        }
        elseif($masterId==10)
        {
            $clientMasterData[10]['id']=10;
            $clientMasterData[10]['name']="Profession Tax-Registration";
            $clientMasterData[10]['type']="act";
        }
        elseif($masterId==11)
        {
            $clientMasterData[11]['id']=11;
            $clientMasterData[11]['name']="Shops & Establishment";
            $clientMasterData[11]['type']="act";
        }

        $this->data['clientMasterData']=$clientMasterData;

        $clientCondtnArr['client_tbl.status']=1;
        // $clientCondtnArr['client_tbl.clientRegDocument !=']="";

        $clientJoinArr[]=array("tbl"=>$this->client_group_tbl, "condtn"=>"client_group_tbl.client_group_id=client_tbl.clientGroup", "type"=>"left");
        $clientJoinArr[]=array("tbl"=>$this->organisation_type_tbl, "condtn"=>"organisation_type_tbl.organisation_type_id=client_tbl.clientBussOrganisationType", "type"=>"left");
        
        $query=$this->Mcommon->getRecords($tableName=$this->client_tbl, $colNames="client_tbl.*, client_group_tbl.client_group_number, organisation_type_tbl.organisation_type_name", $clientCondtnArr, $likeCondtnArr=array(), $clientJoinArr, $singleRow=FALSE, $clientOrderByArr=array(), $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $clientDataArr=$query['userData'];

        $clientActCondtnArr['client_tbl.status']=1;
        $clientActCondtnArr['client_document_map_tbl.status']=1;
        $clientActCondtnArr['client_document_map_tbl.client_document_number !=']="";

        $clientActJoinArr[]=array("tbl"=>$this->client_tbl, "condtn"=>"client_tbl.clientId=client_document_map_tbl.fk_client_id", "type"=>"left");
        $clientActJoinArr[]=array("tbl"=>$this->client_group_tbl, "condtn"=>"client_group_tbl.client_group_id=client_tbl.clientGroup", "type"=>"left");
        $clientActJoinArr[]=array("tbl"=>$this->organisation_type_tbl, "condtn"=>"organisation_type_tbl.organisation_type_id=client_tbl.clientBussOrganisationType", "type"=>"left");
        
        $query=$this->Mcommon->getRecords($tableName=$this->client_document_map_tbl, $colNames="client_document_map_tbl.fk_client_document_id, client_tbl.*, client_group_tbl.client_group_number, organisation_type_tbl.organisation_type_name, client_document_map_tbl.client_document_number", $clientActCondtnArr, $likeCondtnArr=array(), $clientActJoinArr, $singleRow=FALSE, $clientOrderByArr=array(), $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $clientActDataArr=$query['userData'];

        $clientOrgArr=array();

        if(!empty($clientDataArr))
        {
            foreach($clientDataArr AS $e_cl)
            {
                $clientOrgArr[$e_cl['clientBussOrganisationType']][$e_cl['clientId']]=$e_cl;
            }
        }

        $clientDocArr=array();

        if(!empty($clientActDataArr))
        {
            foreach($clientActDataArr AS $e_cl_act)
            {
                $clientDocArr[$e_cl_act['fk_client_document_id']][$e_cl_act['clientId']]=$e_cl_act;
            }
        }

        $this->data['clientOrgArr']=$clientOrgArr;
        $this->data['clientDocArr']=$clientDocArr; 

        $optionName="";    
        $optionType="";  
        $lastColName="";  

        $resultArr=array();

        if(!empty($clientMasterData))
        {
            foreach($clientMasterData AS $e_cli)
            {
                $optionName=$e_cli['name'];    
                $optionType=$e_cli['type'];    

                $resultArr=array();

                $lastColName="";

                if($e_cli['id']==1)
                {
                    $lastColName="Registration No";

                    if(isset($clientOrgArr[1]))
                        $resultArr=$clientOrgArr[1];
                }
                elseif($e_cli['id']==2)
                {
                    $lastColName="Registration No";

                    if(isset($clientOrgArr[2]))
                        $resultArr=$clientOrgArr[2];
                }
                elseif($e_cli['id']==3)
                {
                    $lastColName="Registration No";

                    if(isset($clientOrgArr[4]))
                        $resultArr=$clientOrgArr[4];
                }
                elseif($e_cli['id']==4)
                {
                    $lastColName="Registration No";

                    if(isset($clientOrgArr[5]))
                        $resultArr=$clientOrgArr[5];
                }
                elseif($e_cli['id']==5)
                {
                    $lastColName="Registration No";

                    if(isset($clientOrgArr[6]))
                        $resultArr1=$clientOrgArr[6];
                    else
                        $resultArr1=array();

                    if(isset($clientOrgArr[7]))
                        $resultArr2=$clientOrgArr[7];
                    else
                        $resultArr2=array();

                    $resultArr=array_merge($resultArr1, $resultArr2);
                }
                elseif($e_cli['id']==6)
                {
                    $lastColName="Aadhar";

                    if(isset($clientDocArr[1]))
                        $resultArr=$clientDocArr[1];
                }
                elseif($e_cli['id']==7)
                {
                    $lastColName="TAN";

                    if(isset($clientDocArr[2]))
                        $resultArr=$clientDocArr[2];
                }
                elseif($e_cli['id']==8)
                {
                    $lastColName="GST No";

                    if(isset($clientDocArr[5]))
                        $resultArr=$clientDocArr[5];
                }
                elseif($e_cli['id']==9)
                {
                    $lastColName="PT-Enrolment";

                    if(isset($clientDocArr[6]))
                        $resultArr=$clientDocArr[6];
                }
                elseif($e_cli['id']==10)
                {
                    $lastColName="PT-Registration";

                    if(isset($clientDocArr[7]))
                        $resultArr=$clientDocArr[7];
                }
                elseif($e_cli['id']==11)
                {
                    $lastColName="Registration No";

                    if(isset($clientDocArr[10]))
                        $resultArr=$clientDocArr[10];
                }
            }
        }

        $this->data['optionName']=$optionName;
        $this->data['optionType']=$optionType;
        $this->data['lastColName']=$lastColName;
        $this->data['resultArr']=$resultArr;

        $html=view('admin/report/getMasterClientData', $this->data);

        $html = mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8');
        $options = new Options();
        $options->set('isHtml5ParserEnabled', TRUE);
        $options->set('isRemoteEnabled', TRUE);
        $options->setDefaultFont('Verdana');

        $pdf = new \Dompdf\Dompdf($options); 
        $pdf->loadHtml(view('admin/report/getMasterClientData', $this->data));
        $pdf->setPaper('A4', 'portrait');
        $pdf->render();

        $canvas = $pdf->getCanvas();
        $header = $canvas->open_object();
        $font = $pdf->getFontMetrics()->get_font("helvetica", "bold");

        // $pdf->getCanvas()->page_text(72, 18, "Header: {PAGE_NUM} of {PAGE_COUNT}", $font, 10, array(0,0,0));

        $canvas->page_text(500, 803, "Page: {PAGE_NUM} of {PAGE_COUNT}", $font, 10, array(0,0,0));
        $canvas->page_text(90, 803, $reportTitle." (".$optionName.")", $font, 10, array(0,0,0));

        // $pdf->getCanvas()->image($cmpyLogo,'png', 790, 0, 30, 30);

        // $canvas->image($cmpyLogo, 20, 790, 40, 30);

        $canvas->close_object();
        $canvas->add_object($header, 'all');

        $file_name=strtolower(str_replace(" ", "_", trim($reportTitle)));
        
        // header('Content-type:application/pdf');

        // Output the generated PDF (1 = download and 0 = preview)
        $pdf->stream($file_name.".pdf", array("Attachment"=>0));
        exit();

        // $pdf->stream();
    }

    // function htmlToPDF(){
    //     $dompdf = new \Dompdf\Dompdf(); 
    //     $dompdf->loadHtml(view('pdf_view'));
    //     $dompdf->setPaper('A4', 'portrait');
    //     $dompdf->render();
    //     $dompdf->stream();
    // }
}
?>