@extends('app')

@section('content')
<div class="onepcssgrid-1200">
    <div class="onerow">
        <div class="col12">
            <section id="sqlqueries">
              <!-- Sql laravel php -->
                <!-- One Value -->
                <h1>SQL Query Magic</h1>
                <h2>Laravel Queries</h2>
                <h3>One Value</h3>
                <?php
                   echo "<table><tr><td>".$oneValue."</td></tr></table>"; 
                ?>

                <!-- One Row -->
                <h3>One Row - Selected 7 Columns</h3>
                <div class="scrollit"> 
               <table class="fluid_table">
                  <tr>
                  @foreach(array_keys($firstRow[0]) as $column_name)
                      <th><strong>{{ $column_name = str_replace('_', ' ', $column_name) }}</strong></th>
                  @endforeach
                  </tr>

                @foreach($firstRow as $firstRow)
                <tr>                
                   @foreach ($firstRow as $value)
                <td>{{ $value }}</td>
                @endforeach
              </tr>
                @endforeach
              </table>
            </div>

              <!-- One Column - foreach php native way -->
              <h3>One Column - First 20, Ascending Order</h3>             
              <?php
              echo "<table>";
              echo "<tr><th><strong>Countries</strong></th></tr>";
              foreach($firstColumn as $firstColumn) {
               echo "<tr><td>".$firstColumn->Name."</td></tr>";
             }
             echo "</table>";
             ?>

                <!-- Multiple Rows -->
                <h3>Multiple Rows - Selected 7 Columns</h3>   
                <div class="scrollit">            
                <table class="fluid_table">
                  <tr>
                  @foreach(array_keys($multipleRows[0]) as $column_name)
                      <th><strong>{{ $column_name = str_replace('_', ' ', $column_name) }}</strong></th>
                  @endforeach
                  </tr>

                @foreach($multipleRows as $multipleRows)
                    <tr>
                    @foreach($multipleRows as $value)

                        <td>{{ $value }}</td>

                    @endforeach
                    </tr>
                @endforeach


                </table>
                </div>
                <!-- Aggregates - php native way -->
                <h3>Aggregates - Average Life Expectancy in Europe (2 decimal places)</h3>

                <?php
                   echo "<table>";
                   echo "<tr><th><strong>Average Life Expectancy in Europe</strong></th></tr>";
                   echo "<tr><td>";
                   echo $aggregatesDecimal;
                   echo "</td></tr>";
                   echo "</table>"
                ?>

                <!-- GroupBy -->
                <h3>Group By number of countries in each Region per Continent, Descending</h3>
                <table class="table table-striped table-bordered">

                  <tr>
                  @foreach(array_keys($groupBy[0]) as $column_name)
                      <th><strong>{{ $column_name = str_replace('_', ' ', $column_name) }}</strong></th>
                  @endforeach
                  </tr>

                @foreach($groupBy as $groupBy)
                <tr>
                   @foreach ($groupBy as $value)
                <td>{{ $value }}</td>
                @endforeach
              </tr>
                @endforeach
                </table>

                <!-- Join Tables -->
                <h3>Join 2 Tables - Country and Official Languages in Europe </h3>
                <table class="table table-striped table-bordered">
                  <tr>                  
                      <th><strong>Country</strong></th>
                      <th><strong>Official Language(s)</strong></th>
                  </tr>

                @foreach($joinTable as $joinTable)
                <tr>                
                   @foreach ($joinTable as $value)
                <td>{{ $value }}</td>
                @endforeach
              </tr>
                @endforeach
              </table>

              <!-- Random List on refresh -->
              <h3>Random List order on refresh</h3>

              <?php
              echo "<table>";
              foreach(array_keys($randomOrder[0]) as $column_name) {
                echo "<tr><th><strong>";
                echo $column_name;
                echo "</tr></th></strong>";
              }

              foreach($randomOrder as $randomOrder)
              {
                foreach ($randomOrder as $value)
                  echo "<tr><td>";
                  echo $value;
                  echo "</td></tr>";
              }
              echo "</table>";
              ?>

              <!-- Sql native php -->
              <?php
              // Needs to be in this Order
              $servername = "name";
              $username = "username";
              $password = "password";
              $dbname = "dbname";

              // Create connection - Only once
              $conn = new mysqli($servername, $username, $password, $dbname);
              $conn->set_charset("utf8"); // Change to Utf8

              // Check connection
              if ($conn->connect_error) {
                  die("Connection failed: " . $conn->connect_error);
              }
              // echo "Connected successfully";

              echo "<h2>Native PHP Queries</h2>";

              // One Value
              $sql = "SELECT name FROM Country WHERE name = 'United Kingdom' LIMIT 1";
              $result = $conn->query($sql);

              echo "<h3>One Value</h3>";
              // If no results found e.g Where name = 'Fake Country' will return "No results found"
              if ($result->num_rows > 0) {
                $row = $result->fetch_array();
                echo "<table><tr><td>".$row['name']."</td></tr></table>";
              } else {
                echo "No results found";
              }

              // One Row
              $sql = "SELECT Code, Name AS Country, Continent, Region, SurfaceArea AS Surface_Area, Population, LifeExpectancy AS Life_Expectancy FROM Country WHERE name = 'United Kingdom' LIMIT 1";
              $result = $conn->query($sql);

              echo "<h3>One Row - Selected 7 Columns</h3>";
              echo "<div class='scrollit'>";
              echo "<table class='fluid_table'>";

              // Fetches Column Field Names
              $column_name = $result->fetch_fields();
              echo "<tr>";
              foreach ($column_name as $val) {
                echo "<th><strong>".$val->name = str_replace('_', ' ', $val->name)."</strong></th>"; // Gets all field values
              }
              echo "</tr>";

              while($row = $result->fetch_assoc()) {
                echo "<tr><td>".$row["Code"]."</td>";
                echo "<td>".$row["Country"]."</td>";
                echo "<td>".$row["Continent"]."</td>";
                echo "<td>".$row["Region"]."</td>";
                echo "<td>".$row["Surface_Area"]."</td>";
                echo "<td>".$row["Population"]."</td>";
                echo "<td>".$row["Life_Expectancy"]."</td></tr>";
              }
              echo "</table>";
              echo "</div>";

              // One Column
              $sql = "SELECT name FROM Country ORDER BY name ASC LIMIT 20";
              $result = $conn->query($sql);

              echo "<h3>One Column - First 20, Ascending Order</h3>";
              echo "<tr><th><strong>Countries</strong></th></tr>";
              echo "<table>";

                // fetch_assoc - returns string field name as array
              while($row = $result->fetch_assoc()) {
                echo "<tr><td>".$row["name"]."</td></tr>";
              }
              echo "</table>";

              // Multiple Rows
              $sql = "SELECT Code, Name AS Country, Continent, Region, SurfaceArea AS Surface_Area, Population, LifeExpectancy AS Life_Expectancy FROM Country WHERE name = 'United Kingdom' OR name = 'Netherlands' OR name = 'Spain' ORDER BY Code ASC Limit 3";
              $result = $conn->query($sql);

              echo "<h3>Multiple Rows - Selected 7 Columns</h3>";
              echo "<div class='scrollit'>";
              echo "<table class='fluid_table'>";

              // Fetches Column Field Names
              $column_name = $result->fetch_fields();
              echo "<tr>";
              foreach ($column_name as $val) {
                echo "<th><strong>".$val->name = str_replace('_', ' ', $val->name)."</strong></th>"; // Gets all field values
              }
              echo "</tr>";

              // For each Way instead of - echo "<tr><td>".$row["Code"]."</td>";
              while($row = $result->fetch_assoc()) {
                $c = 0; // Our counter
                $n = 7; // Each Nth iteration would be a new table row
                    foreach($row as $field) {
                        if($c % $n == 0) // If $c is divisible by $n...
                            {
                              // New table row after every nth
                              echo '</tr><tr>';
                            }
                         $c++;
                      echo '<td>'.$field.'</td>';
                    }
              }
              echo "</table>";
              echo "</div>";

            // Aggregates
             $sql = "SELECT AVG(LifeExpectancy) AS Life_Expectancy FROM Country WHERE Continent = 'Europe' Limit 1";
             $result = $conn->query($sql);

             echo "<h3>Average Life Expectancy in Europe (2 decimal places)</h3>";
             echo "<table>";
             echo "<tr><th><strong>Average Life Expectancy in Europe</strong></th></tr>";
             echo "<tr><td>";
             while($row = $result->fetch_array()) {
                  echo $rowDecimal = number_format((float)$row['Life_Expectancy'], 2, '.', '');
             }
             echo "</td></tr>";
             echo "</table>";

              // Group By
             $sql = "SELECT Continent, Region, COUNT(*) AS Total_Countries FROM Country GROUP BY Continent, Region ORDER BY Total_Countries DESC ";
             $result = $conn->query($sql);

             echo "<h3>Group By number of countries in each Region per Continent, Descending</h3>";
             echo "<table>";
             // Fetches Column Field Names
              $column_name = $result->fetch_fields();
              echo "<tr>";
              foreach ($column_name as $val) {
                echo "<th><strong>".$val->name = str_replace('_', ' ', $val->name)."</strong></th>"; // Gets all field values
              }
              echo "</tr>";

              while($row = $result->fetch_assoc()) {
                echo "<tr><td>".$row["Continent"]."</td>";
                echo "<td>".$row["Region"]."</td>";
                echo "<td>".$row["Total_Countries"]."</td></tr>";
              }
              echo "</table>";

              // Join Tables
             $sql = "SELECT country.Name AS Country, GROUP_CONCAT(Language ORDER BY Language ASC) AS Official_Language FROM Country INNER JOIN countrylanguage ON country.Code = countrylanguage.CountryCode WHERE country.Continent = 'Europe' AND countrylanguage.IsOfficial = 'T' GROUP BY Name ORDER BY Name ASC ";
             $result = $conn->query($sql);

             echo "<h3>Join 2 Tables - Country and Official Languages in Europe</h3>";
             echo "<table>";
             echo "<tr><th><strong>Country</strong></th>";
             echo "<th><strong>Official Language(s)</strong></th></tr>";

              while($row = $result->fetch_assoc()) {
                echo "<tr><td>".$row["Country"]."</td>";
                echo "<td>".$row["Official_Language"]."</td></tr>";
              }
              echo "</table>";

             // Random List
             $sql = "SELECT name as Country From Country WHERE name Like 'C%' ORDER BY RAND()";
             $result = $conn->query($sql);

             echo "<h3>Random List on refresh (beginning with 'C')</h3>";
              echo "<table>";
              // Fetches Column Field Names
              $column_name = $result->fetch_fields();
              echo "<tr>";
              foreach ($column_name as $val) {
                echo "<th><strong>".$val->name = str_replace('_', ' ', $val->name)."</strong></th>"; // Gets all field values
              }
              echo "</tr>";
               while($row = $result->fetch_assoc()) {
                echo "<tr><td>".$row["Country"]."</td></tr>";
              }
              echo "</table>";
           
              $conn->close();
              ?>

            </section>
        </div>
    </div> <!-- Row Closing -->
</div> <!-- 1200 Closing -->
@endsection