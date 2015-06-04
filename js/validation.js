
$(document).ready(function(){
//load table with data 
$('#placeForData').load('php/loadData.php');

$('#chooseFileButton').on('click',function(){
	$("#picture").click();
});
$('#deleteFileButton').on('click',function(){
	$('input[name=picture]').val('');
	$('#pictureMistake').css('display','none');
	$('#upload-file-info').html('There are no selected files to add');
});

// Check eMail for validity
$('input[name=eMail]').on('change', function() {

  var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
   var eMail = $('input[name=eMail]').val();
   if(reg.test(eMail) == false) {
       $('#eMailMistake').css('display','inline');
      return false;
   }
   else{
		$('#eMailMistake').css('display','none');
		return false;
	}
});
// Check userName for validity
$('input[name=userName]').on('change', function() {

  var reg = /^([A-Za-z0-9]+)$/;
   var userName = $('input[name=userName]').val();
   if(reg.test(userName) == false) {
      
	  $('#nameMistake').css('display','inline');
      return false;
   }
   else{
		$('#nameMistake').css('display','none');
		return false;
	}
});
// Check homePage for validity
$('input[name=homePage]').on('change', function() {

  var reg = /^(ht|f)tps?:\/\/[a-z0-9-\.]+\.[a-z]{2,4}\/?([^\s<>\#%"\,\{\}\\|\\\^\[\]`]+)?$/;
   var homePage = $('input[name=homePage]').val();
   if(reg.test(homePage) == false && homePage !='') {
      
	  $('#homePageMistake').css('display','inline');
      return false;
   }
   else{
		$('#homePageMistake').css('display','none');
		return false;
	}
});
// exclude signs which can make the tags not valid
$('textarea[name=message]').on('keyup', function() {
this.value = this.value.replace(/\s{2,}/g, ' ').replace(/\>{2,}|\s{1,}\>/g,'>').replace(/(\<{2,}|\<\s{1,})/g,'<').replace(/(\<\/{2,}|\<\/\s{1,})/g,'</');
});
// Check message for validity
$('textarea[name=message]').on('change', function() {
	var message = $('textarea[name=message]').val();
	//var textWithOutCode = message.replace(/<code>[a-z0-9-\.]+<\/code>/g,' ');
	var checkAnyTags = /<[\/\!]*?[^<>]*?>/i;        // Check, are there tags in the text
		if(checkAnyTags.test(message) == false) {	
      
			$('#messageMistake').css('display','none');
		}
		else {												// if text has tags: we delete all valid tags
			var checkOpenTags = /<(i|strong|strike|code|(a href="(ht|f)tps?:\/\/[a-z0-9-\.]+\.[a-z]{2,4}\/?([^\s<>\#%"\,\{\}\\|\\\^\[\]`]+)?"))>/g;
			var checkCloseTags =/<\/(i|strong|strike|code|a)>/g;
			var CheckingText = message.replace(checkOpenTags, ' ').replace(checkCloseTags,' ');
			
				if(checkAnyTags.test(CheckingText) == false) { 	  //Check, are there tags in the text after deleting all valid tags
					param = {
							message:message
					};
					$.ajax({ 				// if text is valid on this phase, we send it to nextone
							type: 'POST',
							url: 'php/checkTags.php', 	//in this file we check text on XHTML validity.
							data: param,
							success: function(data){
								if(data !='validate'){
									$('#messageMistake').css('display','inline');
								}
								else{
									$('#messageMistake').css('display','none');
								}
								
							},
							error: function(XMLHttpRequest, textStatus, errorThrown){alert(textStatus+XMLHttpRequest+errorThrown)}
						});
				
				}
				else {
					$('#messageMistake').css('display','inline');
				}
			
		}
	
});
// Check file for validity
$('input[name=picture]').on('change', function() {
	
	$("#upload-file-info").html($(this).val());
 
   var fileInput = $('input[name=picture]')[0];
  
   var fileInputSize = fileInput.files[0].size;
   var fileInputType = picture.value.substring(picture.value.lastIndexOf('.')+1,picture.value.length).toLowerCase();
   
		if( fileInputType != 'jpeg' && fileInputType != 'jpg' && fileInputType != 'gif' && fileInputType != 'png' && fileInputType != 'txt' || (fileInputSize > 102400 && fileInputType == 'txt')){
			$('#pictureMistake').css('display','inline');
			$('input[name=picture]').val('');
			
			
		}
		else {
			$('#pictureMistake').css('display','none');
		}

});
// Check captcha for validity
$('input[name=norobot]').on('change', function() {
	var norobot = $('input[name=norobot]').val();
		param = {
					norobot:norobot
				};

		$.ajax({
				type: 'POST',
				url: 'php/norobot.php',
				data: param,
				success: function(data){
					if(data == 'robot'){
						
						$('#captchaMistake').css('display','inline');
						
						$('#work').html('<img id = "captchaImage" src="php/captcha.php?randomnr='+Math.random()+'" />');
						$('input[name=norobot]').val('');
					}
				else {
				$('#captchaMistake').css('display','none');
					}
				},
				error: function(XMLHttpRequest, textStatus, errorThrown){alert(textStatus+XMLHttpRequest+errorThrown)}
			});
	
	});
// text preview function
$('#preview').on('click', function(){
	if($('#messageMistake').css('display') == 'none')
		{
			var text = $('textarea[name=message]').val();
			$('#previewText').html(text);
		}
	});
// 	wrap message on tags 
$('a[name=link]').on('click',function(){
	var url = prompt("Enter url!", "http://");
	insertTag('message','<a href="'+url+'">','</a>');
});
$('a[name=strong]').on('click',function(){
	insertTag('message','<strong>','</strong>');
});
$('a[name=italic]').on('click',function(){
	insertTag('message','<i>','</i>');
});
$('a[name=strike]').on('click',function(){
	insertTag('message','<strike>','</strike>');
});

// Check all components  for validity and submit
$('#submitButton').on('click', function(){
	if ($('input[name=eMail]').val() != '' && 
		$('input[name=userName]').val() != '' && 
		$('textarea[name=message]').val() != '' && 
		$('input[name=norobot]').val() != '' && 
		$('#eMailMistake').css('display') == 'none' &&
		$('#nameMistake').css('display') == 'none' &&
		$('#homePageMistake').css('display') == 'none' &&
		$('#messageMistake').css('display') == 'none' &&
		$('#pictureMistake').css('display') == 'none' &&
		$('#captchaMistake').css('display') == 'none' ){
			
			$('form[name=baseForm]').submit();
	}
	else{
		$('#formMistake').css('display','inline');
	}
});
// hide all fields on reset click
$('#resetButton').on('click', function(){
	
		$('#eMailMistake').css('display','none');
		$('#nameMistake').css('display','none');
		$('#homePageMistake').css('display','none');
		$('#messageMistake').css('display','none');
		$('#pictureMistake').css('display','none');
		$('#captchaMistake').css('display','none');
		$('#formMistake').css('display','none');
		$('#previewText').html('<font color = "darkgray">Your text will be here...</font>');
});

});
// Function WrapText
function insertTag(_obj_name, _tag_start, _tag_end)
{
var area=document.getElementsByName("message").item(0);
 
// For Mozilla 
if (document.getSelection)
{ 
  area.value=area.value.substring(0,area.selectionStart)+
   _tag_start+
   area.value.substring(area.selectionStart, area.selectionEnd)+
  _tag_end+
   area.value.substring(area.selectionEnd,area.value.length);
}
 
// For Internet Explorer
else
{ var selectedText=document.selection.createRange().text;
  if (selectedText!='')
  { var newText=_tag_start+selectedText+_tag_end;
    document.selection.createRange().text=newText;
  }
}
}