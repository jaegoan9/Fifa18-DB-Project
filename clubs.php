<!DOCTYPE html>
<html>
<head>
    <style>
    * {box-sizing: border-box}

    /* Set height of body and the document to 100% */
    body, html {
        height: 100%;
        margin: 0;
	font-family: Arial;
	background-color: #337AFF;
    }

    /* Style tab links */
    .tablink {
        background-color: #3142B9;
        color: white;
        float: left;
        border: none;
        outline: none;
        cursor: pointer;
        padding: 14px 16px;
	font-size: 20px;
	font-family: Arial Black;
        width: 25%;
    }

    .tablink:hover {
        background-color: #777;
    }

    /* Style the tab content (and add height:100% for full page content) */
    .tabcontent {
        color: white;
        display: none;
        padding: 80px 20px;
    }

    #Home {background-color: #337AFF;}
    #News {background-color: #337AFF;}
    #Contact {background-color: #337AFF;}
    #About {background-color: #337AFF;}
    </style>
</head>

<body>

<button class="tablink" onclick="openPage('Home', this, 'red')">List by Country</button>
<button class="tablink" onclick="openPage('News', this, 'green')">Search Player</button>
<button class="tablink" onclick="openPage('Contact', this, 'blue')"id="defaultOpen">List by Clubs</button>
<button class="tablink" onclick="openPage('About', this, 'orange')">Player Attribute</button>

<div id="Home" class="tabcontent">
      <?php
      $conn = new mysqli('dbase.cs.jhu.edu', 'ykim160', 'zbjeaciuma', 'cs41517_ykim160_db') 
      or die ('Cannot connect to db');
      $conn -> set_charset('utf8');
          $result = $conn->query("select NTC, Country_Name from Country");

          echo "<!DOCTYPE html>";
	  echo "<html>";
          echo "<head>";
	  echo "<style>";
          echo '* {
                  box-sizing: border-box;
                }

                #myInput {
                  background-position: 10px 12px;
		  background-repeat: no-repeat;
                  width: 100%;
                  font-size: 16px;
                  padding: 12px 20px 12px 30px;
		  border: 1px solid #ddd;
                  margin-top: 40px;
                  margin-bottom: 12px;
                }

                #myUL {
                  list-style-type: none;
                  padding: 0;
                  margin: 0;
                }

                #myUL li a {
                  border: 1px solid #ddd;
                  margin-top: -1px; /* Prevent double borders */
                  background-color: #f6f6f6;
                  padding: 12px;
                  text-decoration: none;
                  font-size: 18px;
                  color: black;
                  display: block
                }

                #myUL li a:hover:not(.header) {
                  background-color: #eee;
		}

                label {
                    padding: 12px 12px 12px 15px;
		    display: inline-block;
                    color: #FF5733;
		    font-size: 20px;
                    font-family: Verdana;
		}

                .container {
                    border-radius: 5px;
                    background-color: #f2f2f2;
                    padding: 20px;
		}

                .col-25 {
                    float: left;
                    width: 25%;
                    margin-top: 6px;
                }

                .col-75 {
                    float: left;
                    width: 75%;
                    margin-top: 6px;
		}

                .row:after {
                    content: "";
                    display: table;
                    clear: both;
		}

		input[type=submit]:hover {
                    background-color: #45a049;
                }

                input[type=submit] {
                    background-color: #4CAF50;
                    color: white;
                    padding: 12px 20px;
                    border: none;
                    border-radius: 4px;
                    cursor: pointer;
		    float: right;
                    margin-top: 30px;
		}

                input[type=text], select, textarea{
                    width: 100%;
                    padding: 12px;
                    border: 1px solid #ccc;
                    border-radius: 4px;
                    box-sizing: border-box;
                    resize: vertical;
		}

		caption {
                    margin-top: 25px;
                }';

	  echo "</style>";
          echo "</head>";
	  echo "<body>";
          echo "<h1>View Players by Nationality</h1>";
	  echo '<div class="container">';
	  echo "<form action='fifa.php' method=\"POST\">";
          echo '<div class="row">
                <div class="col-25">
                  <label for="country">Country</label>
                </div>
                <div class="col-75">';
	  echo "<select name=\"table\">";
          echo "<option value=\"$value\">$value</option>";
	  while ($row = $result->fetch_assoc()) {
                        unset($name);
                        $name = $row['Country_Name'];
                        $id = $row['NTC'];
                        echo '<option value="'.$id.'">'.$name.'</option>';
          }
          echo "</select>";
	  echo '</div>';
	  echo '</div>';
	  echo '<div class="row">';
	  echo "<input type=\"submit\" name=\"submit\" value=\"Submit\" />";
	  echo '</div>';
          echo "</form>";
	  $selected_key = $_POST['table'];
