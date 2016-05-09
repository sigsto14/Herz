   <?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "herz";
$content = '';

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection

$mysqli = new mysqli("localhost","root","","herz");
$soundID = $_POST['soundID'];


if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


else {
if(isset($_POST['userID'])){
  $userID = $_POST['userID'];
$commentRaw = $_POST['comment'];
$comment = utf8_decode($commentRaw);
  $time = date('Y-m-d H:i:s');

$sql = $sql = "INSERT INTO comments (userID, soundID, comment, created_at)
VALUES ('{$userID}', '{$soundID}', '{$comment}', '{$time}')";
if (mysqli_query($conn, $sql)) {
$commentsQ = <<<END
SELECT comments.comment, comments.created_at, users.profilePicture, users.userID, users.username FROM comments
INNER JOIN users
ON comments.userID = users.userID
WHERE comments.soundID = '{$soundID}'
ORDER BY comments.created_at DESC
END;
$commentsG = $mysqli->query($commentsQ);
if($commentsG->num_rows > 0){
$comment = $commentsG->fetch_object();
$username = utf8_encode($comment->username);
$commentCont = utf8_encode($comment->comment);
$content = '<div class="commentbox">
                <ul>
                  <li class="well">
                    <ul>
                        

                      <li id="well-left" ><img src="' .  $comment->profilePicture . '" width="40px" height="40px" ></li>
                      <li id="well-left"><a href="http://localhost/Herz/public/user/' . $comment->userID . '">' . $username . '</a></li>
                      <li id="well-left-right">' . $comment->created_at . '</li>
                    </ul>
                  </li> 
                  <!--  Komment -->
                  <div class="well2"><p> ' . $commentCont . '</p>
                  </div>
                </ul>
              </div>';
              while($comment = $commentsG->fetch_object()){

             $username = utf8_encode($comment->username);
$commentCont = utf8_encode($comment->comment);
$content .= '<div class="commentbox">
                <ul>
                  <li class="well">
                    <ul>
                        

                      <li id="well-left" ><img src="' .  $comment->profilePicture . '" width="40px" height="40px" ></li>
                      <li id="well-left"><a href="http://localhost/Herz/public/user/' . $comment->userID . '">' . $username . '</a></li>
                      <li id="well-left-right">' . $comment->created_at . '</li>
                    </ul>
                  </li> 
                  <!--  Komment -->
                  <div class="well2"><p> ' . $commentCont . '</p>
                  </div>
                </ul>
              </div>'; 
              }
}
 }
}
else {

$commentsQ = <<<END
SELECT comments.comment, comments.created_at, users.profilePicture, users.userID, users.username FROM comments
INNER JOIN users
ON comments.userID = users.userID
WHERE comments.soundID = '{$soundID}'
ORDER BY comments.created_at DESC
END;
$commentsG = $mysqli->query($commentsQ);
if($commentsG->num_rows > 0){
$comment = $commentsG->fetch_object();
$username = utf8_encode($comment->username);
$commentCont = utf8_encode($comment->comment);
$content = '<div class="commentbox">
                <ul>
                  <li class="well">
                    <ul>
                        

                      <li id="well-left" ><img src="' .  $comment->profilePicture . '" width="40px" height="40px" ></li>
                      <li id="well-left"><a href="http://localhost/Herz/public/user/' . $comment->userID . '">' . $username . '</a></li>
                      <li id="well-left-right">' . $comment->created_at . '</li>
                    </ul>
                  </li> 
                  <!--  Komment -->
                  <div class="well2"><p> ' . $commentCont . '</p>
                  </div>
                </ul>
              </div>';
              while($comment = $commentsG->fetch_object()){

           $username = utf8_encode($comment->username);
$commentCont = utf8_encode($comment->comment);
$content .= '<div class="commentbox">
                <ul>
                  <li class="well">
                    <ul>
                        

                      <li id="well-left" ><img src="' .  $comment->profilePicture . '" width="40px" height="40px" ></li>
                      <li id="well-left"><a href="http://localhost/Herz/public/user/' . $comment->userID . '">' . $username . '</a></li>
                      <li id="well-left-right">' . $comment->created_at . '</li>
                    </ul>
                  </li> 
                  <!--  Komment -->
                  <div class="well2"><p> ' . $commentCont . '</p>
                  </div>
                </ul>
              </div>'; 
              }
            }
}
echo $content;  
      
}

               ?>