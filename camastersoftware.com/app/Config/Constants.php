<?php

/*
 | --------------------------------------------------------------------
 | App Namespace
 | --------------------------------------------------------------------
 |
 | This defines the default Namespace that is used throughout
 | CodeIgniter to refer to the Application directory. Change
 | this constant to change the namespace that all application
 | classes should use.
 |
 | NOTE: changing this will require manually modifying the
 | existing namespaces of App\* namespaced-classes.
 */
defined('APP_NAMESPACE') || define('APP_NAMESPACE', 'App');

/*
 | --------------------------------------------------------------------------
 | Composer Path
 | --------------------------------------------------------------------------
 |
 | The path that Composer's autoload file is expected to live. By default,
 | the vendor folder is in the Root directory, but you can customize that here.
 */
defined('COMPOSER_PATH') || define('COMPOSER_PATH', ROOTPATH . 'vendor/autoload.php');

/*
 |--------------------------------------------------------------------------
 | Timing Constants
 |--------------------------------------------------------------------------
 |
 | Provide simple ways to work with the myriad of PHP functions that
 | require information to be in seconds.
 */
defined('SECOND') || define('SECOND', 1);
defined('MINUTE') || define('MINUTE', 60);
defined('HOUR')   || define('HOUR', 3600);
defined('DAY')    || define('DAY', 86400);
defined('WEEK')   || define('WEEK', 604800);
defined('MONTH')  || define('MONTH', 2592000);
defined('YEAR')   || define('YEAR', 31536000);
defined('DECADE') || define('DECADE', 315360000);

/*
 | --------------------------------------------------------------------------
 | Exit Status Codes
 | --------------------------------------------------------------------------
 |
 | Used to indicate the conditions under which the script is exit()ing.
 | While there is no universal standard for error codes, there are some
 | broad conventions.  Three such conventions are mentioned below, for
 | those who wish to make use of them.  The CodeIgniter defaults were
 | chosen for the least overlap with these conventions, while still
 | leaving room for others to be defined in future versions and user
 | applications.
 |
 | The three main conventions used for determining exit status codes
 | are as follows:
 |
 |    Standard C/C++ Library (stdlibc):
 |       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
 |       (This link also contains other GNU-specific conventions)
 |    BSD sysexits.h:
 |       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
 |    Bash scripting:
 |       http://tldp.org/LDP/abs/html/exitcodes.html
 |
 */
defined('EXIT_SUCCESS')        || define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          || define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         || define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   || define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  || define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') || define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     || define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       || define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      || define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      || define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code

defined('EXT_DUE_DATE_CLR')      || define('EXT_DUE_DATE_CLR', "#80ccdd99"); // Extended Due Date Colour

defined('EXT_DUE_DATE_STYLE')       ||  define('EXT_DUE_DATE_STYLE', "#dbe3dd9e"); // Extended Due Date Colour
defined('PROJ_PREFIX')              ||  define('PROJ_PREFIX', "camastersoftware"); // Firms Database User Name
defined('FIRM_DB_USERNAME')         ||  define('FIRM_DB_USERNAME', "camastersoftware_firm_user"); // Firms Database User Name
defined('FIRM_DB_PASSWORD')         ||  define('FIRM_DB_PASSWORD', "_W8_16dQ$;)S"); // Firms Database Password

// defined('FIRM_DB_USERNAME')         ||  define('FIRM_DB_USERNAME', "root"); // Firms Database User Name
// defined('FIRM_DB_PASSWORD')         ||  define('FIRM_DB_PASSWORD', ""); // Firms Database Password

$INDIVIDUAL_ARRAY = array(8, 9, 22, 23);

defined('INDIVIDUAL_ARRAY')       ||  define('INDIVIDUAL_ARRAY', $INDIVIDUAL_ARRAY); // Extended Due Date Colour



//---------------------------------------------------------------------------------------------------------//
// ----------------------------------------- Due Date For -------------------------------------------------//
//---------------------------------------------------------------------------------------------------------//


// ----------------------------------------- Income Tax - Start --------------------------------------// 

// Returns
$INC_RET_DDF_ARRAY = array(1, 4, 6, 7, 8, 142, 190, 265);
defined('INC_RET_DDF_ARRAY')       ||  define('INC_RET_DDF_ARRAY', $INC_RET_DDF_ARRAY);

