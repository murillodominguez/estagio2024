<?php

function manufactureComponentAlert($type, $message){

  $return="<div class='clear'><br></div><div class='alert alert-".$type."'><h3 class='text-center'>AVISO ".(($type=='danger')?'DE FALHA NO':'DO')." SISTEMA!</h3><br><div class='panel-footer'><br><p class='text-center'>".$message."</p></div></div>";    

  return $return;

}

function manufactureComponentContainer($size, $core){

  $return="<div class='col-sm-".$size."'>".$core."</div>";

  return $return;
}

function manufactureComponentButtonReturnList($linksystem, $controller){

  return "<form action='".$linksystem."/".$controller."' method='post'><button type='submit' class='btn btn-tool-return pull-right hidden-print' id='submitreturn' name='action'  value='voltar'>".manufactureComponentIconTool('voltar')."</button></form>";

}

function getReturnRoute($link, $login, $controller, $method){

  $sql="select uri, page, filter from log where registration=? and (controller!=? or method!=?) order by id desc limit 0,1";
  $stmt = $link->prepare($sql);
	$stmt->bind_Param('iss', $login, $controller, $method);
  $stmt->execute();
	$result = $stmt->get_result();
    
    if($result->num_rows>0){                
    
        return $result->fetch_assoc();

    }

    return false;

}



function manufactureComponentButtonReturn($link, $linksystem, $login, $controller, $method, $action){

        $return='';
        $method=$method.'Method';
        
        if(is_array($returnRouteData= getReturnRoute($link, $login, $controller, $method))){

          return "<form action='".str_replace('/rfr','', $linksystem).$returnRouteData['uri']."' method='post'><input type=hidden name=pagina value=".(($returnRouteData['page']==null)?'1':$returnRouteData['page'])."><input type=hidden name=filter value=".$returnRouteData['filter']."><button type='submit' class='btn btn-tool-return pull-right hidden-print' name='action' id='submitreturn' value='".(isset($action)?$action:$method)."'>".manufactureComponentIconTool('voltar')."</button></form>";

        }

       return $return;       

}

function manufactureComponentButtonShowDataFilter($method, $status, $name, $icon){

  return "<a class='btn btn-primary' role='button' data-toggle='collapse' href='#collapse".$method."' aria-expanded='".$status."' aria-controls='collapse".$method."'>".(($icon==null)?$name:("<b class='fa".$icon." fa-lg'></b>"))."</a>";

}

function manufactureComponentListingDataFilter($link, $linksystem, $controller, $method, $filterVar, $forOrder, $orderVar){
    
  $return="<div class='alert alert-toolbtn-filter'><form class='form-inline' action='".$linksystem."/".$controller."/".(($method!='list')?$method:'')."' method='post'>
  <div class='form-group'>
    <label for='txfilterVar'>Filtrar: </label>
    <input type='text' class='form-control' id='txfilterVar' name='filterVar' value='".(($filterVar!=null)?$filterVar:'')."' placeholder='Filtrar Por...'>
  </div>
  <div class='form-group'>
    <label for='txforOrder'>Ordenar Por: </label>
    <input type='text' class='form-control' id='txforOrder' name='forOrder' value='".(($forOrder!=null)?$forOrder:'')."' placeholder='campo'>
  </div>
  <div class='form-group'>
    <label for='txorderVar,'>Em ordem: </label>
    <select class='form-control' id='txorderVar' name='orderVar'>
       <option value='ASC' ".(($orderVar=='ASC')?'selected/':'').">CRESCENTE</option>
       <option value='DESC' ".(($orderVar=='DESC')?'selected/':'').">DECRESCENTE</option>
    </select>    
  </div>
  <button type='submit' class='btn btn-toolfilter pull-right'>Filtrar</button>
</form></div>";
  	return $return;
}


