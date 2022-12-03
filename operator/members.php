<?php
 include('config.php');
 if($_SESSION['username']=='')
 {
header("Location: index.php");	 
 }
?><title>ACK</title>
<head>
    <meta charset="utf-8">
    <title>Page title</title>
    <style>
      #navbar {
        margin: 0;
        padding: 0;
        list-style-type: none;
        width: auto;
      }
      #navbar li {
        border-left: 10px solid #666;
        border-bottom: 1px solid #666;
      }
      #navbar a {
        background-color: #949494;
        color: #fff;
        padding: 5px;
        text-decoration: none;
        font-weight: bold;
        border-left: 5px solid #33ADFF;
        display: block;
      }
table {
    border-collapse: collapse;
}
td, th {
    border: 1px solid black;
}
    </style>
</head>
 
  <body>
  <form method="post" action="">
   <table width="100%" border="0">
  <tr>
    <td style="width:15%;" valign="top">
    <ul id="navbar">
      <li><a href="?file=New">New Testament</a></li>
      <li><a href="?file=Old">Old Testament</a></li>
      <li><a href="?file=PrayerBook">Prayer Book</a></li>
      <li><a href="?file=Songs">Songs</a></li>
      
      <li><a style="white-space:nowrap" href="?file=Ibada">Kitabu Cha Ibada</a></li>
      <li><a href="?file=Nyimbo">Nyimbo</a></li>
      
      <li><a href="?file=Notes">Notes</a></li>
      <li><a href="?file=Scroll">Scroller</a></li>
      <li><a href="logout.php">Log Out</a></li>
    </ul></td>
    <td valign="top" width="20%">
    
    <style>
	button:disabled,
button[disabled]{
  border: 1px solid #999999;
  background-color: #cccccc;
  color: #666666;
  opacity: 0.4
}
</style>
    
    <div align="center" style="background-color:#949494; color:#fff"><strong> BOOKS :
<?
	 if($_GET['file']=='New') { echo "New Testament"; }
	elseif($_GET['file']=='Old') { echo "Old Testament"; }
	elseif($_GET['file']=='PrayerBook') { echo "Prayer Book"; }
	elseif($_GET['file']=='Songs') { echo "Songs"; }
	elseif($_GET['file']=='Ibada') { echo "Kitabu Cha Ibada"; }
	elseif($_GET['file']=='Nyimbo') { echo "Nyimbo"; }
	elseif($_GET['file']=='Notes') { echo "Notes"; }
	elseif($_GET['file']=='Scroll') { echo "Scroll"; }
	 ?>
      </strong>
    </div>
    
      <div style="width:auto; height:500px; overflow-y: scroll;">
        <table border="0" width="100%" style="border:none">
  <tr>
  <td><strong>#</strong></td><td><strong>Name</strong></td><td><strong>Code</strong></td>
  <td colspan="3"><a title="Add Book" href="members.php?file=<?=$_GET['file']?>&add=1"><div align="center"><img src="../assets/images/add.png" width="18" height="18" /></div></a></td>
  </tr>
  <?
  $check = mysqli_query($conect, "SELECT * FROM booklist  WHERE  BookTestament= '".$_GET['file']."' order by orderid asc");
  while($row = mysqli_fetch_array( $check )){
	$count=$count+1;  ?>
      <tr>
        <td><?=$count?>&nbsp;</td>
    <td style="white-space:nowrap"><?=$row['BookName']?></td>
    <td><?=$row['BookCode']?></td>
    <td><a title="Edit Book" href="members.php?file=<?=$_GET['file']?>&add=<?=$row['bookList_id']?>"><div align="center"><img src="../assets/images/edit.gif" width="18" height="18" /></div></a></td>
    <td><a title="chapters" href="members.php?file=<?=$_GET['file']?>&bookList_id=<?=$row['bookList_id']?>">
      <div align="center"><img src="../assets/images/folder.gif" width="18" height="18" /></div>
    </a></td>
    <td>
    <? $checkd = mysqli_query($conect, "SELECT * FROM kjv_english  WHERE  book_id= '".$row['bookList_id']."' group by chapter_number");
  
  ?>
    <button <? if(mysqli_num_rows($checkd)>0) { echo 'disabled'; } ?> type="submit" name="deletebook" id="deletebook" value="<?=$row['bookList_id']?>"><img src="../assets/images/escape.png" width="16" height="16" /></button>
    </td>
      </tr>
  <? } ?>
  </table>
