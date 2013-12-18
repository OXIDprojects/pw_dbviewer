<?php

/**
 * This OXID module gives you the ability in the admin area to submit select statements.
 * The results will be displayed. You can also download them as csv. 
 * 
 * You need the be administrator to use this function. 
 * There will be a new submenu under services. 
 * 
 * NOTICE OF LICENSE
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; version 3 of the License
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see http://www.gnu.org/licenses/
 *
 * @copyright   Copyright (c) 2013 Peter Wiedeking
 * @author      Peter Wiedeking
 * @license     http://opensource.org/licenses/GPL-3.0  GNU General Public License, version 3 (GPL-3.0)
 */

/**
 * Metadata version
 */
$sMetadataVersion = '1.0';
 
/**
 * Module information
 */
$aModule = array(
    'id'           => 'pw_dbviewer',
    'title'        => 'DB Viewer ',
    'description'  => array(
                        'de'=>'Modul zur Anzeige von SQL Ergebnissen. - Neues Sub-Menue unter Services<br>Benutzung auf eigene Gefahr!',
                        'en'=>'module to display sql results. - New Sub-Menue under Services<br>Use at your own risk!'
                        ),
    'thumbnail'    => 'abendtuete.png',
    'version'      => '1.0',
    'author'       => 'peter wiedeking',
    'url'          => '',
    'email'        => 'peter.wiedeking@abendtuete.de',
    'extend'       => array(
                        ),
    'files'        => array(
        'pwsql' => 'pw_dbviewer/application/controllers/admin/pwsql.php'
                        ),
    'templates'    => array(
        'pwsql.tpl' => 'pw_dbviewer/views/admin/tpl/pwsql.tpl'
                        ),
    );

?>