//          echo '<label for="ntc">'.$selected_key.'</label>'; 
          echo "</div>";

          $sql="SELECT * FROM Player WHERE '$selected_key'=NTC";
	  $result=mysqli_query($conn, $sql);

          echo '<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names..." title="Type in a name">';


	  echo '<ul id="myUL">';
	  while($row=mysqli_fetch_array($result)) {
              $tmp = $row['Name'];
              echo '<li><a href="#">'.$tmp.'</a></li>';
	  }
  
	  echo '</ul>';

          echo "<script>";
          echo 'function myFunction() {
		    var input, filter, ul, li, a, i;
                    input = document.getElementById("myInput");
                    filter = input.value.toUpperCase();
                    ul = document.getElementById("myUL");
                    li = ul.getElementsByTagName("li");
                    for (i = 0; i < li.length; i++) {
                        a = li[i].getElementsByTagName("a")[0];
                        if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
                            li[i].style.display = "";
                        } else {
                            li[i].style.display = "none";
                        } 
                    }
		}';		  
          echo "</script>";
//          echo "</div>";		  
          echo "</body>";
	  echo "</html>";
      ?> 
</div>

<div id="News" class="tabcontent">
      <?php

      $conn = new mysqli('dbase.cs.jhu.edu', 'ykim160', 'zbjeaciuma', 'cs41517_ykim160_db')
      or die ('Cannot connect to db');
      $conn -> set_charset('utf8');
          $result = $conn->query("SELECT Player_id, Name FROM Player");

          echo "<html>";
          echo "<body>";
	  echo "<h1>Show Player Stats</h1>";
	  echo '<div class="container">';
          echo "<form action='stats.php' method=\"POST\">";
          echo '<div class="row">
                <div class="col-25">
                  <label for="player">Player</label>
                </div>
                <div class="col-75">';
	  echo "<select name=\"table\">";
          echo "<option value=\"$value\">$value</option>";
          while ($row = $result->fetch_assoc()) {
                        unset($name);
                        $name = $row['Name'];
                        $id = $row['Player_id'];
                        echo '<option value="'.$id.'">'.$name.'</option>';
          }
//          echo "</select> </br>";
          echo "</select>";
