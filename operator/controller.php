<?php 
	require_once('bible.php');
	$bible = new Bible();
	

         $request = isset($_POST['action'])?$_POST['action']:"";
         if ($request == "chapter"){
              $bible->getChapter($_POST['book_id']);
         }

         if ($request == "bookList"){
              $bible->getBookList();
         }

         if ($request == "verse"){
             $bible->getVerse($_POST['book_id'],
                              $_POST['chapter_number']);
         }

         if ($request == "getBible"){
             $bible->getBible($_POST['book_id'],
                              $_POST['chapter_number'],
                              $_POST['verse_number']);
         }

         if ($request == "back"){
             $bible->getBack($_POST['book_id'],
                             $_POST['chapter_number'],
                             $_POST['verse_number']);
         }

         if ($request == "forward"){
             $bible->getForward($_POST['book_id'],
                                $_POST['chapter_number'],
                                $_POST['verse_number']);
         }

          if ($request == "search"){
             $bible->getSearch($_POST['searchQuery'],
                               $_POST['testament']);
         }
         
 ?>
