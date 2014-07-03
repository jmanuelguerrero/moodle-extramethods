<?php

// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * External Extra Methods
 *
 * @package 	localextramethods
 * @copyright  Jose Manuel Guerrero (jmanuelguerrero@gmail.com) & Jose reyero (consulting@reyero.net)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once($CFG->libdir . "/externallib.php");

class local_extramethods_external extends external_api {

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function extramethods_get_user_finised_by_uid_parameters() {
        return new external_function_parameters(
                array('iduser' => new external_value(PARAM_TEXT, 'The user id,"'))
        );
    }
    
    public static function extramethods_get_user_finised_by_username_parameters() {
    	return new external_function_parameters(
    			array('username' => new external_value(PARAM_TEXT, 'The user name,"'))
    	);
    }
    
    public function get_User_Id($username){
    	global $USER, $DB;
    	$userid = $DB->get_records_select('user', 'username = "'.$username.'"' , array ($fields='id'));
    	$output = key($userid);
    	return $output;
    }
    
    public function manage_Null()
    {
    	$exit = array();
    	return $exit;
    }

    /**
     * Returns welcome message
     * @return string welcome message
     */
    public static function extramethods_get_user_finised_by_username($username) {
    	global $USER, $DB;
    	$iduser = self::get_User_Id($username);
    	if (!isset($iduser)){
    		$query = self::manage_NULL();
    	}
    	else 
    	{
    		$query = $DB->get_records_select('course_completions', 'userid= '.$iduser.'');
    	}
    	$params = self::validate_parameters(self::extramethods_get_user_finised_by_uid_parameters(),
    			array('iduser' => $iduser));
    
    	$context = get_context_instance(CONTEXT_USER, $USER->id);
    	self::validate_context($context);
    
    	if (!has_capability('moodle/user:viewdetails', $context)) {
    		throw new moodle_exception('cannotviewprofile');
    	}

    	return $query;
    }
    
    /**
     * Returns welcome message
     * @return string welcome message
     */
    public static function extramethods_get_user_finised_by_uid($iduser) {
        global $USER, $DB;

      	$query = $DB->get_records_select('course_completions', 'userid= '.$iduser.'');

        $params = self::validate_parameters(self::extramethods_get_user_finised_by_uid_parameters(),
                array('iduser' => $iduser));

        $context = get_context_instance(CONTEXT_USER, $USER->id);
        self::validate_context($context);

        if (!has_capability('moodle/user:viewdetails', $context)) {
            throw new moodle_exception('cannotviewprofile');
        }

		return $query;
    }

    /**
     * Returns description of method result value
     * @return array
     */
    public static function extramethods_get_user_finised_by_uid_returns() {
       
    	return new external_multiple_structure(
    			new external_single_structure(
    			 array(
       				'id' => new external_value(PARAM_INT, 'id of course finished'),
        			'userid' => new external_value(PARAM_TEXT, 'User id'),
        			'course' => new external_value(PARAM_INT, 'Course id'),
        			'timeenrolled' => new external_value(PARAM_TEXT, 'Time enrolled in the course'),
        			'timestarted' => new external_value(PARAM_TEXT, 'When the user start'),
        			'timecompleted' => new external_value(PARAM_TEXT, 'when the user end'),
        			'reaggregate' => new external_value(PARAM_TEXT, 'reagregate to a course')
       			)
       	)
    );
    	
    	
    }    
    /**
     * Returns description of method result value
     * @return array
     */
    public static function extramethods_get_user_finised_by_username_returns() {
    	return new external_multiple_structure(
    			new external_single_structure(
    			array(
   					'id' => new external_value(PARAM_INT, 'id of course finished'),
   					'userid' => new external_value(PARAM_TEXT, 'User id'),
   					'course' => new external_value(PARAM_INT, 'Course id'),
   					'timeenrolled' => new external_value(PARAM_TEXT, 'Time enrolled in the course'),
   					'timestarted' => new external_value(PARAM_TEXT, 'When the user start'),
   					'timecompleted' => new external_value(PARAM_TEXT, 'when the user end'),
   					'reaggregate' => new external_value(PARAM_TEXT, 'reagregate to a course')
   			)
     	)
   );
    	 
    	 
    }   

    
    
}
