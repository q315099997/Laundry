<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Basic DataGrid - jQuery EasyUI Demo</title>
	<link rel="stylesheet" type="text/css" href="__PUBLIC__/ThirdParty/EasyUI/themes/default/easyui.css">
<link rel="stylesheet" type="text/css" href="__PUBLIC__/ThirdParty/EasyUI/themes/icon.css">
<link rel="stylesheet" type="text/css" href="__PUBLIC__/ThirdParty/EasyUI/demo/demo.css">
<script type="text/javascript" src="__PUBLIC__/ThirdParty/EasyUI/jquery.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/ThirdParty/EasyUI/jquery.easyui.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/ThirdParty/Others/uploadPreview.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/Fuego/PublicJS/jsonConvert.js"></script>
<script type="text/javascript" src="__PUBLIC__/Fuego/PublicJS/public.js"></script>
</head>
<body class="easyui-layout">
	<div data-options="region:'north',border:false" style="height:60px;background:#B3DFDA;padding:10px">north region</div>
	<div data-options="region:'west',split:true,title:'West'" style="width:250px;padding:10px;">
		<div class="easyui-panel" style="padding:5px">
			<ul id="menuTree" class="easyui-tree" data-options="url:'__APP__/Index/getMenuTree',method:'get',animate:true,lines:true"></ul>
		</div>
	</div>
	<div data-options="region:'center'">
	<div id="tt" class="easyui-tabs"  data-options="fit:true">
	</div>
	</div>
<script type="text/javascript" >  
    $('#menuTree').tree({
		onClick: function(node){  
			    if ($('#tt').tabs('exists', node.text))
			    {    
			        $('#tt').tabs('select', node.text);    
			    } 
			    else 
			    {    
			        var content = '<iframe scrolling="auto" frameborder="0"  src="__ROOT__/'+node.attributes.url+'" style="width:100%;height:99%;"></iframe>';
			        $('#tt').tabs('add',{    
			            title:node.text,    
			            content:content,    
			            closable:true    
			        });    
			    }    
		//$('#tt').tabs('add',{title:node.text,href:"__APP__/UserManage/saveData.html",closable:true,width:1000,height:1000,});
	} 
});
</script>
</body>
</html>