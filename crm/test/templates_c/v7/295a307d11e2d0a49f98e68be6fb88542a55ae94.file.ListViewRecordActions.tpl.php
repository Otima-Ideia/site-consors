<?php /* Smarty version Smarty-3.1.7, created on 2020-05-19 01:45:16
         compiled from "/home/wwwconsorscom/public_html/crm/includes/runtime/../../layouts/v7/modules/Users/ListViewRecordActions.tpl" */ ?>
<?php /*%%SmartyHeaderCode:143248515ec33a2c4a3e24-67378311%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '295a307d11e2d0a49f98e68be6fb88542a55ae94' => 
    array (
      0 => '/home/wwwconsorscom/public_html/crm/includes/runtime/../../layouts/v7/modules/Users/ListViewRecordActions.tpl',
      1 => 1520586669,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '143248515ec33a2c4a3e24-67378311',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'MODULE' => 0,
    'LISTVIEW_ENTRY' => 0,
    'IS_MODULE_EDITABLE' => 0,
    'IS_MODULE_DELETABLE' => 0,
    'USER_MODEL' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5ec33a2c4d9b7',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5ec33a2c4d9b7')) {function content_5ec33a2c4d9b7($_smarty_tpl) {?>

<div class="table-actions"><span class="more dropdown action"><span href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"><i title="<?php echo vtranslate("LBL_MORE_OPTIONS",$_smarty_tpl->tpl_vars['MODULE']->value);?>
" class="fa fa-ellipsis-v icon"></i></span><ul class="dropdown-menu"><?php if ($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->get('status')=='Active'){?><?php if (Users_Privileges_Model::isPermittedToChangeUsername($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->getId())){?><li><a onclick="Settings_Users_List_Js.triggerChangeUsername('<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->getChangeUsernameUrl();?>
');"><?php echo vtranslate('LBL_CHANGE_USERNAME',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a></li><?php }?><li><a onclick="Settings_Users_List_Js.triggerChangePassword('<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->getChangePwdUrl();?>
');"><?php echo vtranslate('LBL_CHANGE_PASSWORD',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a></li><?php if ($_smarty_tpl->tpl_vars['IS_MODULE_EDITABLE']->value&&$_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->get('status')=='Active'){?><li><a href="<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->getEditViewUrl();?>
&parentblock=LBL_USER_MANAGEMENT" name="editlink"><?php echo vtranslate('LBL_EDIT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a></li><?php }?><?php }?><?php if ($_smarty_tpl->tpl_vars['IS_MODULE_DELETABLE']->value&&$_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->getId()!=$_smarty_tpl->tpl_vars['USER_MODEL']->value->getId()){?><?php if ($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->get('status')=='Active'){?><li><a href='javascript:Settings_Users_List_Js.triggerDeleteUser("<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->getDeleteUrl();?>
")'><?php echo vtranslate("LBL_REMOVE_USER",$_smarty_tpl->tpl_vars['MODULE']->value);?>
</i></a></li><?php }else{ ?><li><a onclick="Settings_Users_List_Js.restoreUser(<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->getId();?>
, event);"><?php echo vtranslate("LBL_RESTORE_USER",$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a></li><li><a href='javascript:Settings_Users_List_Js.triggerDeleteUser("<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->getDeleteUrl();?>
", "true")'><?php echo vtranslate("LBL_REMOVE_USER",$_smarty_tpl->tpl_vars['MODULE']->value);?>
</i></a></li><?php }?><?php }?></ul></span></div><?php }} ?>