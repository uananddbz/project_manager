t=new Date();
i=t.getMinutes();
if (t.getHours() > 12)
{
h=t.getHours()-12;
a='pm';
}
else
{
h=t.getHours();
a='am';
}
if (h < 10)
{
h='0'+h;
}

if (i < 10)
{
i='0'+i;
}// for time

$(document).ready(function(){

		$('.del').hide();

function md(el) {

	$(el).draggable({cursor: "move",revert: "invalid",distance: 50 ,opacity: 0.8,
			start: function() {
				
				$('.del').show('blind','fast');
				
				},
				stop: function() {
					$('.del').hide('blind','fast');
					}
					});
			}

md('#task-list li');
md('#done-list li');

$('.del').droppable({
	hoverClass: "active",
	drop: function( event, ui ) {
	id=$(ui.draggable).attr('data-id');	
	$(ui.draggable).hide('blind');
	$.ajax({url:'ajax.php?del='+id});
			}
		});

//loading
$("#loading").hide();

$(document).ajaxSend(function(){
$("#loading").show();
});

$(document).ajaxStop(function(){
$("#loading").fadeOut();
});


//to add project
$("#addp").submit(function(e){
data=$(this).serializeArray();
url=$(this).attr('action');
$.post(url,data,function(result){
$("#project-list").prepend('<li class="new"><a class="bl" href="task.php?pid='+result+' ">'+data[0].value+'<span class="status info fr">&nbsp;</span></a></li>');
$('.new').show('blind','normal').effect('highlight','slow').removeClass("new");
  });
document.getElementById("addp").reset();
  return false;
});


//to add task
$("#addt").submit(function(e){
data=$(this).serializeArray();
url=$(this).attr('action');
$.post(url,data,function(result){
$("#task-list").prepend('<li class="new" data-id="'+result+'"><small class="pr fl '+data[2].value+'">&nbsp;</small><a href="#" class="name">'+data[1].value+'</a><a href="#" class="fr but task_done">Done</a><p class="des"><small>'+data[3].value+'</small></p></li>');
md('.new');
$('.new').children('.des').hide();
$('.new').show('blind','normal').effect('highlight','slow').removeClass("new");
  });
document.getElementById("addt").reset();
  return false;
});


$("#task-list").on("click",".task_done",function(){
	id=$(this).parent("li").attr('data-id');	
	$.ajax({url:'ajax.php?done='+id});
	$(this).parent("li").hide('puff','fast',function() {
	$(this).children('small').remove();
	$(this).children('.task_done').remove();
	$(this).prependTo(".all-done ul").show('blind','slow');
			});
return false;

});

//hide description

$('.des').hide();

$(".list").on("click",".name",function(){
$(this).parent("li").children('.des').slideToggle('fast');
return false;

});

$('.add-task').hide();
$('.af').click(function () {
$('#ad').show();
$('#d').hide();
$('.add-task').animate({height:'toggle'},'2000','easeOutQuart');
})


$('#ad').click(function () {
$(this).hide();
$('#d').animate({height:'toggle'},'2000','easeOutQuart');
})


});