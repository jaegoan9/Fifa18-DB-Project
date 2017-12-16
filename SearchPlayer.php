<html>
    <body>  
      <?php

      $conn = new mysqli('127.0.0.1:3306', 'root', 'gonnya', 'Fifa18') 
      or die ('Cannot connect to db');
      $conn -> set_charset('utf8mb4');
          $result = $conn->query("SELECT Player_id, Name FROM Player");

          echo "<html>";
          echo "<body>";
          echo "<h1>Show Player Stats</h1>";
          echo "<form action='SearchPlayer.php' method=\"POST\">";
          echo "<select name=\"table\">";
          echo "<option value=\"$value\">$value</option>";
          while ($row = $result->fetch_assoc()) {

                        unset($name);
                        $name = $row['Name'];
                        $id = $row['Player_id'];
                        echo '<option value="'.$id.'">'.$name.'</option>';

      }
          echo "</select> </br>";
          echo "<input type=\"submit\" name=\"submit\" value=\"Submit\" />";
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

          #Steps for obtaining Player's Midfield stats
          $sql="SELECT  CAM, CDM, CM, LAM, LCM, LDM, LM, RAM, RCM, RDM, RM  FROM Midfield WHERE '$selected_key'=Player_id";
          $result=mysqli_query($conn, $sql);
          echo "<table bgcolor=\"#FFFF00\" border=\"1px solid black\">";
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
          echo "</body>";
          echo "</html>";
      ?> 