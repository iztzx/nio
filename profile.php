<?php
include("header.php");
?>
<!DOCTYPE html>
<html>
<link rel="stylesheet" href="profile.css">
<head>
  <title>Attribution</title>
<script>
function changeColor(color) {
  var content = document.querySelector('.body1');
  content.style.color = color;

  var headings = document.querySelectorAll('h1');
  headings.forEach(function (heading) {
    heading.style.color = color;
  });
}
  </script>
</head>
<body>
  <div class="body1">
    <header>
      <h1>Attribution</h1>
      <i class="fas fa-wheelchair"></i>
      <button class="button button-black" onclick="changeColor('black')">Black</button>
      <button class="button button-red" onclick="changeColor('FireBrick')">Red</button>
      <button class="button button-green" onclick="changeColor('darkgreen')">Green</button>
      <button class="button button-blue" onclick="changeColor('darkblue')">Blue</button>
      <button class="button button-purple" onclick="changeColor('indigo')">Indigo</button>
    </header>
    <div style="display: flex; justify-content: center;">
      <div class="ABTUS">
        <h1>About Us</h1>
        <h3>Make life easier with a little help from us. Established since 2022, pioneering since then and exhibiting innovation, novelty, outstanding performance.</h3>
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3988.517313963682!2d103.73689137335775!3d1.4632299612042807!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31da12a4a3f33c99%3A0x8acf5b3794451d3d!2sEnglish%20College%20(EC)!5e0!3m2!1sen!2smy!4v1686793086490!5m2!1sen!2smy" width="600" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div>
      <div class="profile-card">
        <img class="profile-pic" src="imej/pfp.jpg" alt="Profile Picture">
        <div class="profile-info">
          <div class="name">Isaac Teo</div>
          <div class="occupation">Creator of NIO</div>
          <div class="description">
            4 Akas Student
          </div>
        </div>
      </div>
      <div class="profile-card">
        <img class="profile-pic" src="imej/pfp1.png" alt="Profile Picture">
        <div class="profile-info">
          <div class="name">Cikgu Nurul Afzanizan</div>
          <div class="occupation">Teacher of Isaac</div>
          <div class="description">
            Dedicated SK teacher
          </div>
        </div>
      </div>
    </div>
  </div>

  <center><h5 class="text-muted">Copyright © 2023 NIO Inc. All rights reserved.</h5></center>
</body>
</html>