//	  echo '<div class="row">';
//	  echo "<input type=\"submit\" name=\"submit\" value=\"Submit\" />";
//	  echo '</div>';

	  echo "<input type=\"submit\" name=\"submit\" value=\"Submit\" />";
	  echo '</div>';
	  echo '</div>';
	  echo '</div>';
	  echo "</form>";
          $selected_key = $_POST['table'];


          #Steps for obtaining Player's attack stats
          $sql="SELECT CF, LF, LS, LW, RF, RS, RW, ST FROM Attack WHERE '$selected_key'=Player_id";
          $result=mysqli_query($conn, $sql);
          echo "<table bgcolor=\"#00FF00\" border=\"1px solid black\">";
          echo "<caption>Player Attack Stats</caption>";
          echo "<tr><td>CF</td><td>LF</td><td>LS</td><td>LW</td><td>RF</td><td>RS</td><td>RW</td><td>ST</td></tr>\n";
          while($row=mysqli_fetch_array($result)) {
            $CF = $row["CF"];
            $LF = $row["LF"];
            $LS = $row["LS"];
            $LW = $row["LW"];
            $RF = $row["RF"];
            $RS = $row["RS"];
            $RW = $row["RW"];
            $ST = $row["ST"];
            printf("<tr><td>%d</td><td>%d</td><td>%d</td><td>%d</td><td>%d</td><td>%d</td><td>%d</td><td>%d</td></tr><br>", $CF, $LF, $LS, $LW, $RF,$RS, $RW, $ST);
	  }
	  echo "</table>";
	  
          #Steps for obtaining Player's Defense stats
          $sql="SELECT CB, LB, LCB, LWB, RB, RCB, RWB FROM Defense WHERE '$selected_key'=Player_id";
          $result=mysqli_query($conn, $sql);
          echo "<table bgcolor=\"#FF0000\" border=\"1px solid black\">";
          echo "<caption>Player Defense Stats</caption>";
          echo "<tr><td>CB</td><td>LB</td><td>LCB</td><td>LWB</td><td>RB</td><td>RCB</td><td>RWB</td></tr>\n";
          while($row=mysqli_fetch_array($result)) {
            $CB = $row["CB"];
            $LB = $row["LB"];
            $LCB = $row["LCB"];
            $LWB = $row["LWB"];
            $RB = $row["RB"];
            $RCB = $row["RCB"];
            $RWB = $row["RWB"];
            printf("<tr><td>%d</td><td>%d</td><td>%d</td><td>%d</td><td>%d</td><td>%d</td><td>%d</td></tr><br>", $CB, $LB, $LCB, $LWB, $RB,$RCB, $RWB);
	  }
          echo "</table>";

          #Steps for obtaining Player's Midfield stats
          $sql="SELECT  CAM, CDM, CM, LAM, LCM, LDM, LM, RAM, RCM, RDM, RM  FROM Midfield WHERE '$selected_key'=Player_id";
          $result=mysqli_query($conn, $sql);
          echo "<table bgcolor=\"CC6600\" border=\"1px solid black\">";
          echo "<caption>Player Midfield Stats</caption>";
          echo "<tr><td>CAM</td><td>CDM</td><td>CM</td><td>LAM</td><td>LCM</td><td>LDM</td><td>LM</td><td>RAM</td><td>RCM</td><td>RDM</td><td>RM</td></tr>\n";
          while($row=mysqli_fetch_array($result)) {
            $CAM = $row["CAM"];
            $CDM = $row["CDM"];
            $CM = $row["CM"];
            $LAM = $row["LAM"];
            $LCM = $row["LCM"];
            $LDM = $row["LDM"];
            $LM = $row["LM"];
            $RAM = $row["RAM"];
            $RCM = $row["RCM"];
            $RDM = $row["RDM"];
            $RM = $row["RM"];
            printf("<tr><td>%d</td><td>%d</td><td>%d</td><td>%d</td><td>%d</td><td>%d</td><td>%d</td><td>%d</td><td>%d</td><td>%d</td><td>%d</td></tr><br>", $CAM, $CDM, $CM, $LAM, $LCM, $LDM, $LM, $RAM, $RCM, $RDM, $RM);
	  }
	  echo "</table>";
	  echo "</body>";
          echo "</html>";
      ?> 
</div>

