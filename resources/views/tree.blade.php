<!DOCTYPE html>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script>
$(document).ready(function () {
	$("#treeview .parent").click(function (e) {
		e.stopPropagation();
		$(this).find(">ul").toggle("slow");
		if ($(this).hasClass("close"))
			$(this).removeClass("close");
		else
			$(this).addClass("close");
	});
});


$(document).on('click','#treeview2 .parent',function (e) {
	e.stopPropagation();
	$(this).find(">ul").toggle("slow");
	if ($(this).hasClass("close")){
		$(this).children().remove();
		$(this).removeClass("close");
		return false;
	}else{
		$(this).addClass("close");
	}	

	var entry_id = $(this).attr('data-id');

	$.ajax({
		url: "{{route('getChildTree')}}",
		method: "POST",
		dataType: 'json',
		data: {'entry_id': entry_id},
		headers: {
			'X-CSRF-TOKEN': "{{ csrf_token() }}"
		},      
		success: function(result) {
			if(result.status == "success"){
				//console.log(result.data);
				//$('#child_'+''+entry_id).append(result.data);	
				
				var dt = '<ul id="treeview2" style="display: block;">';
				$.each(result.data, function(key, value) {
					dt +='<li class="parent" id="child_'+value.entry_id+'" data-id="'+value.entry_id+'">'+value.entry_id+'. '+value.tree_lang.name+'</li>';
				});
				dt += '</ul>';
				$('#child_'+''+entry_id).append(dt);
				
			}else{
				alert(result.message);
			}
		}
	});		
});

</script>
<style>
#treeview, #treeview ul {
	list-style: none;
}

#treeview .parent {
	position: relative;
	cursor: pointer;
}

#treeview .parent:before {
	padding-left: 25px;
	background: url({{asset('images/toggle-small-expand.png')}}) no-repeat;
	background-position: 0 top;
	content: "";
	height: 25px;
}

#treeview .close:before {
	padding-left: 25px;
	background: url({{asset('images/toggle-small.png')}}) no-repeat;
	background-position: 0 top;
	content: "";
	height: 25px;
}

#treeview .parent > ul {
	display: none;
}


#treeview2, #treeview2 ul {
	list-style: none;
}

#treeview2 .parent {
	position: relative;
	cursor: pointer;
}

#treeview2 .parent:before {
	padding-left: 25px;
	background: url({{asset('images/toggle-small-expand.png')}}) no-repeat;
	background-position: 0 top;
	content: "";
	height: 25px;
}

#treeview2 .close:before {
	padding-left: 25px;
	background: url({{asset('images/toggle-small.png')}}) no-repeat;
	background-position: 0 top;
	content: "";
	height: 25px;
}

#treeview2 .parent > ul {
	display: none;
}
</style>	
</head>

<body>

<div>
<!--<h2>Simple Tree</h2>-->
@php
function print_list($array, $parent=0) {
	echo "<ul id='treeview'>";
	foreach ($array as $row) {
		if ($row->parent_entry_id == $parent) {
			echo "<li class='parent'>".$row->entry_id.'. '.$row->treeLang->name;
			print_list($array, $row->entry_id); 
			echo "</li>";
		}   
	}
	echo  "</ul>";
}
print_list($results);
@endphp
</div>

<div>
<!--<h2>Ajax Tree</h2>-->
<ul id='treeview2'>
@foreach($resultData as $result)
	<li class="parent" id="child_{{$result->entry_id}}" data-id="{{$result->entry_id}}">
	{{$result->entry_id.'. '.$result->treeLang->name}}
	</li>
@endforeach
</ul>	
</div>

</body>	
</html>