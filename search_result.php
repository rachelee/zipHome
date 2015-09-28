
<?php
    
    $search_type = $_GET["search_type"];
    $text = $_GET["text_input"];
    $price_from = $_GET["price_from"];
    $price_to = $_GET["price_to"];
    $bedroom = $_GET["bedroom"];
    $bathroom = $_GET["bathroom"];
    $pet = $_GET["pet"];
    $parking = $_GET["parking"];
    $smoking = $_GET["smoking"];
    $payment = $_GET["payment"];
    /*
    echo $search_type;
    echo $text;
    echo $price_from;
    echo $price_to;
    echo $bedroom;
    echo $bathroom;
    echo $pet;
    echo $parking;
    echo $smoking;
    echo $payment;
    */
    $query = "SELECT PROPERTY.Property_id, PROPERTY.Bedrooms, PROPERTY.Bathrooms, PROPERTY.Price, PROPERTY.State, PROPERTY.City, PROPERTY.Street, PROPERTY.Number,
               PROPERTY.Apt_no, PROPERTY.Zipcode FROM PROPERTY ";
    
    /*seach type and text*/
    if ($search_type == "City")
    {
      
      if ($smoking != "" OR $payment !="")
      {
        echo "<h3>NOTE: Smoking policy and payment type is only available when the property is in a specific community. Otherwise contact the landlord for more details.</h3>";
        $query = $query."LEFT OUTER JOIN COMMUNITY ON COMMUNITY.C_id=PROPERTY.Community_id WHERE ";
      }
      else
      {
        $query = $query. "WHERE ";
      }
      /*text from the input*/
      $query = $query."PROPERTY.City LIKE"."'%".$text."%'";
      
      /*smoking policy and payment type*/
      if ($smoking != "")
      {
          $query = $query." AND COMMUNITY.Smoke_policy='".$smoking."'". " OR (COMMUNITY.Smoke_policy IS NULL)";
      }
      if ($payment != "")
      {
          $query = $query." AND COMMUNITY.Payment='".$payment."'". " OR (COMMUNITY.Payment IS NULL)" ;
      }
      
      
    }
    elseif ($search_type == "Community")
    {

      $query = $query."JOIN COMMUNITY ON PROPERTY.Community_id=COMMUNITY.C_id WHERE ";
      
      /*text from the input*/
      
      $query = $query."COMMUNITY.Name LIKE"."'%".$text."%'";
      
      /*smoking and parking*/
      if ($smoking != "")
      {
        $query = $query." AND COMMUNITY.Smoke_policy='".$smoking."'"." ";
      }
      if ($payment != "")
      {
        $query = $query." AND COMMUNITY.Payment='".$payment."'"." ";
      }
    }
    elseif($search_type == "Company")
    {
      if ($smoking != "" OR $payment != "")
      {
        echo "<h3>NOTE: Smoking policy and payment type is only available when the property is in a specific community. Otherwise contact the landlord for more details.</h3>";
        $query = $query."JOIN MANAGEMENT_COMPANY ON PROPERTY.Company_id=MANAGEMENT_COMPANY.Registered_id LEFT OUTER JOIN COMMUNITY ON MANAGEMENT_COMPANY.Registered_id=COMMUNITY.Company_id WHERE ";
      }
      else
      {
        $query = $query."JOIN MANAGEMENT_COMPANY ON PROPERTY.Company_id=MANAGEMENT_COMPANY.Registered_id WHERE ";
      }
      $query = $query."MANAGEMENT_COMPANY.Name LIKE"."'%".$text."%'";
      
      /*smoking policy and payment type*/
      if ($smoking != "")
      {
          $query = $query." AND COMMUNITY.Smoke_policy='".$smoking."'". " OR (COMMUNITY.Smoke_policy IS NULL)";
      }
      if ($payment != "")
      {
          $query = $query." AND COMMUNITY.Payment='".$payment."'". " OR (COMMUNITY.Payment IS NULL)" ;
      }
      
    }
    else
    {
      exit("<h3>NOTE: No search type was chosen! Please choose from search by city, search by community or search by company.</h3>");
    }
    
    /*price*/
    if (!($price_from == "" AND $price_to == ""))
    {
      if ($price_from == "" AND $price_to != "")
      {
        $query = $query." AND PROPERTY.Price<=".$price_to;
      }
      elseif ($price_from != "" AND $price_to == "")
      {
        $query = $query." AND PROPERTY.Price>=".$price_from;
      }
      else 
      {
        $query = $query." AND PROPERTY.Price>=".$price_from." AND PROPERTY.Price<=".$price_to;
      }
    }
    
    /*bedrooms*/
    if ($bedroom != "")
    {
      if($bedroom == "3 and more")
      {
        $query = $query." AND PROPERTY.Bedrooms>=3";
      }
      else if ($bedroom == "1 bedroom")
      {
        $query = $query." AND PROPERTY.Bedrooms=1";
      }
      else
      {
        $query = $query." AND PROPERTY.Bedrooms=2";
      }
    }
    
    /*bathrooms*/
    if ($bathroom != "")
    {
      if($bathroom == "3 and more")
      {
        $query = $query." AND PROPERTY.Bathrooms>=3";
      }
      else if ($bathroom == "1 bathroom")
      {
        $query = $query." AND PROPERTY.Bathrooms=1";
      }
      else
      {
        $query = $query." AND PROPERTY.Bathrooms=2";
      }
    }
    
    /*pet*/
    if ($pet != "")
    {
      $query  = $query." AND PROPERTY.Pet_policy='".$pet."'";
    }
    
    /*parking*/
    if($parking != "")
    {
      $query = $query." AND PROPERTY.Parking='".$parking."'";
    }
    
    //echo $query;

    /*use query to get data from database*/
    require_once("./database.php");
    $db = new Db();
    $results = $db -> select($query);
    if ($results == false)
    {
      echo "<h3>No property that matches the requirements was found. Please modify your requirement.</h3>";
    }
    else
    {
      $count = 1;
      echo "<h2>Search Results</h2>";
      foreach ($results as $item)
      {
  
          echo "<div class = 'search_result'>";
          echo "<h3>"."<a href='".getenv('HTTP_HOST')."/zipHome/property_detail.php?property_id=".$item['Property_id']."'>"."Property ".$count."</a></h3>";
          echo "<p>".$item['Bedrooms']." Bedroom(s) ".$item['Bathrooms']." Bathroom(s) </p>";
          echo "<p> Price: $".$item['Price']."</p>";
          echo "<p> Address: ". $item['Number']. " ".$item['Street'].", ".$item['Apt_no']."<p>";
          echo "<p>".$item['City'].", ".$item['State'].", ".$item['Zipcode']."."."</p>";
          echo "</div>";
          $count++;
          
      }
    }
    
    
    

    
?>
    

