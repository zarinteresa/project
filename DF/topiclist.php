<?php
include 'connect.php';
doDB();

if($_SESSION["user"] == null){
	header("Location: userLogin.html");
	exit;
}
//gather the topics
$get_topics_sql = "SELECT TopicId, Title, DATE_FORMAT(Created,  '%b %e %Y at %r') as fmt_topic_create_time, Owner, Likes, Hot FROM topics ORDER BY Created DESC";
$get_topics_res = mysqli_query($mysqli, $get_topics_sql) or die(mysqli_error($mysqli));

$display_read = "<a href = 'ReadTopicList.php'><button id = 'read' class = 'styledButton'>Read Saved Topics</button></a>";
$display_save = "";
if (mysqli_num_rows($get_topics_res) >= 1) {
	$display_save = "<a href = 'SaveTopicList.php'><button id = 'save' class = 'styledButton'>Save Topics</button></a>";
}

if (mysqli_num_rows($get_topics_res) < 1) {
	//there are no topics, so say so
	$display_block = "<p><em>No topics exist.</em></p>";
} else {
	//create the display string
    $display_block = <<<END_OF_TEXT
    <table style=" border-collapse: collapse; width:100%">
    <tr>
    <th>Topic Title</th>
	<th class = 'num_posts_col'>Posts</th>
	<th class = 'num_posts_col'>Likes</th>
	<th class = 'num_posts_col'>Edit/Delete</th>
    </tr>
END_OF_TEXT;

	while ($topic_info = mysqli_fetch_array($get_topics_res)) {
		$topic_id = $topic_info['TopicId'];
		$topic_title = stripslashes($topic_info['Title']);
		$topic_create_time = $topic_info['fmt_topic_create_time'];
		$topic_owner = stripslashes($topic_info['Owner']);
		$topic_likes = $topic_info['Likes'];
		$topic_hot = $topic_info['Hot'];

		//get number of posts
		$get_num_posts_sql = "SELECT COUNT(PostId) AS post_count FROM posts WHERE TopicId = '".$topic_id."'";
		$get_num_posts_res = mysqli_query($mysqli, $get_num_posts_sql) or die(mysqli_error($mysqli));

		while ($posts_info = mysqli_fetch_array($get_num_posts_res)) {
			$num_posts = $posts_info['post_count'];
		}

		if($topic_likes >= 10){
			$topic_hot = 1;
		}
		else{
			$topic_hot = 0;
		}

		if($topic_hot == 1){
			//add to display
			$display_block .= <<<END_OF_TEXT
			<tr>
			<td><a href="showtopic.php?topic_id=$topic_id"><strong>$topic_title</strong></a> <i class = "fa fa-check-circle" id = "check"></i><br/>
			Created on <label> $topic_create_time </label> <br> <i id = "userLogo" class = "fa fa-user"></i> <u> $topic_owner </u></td>
			<td class="num_posts_col">$num_posts</td><td class="num_posts_col" style = 'min-width: 90px;'><a id = "like" href = "handleLikes.php?topic_id=$topic_id"><i class = "fa fa-heart-o"></i></a> $topic_likes</td>
END_OF_TEXT;
			if($topic_owner == stripslashes($_SESSION["user"])){
				$display_block .= '<td class="num_posts_col">  <a id = "edit" href = "handleEditTopic.php?topic_id='.$topic_id.'"><i class = "fa fa-edit"></i></a> <a id = "delete" href = "handleDeleteTopic.php?topic_id='.$topic_id.'"><i class = "fa fa-trash"></i></a></td>';				
			}
			else{
				$display_block .= '<td class = "num_posts_col">Not <br> Available</td>';
			}

			$display_block .= "</tr>";
		}
		else{
			//add to display
			$display_block .= <<<END_OF_TEXT
			<tr>
			<td><a href="showtopic.php?topic_id=$topic_id"><strong>$topic_title</strong></a><br/>
			Created on <label> $topic_create_time </label> <br> <i id = "userLogo" class = "fa fa-user"></i> <u> $topic_owner </u></td>
			<td class="num_posts_col">$num_posts</td><td class="num_posts_col" style = 'min-width: 90px;'><a id = "like" href = "handleLikes.php?topic_id=$topic_id"><i class = "fa fa-heart-o"></i></a> $topic_likes</td>
END_OF_TEXT;
			if($topic_owner == stripslashes($_SESSION["user"])){
				$display_block .= '<td class="num_posts_col">  <a id = "edit" href = "handleEditTopic.php?topic_id='.$topic_id.'"><i class = "fa fa-edit"></i></a> <a id = "delete" href = "handleDeleteTopic.php?topic_id='.$topic_id.'"><i class = "fa fa-trash"></i></a></td>';				
			}
			else{
				$display_block .= '<td class = "num_posts_col">Not <br> Available</td>';
			}

			$display_block .= "</tr>";
		}
		
	}
	//free results
	mysqli_free_result($get_topics_res);
	mysqli_free_result($get_num_posts_res);

	//close connection to MySQL
	mysqli_close($mysqli);

	//close up the table
	$display_block .= "</table>";
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Topics in My Forum</title>
<meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="initial-scale=1, maximum-scale=1">
      <title>Home Page</title>
      <link rel="stylesheet" href="css/bootstrap.min.css">
      <link rel="stylesheet" href="css/topics.css">
	  <link rel="stylesheet" href="css/menu.css">
      <link rel="stylesheet" href="css/responsive.css">
      <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
      <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
	table {
		border: 3px solid black;
		border-collapse: collapse;
		width:100%;
		font-size:20px;
	}
	th {
		border: 3px solid black;
		padding: 6px;
		font-weight: bold;
	}
	td {
		border: 3px solid black;
		padding: 6px;
		vertical-align: top;
	}

		.num_posts_col { text-align: center; }
		#logOut{
		background-color: #4286f4;
		color: white;
		position: fixed;
		top: 50px;
		right: 50px;
		padding: 20px 40px;
		border: 1px solid white;
		border-radius: 20px;
		font-size: 17px;
	}
	#logOut:hover{
		background-color: skyblue;
		color: black;
	}
		.topnav input[type=text] {
    float: right;
    padding: 6px;
    border: none;
    margin-top: 8px;
    margin-right: 16px;
    font-size: 17px;
  }

  .topnav input[type=text] {
    float: none;
    display: block;
    text-align: left;
    width: 70%;
    margin: 0;
    padding: 14px;
  }
  .topnav input[type=text] {
    border: 1px solid #ccc;
  }

  
  .wrap input {
  width: 100%;
  position: relative;
  display: flex;
  width: 100%;
  border: 1px solid #000080;
  padding: 20px;
  height: 20px;
  border-radius: 5px;
  outline: none;
  color: #9DBFAF;
}


