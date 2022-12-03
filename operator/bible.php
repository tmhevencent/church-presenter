<?php require_once('config.php');
class Bible {
  
      public function getChapter($book_id){
		  global $conect;
          $query = mysqli_query($conect,"select distinct chapter_number from kjv_english where 
                              book_id = {$book_id} ");
          echo " <hr><b>CHAPTER</b><br>";
          if(mysqli_num_rows($query)>0){
               while($row= mysqli_fetch_array($query)){
               $action = "loadVerse(".$row['chapter_number'].", \"".
                                      $row['chapter_number']."\")";
               $this->tiler($row['chapter_number'], $action);  
               }
          }
     }

      public function getVerse($book_id, $chapter){
		  global $conect;
          $query = mysqli_query($conect,"select distinct verse_number from kjv_english where 
                              book_id = {$book_id} and 
                              chapter_number = {$chapter}");
          echo " <hr><b>VERSE</b><br>";
          if(mysqli_num_rows($query)>0){
               while($row= mysqli_fetch_array($query)){
               $action = "loadBible(".$row['verse_number'].")";
               $this->tiler($row['verse_number'], $action);   
               }
          }
     }

     public function getBookList(){
	global $conect;	 
     $query = mysqli_query($conect,"select * from booklist where BookTestament = 'Old'");
          echo "<hr><b>OLD TESTAMENT</b><br><br>";
          if(mysqli_num_rows($query)>0){
               while($row= mysqli_fetch_array($query)){
               $action = "loadChapter(".$row['bookList_id'].", \"".
                                        $row['BookName']."\")";
               $this->tiler($row['BookCode'], $action);  
               }
          }
          echo "<br><br><hr><b>NEW TESTAMENT</b><br><br>";
          $query1 = mysqli_query($conect,"select * from booklist where BookTestament = 'New'");
          if(mysqli_num_rows($query)>0){
               while($row= mysqli_fetch_array($query1)){
               $action = "loadChapter(".$row['bookList_id'].", \"".
                                        $row['BookName']."\")";
               $this->tiler($row['BookCode'], $action);
               }
          }
		  
		  echo "<br><br><hr><b>Prayer Book</b><br><br>";
          $query1 = mysqli_query($conect,"select * from booklist where BookTestament = 'PrayerBook'");
          if(mysqli_num_rows($query)>0){
               while($row= mysqli_fetch_array($query1)){
               $action = "loadChapter(".$row['bookList_id'].", \"".
                                        $row['BookName']."\")";
               $this->tiler($row['BookCode'], $action);
               }
		  }
			   
			echo "<br><br><hr><b>Songs</b><br><br>";
          $query1 = mysqli_query($conect,"select * from booklist where BookTestament = 'Songs'");
          if(mysqli_num_rows($query)>0){
               while($row= mysqli_fetch_array($query1)){
               $action = "loadChapter(".$row['bookList_id'].", \"".
                                        $row['BookName']."\")";
               $this->tiler($row['BookCode'], $action);
               }
			      
          }
		  
		  echo "<br><br><hr><b>Ibada</b><br><br>";
          $query1 = mysqli_query($conect,"select * from booklist where BookTestament = 'Ibada'");
          if(mysqli_num_rows($query)>0){
               while($row= mysqli_fetch_array($query1)){
               $action = "loadChapter(".$row['bookList_id'].", \"".
                                        $row['BookName']."\")";
               $this->tiler($row['BookCode'], $action);
               }
			      
          }
		  
		  echo "<br><br><hr><b>Nyimbo</b><br><br>";
          $query1 = mysqli_query($conect,"select * from booklist where BookTestament = 'Nyimbo'");
          if(mysqli_num_rows($query)>0){
               while($row= mysqli_fetch_array($query1)){
               $action = "loadChapter(".$row['bookList_id'].", \"".
                                        $row['BookName']."\")";
               $this->tiler($row['BookCode'], $action);
               }
			      
          }
		  
		  echo "<br><br><hr><b>Notes</b><br><br>";
          $query1 = mysqli_query($conect,"select * from booklist where BookTestament = 'Notes'");
          if(mysqli_num_rows($query)>0){
               while($row= mysqli_fetch_array($query1)){
               $action = "loadChapter(".$row['bookList_id'].", \"".
                                        $row['BookName']."\")";
               $this->tiler($row['BookCode'], $action);
               }
			      
          }
     }

     public function getBible($book_id, $chapter, $verse){
		 global $conect;
          $query = mysqli_query($conect,"select verse_text from kjv_english where 
                              book_id = {$book_id} and 
                              chapter_number = {$chapter} and 
                              verse_number = {$verse}");
          if(mysqli_num_rows($query)>0){
               $row= mysqli_fetch_array($query);
               echo "<div id = 'verseText'>".$row['verse_text']."</div>";
          }
     }

     public function getBack($bookid, $chapterid, $verseid){
		 global $conect;
          $book_id = $bookid;
          $chapter = $chapterid;
          $verse = $verseid - 1;
          $query = mysqli_query($conect,"select * from kjv_english k JOIN booklist 
                    b ON(k.book_id = b.bookList_id ) where 
                              book_id = {$book_id} and 
                              chapter_number = {$chapter} and 
                              verse_number = {$verse}");
          if(mysqli_num_rows($query)>0){
               $row= mysqli_fetch_array($query);
               $phrase = $row['verse_text'];
               $bookname = $row['BookName'];
               $json = "{
                    \"bookname\" : \"".$bookname."\",
                    \"book\" : ".$book_id.",
                    \"chapter\" : ".$chapter.",
                    \"verse\" : ".$verse.",
                    \"phrase\" : \"".$phrase."\"
               }";
               echo $json;
          }else{
               $chapter = $chapter - 1;
               $verse = $this->getMaxVerse($book_id, $chapter);
               $sql = "select * from kjv_english k JOIN booklist
                         b ON(k.book_id = b.bookList_id ) where 
                              book_id = {$book_id} and 
                              chapter_number = {$chapter} and 
                              verse_number = {$verse}";
               $query = mysqli_query($conect,$sql);
               if(mysqli_num_rows($query)>0){
                    $row= mysqli_fetch_array($query);
                    $phrase = $row['verse_text'];
                    $bookname = $row['BookName'];
                    $json = "{
                         \"bookname\" : \"".$bookname."\",
                         \"book\" : ".$book_id.",
                         \"chapter\" : ".$chapter.",
                         \"verse\" : ".$verse.",
                         \"phrase\" : \"".$phrase."\"
                    }";
                    echo $json;
               }else{
                    $book_id = $book_id - 1;
                    $chapter = $this->getMaxChapter($book_id); 
                    $verse = $this->getMaxVerse($book_id, $chapter);
                    $query = mysqli_query($conect,"select * from kjv_english k JOIN booklist 
                              b ON(k.book_id = b.bookList_id ) where 
                                   book_id = {$book_id} and 
                                   chapter_number = {$chapter} and 
                                   verse_number = {$verse}");
                    if(mysqli_num_rows($query)>0){
                         $row= mysqli_fetch_array($query);
                         $phrase = $row['verse_text'];
                         $bookname = $row['BookName'];
                         $json = "{
                              \"bookname\" : \"".$bookname."\",
                              \"book\" : ".$book_id.",
                              \"chapter\" : ".$chapter.",
                              \"verse\" : ".$verse.",
                              \"phrase\" : \"".$phrase."\"
                         }";
                         echo $json;
                    }else{
                          $query = mysqli_query($conect,"select * from kjv_english k JOIN booklist 
                                   b ON(k.book_id = b.bookList_id ) where 
                                         book_id = 66 and 
                                         chapter_number = 22 and 
                                         verse_number = 21");
                         if(mysqli_num_rows($query)>0){
                              $row= mysqli_fetch_array($query);
                              $phrase = $row['verse_text'];
                              $bookname = $row['BookName'];
                              $json = "{
                                   \"bookname\" : \"".$bookname."\",
                                   \"book\" : 66,
                                   \"chapter\" : 22,
                                   \"verse\" : 21,
                                   \"phrase\" : \"".$phrase."\"
                              }";
                              echo $json;
                         }
                    }
               }
          }
     }
     
     public function getMaxVerse($book_id, $chapter){
		 global $conect;
          if($chapter > 0){
               $query = mysqli_query($conect,"select max(verse_number) as verse from kjv_english where
                                   book_id = {$book_id} AND 
                                   chapter_number = {$chapter}");
               if(mysqli_num_rows($query)>0){
                    $row= mysqli_fetch_array($query);
                    return $row['verse'];
               }
          }else{
               return 0;
          }
     }
     public function getMaxChapter($book_id){
		 global $conect;
           if($book_id > 0){
               $query = mysqli_query($conect,"select max(chapter_number) as chapter from kjv_english where   
                                   book_id = {$book_id}");
               if(mysqli_num_rows($query)>0){
                    $row= mysqli_fetch_array($query);
                    return $row['chapter'];
               }
          }else{
               return 0;
          }
     }

     public function getForward($bookid, $chapterid, $verseid){
		 global $conect;
          $book_id = $bookid;
          $chapter = $chapterid;
          $verse = $verseid + 1;
          $query = mysqli_query($conect,$fg="select * from kjv_english k JOIN booklist 
                    b ON(k.book_id = b.bookList_id ) where 
                              book_id = {$book_id} and 
                              chapter_number = {$chapter} and 
                              verse_number = {$verse}")or die(mysqli_error($conect));;
		 				  
          if(mysqli_num_rows($query)>0){
               $row= mysqli_fetch_array($query);
               $phrase = $row['verse_text'];
               $bookname = $row['BookName'];
               $json = "{
                    \"bookname\" : \"".$bookname."\",
                    \"book\" : ".$book_id.",
                    \"chapter\" : ".$chapter.",
                    \"verse\" : ".$verse.",
                    \"phrase\" : \"".$phrase."\"
               }";
               echo $json;
          }else{
               $verse = 1;
               $chapter = $chapter + 1;
               $query = mysqli_query($conect,"select * from kjv_english k JOIN booklist 
                         b ON(k.book_id = b.bookList_id ) where 
                                   book_id = {$book_id} and 
                                   chapter_number = {$chapter} and 
                                   verse_number = {$verse}");
               if(mysqli_num_rows($query)>0){
                    $row= mysqli_fetch_array($query);
                    $phrase = $row['verse_text'];
                    $bookname = $row['BookName'];
                    $json = "{
                         \"bookname\" : \"".$bookname."\",
                         \"book\" : ".$book_id.",
                         \"chapter\" : ".$chapter.",
                         \"verse\" : ".$verse.",
                         \"phrase\" : \"".$phrase."\"
                    }";
                    echo $json;
               }else{
                    $verse = 1;
                    $chapter = 1;
                    $book_id = $book_id + 1;
               
                    $query = mysqli_query($conect,"select * from kjv_english k JOIN booklist 
                              b ON(k.book_id = b.bookList_id ) where 
                                        book_id = {$book_id} and 
                                        chapter_number = {$chapter} and 
                                        verse_number = {$verse}");
                    if(mysqli_num_rows($query)>0){
                         $row= mysqli_fetch_array($query);
                         $phrase = $row['verse_text'];
                         $bookname = $row['BookName'];
                         $json = "{
                              \"bookname\" : \"".$bookname."\",
                              \"book\" : ".$book_id.",
                              \"chapter\" : ".$chapter.",
                              \"verse\" : ".$verse.",
                              \"phrase\" : \"".$phrase."\"
                         }";
                         echo $json;
                    }else{
                          $query = mysqli_query($conect,"select * from kjv_english k JOIN booklist 
                                   b ON(k.book_id = b.bookList_id ) where 
                                              book_id = 1 and 
                                              chapter_number = 1 and 
                                              verse_number = 1");
                         if(mysqli_num_rows($query)>0){
                              $row= mysqli_fetch_array($query);
                              $phrase = $row['verse_text'];
                              $bookname = $row['BookName'];
                              $json = "{
                                   \"bookname\" : \"".$bookname."\",
                                   \"book\" : 1,
                                   \"chapter\" : 1,
                                   \"verse\" : 1,
                                   \"phrase\" : \"".$phrase."\"
                              }";
                              echo $json;
                         }
                    }
               }
          }
     }

     public function getSearch($search, $testament){
         global $conect;
		   $era = "";
           if ($testament == "All"){
               $era = "";
           } else {
			    $era = "and BookTestament = '{$testament}'";
		   }
		   
		   if($search=='') {  }
		   else {
          $query = mysqli_query($conect,"select * from kjv_english k JOIN booklist 
                    b ON(k.book_id = b.bookList_id ) where 
                              verse_text LIKE '%{$search}%' {$era} order by k.book_id asc");
		   }
          $num_rows = mysqli_num_rows($query) or mysqli_error($conect);
          if($num_rows>0){
               echo "<div>".$num_rows." results found</div><hr>";
               while($row= mysqli_fetch_array($query)){
                    $sResult = substr($row['verse_text'], 0, 30);
                    echo "<div onclick = \"loadPhrase('".$row['BookName']."',
                               ".$row['book_id'].",
                               ".$row['chapter_number'].",
                               ".$row['verse_number'].")\">";
                    echo $row['BookName']." ".
                         $row['chapter_number'].":".
                         $row['verse_number']."<br>";
                  echo $sResult."...</div><hr>";       
               }
          }else{
           echo "no result found";
          }
     }

    public static function get_verse($id) {   
	global $conect;
       $query = mysqli_query($conect,"select verse_text from kjv_english where book_id = '{$id}'");
    }	

    public function tiler($value, $action){
          $tile = "<div class = 'tile' onclick = '".$action."'>".$value."</div>";
          echo $tile;
    }			
   
}
?>