function manufactureComponentIconTool($id_btn){

    switch ($id_btn) {

        case 'edit':
              return "<b class='fa fa-pencil fa-sm'></b>";

        case 'view':
                return "<b class='fa fa-file fa-sm'></b>";
                
        case 'print':
                return "<b class='fa fa-print fa-sm'></b>";
              
        case 'cancel':
                return "<b class='fa fa-times fa-sm'></b>";
              
        case 'check':
                return "<b class='fa fa-check fa-sm'></b>";
              
        case 'image':
                return "<b class='fa fa-camera fa-sm'></b>";
               
        case 'report':
                return "<b class='fa fa-text-width fa-sm'></b>";
                
        case 'damage':
                return "<b class='fa fa-bug fa-sm'></b>";
               
        case 'qrcode':
              return "<b class='fa fa-qrcode fa-sm'></b>";
                
        case 'password':
                return "<b class='fa fa-key fa-sm'></b>";
                     
        case 'form':
                return "<strong>+</strong>";
                
        case 'vehicle':
                 return "<strong>+</strong>";
                
        case 'pdf':
                return "<b class='fa fa-file-text-o'></b>";
                
        default:
              return capitalFirstLetterTreatment($id_btn); 
          
  }

}

function manufactureComponentFormTitleButton($linksystem, $controller, $method, $varLabelPointer, $idPointer, $id_btn, $btnStatus){

  return "<li class='pull-right'><form action='".$linksystem."/".$controller."/".$method."' method='post'><input type=hidden name=".$varLabelPointer." value=".$idPointer."><button type='submit' class='btn-inline ".$btnStatus."' name='action'  value='".$id_btn."'>".manufactureComponentIconTool($id_btn)."</button></form></li>";

}


function manufactureComponentFormToolButton($linksystem, $controller, $method, $varLabelPointer, $idPointer, $id_btn, $btnStatus, $action, $typeaction){
    return "<li class='pull-right'><form action='".$linksystem."/".$controller."/".$method."/' method='post'><input type=hidden name=".$varLabelPointer." value=".$idPointer.">".((isset($typeaction) and !empty($typeaction))?"<input type=hidden name='typeaction' value='".$typeaction."'>":'')."<button type='submit' class='btn-inline ".$btnStatus."' name='action'  value='".$action."'>".manufactureComponentIconTool($id_btn)."</button></form></li>";
}


function manufactureComponentUtilityBar($label, $status){

  return "<li class='pull-right'><span class='label label-inline label-".$status."'>".$label."</span></li>";
 
}
         
function manufactureComponentToolbar($link, $linksystem, $controller, $method, $varLabelPointer, $idPointer, $UserFunctionalLevel, $mode, $ServidorID){

    $userpermissions='';
    $toolbarfunction= $controller.'Toolbar'.$method;
    if(function_exists($toolbarfunction)){

      $tools=call_user_func_array($toolbarfunction, array($link, $UserFunctionalLevel, $idPointer, $mode, $ServidorID));
      
    }

    if(!isset($tools)){

      return null;

    }
    
    if(!is_array($tools)){
      
      return null;

    }

    $userpermissions=searchTheUserAccessPermissionsDatabase($link, $controller, $ServidorID);
    
    if(is_array($userpermissions)){
        
      $return='';
      
      foreach ($tools as $rowTools) {          
       if(authorizedUserAccessMethod($rowTools['type'], $userpermissions) or authorizedUserAccessMethod($rowTools['action'], $userpermissions)){
            $return=$return.((isset($rowTools['hidden']) && $rowTools['hidden'])?null:manufactureComponentFormToolButton($linksystem, $controller, $rowTools['type'], $varLabelPointer, $idPointer, $rowTools['btn'], $rowTools['btn-status'], (isset($rowTools['action'])?$rowTools['action']:$rowTools['btn']), (isset($rowTools['typeaction'])?$rowTools['typeaction']:null)));       
         }

      }

      return $return;

}

 return false;   

}

