<script language="javascript" type="text/javascript">

				function validatePass(theForm) {

					if(theForm.pass_one.value == theForm.pass_two.value) {

						document.getElementById("settingsForm").submit();

					} else {

						alert('Passwords don\'t match!');

					}

				}

</script>
