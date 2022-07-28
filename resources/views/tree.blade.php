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
</style>	
</head>

<body>

@php
function print_list($array, $parent=0) {
	echo "<ul id='treeview'>";
	foreach ($array as $row) {
		if ($row->parent_entry_id == $parent) {
			echo "<li class='parent'>".$row->entry_id.'. '.$row->treeLang->name;
			print_list($array, $row->entry_id); 
			echo "</li>";
	}   }
	echo  "</ul>";
}
print_list($results);
@endphp

</body>	
</html>