<div id="Contact" class="tabcontent">
      <?php

      $conn = new mysqli('dbase.cs.jhu.edu', 'ykim160', 'zbjeaciuma', 'cs41517_ykim160_db') 
      or die ('Cannot connect to db');
      $conn -> set_charset('utf8');
          $result = $conn->query("select Club_id, Club_Name from Club");

          echo "<!DOCTYPE html>";
          echo "<html>";
          echo "<body>";
          echo "<h1>View Players by Clubs</h1>";
	  echo '<div class="container">';
          echo "<form action='clubs.php' method=\"POST\">";
          echo '<div class="row">
                <div class="col-25">
                  <label for="club">Club</label>
                </div>
                <div class="col-75">';
	  echo "<select name=\"table\">";
          while ($row = $result->fetch_assoc()) {
                        unset($name);
                        $name = $row['Club_Name'];
                        $id = $row['Club_id'];
                        echo '<option value="'.$id.'">'.$name.'</option>';
          }
          echo "</select>";
	  echo "<input type=\"submit\" name=\"submit\" value=\"Submit\" />";
	  echo '</div>';
	  echo '</div>';
	  $selected_key = $_POST['table'];
          $namesql="SELECT Club_Name FROM Club WHERE Club_id = '$selected_key'";
	  $nameresult=mysqli_query($conn, $namesql);
	  $namerow=mysqli_fetch_array($nameresult);
	  if ($namerow['Club_Name'] == "") {
              echo '<label for="name">Have No Team</label>';
	  }
	  echo '<label for="name">'.$namerow['Club_Name'].'</label>';
 	  echo '</div>';
	  echo "</form>";

	  $sql="SELECT Player.Name FROM Player, Plays_in, Club WHERE Player.Player_id=Plays_in.Player_id 
		  AND Plays_in.Club_id=Club.Club_id AND '$selected_key'=Club.Club_id";
	  $result=mysqli_query($conn, $sql);
	  echo '<ul id="myUL">';
	  while($row=mysqli_fetch_array($result)) {
              $tmp = $row['Name'];
              echo '<li><a href="#">'.$tmp.'</a></li>';
	  }

          echo "</body>";
          echo "</html>";

      ?> 

</div>