// Audit
$INC_ADT_DDF_ARRAY = array(2, 5);
defined('INC_ADT_DDF_ARRAY')       ||  define('INC_ADT_DDF_ARRAY', $INC_ADT_DDF_ARRAY);

// Tax Payments 
$INC_PMT_DDF_ARRAY = array(101);
defined('INC_PMT_DDF_ARRAY')       ||  define('INC_PMT_DDF_ARRAY', $INC_PMT_DDF_ARRAY);

// ----------------------------------------- Income Tax - End ---------------------------------------// 



// ----------------------------------------- Companies Act - Start --------------------------------------// 

// Returns
// $CMPY_RET_DDF_ARRAY = array(106, 107, 112, 113);
$CMPY_RET_DDF_ARRAY = array(106, 112, 113);
defined('CMPY_RET_DDF_ARRAY')       ||  define('CMPY_RET_DDF_ARRAY', $CMPY_RET_DDF_ARRAY);

// Audit
$CMPY_ADT_DDF_ARRAY = array(49, 227);
defined('CMPY_ADT_DDF_ARRAY')       ||  define('CMPY_ADT_DDF_ARRAY', $CMPY_ADT_DDF_ARRAY);

// ----------------------------------------- Companies Act - End ---------------------------------------//



// ----------------------------------------- TDS Income Tax - Start --------------------------------------// 

// Returns
$TDS_INC_RET_DDF_ARRAY = array(126, 187, 165, 121);
defined('TDS_INC_RET_DDF_ARRAY')       ||  define('TDS_INC_RET_DDF_ARRAY', $TDS_INC_RET_DDF_ARRAY);

// Payment
$TDS_INC_PMT_DDF_ARRAY = array(162, 124, 263, 185, 128, 164, 160, 118);
defined('TDS_INC_PMT_DDF_ARRAY')       ||  define('TDS_INC_PMT_DDF_ARRAY', $TDS_INC_PMT_DDF_ARRAY);

// Certificate
$TDS_INC_CERT_DDF_ARRAY = array(163, 184, 189, 159, 166, 161, 42);
defined('TDS_INC_CERT_DDF_ARRAY')       ||  define('TDS_INC_CERT_DDF_ARRAY', $TDS_INC_CERT_DDF_ARRAY);

// ----------------------------------------- TDS Income Tax - End ---------------------------------------// 



// ----------------------------------------- TCS Income Tax - Start --------------------------------------// 

// Returns
$TCS_INC_RET_DDF_ARRAY = array(178);
defined('TCS_INC_RET_DDF_ARRAY')       ||  define('TCS_INC_RET_DDF_ARRAY', $TCS_INC_RET_DDF_ARRAY);

// Payment
$TCS_INC_PMT_DDF_ARRAY = array(177);
defined('TCS_INC_PMT_DDF_ARRAY')       ||  define('TCS_INC_PMT_DDF_ARRAY', $TCS_INC_PMT_DDF_ARRAY);

// Certificate
$TCS_INC_CERT_DDF_ARRAY = array(179);
defined('TCS_INC_CERT_DDF_ARRAY')       ||  define('TCS_INC_CERT_DDF_ARRAY', $TCS_INC_CERT_DDF_ARRAY);

// ----------------------------------------- TCS Income Tax - End ---------------------------------------// 



// ----------------------------------------- TDS - TCS Income Tax - Start --------------------------------------// 

// Returns
$TDS_TCS_INC_RET_DDF_ARRAY = array_merge($TDS_INC_RET_DDF_ARRAY, $TCS_INC_RET_DDF_ARRAY);
defined('TDS_TCS_INC_RET_DDF_ARRAY')       ||  define('TDS_TCS_INC_RET_DDF_ARRAY', $TDS_TCS_INC_RET_DDF_ARRAY);

// Payment
$TDS_TCS_INC_PMT_DDF_ARRAY = array_merge($TDS_INC_PMT_DDF_ARRAY, $TCS_INC_PMT_DDF_ARRAY);
defined('TDS_TCS_INC_PMT_DDF_ARRAY')       ||  define('TDS_TCS_INC_PMT_DDF_ARRAY', $TDS_TCS_INC_PMT_DDF_ARRAY);

// Certificate
$TDS_TCS_INC_CERT_DDF_ARRAY = array_merge($TDS_INC_CERT_DDF_ARRAY, $TCS_INC_CERT_DDF_ARRAY);
defined('TDS_TCS_INC_CERT_DDF_ARRAY')       ||  define('TDS_TCS_INC_CERT_DDF_ARRAY', $TDS_TCS_INC_CERT_DDF_ARRAY);