function manufactureComponentList($link, $linksystem, $varTableHeader, $varLabelDataBase, $varDataBase, $controller, $method, $varLabelPointer, $ServidorID, $UserFunctionalLevel, $number, $mode){

    $return="<table class='table table-striped table-hover table-sgo'><thead><tr><th scope='cols' style='vertical-align:middle'>#</th>";
    
    foreach ($varTableHeader as $key => $value) {

         $return=$return."<th scope='cols' style='vertical-align:middle'>".$value."</th>";
    }

    $return=$return."</tr></thead><tbody>";

    $counter=0;
    
    if($number!=null) $counter=$number;

    if(is_array($varDataBase) and !empty($varDataBase)){

        foreach ($varDataBase as $rowDataBase) {

            $return=$return."<tr><td data-label='#:' style='vertical-align:middle'>".++$counter."</th>";
            var_dump ($rowDataBase);
            extract($rowDataBase);

            foreach ($varLabelDataBase as $key => $value) {
              echo $key;
              if($key == 0){
                if($path == null){
                  $return=$return."<td data-label='".$varTableHeader[$key].":' style='vertical-align:middle;'></td>";
                }
                else{
                echo $path;
                $path = '/rfr/'.$path;
                  $return=$return."<td data-label='".$varTableHeader[$key].":' style='vertical-align:middle;'><img style='width: 100px; height: 80px;' src='".$path."'></img></td>";
                }
              }
              else{
                $return=$return."<td data-label='".$varTableHeader[$key].":' style='vertical-align:middle'>".formatDate($link, $controller, $$varLabelPointer, $value, $$value)."</td>";
              }
            }
            
            $return=$return."<td data-label='".$varTableHeader[count($varTableHeader)-1].":' style='vertical-align:middle'><ul class='nav'>".manufactureComponentToolbar($link, $linksystem, $controller, $method, $varLabelPointer, $$varLabelPointer, $UserFunctionalLevel, $mode, $ServidorID)."</ul></td></tr>";      

      }
           
    }

    $return=$return."</tbody></table>"; 
									      
return $return;
     
}

function manufactureFormComponentPaginationBar($linksystem, $controller, $pagina, $filters, $btn_name){

  return "<form action='".$linksystem."/".$controller."/' method='post'><input type=hidden name='pagina' value=".$pagina."><input type=hidden name='filters' value=".$filters."><button class='btn-toolpagination' type='submit' id='pagination'>".$btn_name."</button></form>";


}

