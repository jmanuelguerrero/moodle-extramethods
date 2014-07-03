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
 * Web service local plugin template external functions and service definitions.
 *
 * @package    localextramethods
 * @copyright  Jose Manuel Guerrero (jmanuelguerrero@gmail.com) & Jose reyero (consulting@reyero.net)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

// We defined the web service functions to install.
$functions = array(
        'local_extramethods_get_user_finised_by_uid' => array(
                'classname'   => 'local_extramethods_external',
                'methodname'  => 'extramethods_get_user_finised_by_uid',
                'classpath'   => 'local/extramethods/externallib.php',
                'description' => 'Return courses finished by uid',
                'type'        => 'read',
        ),
        'local_extramethods_get_user_finised_by_username' => array(
        		'classname'   => 'local_extramethods_external',
        		'methodname'  => 'extramethods_get_user_finised_by_username',
        		'classpath'   => 'local/extramethods/externallib.php',
        		'description' => 'Return courses finished by username',
        		'type'        => 'read',
        )
);

// We define the services to install as pre-build services. A pre-build service is not editable by administrator.
$services = array(
        'extramethods' => array(
                'functions' => array (
                		'local_extramethods_get_user_finised_by_uid',
                		'local_extramethods_get_user_finised_by_username'),
                'restrictedusers' => 0,
                'enabled'=>1,
        		)
     
);
