<!DOCTYPE HTML>
<html>
<head>
<title>Test project</title>

	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/validation.js"></script>
	<script type="text/javascript" src="js/ajaxupload.js"></script>
	<link href="css/bootstrap.css" rel="stylesheet" media="screen">
	<link href="css/bootstrap-icon.css" rel="stylesheet" media="screen">
	<link href="css/myStyle.css" rel="stylesheet">

	<link rel=stylesheet href="css/style.css" type="text/css" media="screen">
	
</head>
<body>
	<div class="container">
		<div class="header">
			<h3 >This test task has been offered by Anton Shevchuk.</h3>
			<hr></hr>
		</div>
		
		<form name = "baseForm" method = "post" action = "php/saveFormData.php" enctype="multipart/form-data" class = "mainForm" >
			<p>
				<label  for = "userName" class = ""> 
					<span class="fieldName">User Name:*</span>
					<input id = "userName" name = "userName" type = "text" placeholder = "Write your Name here!"/>
					<span class="fieldDescription">Only latin letters and numbers</span>
				</label>
			</p>
			
			<em id = "nameMistake"   class="mistakes label label-important">Check your User Name</em>
			
			<p>
				<label  for = "eMail" class = ""> 
					<span class="fieldName">E-mail:* </span>
					<input id = "eMail" name = "eMail" type = "text" placeholder = "Write your E-mail here!"/>
					<span class="fieldDescription">Example: example@gmail.com </span>
				</label>
			</p>
			
			<em id = "eMailMistake" class = "mistakes label label-important" >Check your  E-mail </em>
			
			<p>
				<label for = "homePage"  class = "">
					<span class="fieldName">Homepage:</span>  
					<input id = "homePage" name = "homePage" type = "text" placeholder = "Write your URL here!"/>
					<span class="fieldDescription">Example: http://www.mysite.ru</span>
				</label>
			</p>
			
			<em id = "homePageMistake" class = "mistakes label label-important">Check your Homepage </em> 
			
			<hr></hr>
			
			<p>
				<label for = "message" class = "">Text message:*
					<textarea id = "message" name = "message"  maxlength="255"  placeholder = "Write your text here..."></textarea>
				</label>
				
				<div class = "textButtonsContainer">
					<a href="javascript:void(0);"  id ="preview" class = "wrap btn btn-default" >
					 Preview text</a>
					<a href="javascript:void(0);" class=" wrap btn btn-default"  name = "link" >
					 Link</a>
					 <a href="javascript:void(0);"  class="wrap btn btn-default" name = "strong" >
					 Strong</a>
					 <a href="javascript:void(0);"  class="wrap btn btn-default"  name = "italic" >
					 Italic</a>
					 <a href="javascript:void(0);"  class="wrap btn btn-default" name = "strike" >
					 Strike</a>
				</div>	
				
				<div  class = "previewTextContainer "id = "previewText"><font color = "darkgray">Your text will be here...</font>
					
				</div>
				
				<em id = "messageMistake"  class = "mistakes label label-important">Your text is not validate</em>	
			
				<span class="label label-warning">You can use only such HTML tags: &lt;a href=""&gt;, &lt;code&gt;, &lt;i&gt; , &lt;strong&gt;, &lt;strike&gt;.  Remember: the code must be valid XHTML!
				</span>
			</p>
			<hr></hr>
			<p>
				<div style="position:relative;" >
					 Add file: 
						<input type="file" id = "picture" class = "file-upload" name="picture" size="80" >
						<span  id="upload-file-info" style = "margin-left: 30px;">There are no selected files to add</span>
						<div class = 'fileButtonsContainer'>
							<a id = 'chooseFileButton' class='btn btn-default' href='javascript:void(0);'>
							Choose File
							</a>
							<a id = 'deleteFileButton' class='btn btn-default' href='javascript:void(0);'>
							Delete File
							</a>
						</div>
				</div>
				<br>
				<em id ="pictureMistake" class = "mistakes label label-important" >Check your attached file</em>
				<span class="label label-warning">For image: only GPG, PNG, GIF formats. For txt file: only .txt format, less 100 kb. 
				</span>
			</p>
			
			<hr></hr>
			
			
			<p>
				<label for="norobot">
					<span class="fieldName">Captcha:*</span>
					<input class="input" type="text" id = "norobot" name="norobot" placeholder = "Write code from image..."/>
					<span id = 'work' class = "fieldDescription">	
						<img id = "captchaImage"  src="php/captcha.php" alt = "captcha" />
					</span>
					<em class = "label label-important" id = "captchaMistake" >Wrong code or you are BOT! Try Again!</em> 
				</label>
				
			</p>
			
			<hr></hr>
			
			<p>
				<div class = "endFormButtons">
					<input type = "reset" class="btn btn-default" value = "Reset" id = "resetButton" />
					<input type="button" class="btn btn-default" value = "SubmitForm"  id = "submitButton" /> 
					<em id = "formMistake" class = "label label-important" >All fields must be correct!!!</em>
				</div>
			
			</p>
			<hr></hr>
		</form>
		
		
		
		<h3>&nbsp;Loaded content:</h3>
		<div id = "placeForData" >
			
		</div>

	<div class="footer">
			<hr></hr>
			<h5>&copy;&nbsp; This project is developed by Zvarych Anton</h5>
			
			
		  </div>

</div>

</body>
</html>



