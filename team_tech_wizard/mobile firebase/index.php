<!DOCTYPE html>
<html>
  <head>
    <title>Firebase Phone Verification</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <link href="main.css" rel="stylesheet">

  </head>
  <body>
    <form action="verification.php">
      <h1>Firebase Phone verification In PHP</h1>
      <div class="formcontainer">
      <hr/>
      <div class="container">
        <label for="uname"><strong>Phone Number</strong></label>
        <input type="text" id="number" placeholder="Enter phone number" name="uname" required>
      </div>
      <div id="recaptcha-container"></div>
      <button type="button" onclick="phoneAuth();">Send Otp</button>
    
    </form>


    <script src="https://www.gstatic.com/firebasejs/8.3.1/firebase.js"></script>
    <script>
    // Your web app's Firebase configuration
    var firebaseConfig = {
      apiKey: "AIzaSyB2IU71IQqaI_zJ_d73u_FwxhydvvSqQNM",
    authDomain: "rajasthan-9b2d9.firebaseapp.com",
    projectId: "rajasthan-9b2d9",
    storageBucket: "rajasthan-9b2d9.appspot.com",
    messagingSenderId: "1097677672026",
    appId: "1:1097677672026:web:f6f720b994e0b461699263",
    measurementId: "G-KDGXVYJ728"
    };

    // Initialize Firebase
    firebase.initializeApp(firebaseConfig);
     firebase.analytics();
</script>
    <script src="firebase.js" type="text/javascript"></script>
  </body>
</html>