// ----------------------------------------- TDS - TCS Income Tax - End ---------------------------------------// 



// ----------------------------------------- Profession Tax - Start --------------------------------------// 

// Enrolment - Payment
$PT_ENROL_PMT_DDF_ARRAY = array(67);
defined('PT_ENROL_PMT_DDF_ARRAY')       ||  define('PT_ENROL_PMT_DDF_ARRAY', $PT_ENROL_PMT_DDF_ARRAY);

// Registration - Returns
$PT_REG_RET_DDF_ARRAY = array(133);
defined('PT_REG_RET_DDF_ARRAY')       ||  define('PT_REG_RET_DDF_ARRAY', $PT_REG_RET_DDF_ARRAY);

// Registration - Payment
$PT_REG_PMT_DDF_ARRAY = array(134);
defined('PT_REG_PMT_DDF_ARRAY')       ||  define('PT_REG_PMT_DDF_ARRAY', $PT_REG_PMT_DDF_ARRAY);

// ----------------------------------------- Profession Tax - End ---------------------------------------// 



// ----------------------------------------- LLP - Start --------------------------------------// 

// Returns
$LLP_RET_DDF_ARRAY = array(116, 117);
defined('LLP_RET_DDF_ARRAY')       ||  define('LLP_RET_DDF_ARRAY', $LLP_RET_DDF_ARRAY);

// Audit
$LLP_ADT_DDF_ARRAY = array(64);
defined('LLP_ADT_DDF_ARRAY')       ||  define('LLP_ADT_DDF_ARRAY', $LLP_ADT_DDF_ARRAY);

// ----------------------------------------- LLP - End ---------------------------------------// 



// ----------------------------------------- GST - Start --------------------------------------// 

// Returns
$GST_RET_DDF_ARRAY = array(146, 147, 148, 149, 255, 260, 261, 150, 151, 152, 153, 154, 155, 156);
defined('GST_RET_DDF_ARRAY')       ||  define('GST_RET_DDF_ARRAY', $GST_RET_DDF_ARRAY);

// Audit
$GST_ADT_DDF_ARRAY = array(76);
defined('GST_ADT_DDF_ARRAY')       ||  define('GST_ADT_DDF_ARRAY', $GST_ADT_DDF_ARRAY);

// Tax Payments 
$GST_PMT_DDF_ARRAY = array(75, 76, 148, 149, 151, 152, 154, 155, 156, 260);
defined('GST_PMT_DDF_ARRAY')       ||  define('GST_PMT_DDF_ARRAY', $GST_PMT_DDF_ARRAY);

// ----------------------------------------- GST - End ---------------------------------------// 



// ----------------------------------------- Work Form Link - Start --------------------------------------// 

$WORK_FORM_LINK_ARR = 
    array(
        "1" => "income_tax/work_form/",  // Income Tax Act
        "3" => "",  // TDS Act
        "4" => "company-work-form/",  // Companies Act
        "6" => "llp-work-form/",  // LLP Act
        "7" => "",  // Profession Tax Act
        "8" => "",  // Act
        "9" => "",  // Act
        "10" => "",  // Act
        "11" => "",  // Act
        "12" => "",  // Act
        "13" => "",  // Act
        "14" => "",  // Act
        "15" => "",  // Act
        "16" => "",  // Act
        "17" => "",  // Act
        "18" => "",  // Act
        "19" => "",  // Act
        "20" => ""  // Act
    );
defined('WORK_FORM_LINK_ARR')       ||  define('WORK_FORM_LINK_ARR', $WORK_FORM_LINK_ARR);


// ----------------------------------------- Work Form Link - End ---------------------------------------//


// ----------------------------------------- Updated Return Due Date For Id's - Start --------------------------------------//

$INC_TAX_UPDATED_RETURN = array(265, 309, 310);

defined('INC_TAX_UPDATED_RETURN')       ||  define('INC_TAX_UPDATED_RETURN', $INC_TAX_UPDATED_RETURN);

// ----------------------------------------- Updated Return Due Date For Id's - End ---------------------------------------//


// ----------------------------------------- Images Path - Start --------------------------------------//

defined('EVERYDAYLABPATH')       ||  define('EVERYDAYLABPATH', "uploads/admin/everyday_lab/");

// ----------------------------------------- Images Path - End ---------------------------------------// 