.wrap button {
    float:right;
    margin-top:5px;
  width: 100px;
  height: 30px;
  border: 1px solid #000080;
  background: #00B4CC;
  text-align: center;
  color: #fff;
  border-radius:5px;
  cursor: pointer;
  font-size: 15px;
}

.wrap button:hover{
    color: white;
    box-shadow: inset 0 -100px 0 0 #725AC1;
}

.wrap{
  width: 80%;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}


</style>
</head>
<body>
<header>
       <div  class="head_top">
          <div class="header">
             <div class="container-fluid">
                <div class="row">
                   <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col logo_section">
                      <div class="full">
                         <div class="center-desk">
                            <div class="logo">
                               <a href="homepage.php"><img src="css/images/logo.png" alt="#" /></a>
                            </div>
                         </div>
                      </div>
                   </div>
                    <div class="col-xl-5 col-lg-5 col-md-5 col-sm-5">
					<div class="wrap">
					<form action="search.php" method="POST">
				<input type="text" name="search" placeholder="Search">
				<button type="submit" name="submit-search">Search</button>
			</form>
                    </div>
					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
					<a href = "logOut.php"><button id = "logOut">Log Out</button></a>
                    </div>
					</div> 
                </div>
             </div>
			 <section class="banner_main">
             <div class="container">
                <div class="row d_flex">
                   <div class="col">
				   <section id = "filler"> </section>
						<section id = "topics">
							<?php echo $display_block; 
								echo $display_save;
								
							?>
						</section>
					<section id = "filler"> </section>
                   </div>
                </div>
             </div>
          </section>
</div>



</header>
<footer>
      <div class="footer">
         <div class="container">
            <div class="row">
               <div class="col-md-12 ">
                  <div class="cont">
                     <h3> <strong class="multi"> Institute of Information Technology</strong><br>
                        Jahangirnagar University
                     </h3>
                  </div>
               </div>
               <div class="col-md-12">
                  <ul class="social_icon">
                     <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                     <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></i></a></li>
                     <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></i></a></li>
                  </ul>
               </div>
            </div>
         </div>
         <div class="copyright">
            <div class="container">
               <div class="row">
                  <div class="col-md-12">
                     <p>Copyright 2022 All Right Reserved By <a href="https://html.design/"> A D Z </a></p>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </footer>

<script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery-3.0.0.min.js"></script>
</body>
</html>
