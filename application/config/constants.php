<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
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
defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code
define('WELCOME_MSG', "Welcome to Restaurant.");
define('SIGNUP_PROFILE','See Your Email Inbox And Spam, A Link Has Been Sent By Us So That You Can Varify Your Account, Then You Will Be Able To Login.');
define('PROFILE_VERIFY','Profile Verified.');
define('PROFILE_NOTVERIFY','Profile Not Verified.');
define('PROFILE_ALLVERIFY','Profile Already Verified Verified.');
define('LOGIN','Login  Successfull.');
define('LOGINUN','Login  Unsuccessfull.');
define('UPDATE_PROFILE','Update Profile Successfull.');
define('ADDAUCTION','Restaurant Add Successfull.');
define('NOTADDAUCTION','Restaurant Not Added Successfull.');
define('MYAUCTION','Get My All Restaurant.');
define('NOAUCTION','No Restaurant.');
define('EDITAUCTION','Restaurant Update Successfull.');
define('CHKFIELD','Please Check All Field.');
define('NODATA','NO Data Found.');
define('DELAUCTION','Restaurant Delete Successfull.');
define('BIDPLACE','Bid Place.');
define('VOTE','Vote Your Profile');
define('VIEW','View Restaurant');
define('RATING','Rating');
define('CRYSET_TBL',"currency_setting");
define('INSPLACE','Bid Place Successfull.');
define('INSVOTE','Vote  Successfull.');
define('NOVOTE','You can not vote on your product.');
define('DISVOTE','You can not vote on your product.');
define('INSVIEW','View Restaurant  Successfull.');
define('INSRAT','Rating Successfull.');
define('MYBID','Get All Bid List.');
define('USER_INFO','Get User Info.');
define('LOGIN_FLASH',"Please enter valid Username or Password.");
define('MYVIEWCOUNT',"My View Count.");
define('MYVOTECOUNT',"My Vote Count.");
define('NOVIEW',"No View.");
define('NOEMAIL',"Email Not Exits.");
define('RESETPASS',"Reset password.");
define('GET_CART', "Get my Cart.");
define('CART_EMPTY', "Cart is empty");
define('FORGETPASS',"Your password changed Successfull and your login password is  .");
define('CART_UPDATE',"Cart updated successfully.");
define('MAKE_ORDER', "Make Order");
define('NOT_RESPONDING', 'Please try after some time');
define('NO_PRODUCT', "No products");
define('GET_CAT', "Get All Category.");
define('GET_MENU', "Get All Menu.");
define('NO_CAT', "Category not found.");
define('NO_MENU', "Menu not found.");
define('PUR_ADD', "Purchase and expenses added successfully.");
define('ACCOUNT_STATUS', "Your account is deactivate by admin.");
define('FIRE_BASE_KEY', "AAAASpTNidM:APA91bEZ31QjBfKtSfrBRy-0ZbmNsgnVqzJYtZMs8PbrIhX-KXeTty_cIgu00B6LlxtBhfEX1vGTlxh0Wms9GiT5TkGJTnt7Rg9lSP_dI0Wpi8TSJ56Y9cDRaBmTwFzSmPyPZ2VyVS1igzTZB2Gx0Z8trHLqVyQV_g");
 