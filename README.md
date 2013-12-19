Language packs for OXID eShop
=============================

This repository is used to collect all language key translations and related files under GPLv3 for OXID eShop:

###1 - language keys and translations for the store front, admin panel, help texts and setup
The translations are done via http://translate.oxidforge.org and will be exported to GitHub from this place. 
If you can help with translations, please register there instead of sending a pull request via GitHub.

###2 - transliteration lists
Aside the base lang files you will find a file /application/translations/{locale}/translit_lang.php containing an array with a language based 
list of special characters (e.g. German Umlauts) transliterating them into clean latin characters, for example: ä => ae. 
This is valid especially for languages with non-latin based characters for clean latin based URLs. 
Please feel free to send pull requests where the file is missing or the lists are incomplete.

###3 - map.php files
map.php files are used to support theming and own language keys in different themes in OXID eShop and can depend on the
basic language used for the translation.
Please feel free to send pull requests for such files.

###4 - flag images
You will find the flag images for azure theme in the following folder:<br>
/out/azure/img/lang/ adjusted at 14x10 px<br>
Please feel free to send pull requests for such files.

You'll find the translated language files for former OXID eShop versions in the 'tags' section:<br>
https://github.com/OXIDprojects/languages/tags

For more information and how to install a language, please visit<br>
http://wiki.oxidforge.org/Tutorials/Language_handling


DB Viewer
=============================
This module allows you to execute SQL statements in the admin console. It will display the results dynamically. 
You can also download the results as CSV.  

This is helpful for quick database analysis e.g. "the Client adresses of last month, analysis of your articles etc."

DISCLAIMER: it is possible to execute EVERY SQL Statement. So please be careful. Use only if you know SQL!

Tested with OXID eShop Community Edition version: 4.7 


NOTICE OF LICENSE
=============================
	* This program is free software: you can redistribute it and/or modify
	* it under the terms of the GNU General Public License as published by
	* the Free Software Foundation; version 3 of the License
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

 
Installation
=============================
	1. Copy "copy_this" to OXID Directory
	2. Activate the module in the OXID Admin GUI (Erweiterungen=>Module=>DB Viewser => activate!)
	3. Delete the TMP Directory
	4. Go to Services within the ADMIN Console and use DB VIEWER

