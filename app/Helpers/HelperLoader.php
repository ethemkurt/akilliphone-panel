<?php
define('FORCEADMIN', TRUE);
if(is_file( dirname(__FILE__).'/Helpers.php') ){
    include_once( dirname(__FILE__).'/Helpers.php' );
}
if(is_file( dirname(__FILE__).'/Amele.php') ){
    include_once( dirname(__FILE__).'/Amele.php' );
}
if(is_file( dirname(__FILE__).'/WebService.php') ){
    include_once( dirname(__FILE__).'/WebService.php' );
}
if(is_file( dirname(__FILE__).'/AjaxDataTable.php') ){
    include_once( dirname(__FILE__).'/AjaxDataTable.php' );
}
if(is_file( dirname(__FILE__).'/Enum.php') ){
    include_once( dirname(__FILE__).'/Enum.php' );
}
if(is_file( dirname(__FILE__).'/Current.php') ){
    include_once( dirname(__FILE__).'/Current.php' );
}
if(is_file( dirname(__FILE__).'/Instance.php') ){
    include_once( dirname(__FILE__).'/Instance.php' );
}
if(is_file( dirname(__FILE__).'/KargoService.php') ){
    include_once( dirname(__FILE__).'/KargoService.php' );
}
if(is_file( dirname(__FILE__).'/CdnService.php') ){
    include_once( dirname(__FILE__).'/CdnService.php' );
}
if(is_file( dirname(__FILE__).'/TrendyolService.php') ){
    include_once( dirname(__FILE__).'/TrendyolService.php' );
}
if(is_file( dirname(__FILE__).'/CiceksepetiService.php') ){
    include_once( dirname(__FILE__).'/CiceksepetiService.php' );
}
