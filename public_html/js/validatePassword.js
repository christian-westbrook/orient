<script LANGUAGE="JavaScript">

				function validatePass(theForm) {
					
					if(theForm.password.value == theForm.password_confirm.value) {
						
						document.getElementById("settingsForm").submit();
						
					} else {
						
						alert('Passwords don\'t match!');
						
					}
					
				}
				
</script>