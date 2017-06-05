<?php session_start();
$member_id = $_SESSION['member_id'];
if(!$_SESSION['account'])
echo "<script>document.location.href='index.php'</script>";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Video Learning</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="css/style.css" rel="stylesheet" type="text/css" media="screen" />
<link href="css/colorbox.css" rel="stylesheet" type="text/css" media="screen" />
<link rel="stylesheet" href="css/bootstrap.min.css"/>
<link rel="stylesheet" href="css/jquery.jOrgChart.css"/>
<link rel="stylesheet" href="css/custom.css"/>
<link href="css/prettify.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
<!----<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js"></script>------->
<script type="text/javascript" src="js/prettify.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/swfobject/2/swfobject.js"></script>
<script src="js/jquery.event.drag-1.5.min.js" type="text/javascript"></script>
<script src="js/jquery.jOrgChart.js"></script>
<!--[if IE]>
<style type="text/css">
#sidebar #calendar {
	background-position: 0px 20px;
}
</style>
<![endif]-->
<style type="text/css">
code {
	display: block;
	background: #F9F9F9;
	border: 1px dashed #ABC;
	font: 12px/16px "Courier New", Courier, monospace;
	padding: 10px;
	margin: 0 0 30px 110px;
	}
.str { color: #00A; }
.kwd { color: #808; }
.com { color: #777; }
.typ { color: #088; }
.lit { color: #800; }
.pun { color: #000; }
.pln { color: #002; }
.tag { color: #008; }
.atn { color: #606; }
.atv { color: #080; }
.dec { color: #606; }
p {
	margin: 0 0 5px 110px;
	}
.handle {
	position: absolute;
	cursor: move;
	}
.bar {
	background: #AAD;
	}
.active {
	background-color: #CFC;
	border-color: #ADA;
	}
.active .bar {
	background-color: #ADA;
	}
.point {
	position: absolute;
	height: 4px;
	width: 4px; 
	margin: -2px 0 0 -2px;
	background: #A00;
	}
.section {
	display: none;
	}
h1 {
	border-bottom: 1px solid #CCC;
	text-indent: 110px;
	cursor: pointer;
	}
</style>
</head>
<body>
<div id="logo">
	<?php
	if($_SESSION['account']){
	include_once("banner_stu.php");
	include_once("php/root.php");
	}else{
		echo "<h2><input type='button' class='colorbox' style='background-image: url(images/login_btn.jpg);width:90px; height:30px;'/></h2>";
	}
	?>	
</div>
<!-- start page -->
<div id="page">
	<div class="content" id="content">
        <div class="Tit"><img src="images/test/pic-Tit.png"/>
            <a href="index.php" title="個人書房">個人書房</a> >> <a href="#" title="統整">統整</a></div><br/><br/>
	<div id='composition'>
		<p>請選擇欲使用的組織方式</p>
		<div style='text-align:center'>
			<img id='list' class='composition' style='width:150px;'src='./images/test/list 1.png';></img>
			<img id='sequence' class='composition' style='width:150px;'src='./images/test/sequence1.png';></img>
			<img id='hie' class='composition' style='width:150px;'src='./images/test/hie1.png';></img>
			<img id='mesh' class='composition' style='width:150px;'src='./images/test/Mesh1.png';></img>
		</div>
	</div>
    </div>
</div>
<!-- end page -->
<div id="footer">
	
	<p class="legal">靜宜大學</p>
	<p class="credit">Wang, Dai-Yi </p>
</div>
<script type="text/javascript" src="js/jquery.colorbox-min.js"></script>
<script type="text/javascript" src="js/jquery.jeditable.min.js"></script>
<script type="text/javascript" src="js/jcanvas.js"></script>
<script type="text/javascript" src="js/menu.js"></script>
<script type="text/javascript">
var member_id = "<?php print $_SESSION['member_id']; ?>";
var compet = "<?php print $_SESSION['compet']; ?>";
var user_media_id = "<?php print $user_media_id; ?>";
var composition; 
var book_name; 
var del_child= new Array();
var del_line= new Array();
$(function(){
	function save(composition,member_id){
		var index_new;
		var index_edit;
		var compos_id= new Array();
		var image_arr_new= new Array();
		var image_arr_edit= new Array();
		var descript_arr_new= new Array();
		var descript_arr_edit= new Array();
		var parent_arr_new= new Array();
		var parent_arr_edit= new Array();
		var point1_id= new Array();
		var point2_id= new Array();
		var node = new Array();
		var node_edit = new Array();
		var this_id= new Array();
		var composition_name;
		var compos_book_id=$('div#Edit').attr('name');
		var line_new=$('canvas').size();
		if(composition=='hie'){
			index_new=$('li table.composition_new').size();
			index_edit=$('li table.composition_edit').size();
		}else{
			index_new=$('table').filter('.composition_new').size();
			index_edit=$('table').filter('.composition_edit').size();
		}
		
		if(compos_book_id==null){
		//新產生章節
			do{
				composition_name=prompt("請輸入此章節名稱：");
				if(composition_name != null){
					if(composition_name != ''){
						if(index_new!=0){
							if(composition=='hie'){
								$('li table.composition_new').each(function(index_new){
									
									node[index_new] = new Array();
									node[index_new][0]=$(this).find('.descript_text').attr('id');
									node[index_new][1]=$(this).find('.image_url').attr('id');
									parent_arr_new[index_new]=$(this).parents('ul:first').siblings('table').attr('id');
									if(parent_arr_new[index_new]==null)
										parent_arr_new[index_new]='0';
										
									this_id[index_new]=$(this).attr('id');
									})								
							}else if(composition=='mesh'){
									var Edit=$('#Edit').offset();//每台電腦不同的位置
									var Edit_x=Edit.left;
									var Edit_y=Edit.top;
								$('table.composition_new').each(function(index_new){
									node[index_new] = new Array();
									node[index_new][0]=$(this).find('.descript_text').attr('id');
									node[index_new][1]=$(this).find('.image_url').attr('id');
									node[index_new][2]=$(this).offset().left-Edit_x;//x
									node[index_new][3]=$(this).offset().top-Edit_y;//y
									this_id[index_new]=$(this).attr('id');
								})
							}else {
								$('table.composition_new').each(function(index_new){
									node[index_new] = new Array();
									node[index_new][0]=$(this).find('.descript_text').attr('id');
									node[index_new][1]=$(this).find('.image_url').attr('id');
								})
							}
						}
						
						if(line_new!=0){
						$('canvas').each(function(index_new){
								var canvas_line=$(this).attr('id').split("_");
								point1_id[index_new]=canvas_line[0];
								point2_id[index_new]=canvas_line[1];
							})
						}
						
						$.post("php/composition_save.php",{node:node,composition:composition,member_id:member_id,index_new:index_new,composition_name:composition_name,parent_arr_new:parent_arr_new,this_id:this_id,point1_id:point1_id,point2_id:point2_id,line_new:line_new},
						function(data) {
							//$('div#Edit').attr('name',data);
							
							show(data,member_id);
							$.post("php/composition_select.php",{member_id:member_id},
								function(data) {$('div#compos_book').html(data);
									$('table.composition_new').attr('class','composition');
									$('table.composition_edit').attr('class','composition');
								});
						});
					}
				}
			}while((composition_name!=null && composition_name=='' ));
		}else{
		//編輯修改章節
			if(index_new!=0){
				if(composition=='hie'){
					$('li table.composition_new').each(function(index_new){
						node[index_new] = new Array();
						node[index_new][0]=$(this).find('.descript_text').attr('id');
						node[index_new][1]=$(this).find('.image_url').attr('id');
						parent_arr_new[index_new]=$(this).parents('ul:first').siblings('table').attr('id');
						if(parent_arr_new[index_new]==null)
							parent_arr_new[index_new]='0';
							this_id[index_new]=$(this).attr('id');
						})								
					}else if(composition=='mesh'){
						var Edit=$('#Edit').offset();//每台電腦不同的位置
									var Edit_x=Edit.left;
									var Edit_y=Edit.top;
								$('table.composition_new').each(function(index_new){
									node[index_new] = new Array();
									node[index_new][0]=$(this).find('.descript_text').attr('id');
									node[index_new][1]=$(this).find('.image_url').attr('id');
									node[index_new][2]=$(this).offset().left-Edit_x;//x
									node[index_new][3]=$(this).offset().top-Edit_y;//y
									this_id[index_new]=$(this).attr('id');
								})
					}else {
						$('table.composition_new').each(function(index_new){
							node[index_new] = new Array();
							node[index_new][0]=$(this).find('.descript_text').attr('id');
							node[index_new][1]=$(this).find('.image_url').attr('id');
							alert(node[index_new][0]);
						})
					}
			}
			if(line_new!=0){
				
				$('canvas').each(function(index_new){
				var canvas_line=$(this).attr('id').split("_");
				point1_id[index_new]=canvas_line[0];
				point2_id[index_new]=canvas_line[1];
				})
			}
			if(index_edit!=0){
				if(composition=='hie'){
					$('li table.composition_edit').each(function(index_edit){
						node_edit[index_edit] = new Array();
						node_edit[index_edit][0]=$(this).attr('id');
						node_edit[index_edit][1]=$(this).find('.descript_text').attr('id');
						node_edit[index_edit][2]=$(this).find('.image_url').attr('id');
					})
				}else if(composition=='mesh'){
					var Edit=$('#Edit').offset();//每台電腦不同的位置
					var Edit_x=Edit.left;
					var Edit_y=Edit.top;
					$('table.composition_edit').each(function(index_new){
						node[index_new] = new Array();
						node[index_new][0]=$(this).find('.descript_text').attr('id');
						node[index_new][1]=$(this).find('.image_url').attr('id');
						node[index_new][2]=$(this).offset().left-Edit_x;//x
						node[index_new][3]=$(this).offset().top-Edit_y;//y
						this_id[index_new]=$(this).attr('id');
					})
				}else{
					$('table.composition_edit').each(function(index_edit){
						node_edit[index_edit] = new Array();
						node_edit[index_edit][0]=$(this).attr('id');
						node_edit[index_edit][1]=$(this).find('.descript_text').attr('id');
						node_edit[index_edit][2]=$(this).find('.image_url').attr('id');
						/*image_arr_edit.push($(this).find('.image_url').attr('id'));
						descript_arr_edit.push($(this).find('.descript_text').attr('id'));
						compos_id[index_edit]=$(this).attr('id');*/
					})
				}
				}
				
				
			$.post("php/composition_save.php",{node:node,node_edit:node_edit,index_new:index_new,index_edit:index_edit,compos_book_id:compos_book_id,composition:composition,member_id:member_id,parent_arr_new:parent_arr_new,point1_id:point1_id,point2_id:point2_id,line_new:line_new},
			function(data) {
				
				//alert(data);
				//alert("有run save.php!!");
				alert('已儲存至筆記本');
				$('table.composition_new').attr('class','composition');
				$('table.composition_edit').attr('class','composition');
			});
		}
		
	}
	function show(compos_book_id,member_id){
		//筆記本顯示
			var Edit_ar= new Array();
			var Edit=$('#Edit').offset();//每台電腦不同的位置
			Edit_ar[0]=Edit.left;
			Edit_ar[1]=Edit.top;
		$.post("php/composition_show.php",{Edit_ar:Edit_ar,compos_book_id:compos_book_id,member_id:member_id},
			function(data) {
				$('div#contentR').html(data);
				composition=$('div#Edit').attr("class");
				if(composition=='hie'){
					$("#org").jOrgChart({container: $("#Edit"), interactive: true
					});
				}
				if(composition=='mesh'){
				var x= new Array();
				var y= new Array();
				var point_id= new Array();
				$('canvas.composition_show').each(function(index_new){
					var point_id=$(this).attr('id').split("_");
					$('div#'+point_id[0]).find('img.handle').hide();
					$('div#'+point_id[1]).find('img.handle').hide();
					var point0=$('div#'+point_id[0]).offset();
					var point1=$('div#'+point_id[1]).offset();
					x[0]=point0.left;
					y[0]=point0.top;
					x[1]=point1.left;
					y[1]=point1.top;
					drowline(x,y,point_id);
				})
				
				
				}
			});
		
	
	}
	
	
	
	function add_book(member_id,composition){
		$.post("php/composition_add.php",{composition:composition,member_id:member_id},
			function(data) {
				$('div#page').html(data);
				$('#contentR').css('background-image',"url('images/test/bak-"+composition+"2.png')")
				if(composition=='hie'){
						$("#org").jOrgChart({container: $("#Edit"), interactive: true
						});
				}
			});
	}
	
	$('img.composition').live("click",function(){
	//alert('composition');
		
		composition=$(this).attr("id");
		add_book(member_id,composition);
	})
	
	
	$('img.tool_composition').live("click",function(){
		
		var composition2=$(this).attr("id");
		var leave=confirm ("是否離開此頁面?");
		if(leave){
				composition=composition2;
				add_book(member_id,composition);
		}else{		
			}
		
		
	})
	
	$('img#toolbaox').live("click",function(){
		$('#toolbaox2').show();
		$(this).hide();
	})
	$('img#pull').live("click",function(){
		$('img#toolbaox').show();
		$('#toolbaox2').hide();
	})
/*圖片&文字註記選單start*/
	$('.image_choose').live("click",function(){
		
		var thisid="div#"+$(this).attr('id');
		var anchor_type="image";
		//alert(thisid);
		$(this).toggle(
			
			function(){
				$(".all_useranchor").remove();
				$.post("php/composition_all_useranchor.php",{anchor_type:anchor_type,member_id:member_id},
					function(data) {
						$('.test').val(data);
						$(thisid).after(data);});
			},function(){
				$(thisid).siblings('.all_useranchor').remove();
		}).trigger('click');
	});
	$('.descript_choose').live("click",function(){
		
		var thisid="div#"+$(this).attr('id');
		var anchor_type="descript";
		$(this).toggle(
			
			function(){
				$(".all_useranchor").remove();
				$.post("php/composition_all_useranchor.php",{anchor_type:anchor_type,member_id:member_id},
					function(data) {$(thisid).after(data);});
			},function(){
				$(thisid).siblings('.all_useranchor').remove();
		}).trigger('click');
	});
	
	$('select#media_select').live("change", function(){ 
		//選擇影片
		user_media_id=$(this).val();
		//var anchor_type=$(this).attr('class');
		//$.post("php/composition_all_useranchor2.php",{anchor_type:anchor_type,member_id:member_id,user_media_id:user_media_id},
		$.post("php/composition_all_useranchor2.php",{member_id:member_id,user_media_id:user_media_id},
			function(data) {
				$('div#media_class').html(data);
			});
	 }); 
	 
	$('div.open_anchor').live("click",function(){
		var class_id=$(this).parent().attr("id");
		var anchor_type=$(this).parents('td').attr("class");
		$.post("php/composition_class_go.php",{anchor_type:anchor_type,class_id:class_id,member_id:member_id,user_media_id:user_media_id},
			function(data) {
					$('div #media_anchor_image').html(data);
			});	
		
	});
	$('img.image_new').live("click",function(){
		//如果點選了註記的圖片
		//var image_url="<img style='width:200px;' src='"+$(this).attr('src')+"' />";
		var thisid="div#"+$(this).parents('div.all_useranchor').siblings('div.image_choose').attr('id');
		var image_url=$(this).attr('src');
		var image_id=$(this).attr('id');
		
		$(thisid).children('img.image_url').attr('src',image_url);
		$(thisid).children('img.image_url').attr('id',image_id);
		
		if($(thisid).parents('table[class*=composition]').attr('class')!="composition_new"){
			$(thisid).parents('table[class*=composition]').attr('class','composition_edit')
		}
		$(thisid).siblings('div.all_useranchor').remove();
	})
	$('div.descript_new').live("click",function(){
		var thisid="div#"+$(this).parents('div.all_useranchor').siblings('div.descript_choose').attr('id');
		var descript_text="<div id="+$(this).attr('id')+" class='descript_text'>"+$(this).text()+"</div>";
		$(thisid).html(descript_text);
		if($(thisid).parents('table[class*=composition]').attr('class')!="composition_new"){
			$(thisid).parents('table[class*=composition]').attr('class','composition_edit')
		}
		
		$(thisid).siblings('div.all_useranchor').remove();
		
	})	
/*圖片&文字註記選單end*/
	
	$('select#compos_book_select').live("change", function(){ 
		//筆記本選單
		
		var compos_book_id=$(this).val();
		show(compos_book_id,member_id);
		book_name=$('select#compos_book_select :selected').text();
	 });
	$('#add_new').live("click",function(){
		var index;
		index=parseInt($('table[class*=composition]:last').attr('id'))+1;
		if(isNaN(index)){
			index='1';
		}
		$.post("php/composition_add_new.php",{composition:composition,index:index},
			function(data) {
				if(composition=='list')
					$('div#Edit ul').append(data);
				if(composition=='sequence')
					$('div#Edit ol').append(data);
				if(composition=='mesh')
					$('div#Edit').append(data);
			});
	})
	$('.add_child').live("click",function(){
		var composition='hie';
		var parent_id=$(this).parents('table').attr('id');
		var parent_arr=parent_id.split("_");
		var child_index=$('table#'+parent_id).siblings('ul').children('li').size();
		if(child_index==0){
			index="1_"+parent_id;
			}else{
				var last_id=$('table#'+parent_id).siblings('ul').find('table[class*=composition]:last').attr('id');
				var last_arr=last_id.split("_");
				index=(parseInt(last_arr[0])+1)+"_"+parent_id;
			}
			$.post("php/composition_add_new.php",{composition:composition,index:index},
			function(data) {
					var $new_child ;
					var $id="li table[id="+parent_id+"]";
					
					if(child_index > 0){
						$new_child = data;
						$($id).next('ul').append($new_child);
					}else{
						$new_child = '<ul>'+data+'</ul>';
						$($id).after($new_child);
					}
					$('div.jOrgChart').remove();
					$("#org").jOrgChart({container: $("#Edit"), interactive: true			
					});
				
			});
				$('div.jOrgChart').remove();
				 $("#org").jOrgChart({container: $("#Edit"), interactive: true
            //chartElement : '#chart',
            //dragAndDrop  : true
			
				});
	})
	$('.del_compos').live("click",function(){
		var composition="list";
		var del_compos_id = $(this).attr('id');
		if(confirm("確定刪除本章節?")){
			$.post("php/composition_drop.php",{del_compos_id:del_compos_id},
				function(data) {
					alert(data);
					add_book(member_id,composition);
			});
		}
	})
	
	$('.del_child').live("click",function(){
		var $id="li table[id="+$(this).parents('table').attr('id')+"]";
		if($($id).attr('class')!='composition_new'){
			$($($id).parent('li').find('table[class*=composition]')).each(function(index_new){
				if($(this).attr('class')!='composition_new'){
					del_child.push($(this).attr('id'));
				}
			})
		}	
		$($id).parent('li').remove();
		$('div.jOrgChart').remove();
		$("#org").jOrgChart({container: $("#Edit"), interactive: true
		});
	})
	$('.del_new').live("click",function(){
		if(composition=='mesh'){
			var node_id=$(this).parents('table').attr('id');
			$("canvas[id*="+node_id+"]").each(function(index){
				var point=$(this).attr('id').split("_");
				if($("canvas[id*="+point[0]+"]").length==1){
				$('div#'+point[0]).find('img.handle').css('display','inline');}
				if($("canvas[id*="+point[1]+"]").length==1){
				$('div#'+point[1]).find('img.handle').css('display','inline');}
				del_line.push(point);
				$(this).remove();
			})
			if($(this).parents('table').attr('class')!='composition_new'){
				del_child.push($(this).parents('table').attr('id'));
			}
			$(this).parents('table').parent().remove();
		}else{
			if($(this).parents('table').attr('class')!='composition_new'){
				del_child.push($(this).parents('table').attr('id'));
			}
			$(this).parents('table').remove();
		}
		//alert(del_child[0]);
	})
	$('#clean').live("click",function(){
		var book_id = $('div#Edit').attr('name');
		if(book_id){
		$.post("php/composition_del.php",{composition:composition,book_id:book_id},
			function(data) {
				
			})
		}
		//var composition=$(this).attr('class');
		var index='1';
		//alert(composition);
		$.post("php/composition_add_new.php",{composition:composition,index:index},
			function(data) {
				if(composition=='list')
					$('div#Edit ul').html(data);
				if(composition=='sequence')
					$('div#Edit ol').html(data);
				if(composition=='hie'){
					$('div#Edit ul').html(data);
					$('div.jOrgChart').remove();
					$("#org").jOrgChart({container: $("#Edit"), interactive: true
					});
				}
				if(composition=='mesh'){
					$('div#Edit').html(data);
				}
			});
			
		
	})
	$('#save').live("click",function(){
		//alert("composition-"+composition+",member_id"+member_id);
		//alert(del_child[0]);
		var compos_book_id=$('div#Edit').attr('name');
		if(del_child){
			$.post("php/composition_del.php",{composition:composition,del_child:del_child},
			function(data) {
				
			});}
		if(del_line){
			$.post("php/composition_del_line.php",{del_line:del_line,compos_book_id:compos_book_id},
			function(data) {
			});
		}
		save(composition,member_id);
		del_child=[];
		del_line=[];
	})
	$('img.Select').live("click",function(){
		var select_sum=$('div.Select').length;
		//alert($(this).parents('div.Select').length);
		if($(this).parents('div.Select').length){
			$(this).parents('table').css('border','1px solid');
			$(this).parents('table').parent().attr('class','');
		}else{
			if(select_sum >= 2){
				alert('已選取2個節點');
			}else{
				$(this).parents('table').css('border','5px solid');
				$(this).parents('table').parent().attr('class','Select');
			}
		}
	})
	$(".handle").live("mouseover",function(){
		var id="div#"+$(this).parents('table').attr('id');
		$(id)
		.bind('dragstart',function( event ){
                return $(event.target).is('.handle');
                })
        .bind('drag',function( event ){
                $( this ).css({
                        top: event.offsetY,
                        left: event.offsetX
                        });
				$(this).children('table[class=composition]').attr('class','composition_edit');
                });
	});
	$("#add_line").live("click",function(){
		//新增連線
		var x= new Array();
		var y= new Array();
		var point_id= new Array();
		
		if($("div.Select").length==2){
			$("div.Select").each(function(index){
				var point = $(this).offset();
				x[index]=point.left;
				y[index]=point.top;
				point_id[index] = $(this).children('table').attr('id');
			})
			drowline(x,y,point_id);
			$('div.Select').children('table').css('border','1px solid');
			$('div.Select').find('img.handle').hide();
			$('div.Select').attr('class','');
		}else{
			alert('請點選2個節點');
		}
	});
	
	function drowline(x,y,point_id){
		var obj = {
		  strokeStyle: "#000",
		  strokeWidth: 2,
		  rounded: true
		};
		if(x[0] > x[1]){
			tmp_x=x[0];x[0]=x[1];x[1]=tmp_x;
			tmp_y=y[0];y[0]=y[1];y[1]=tmp_y;
			//tmp_id=point_id[0];point_id[0]=point_id[1];point_id[1]=tmp_id;
		}
		var line_startX;
		var line_startY;
		(x[0] > x[1])?line_startX=x[1]+75.5:line_startX=x[0]+75.5;
		(y[0] > y[1])?line_startY=y[1]+77:line_startY=y[0]+77;
		var line_width=Math.abs(x[0]-x[1]);
		var line_height=Math.abs(y[1]-y[0]);
		
		var  canvas_id=point_id[0]+"_"+point_id[1];
		
		obj['x1'] =0;
		obj['y1'] =((y[0] < y[1])?0:line_height);
		obj['x2'] =line_width;
		obj['y2'] =((y[0] < y[1])?line_height:0);
		
		//alert("line_start"+line_start+"line_width"+line_width+"line_height"+line_height);
		var new_canvas="<canvas id='"+canvas_id+"' width='"+line_width+"' height='"+line_height+"' style='top:"+line_startY+"px;left:"+line_startX+"px;position: absolute;'></canvas>";
		$("canvas#"+canvas_id).remove();
		$('#Edit').append(new_canvas);
		$("canvas#"+canvas_id).drawLine(obj);
	}
	$('#del_line').live("click",function(){
		var point_id= new Array();
		$("div.Select").each(function(index){
			point_id[index] = $(this).children('table').attr('id');
			if($('canvas[id*='+point_id[index]+']').length>1){
				$(this).children('table').css('border','1px solid');
				$(this).attr('class','');
			}else{
				$(this).find('img.handle').css('display','inline');
				$(this).children('table').css('border','1px solid');
				$(this).attr('class','');
			}
		})
		del_line.push(point_id);
		var canvas_id0=point_id[0]+"_"+point_id[1];
		var canvas_id1=point_id[1]+"_"+point_id[0];
		$('canvas#'+canvas_id0).remove();
		$('canvas#'+canvas_id1).remove();
		
	})
	
});
</script>
</body>
</html>