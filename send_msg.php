<html>
<head>
    <script language=Javascript>

       function isNumberKey(evt)
       {
          var charCode = (evt.which) ? evt.which : evt.keyCode;
          if (charCode != 46 && charCode > 31 
            && (charCode < 48 || charCode > 57))
             return false;

          return true;
       }

    </script>
  </head>

<body>
<center><p style="font-family:Arial Black;color:#438295;"><strong>Enter Your way2sms credentials and then mobile number whom you want to send a message: </strong></p>
<form action="curl_text.php" method="post">
<input type="text" name="username" placeholder="Username" onkeypress="return isNumberKey(event)" maxlength="10"></br>
<input type="password" name="password" placeholder="Password"></br></br>
<input type="text" name="mobile" placeholder="mobile" onkeypress="return isNumberKey(event)" maxlength="10"></br>
<input type="text" name="message" placeholder="message"></br>
<input type="submit" value="Send">
</form></center>
</body>
</html>
