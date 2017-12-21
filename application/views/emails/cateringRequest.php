<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Catering Quote</title>
</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center" valign="top" bgcolor="#838383" style="background-color:#838383;"><br>
    <br>
    <table width="600" border="0" cellspacing="0" cellpadding="0">

      <tr>
        <td align="center" valign="top" bgcolor="#d3be6c" style="background-color:#d3be6c; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000; padding:0px 15px 10px 15px;">

        <hr/>

          <div style="font-size:48px; color:#838383;"><b>Catering Request Form</b></div>

        <hr/>

          <!-- Start of title of quote -->

          <div style="font-size:24px; color:#555100;"><br>
            Below is the summary of the request submitted<br>
          </div>

          <!-- End of request title -->

            <div><br>

            <!-- Start of Request Description -->

            <p align="left"><strong>Name:</strong> <?php echo $RequestName; ?></p>
            <p align="left"><strong>Phone:</strong> <?php echo $RequestPhone; ?></p>
            <p align="left"><strong>Email:</strong> <?php echo $RequestEmail; ?></p>
            <p align="left"><strong>Total Expected Guest:</strong> <?php echo $RequestExpectedGuest; ?></p>
            <p align="left"><strong>Total Food Trays:</strong> <?php echo $RequestFoodTrays; ?></p>
            <p align="left"><strong>Request Description:</strong> <?php echo $RequestDescription; ?></p>
            <p align="left"><strong>Other Details:</strong> <?php echo $AdditionalComments; ?></p>
            <p align="left"><strong>Need Chaffers?:</strong> <?php echo $NeedChaffers; ?></p>
            <p align="left"><strong>Event Address:</strong> <?php echo $RequestAddress; ?></p>
            <p align="left"><strong>Event Date:</strong> <?php echo $RequestDate; ?></p>

            <!-- End of request description -->

            <br>
            <br>
            <br>
            
            <b>Naija Foodies LLC</b><br>
            Phone: (317) 883  7205 <br>
            Date Submitted: <?php echo date('m-d-y'); ?><br>
          <a href="http://www.naijafoodies.com" target="_blank" style="color:#000000; text-decoration:none;"> http://www.naijafoodies.com</a></div></td>

      </tr>

      <tr>
        <td align="left" valign="top"><img src="../images/logo/companylogo.jpg" width="600" height="18" style="display:block;"></td>
      </tr>

  </table>
    <br>
    <br></td>
  </tr>
</table>
</body>
</html>
