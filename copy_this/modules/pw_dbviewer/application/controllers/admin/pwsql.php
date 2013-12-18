<?php

/**
 * PW_DBViewer Module
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

 
class pwsql extends oxAdminView
{
    /**
     * Export class name
     *
     * @var string
     */
    public $sClassDo = "pwsql";

    protected $_sThisTemplate = "pwsql.tpl";
	
    public function render()
    {
        parent::render();
        $oSmarty = oxUtilsView::getInstance()->getSmarty();
        $oSmarty->assign( "oViewConf", $this->_aViewData["oViewConf"]);
        $oSmarty->assign( "shop", $this->_aViewData["shop"]);

        $cSrcVal = isset($_POST['pwsql_srcval']) ? $_POST['pwsql_srcval'] : $_GET['pwsql_srcval']; 
        if (empty($cSrcVal)) {
            $cSrcVal = "Select count(*) from oxorder where oxorder.oxstorno = 0 ";
         }
        $oSmarty->assign( "pwsql_srcval", $cSrcVal );
        
        $sSql = $cSrcVal;
		
        $aSql = array();
        if ($cSrcVal != "") {
   	        $this->fpFile = @fopen( $this->_sFilePath, "w");
              if ( !isset( $this->fpFile) || !$this->fpFile) {
                // we do have an error !
                echo '<h1>Fehler beim Schreiben der Datei!</h1>';
              } else {
   
            $oDb = oxDb::getDb( oxDB::FETCH_MODE_ASSOC );
            $rs = $oDb->Execute($sSql);
						
			if ( $rs != false && $rs->recordCount() > 0) {
            
			    $aColumnNames = array_keys($rs->fields);
			    fputcsv( $this->fpFile,$aColumnNames,';','"');
			    $oSmarty->assign("aColumnNames",$aColumnNames);
                while (!$rs->EOF) {
			       array_push($aSql, $rs->fields);
				   $this->write( $this->fpFile , $rs->fields );
				   $rs->MoveNext();
                }
			} 
            fclose( $this->fpFile);
			}
        }

   
         $oSmarty->assign("aSql",$aSql);
		 
         return $this->_sThisTemplate;
   }
   
    public function write ( $file, $aLine)
    {
    
	$converted_fields = array();
    foreach ($aLine as $value) {
    //$converted_fields[] = mb_convert_encoding($value, "UTF-8");
    $converted_fields[] = $value;
    }
    fputcsv($file, $converted_fields,';','"');
	
	}	
	
    public function __construct()
    {
        parent::__construct();

        // export file name
        $this->sExportFileName = $this->_getExportFileName();

        // set generic frame template
        $this->_sFilePath = $this->_getExportFilePath();
    }

    protected function _getExportFileName()
    {
        $sSessionFileName = oxSession::getVar( "sExportFileName" );
        if ( !$sSessionFileName ) {
            $sSessionFileName = md5( $this->getSession()->getId() . oxUtilsObject::getInstance()->generateUId() );
            oxSession::setVar( "sExportFileName", $sSessionFileName.".csv" );
        }
        return $sSessionFileName;
    }
	
	protected function _getExportFilePath()
    {
        return $this->getConfig()->getConfigParam( 'sShopDir' ) . "/admin/". $this->_getExportFileName();
    }

       /**
     * Returns export file download url
     *
     * @return string
     */
    public function getDownloadUrl()
    {
        $myConfig = $this->getConfig();

        // override cause of admin dir
        $sUrl = $myConfig->getConfigParam( 'sShopURL' ). $myConfig->getConfigParam( 'sAdminDir' );
        if ( $myConfig->getConfigParam( 'sAdminSSLURL' ) ) {
            $sUrl = $myConfig->getConfigParam( 'sAdminSSLURL' );
        }

        //$sUrl = oxRegistry::get("oxUtilsUrl")->processUrl( $sUrl.'/index.php' );
        //return $sUrl . '&amp;cl='.$this->sClassDo.'&amp;fnc=download';
		$sUrl = oxRegistry::get("oxUtilsUrl")->processUrl( $sUrl.'/'.$this->_getExportFileName() );
        return $sUrl;
		
    }

	 /**
     * Performs pwsql csv export to export file.
     *
     * @return null
     */
    public function download()
    {
	    $pwsql_dlfilename = "export";
        
        $oUtils = oxRegistry::getUtils();
        $oUtils->setHeader( "Pragma: public" );
        $oUtils->setHeader( "Cache-Control: must-revalidate, post-check=0, pre-check=0" );
        $oUtils->setHeader( "Expires: 0" );
        $oUtils->setHeader( "Content-Disposition: attachment; filename=".$pwsql_dlfilename.".csv");
        $oUtils->setHeader( "Content-Type: application/csv ");
		//$oUtils->setHeader( "Content-Type: application/csv; charset=Windows-1252" );
        $sFile = $this->_getExportFilePath();
        if ( file_exists( $sFile ) && is_readable( $sFile ) ) {
            readfile( $sFile );
        }
        $oUtils->showMessageAndExit( "" );
    }
 }
?>