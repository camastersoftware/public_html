<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use CodeIgniter\I18n\Time;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */

class BaseController extends Controller
{
    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = ['cookie', 'form', 'Money_helper', 'Check_valid_date_helper', 'Common_helper'];

    /**
     * Constructor.
     *
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param LoggerInterface   $logger
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        $uri = service('uri');
        $totalSegments = $uri->getTotalSegments();

        $uri1 = "";
        $uri2 = "";
        $uri3 = "";

        if (!empty($totalSegments)) {
            $uri1 = $uri->getSegment(1);

            if ($totalSegments >= 2)
                $uri2 = $uri->getSegment(2);

            if ($totalSegments >= 3)
                $uri3 = $uri->getSegment(3);
        }

        //Libraries
        $this->validation =  \Config\Services::validation();
        $this->session = \Config\Services::session();
        $this->db = \Config\Database::connect();

        $this->userLoginName = $this->session->get('userLoginName');

        // $this->admDB = $this->db;

        // if(!empty($this->userLoginName))
        //     $this->admDB = \Config\Database::connect('adminDB');

        //Models
        $this->Mcommon = new \App\Models\Mcommon();
        $this->Mfirm = new \App\Models\Mfirm();
        $this->Mfeedback = new \App\Models\Mfeedback();

        $cssArr = array();
        $jsArr = array();

        $this->data['uri1'] = $uri1;
        $this->data['uri2'] = $uri2;
        $this->data['uri3'] = $uri3;

        $this->data['cssArr'] = $cssArr;
        $this->data['jsArr'] = $jsArr;

        $flashGreetingMsg = $this->session->getFlashdata('greetingMsg');
        $flashSuccessMsg = $this->session->getFlashdata('successMsg');
        $flashWarningMsg = $this->session->getFlashdata('warningMsg');
        $flashErrorMsg = $this->session->getFlashdata('errorMsg');

        $this->data['flashGreetingMsg'] = $flashGreetingMsg;
        $this->data['flashSuccessMsg'] = $flashSuccessMsg;
        $this->data['flashWarningMsg'] = $flashWarningMsg;
        $this->data['flashErrorMsg'] = $flashErrorMsg;

        $pageTitle = "N/A";
        $this->data['pageTitle'] = $pageTitle;

        $navArr = array();
        $this->data['navArr'] = $navArr;

        $this->currTimeStamp = date('Y-m-d H:i:s');
        $this->IPAddress = $request->getIPAddress();
        // $this->macAddress=strtok(exec('getmac'), ' ');
        $this->requestMethod = $request->getMethod();

        $lndryThemeCookie = get_cookie("templateThemeLndry");

        $this->data['lndryThemeCookie'] = $lndryThemeCookie;
        $this->data['base_url'] = base_url();

        $this->adminId = $this->session->get('adminId');
        $this->adminUserName = $this->session->get('userName');
        $this->adminStatus = $this->session->get('status');
        $this->sessCaFirmId = $this->session->get('caFirmId');
        $this->sessCompanyKey = $this->session->get('companyKey');
        $this->sessUserLoginName = $this->session->get('userLoginName');
        $this->sessCaFirmName = $this->session->get('caFirmName');
        $this->sessUserId = $this->session->get('userId');
        $this->sessUserFullName = $this->session->get('userFullName');
        $this->sessUserImg = $this->session->get('userImg');
        $this->sessDueDateYear = $this->session->get('dueDateYear');

        $this->data['sessUserLoginID'] = $this->adminId;
        $this->data['sessUserLoginName'] = $this->sessUserLoginName;
        $this->data['sessCompanyKey'] = $this->sessCompanyKey;
        $this->data['sessCaFirmId'] = $this->sessCaFirmId;
        $this->data['sessCaFirmName'] = $this->sessCaFirmName;
        $this->data['sessUserId'] = $this->sessUserId;
        $this->data['sessUserFullName'] = $this->sessUserFullName;
        $this->data['sessUserImg'] = $this->sessUserImg;

        $this->data['sessDueDateYear'] = $this->sessDueDateYear;
        $this->data['requestMethod'] = $this->requestMethod;

        if (date('n') <= 3)
            $this->currentFinancialYear = date('Y') - 1;
        else
            $this->currentFinancialYear = date('Y');

        $this->data['currentFinancialYear'] = $this->currentFinancialYear;

        // $this->session->destroy();

        $this->greetings = "";
        /* This sets the $time variable to the current hour in the 24 hour clock format */
        $time = date("H");
        /* Set the $timezone variable to become the current timezone */
        $timezone = date("e");
        /* If the time is less than 1200 hours, show good morning */
        if ($time < "12") {
            $this->greetings = "<i class='wi wi-day-sunny'></i>&nbsp;Good morning";
        } else
            /* If the time is grater than or equal to 1200 hours, but less than 1700 hours, so good afternoon */
            if ($time >= "12" && $time < "17") {
                $this->greetings = "<i class='wi wi-day-cloudy'></i>&nbsp;Good afternoon";
            } else
                /* Should the time be between or equal to 1700 and 1900 hours, show good evening */
                if ($time >= "17" && $time < "19") {
                    $this->greetings = "<i class='wi wi-day-haze'></i>&nbsp;Good evening";
                } else
                    /* Finally, show good night if the time is greater than or equal to 1900 hours */
                    if ($time >= "19") {
                        $this->greetings = "<i class='wi wi-moon-alt-waxing-cresent-1'></i>&nbsp;Good night";
                    }

        $this->data['greetingsLabel'] = $this->greetings;

        // $currentTime = gmdate("l jS \of F Y h:i:s A");
        $currentTime = gmdate("l, F j, Y");

        $this->data['currentTime'] = $currentTime;

        $this->admUploadPath = base_url('uploads/admin');

        $this->data['admUploadPath'] = $this->admUploadPath;

        setlocale(LC_MONETARY, 'en_IN');

        $totalFirmArr = $this->Mfirm->select('COUNT(ca_firm_tbl.caFirmId) AS totalFirms, SUM(ca_firm_tbl.caFirmUsers) AS totalUsers')
            ->where('ca_firm_tbl.status', 1)
            ->where('ca_firm_tbl.caFirmStatus', 1)
            ->where('ca_firm_tbl.isVerified', 1)
            ->where('ca_firm_tbl.isTermsAgree', 1)
            ->where('ca_firm_tbl.caFirmCompanyKey !=', "")
            ->get()
            ->getRowArray();

        $this->data['totalFirmArr'] = $totalFirmArr;

        $feedbackList = $this->Mfeedback->select('feedback_tbl.*')
            ->where('feedback_tbl.status', 1)
            ->findAll();

        $this->data['feedbackList'] = $feedbackList;

        $feedbackAvgVal = 0;

        if (!empty($feedbackList)) {
            $feedbackTotalRating = array_sum(array_column($feedbackList, 'ratingVal'));

            $totalfeedbacks = count($feedbackList);

            $feedbackAvg = $feedbackTotalRating / $totalfeedbacks;

            $feedbackAvgVal = number_format((float)$feedbackAvg, 2, '.', '');
        }

        $this->data['feedbackAvgVal'] = $feedbackAvgVal;

        $this->data['tot_Msg_Count'] = getTotMSGCount($this->sessUserId);
        //    dd($this->data['tot_Msg_Count']);

        //--------------------------------------------------------------------
        // Preload any models, libraries, etc, here.
        //--------------------------------------------------------------------
        // E.g.: $this->session = \Config\Services::session();
    }
}