function manufactureComponentPaginationBar($linksystem, $numberOfRow, $numberPerPage, $controller, $method, $pagenumber, $filters){
//function barra_navegacao_tabela($quantidade,$qnt_result_pg, $f, $i, $pagina, $filtros)

	$maxpage = ceil($numberOfRow / $numberPerPage);
		//Limitar os link antes depois
	$maxlinks = 2;

    $pagenumber=(($pagenumber==0)?1:$pagenumber);
	
    if($numberOfRow>$numberPerPage){
    //  $return="<nav aria-label='paginacao'><ul class='pagination'><li class='page-item'>
	    //        <span class='page-link'><a href='./index2.php?f=".$controller."&pagina=1".(($filters!=NULL)?$filters:'')."' onclick='listar_usuario(1,". $numberPerPage.")'>Primeira</a> </span></li>";
              $return="<nav aria-label='paginacao'><ul class='pagination'><li class='page-item'>
	            <span class='page-link'>".manufactureFormComponentPaginationBar($linksystem, $controller, 1, (($filters!=NULL)?$filters:''), 'Primeira')."</span></li>";
    
      for ($previousPage = $pagenumber - $maxlinks; $previousPage <= $pagenumber - 1; $previousPage++){

         if($previousPage > 1){

           //$return=$return."<li class='page-item'><a class='page-link' href='./index2.php?f=".$controller."&pagina=".$previousPage."".(($filters!=NULL)?$filters:'')."' onclick='listar_usuario(".$previousPage.", ".$numberPerPage.")'>".$previousPage."</a></li>";
           $return=$return."<li class='page-item'><span class='page-link'>".manufactureFormComponentPaginationBar($linksystem, $controller, $previousPage, (($filters!=NULL)?$filters:''), $previousPage)."</span></li>";
		
         }
	  }
	  
      //$return=$return."<li class='page-item active'><span class='page-link'>".$pagenumber."</span></li>";
      $return=$return."<li class='page-item active'><span class='page-link'><button class='btn-toolpagination-active'>".$pagenumber."</button></span></li>";

	  for ($backPage = $pagenumber+1; $backPage <= $pagenumber + $maxlinks; $backPage++){

        if($backPage <= $maxpage){

         //  $return=$return."<li class='page-item'><a class='page-link' href='./index2.php?f=".$controller."&pagina=".$backPage."".(($filters!=NULL)?$filters:'')."'' onclick='listar_usuario(".$backPage.",". $numberPerPage.")'>".$backPage."</a></li>";
           $return=$return."<li class='page-item'><span class='page-link'>".manufactureFormComponentPaginationBar($linksystem, $controller, $backPage, (($filters!=NULL)?$filters:''), $backPage)."</span></li>";
        }
	  }

	  //$return=$return."<li class='page-item'><span class='page-link'><a href='./index2.php?f=".$controller."&pagina=".$maxpage."".(($filters!=NULL)?$filters:'')."'' onclick='listar_usuario(".$maxpage.",". $numberPerPage.")'>Última</a></span>
	    //                </li></ul></nav>";
                      $return=$return."<li class='page-item'><span class='page-link'>".manufactureFormComponentPaginationBar($linksystem, $controller, $maxpage, (($filters!=NULL)?$filters:''), 'Última')."</span></li></ul></nav>";

    }else{

        $return='';

    }

    return $return;

}

function manufactureComponentPageBodyTitle($varTitle, $previousLink, $backLink, $csv = null){

   $return="<h3 class='section-title alert alert-info'><ul class='nav'><li class='pull-left'>".$varTitle."</li><li class='pull-right'><ul class='nav'><li class='pull-left'>".$previousLink."</li>".(isset($csv)?("<li style='display:inline-block !important' class='pull-left'>".$csv."</li>"):null)."<li class='pull-right'>".$backLink."</li></ul></li></ul></h3>";

return $return;    

}

function manufactureComponentSectionBodyTitle($varTitle){

  $return="<h5 class='col-sm-12 alert alert-info pull-left'>".$varTitle.":</h5>";

return $return;    

}

function manufactureComponentPageBodyTitleHiddenPrinter($varTitle, $previousLink, $backLink){

  $return="<h3 class='section-title alert alert-info hidden-print'><ul class='nav'><li class='pull-left'>".$varTitle."</li><li class='pull-right'><ul class='nav'><li class='pull-left'>".$previousLink."</li><li class='pull-right'>".$backLink."</li></ul></li></ul></h3>";

return $return;    

}

function manufactureComponentBodySubtitle($varTitle, $previousLink, $backLink, $status){

  $return="<h5 class='section-title alert alert-".(!empty($status)?$status:'info')."'><ul class='nav'><li class='pull-left'>".$varTitle."</li><li class='pull-right'><ul class='nav'><li class='pull-left'>".$previousLink."</li><li class='pull-right'>".$backLink."</li></ul></li></ul></h5>";

return $return;    

}

function manufactureComponentButtonDownloadCsv($link, $linksystem, $controller, $csvfile){
  // $return = '<form action="'.$linksystem."/".$controller.'/csv" method="post">
  // <input type="hidden" name="arquivo" value="arquivo.csv">
  // <button type="submit">Exportar em CSV</button>
  // </form>';

  $return = '<a style="padding: 0; padding-right: 10px; font-size: 0.9em;" href="'.$linksystem.'/DirController/Dir'.ucfirst($controller).'/library/'.$csvfile.'">Exportar em CSV</a>';
  return $return;
};