</div>

    </td>
    <td valign="top"  width="20%">
   
    <? 
	if($_POST['savchap'])
	{
	$BookName= ucwords($_POST['BookName']);
	$BookCode= ucwords($_POST['BookCode']);
	$BookTestament=$_GET['file'];
	$orderid= ($_POST['orderid']);
	
	$insertSQL = "Insert into booklist SET BookName='$BookName',BookCode='$BookCode',BookTestament='$BookTestament',orderid='$orderid'"; 
   if(@mysqli_query($conect,$insertSQL)) 
									{ ?> <script> alert('Book Added');
                                    window.location='members.php?file=<?=$_GET['file']?>&add=1';
                                    </script> <? } else { ?> <script> alert('Error: Book Exist');</script> <? }	
	}
	
	if($_POST['upchap'])
	{
	$BookName= ucwords($_POST['BookName']);
	$BookCode= ucwords($_POST['BookCode']);
	$BookTestament=$_GET['file'];
	$orderid= ($_POST['orderid']);
	
	$insertSQL = "update booklist SET BookName='$BookName',BookCode='$BookCode',BookTestament='$BookTestament',orderid='$orderid' where bookList_id='".$_GET['add']."'"; 
   if(@mysqli_query($conect,$insertSQL)) 
									{ ?> <script> alert('Book Updated');
                                   
                                    </script> <? } else { ?> <script> alert('Error: Book Exist');</script> <? }	
	}
	
	
	if($_POST['chapterverse'])
	{
	$chapter_number= ucwords($_POST['chapter_number']);
	$verse_number= ucwords($_POST['verse_number']);
	$verse_text= ($_POST['verse_text']);
	$book_id=$_GET['bookList_id'];
	
	$insertSQL = "Insert into kjv_english SET chapter_number='$chapter_number',verse_number='$verse_number',verse_text='$verse_text',book_id='$book_id'"; 
   if(@mysqli_query($conect,$insertSQL)) 
									{ ?> <script> alert('Chapter/verse added');
                                    window.location='members.php?file=<?=$_GET['file']?>&bookList_id=<?=$_GET['bookList_id']?>&book_id=<?=$_GET['book_id']?>';
                                    </script> <? } else { ?> <script> alert('Error: Chapter/verse Exist');</script> <? }	
	}
	
	if($_POST['chapterverseu'])
	{
	$chapter_number= ucwords($_POST['chapter_number']);
	$verse_number= ucwords($_POST['verse_number']);
	$verse_text= ($_POST['verse_text']);
	$book_id=$_GET['bookList_id'];
	
	$insertSQL = "update  kjv_english SET chapter_number='$chapter_number',verse_number='$verse_number',verse_text='$verse_text' where logid='".$_GET['edit']."'"; 
   if(@mysqli_query($conect,$insertSQL)) 
									{ ?> <script> alert('Chapter/verse Updated');
                                    //window.location='members.php?file=<?=$_GET['file']?>&bookList_id=<?=$_GET['bookList_id']?>';
                                    </script> <? } else { ?> <script> alert('Error: Chapter/verse Exist');</script> <? }	
	}
	
	if($_POST['delete'])
	{
		$insertSQL = "delete from  kjv_english  where logid='".$_POST['delete']."'"; 
   if(@mysqli_query($conect,$insertSQL)) 
									{ ?> <script> alert('Chapter/verse Deleted'); 
									window.location='members.php?file=<?=$_GET['file']?>&bookList_id=<?=$_GET['bookList_id']?>'; </script> <? } 		
	}
	
	if($_POST['deletebook'])
	{
		$insertSQL = "delete from  booklist  where bookList_id='".$_POST['deletebook']."'"; 
   if(@mysqli_query($conect,$insertSQL)) 
									{ ?> <script> alert('Book Deleted'); 
									window.location='members.php?file=<?=$_GET['file']?>'; </script> <? } 		
	}
	
	 
	if($_GET['add']==1)
	{
	?>
    
    <table width="100%" border="0">
  <tr>
    <td colspan="2" align="center" style="background-color:#949494;color:#fff">Add New Book</td>
    </tr>
  <tr>
    <td>Book Name</td>
    <td><input type="text" name="BookName" id="BookName" required onKeyUp="codeme()" value="<?=$_POST['BookName']?>" /></td>
  </tr>
  <tr>
    <td>Code</td>
    <td><input type="text" name="BookCode" id="BookCode" required maxlength="5" value="<?=$_POST['BookCode']?>" />
    <script>
	function codeme()
	{
	var string=	document.getElementById('BookName').value;
	string=string.substring(0,4);
	document.getElementById('BookCode').value=string.split(' ').join('');
	}
    </script>
    </td>
  </tr>
  <tr>
    <td>Sort Number</td>
    <td><select name="orderid" id="orderid">
    <? 
	for($i=1;$i<1000;$i++)
	{
	?>
    <option value="<?=$i+$count?>"><?=$i+$count?></option>
    
    <?	
	}
	?>
    </select></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" name="savchap" id="savchap" value="Save Book" /></td>
  </tr>
</table>

    
    
    
	<?	
	}
	
	if($_GET['add']>1)
	{
	
	$check = mysqli_query($conect, "SELECT * FROM booklist  WHERE  bookList_id= '".$_GET['add']."'");
  while($row = mysqli_fetch_array( $check )){?>
    
    <table width="100%" border="0">
  <tr>
    <td colspan="2" align="center" style="background-color:#949494;color:#fff">Edit Book</td>
    </tr>
  <tr>
    <td>Book Name</td>
    <td><input type="text" name="BookName" id="BookName" required onKeyUp="codeme()" value="<?=$row['BookName']?>" /></td>
  </tr>
  <tr>
    <td>Code</td>
    <td><input type="text" name="BookCode" id="BookCode" required maxlength="5" value="<?=$row['BookCode']?>" />
    <script>
	function codeme()
	{
	var string=	document.getElementById('BookName').value;
	string=string.substring(0,4);
	document.getElementById('BookCode').value=string.split(' ').join('');
	}
    </script>
    </td>
  </tr>
  <tr>
    <td>Sort Number</td>
    <td><select name="orderid" id="orderid">
    <option value="<?=$row['orderid']?>"><?=$row['orderid']?></option>
    <? 
	for($i=1;$i<1000;$i++)
	{
	?>
    <option value="<?=$i?>"><?=$i?></option>
    
    <?	
	}
	?>
    </select>
      <input type="hidden" name="bookList_id" id="bookList_id" value="<?=$row['bookList_id']?>" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" name="upchap" id="upchap" value="Update Book" /></td>
  </tr>
</table>
<?	}
	}
	
	
	if($_GET['bookList_id']>0)
	{
	?>
    <table width="100%" border="0">
  <tr>
    <td colspan="2" align="center" style="background-color:#949494;color:#fff">Manage Chapters</td>
    </tr>
  <tr>
  <tr>
  <td>
  <style>
.tile {
margin-left: 1px;
margin-top: 1px;
text-align: center;
background-color: #D6C485;
display: inline-block;
width: 44px;
height: 25px;
padding: 3px;
}
</style>
 <div style="width:auto; height:300px; overflow-y: scroll;">
 <?
 $check = mysqli_query($conect, "SELECT * FROM kjv_english  WHERE  book_id= '".$_GET['bookList_id']."' group by chapter_number");
  while($row = mysqli_fetch_array( $check )){ $counts=$counts+1;?>
  
  <a href="members.php?file=<?=$_GET['file']?>&bookList_id=<?=$_GET['bookList_id']?>&book_id=<?=$row['chapter_number']?>"><div class="tile"><?=$chapter_number=$row['chapter_number']?></div></a>
  <? } 
  ?>
  </div>
  <?
  if($_GET['edit']=='')
  { 
  
  if($_GET['book_id']>0)
  {
	$chapter_number=$_GET['book_id'];  
  }
  ?>
  <table width="100%" border="0">
  <tr>
    <td colspan="4" align="center" style="background-color:#949494;color:#fff">Add Chapter &amp; Verse</td>
    </tr>
  <tr>
    <td>Chapter</td>
    <td><select name="chapter_number" id="chapter_number">
      <option value="<?=$chapter_number?>">
        <?=$chapter_number?>
        </option>
		<? 
	for($i=1;$i<1000;$i++)
	{
	?>
      <option value="<?=$i+$chapter_number?>">
        <?=$i+$chapter_number?>
        </option>
      <?	
	}
	?>
    </select></td>
    <td>Verse</td>
    <td><select name="verse_number" id="verse_number">
      <? 
	for($x=1;$x<1000;$x++)
	{
	?>
      <option value="<?=$x?>"><?=$x?></option>
      <?	
	}
	?>
    </select></td>
  </tr>
  <tr>
    <td colspan="4"> 
      <textarea name="verse_text" id="verse_text" style="width: 100%;" rows="5"></textarea></td>
    </tr>
  <tr>
    <td colspan="4" align="center"><input type="submit" name="chapterverse" id="chapterverse" value="Save" /></td>
  </tr>
</table>
<? }
else {
	
	$check = mysqli_query($conect, "SELECT * FROM kjv_english  WHERE  logid= '".$_GET['edit']."'");
  while($row = mysqli_fetch_array( $check )){
	 $chapter_number= $row['chapter_number'];
	 $verse_number= $row['verse_number'];
	 $verse_text= $row['verse_text'];
  }
	 ?>
  <table width="100%" border="0">
  <tr>
    <td colspan="4" align="center" style="background-color:#949494;color:#fff">Edit Chapter &amp; Verse</td>
    </tr>
  <tr>
    <td>Chapter</td>
    <td><select name="chapter_number" id="chapter_number">
      <option value="<?=$chapter_number?>">
        <?=$chapter_number?>
        </option>
		<? 
	for($i=1;$i<1000;$i++)
	{
	?>
      <option value="<?=$i+$chapter_number?>">
        <?=$i+$chapter_number?>
        </option>
      <?	
	}
	?>
    </select></td>
    <td>Verse</td>
    <td><select name="verse_number" id="verse_number">
     <option value="<?=$verse_number?>">
        <?=$verse_number?>
        </option>
         <? 
	for($x=1;$x<1000;$x++)
	{
	?>
      <option value="<?=$x?>"><?=$x?></option>
      <?	
	}
	?>
    </select></td>
  </tr>
  <tr>
    <td colspan="4"> 
      <textarea name="verse_text" id="verse_text" style="width: 100%;" rows="5"><?=$verse_text?></textarea></td>
    </tr>
  <tr>
    <td colspan="4" align="center"><input type="submit" name="chapterverseu" id="chapterverseu" value="Update" /></td>
  </tr>
</table>
<? 
}
  ?>
  </td>
  </tr>
  </table>
    <?	
		
	}
	
	?>
    
    </td>
    <td valign="top" style="width:30%">
    <? if($_GET['book_id'])
	{?>
    <div style="width:auto; height:500px; overflow-y: scroll;">
      <table width="100%" border="0">
        <tr style="background-color:#949494;color:#fff">
          <td>#</td>
          <td>Verse</td>
          <td>Edit</td>
          <td>Del</td>
        </tr>
       <? $check = mysqli_query($conect, "SELECT * FROM kjv_english  WHERE  book_id='".$_GET['bookList_id']."' and chapter_number= '".$_GET['book_id']."'");
  while($row = mysqli_fetch_array( $check )){?> <tr>
         <td valign="top"><?=$row['verse_number']?></td>
          <td  valign="top"><?=$row['verse_text']?></td>
          <td  valign="top"><a title="Edit Verse" href="members.php?file=<?=$_GET['file']?>&bookList_id=<?=$_GET['bookList_id']?>&book_id=<?=$_GET['book_id']?>&edit=<?=$row['logid']?>"><div align="center"><img src="../assets/images/edit.gif" width="18" height="18" /></div></a></td>
          <td  valign="top"><button type="submit" name="delete" id="delete" value="<?=$row['logid']?>"><img src="../assets/images/escape.png" width="16" height="16" /></button></td>
        </tr>
        <? } ?>
      </table>
    </div>
    <? } ?>
    </td>
  </tr>
</table>
 </form>
 
   
