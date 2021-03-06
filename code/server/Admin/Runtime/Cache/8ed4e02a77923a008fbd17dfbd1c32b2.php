<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>产品管理</title>
	<link rel="stylesheet" type="text/css" href="__PUBLIC__/ThirdParty/EasyUI/themes/default/easyui.css">
<link rel="stylesheet" type="text/css" href="__PUBLIC__/ThirdParty/EasyUI/themes/icon.css">
<link rel="stylesheet" type="text/css" href="__PUBLIC__/ThirdParty/EasyUI/demo/demo.css">
<script type="text/javascript" src="__PUBLIC__/ThirdParty/EasyUI/jquery.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/ThirdParty/EasyUI/jquery.easyui.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/ThirdParty/Others/uploadPreview.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/Fuego/PublicJS/jsonConvert.js"></script>
<script type="text/javascript" src="__PUBLIC__/Fuego/PublicJS/public.js"></script>
</head>
<body>
	<div style="margin:20px 0;"></div>
	<div id="toolbar" style="padding:5px;height:auto">
		<a class="easyui-linkbutton" iconCls="icon-add" onclick="onModify('Create')">增加</a>
		<a class="easyui-linkbutton" iconCls="icon-edit" onclick="onModify('Modify')">编辑</a>
		<a class="easyui-linkbutton" iconCls="icon-remove" onclick="onDelete()">删除</a>
		<input class="easyui-datebox" style="width:80px">
		<a href="#" class="easyui-linkbutton" iconCls="icon-search">Search</a>
	</div>
	<div class="easyui-layout"data-options="fit:true">
	<table id="productGrid" class="easyui-datagrid" title="产品管理" style="width:100%;height:95%"
			data-options="checkOnSelect:true,rownumbers:true,pagination:true,pageList:[10,20,30],singleSelect:true,
			url:'__APP__/ProductManage/LoadPage',method:'get',toolbar:'#toolbar'">
		<thead>
			<tr>
				<th data-options="field:'ck',checkbox:true"></th>
				<th data-options="field:'product_id',width:80">产品ID</th>
				<th data-options="field:'product_name',width:80">产品名称</th>
				<th data-options="field:'describe',width:80">产品描述</th>
				<th data-options="field:'price',width:80">产品价格</th>
				<th data-options="field:'product_status',width:80">产品状态</th>
				<th data-options="field:'update_time',width:80">更新时间</th>
				<th data-options="field:'end_time',width:80">截至日期</th>
				<th data-options="field:'detail_info',width:80">详细信息</th>
				<th data-options="field:'type_name',width:80">产品类型</th>
				<!--  <th data-options="field:'original_price',width:80">原价</th>-->
				<th data-options="field:'img',width:80">产品图片</th> 
			</tr>
		</thead>
	</table>
	</div>
	<div id="productModify"></div>
<script type="text/javascript">
function onModify(type){
	var row = $('#productGrid').datagrid('getSelected');
	if((type == "Modify")&&(!row))
	{
		fuegoAlert("请选择一条记录");
	}
	else
	{	
		//打开产品编辑窗口
		$('#productModify').dialog({
		    title: '产品信息',
		    width: 600,
		    height: 240,
		    closed: false,
		    cache: false,
		    href: '__APP__/ProductManage/productInfo.html',
		    modal: true
		});
		if(type == "Modify")
		{
			var json = objToJson(row.product_id);
			$.ajax({
				type:"post",
				url:"__APP__/ProductManage/Show",
				data:json,
				dataType:"json",
				success:function(rsp){
					if(isSuccess(rsp)){
						$('#productForm').form('load',rsp);
						//加载图片
						$("#img0").attr('src', '__PUBLIC__/Fuego/Uploads/'+$("#img").val());
					}
					else{
						fuegoAlert(rsp.errorMsg);
					}
				},
	        	error:function(){
	        		fuegoAlert("当前ajax操作出错！");
				}
			});
		}
	}	
}
function onDelete(){
	var row = $('#productGrid').datagrid('getSelected');
	if(!row)
	{
		fuegoAlert("请选择一条记录");
	}
	else
	{
		$.messager.confirm('确认提示', '确认删除该条记录？', function (r) {
			if(r){
				var json = objToJson(row.product_id);
				$.ajax({
					type:"post",
					url:"__APP__/ProductManage/Delete",
					data:json,
					dataType:"json",
					success:function(rsp){
						if(isSuccess(rsp)){
							//重新加载datagrid数据
							$("#productGrid").datagrid('reload');
						}
						else{
							fuegoAlert(rsp.errorMsg);
						}
					},
		        	error:function(){
		        		fuegoAlert("当前ajax操作出错！");
					}
				});
			}
		});
	}	
}
</script>
</body>
</html>