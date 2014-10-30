function inputValidation(){
		var emailCheck=false;
		var textCheck=false;
		$('.banner_type').each(function(){
			var indexOfAt=$(this).val();
			if($(this).val()!=5)
			{
				emailCheck=true;
				console.log('true');
			}
			else
			{
				animateInput($(this).attr('id'));
				console.log('false');
				return false;
			}
		});
		
		$('.inputClass').each(function(){
			console.log($(this).val().length);
			if($(this).val().length>2)
			{
				textCheck=true;
				console.log('true');
			}
			else
			{
				animateInput($(this).attr('id'));
				console.log('false');
				return false;
			}
		});
		
		if(textCheck==true && emailCheck==true){
			return true;
		}
		else
		{
			return false;
		}
	}
	
	
	function inputValidationMessage(){
		var emailCheck=false;
		var textCheck=false;
		$('.emailClassM').each(function(){
			var indexOfAt=$(this).val().indexOf("@");
			if($(this).val()!='' && indexOfAt!=-1 && indexOfAt!=0)
			{
				emailCheck=true;
				console.log('true');
			}
			else
			{
				animateInput($(this).attr('id'));
				console.log('false');
			}
		});
		
		$('.inputClassM').each(function(){
			console.log($(this).val().length);
			if($(this).val().length>2 && $(this).val()!='Message' && $(this).val()!='Name' && $(this).val()!='Subject')
			{
				textCheck=true;
				console.log('true');
			}
			else
			{
				animateInput($(this).attr('id'));
				console.log('false');
			}
		});
		
		if(textCheck==true && emailCheck==true){
			return true;
		}
		else
		{
			return false;
		}
	}
	
	
	function animateInput(id)
	{
		
		$('#'+id).css({
			'background':'rgba(255,13,0,.3)'
		});
		setTimeout(function(){
			$('#'+id).css({
			'background':'white'
			});
		},1000);
	}