<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> <html xmlns="http://www.w3.org/1999/xhtml">
     <head><link rel="stylesheet" type="text/css" href="assets/css/style.css"></head>
     <title>ACK</title>
     <body> 
     <img src = "assets/images/background.jpg" id = "bg">
          <div id = "bookOverlay"></div>
          <div class = "book">
               <button id = "bookList">Book</button>
               <button id = "chapter" class = "navButton">Chapter</button>
               <button id = "verse" class = "navButton">Verse</button>
               <div id = "selector">
               </div>
          </div>
          <div id = "searchOverlay"></div>
          <div class = "search" id="myform" >
          
               <input type="text" name="text1" size="12" id = "inputSearch" onkeyup = "typeSearch('All')">
               <button id = search>Search</button>
               <input type = "radio" name = "filter" value = "All" id="All" onclick="typeSearch('All')"> All<br>
               <input type = "radio" name = "filter" value = "Old" id = "Old" onclick="typeSearch('Old')"> Old Testament<br>
               <input type = "radio" name = "filter" value = "New" id = "New" onclick="typeSearch('New')">New Testament<br>  
                <input type = "radio" name = "filter" value = "PrayerBook" id="PrayerBook" onclick="typeSearch('PrayerBook')" >Prayer book<br>        
                       <div id = "results">
               </div>
          </div>
          <div>
               <div class = "header">
                    <div id = "title">Anglican Church Of Kenya</div>
                    <ul class = "menu">
                         <li class = "menuBook"><a href="#" id = "bookBtn"><img src="assets/images/book.png"></a></li>
                         <li class = "menuSearch"><a href="#" id = "searchBtn"><img src="assets/images/Search.png"></a></li>
                    </ul>
               </div>
               <div class = "content">
                    <div id = "sitas"></div>        
                    <div id = "phrase">sample</div>
               </div>
          </div>
          <div class = "footer">
               <a href="#" id = "back"><img src="assets/images/back.png"></a>
               <a href="#" id = "forward"><img src="assets/images/forward.png"></a>
          </div>
     </body>
     <script src="assets/js/jquery.js"></script>
     <script src="assets/js/ajax.js"></script>
     <script src="assets/js/navigator.js"></script>
</html>