<div id="About" class="tabcontent">
      <?php

      $conn = new mysqli('dbase.cs.jhu.edu', 'ykim160', 'zbjeaciuma', 'cs41517_ykim160_db') 
      or die ('Cannot connect to db');
      $conn -> set_charset('utf8');
          $result = $conn->query("SELECT Player_id, Name FROM Player");

          echo "<!DOCTYPE html>";
          echo "<html>";
          echo "<body>";
          echo "<h1>Show Player Attributes</h1>";
	  echo '<div class="container">';
          echo "<form action='attribute.php' method=\"POST\">";
          echo '<div class="row">
                <div class="col-25">
                  <label for="player">Player</label>
                </div>
                <div class="col-75">';
	  echo "<select name=\"table\">";
          echo "<option value=\"$value\">$value</option>";
          while ($row = $result->fetch_assoc()) {
                        unset($name);
                        $name = $row['Name'];
                        $id = $row['Player_id'];
                        echo '<option value="'.$id.'">'.$name.'</option>';
          }
          echo "</select>";
	  echo "<input type=\"submit\" name=\"submit\" value=\"Submit\" />";
	  echo '</div>';
	  echo '</div>';
	  $selected_key = $_POST['table'];
          $namesql="SELECT Name FROM Player WHERE Player_id = '$selected_key'";
	  $nameresult=mysqli_query($conn, $namesql);
	  $namerow=mysqli_fetch_array($nameresult);
	  echo '<label for="name">'.$namerow['Name'].'</label>';
	  echo '</div>';
	  echo "</form>";

	  $sql="SELECT Acceleration, Aggression, Agility, 
		  Balance, Ball_control,
                  Composure, Crossing, Curve
                  Dribbling,
                  Finishing, Free_kick_accuracy,
                  GK_diving, GK_handling, GK_kicking, GK_positioning, GK_reflexes,
		  Heading_accuracy, Interceptions, Jumping, Long_passing,
                  Long_shots, Marking, Penalties, Positioning, Reactions,
                  Short_passing, Shot_power, Sliding_tackle, Sprint_speed,
                  Stamina, Standing_tackle, Strength, Vision, Volleys
                  FROM Attributes WHERE '$selected_key'=ID";
	  $result=mysqli_query($conn, $sql);

	  echo "<table bgcolor=\"#C70039\" border=\"1px solid black\">";
          echo "<caption>Player Attributes</caption>";
          echo "<tr>";
	  echo "<td>Acceleration</td>";
          echo "<td>Aggression</td>";
	  echo "<td>Agility</td>";
	  echo "<td>Balance</td>";
	  echo "<td>Ball_control</td>";
	  echo "<td>Composure</td>";
	  echo "<td>Crossing</td>";
	  echo "<td>Curve</td>";
	  echo "<td>Dribbling</td>";
	  echo "<td>Finishing</td>";
	  echo "<td>Free_kick_accuracy</td>";
	  echo "<td>GK_diving</td>";
	  echo "<td>Gk_handling</td>";
	  echo "<td>Gk_kicking</td>";
	  echo "<td>GK_positioning</td>";
	  echo "<td>GK_reflexes</td>";
	  echo "<td>Heading_accuracy</td>";

	  echo "</tr>\n";

	  while($row=mysqli_fetch_array($result)) {
              echo "<tr>";
	      printf("<td>%d</td>", $row["Acceleration"]);
	      printf("<td>%d</td>", $row["Aggression"]);
	      printf("<td>%d</td>", $row["Agility"]);
	      printf("<td>%d</td>", $row["Balance"]);
	      printf("<td>%d</td>", $row["Ball_control"]);
	      printf("<td>%d</td>", $row["Composure"]);
	      printf("<td>%d</td>", $row["Crossing"]);
	      printf("<td>%d</td>", $row["Curve"]);
	      printf("<td>%d</td>", $row["Dribbling"]);
	      printf("<td>%d</td>", $row["Finishing"]);
	      printf("<td>%d</td>", $row["Free_kick_accuracy"]);
	      printf("<td>%d</td>", $row["GK_diving"]);
	      printf("<td>%d</td>", $row["GK_handling"]);
	      printf("<td>%d</td>", $row["GK_kicking"]);
	      printf("<td>%d</td>", $row["GK_positioning"]);
	      printf("<td>%d</td>", $row["GK_reflexes"]);
	      printf("<td>%d</td>", $row["Heading_accuracy"]);
	      echo "</tr>\n";
	  }

	  $result=mysqli_query($conn, $sql);
	  echo "</table>\n";
          echo "<table bgcolor=\"#C70039\" border=\"1px solid black\">";
	  echo "<tr>";
	  echo "<td>Interceptions</td>";
	  echo "<td>Jumping</td>";
	  echo "<td>Long_passing</td>";
	  echo "<td>Long_shots</td>";
	  echo "<td>Marking</td>";
	  echo "<td>Penalties</td>";
	  echo "<td>Poistioning</td>";
	  echo "<td>Reactions</td>";
	  echo "<td>Short_passing</td>";
	  echo "<td>Shot_power</td>";
	  echo "<td>Sliding_tackle</td>";
	  echo "<td>Sprint_speed</td>";
	  echo "<td>Stamina</td>";
	  echo "<td>Standing_tackle</td>";
	  echo "<td>Strength</td>";
	  echo "<td>Vision</td>";
	  echo "<td>Volleys</td>";
	  echo "</tr>\n";

	  while($row=mysqli_fetch_array($result)) {
              echo "<tr>";
	      printf("<td>%d</td>", $row["Interceptions"]);
	      printf("<td>%d</td>", $row["Jumping"]);
	      printf("<td>%d</td>", $row["Long_passing"]);
	      printf("<td>%d</td>", $row["Long_shots"]);
	      printf("<td>%d</td>", $row["Marking"]);
	      printf("<td>%d</td>", $row["Penalties"]);
	      printf("<td>%d</td>", $row["Positioning"]);
	      printf("<td>%d</td>", $row["Reactions"]);
	      printf("<td>%d</td>", $row["Short_passing"]);
	      printf("<td>%d</td>", $row["Shot_power"]);
	      printf("<td>%d</td>", $row["Sliding_tackle"]);
	      printf("<td>%d</td>", $row["Sprint_speed"]);
	      printf("<td>%d</td>", $row["Stamina"]);
	      printf("<td>%d</td>", $row["Standing_tackle"]);
	      printf("<td>%d</td>", $row["Strength"]);
	      printf("<td>%d</td>", $row["Vision"]);
	      printf("<td>%d</td>", $row["Volleys"]);
	      echo "</tr>\n";
	  }
  
	  echo "</table>\n";
          echo "</body>";
          echo "</html>";

      ?> 
</div>

<script>
function openPage(pageName,elmnt,color) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablink");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].style.backgroundColor = "";
    }
    document.getElementById(pageName).style.display = "block";
    elmnt.style.backgroundColor = color;

}
// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();

</script>
</body>
</html>
