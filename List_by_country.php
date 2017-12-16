<html>
    <body>  
      <?php

      $conn = new mysqli('127.0.0.1:3306', 'root', 'gonnya', 'Fifa18') 
      or die ('Cannot connect to db');
      $conn -> set_charset('utf8mb4');
          $result = $conn->query("select NTC, Country_Name from Country");

          echo "<html>";
          echo "<body>";
          echo "<h1>View Players by Nationality</h1>";
          echo "<form action='test.php' method=\"POST\">";
          echo "<select name=\"table\">";
          while ($row = $result->fetch_assoc()) {

                        unset($name);
                        $name = $row['Country_Name'];
                        $id = $row['NTC'];
                        echo '<option value="'.$id.'">'.$name.'</option>';

      }
          echo "</select> </br>";
          echo "<input type=\"submit\" name=\"submit\" value=\"Submit\" />";
          echo "</form>";
          $selected_key = $_POST['table'];
          echo ($selected_key);
          echo "</br>";

          $sql="SELECT * FROM Player WHERE '$selected_key'=NTC";
          $result=mysqli_query($conn, $sql);
          while($row=mysqli_fetch_array($result)) {
            echo $row['Name'];
            echo "</br>";
          }

          echo "</body>";
          echo "</html>";
      ?> 