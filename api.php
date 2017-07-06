<?php
  include('rest.php');
// Read from JSON File

  $str = file_get_contents('data.json');
  $json = json_decode($str, true);
  // echo '<pre>' . print_r($json, true) . '</pre>';

  //  getListOfRestaurants($json);
  // getRestById(4, $json);
  // getRestByIdDetails(1, $json);




  // GET list of restaurants
  function showListOfRestaurants($json){

  $list = [];
  $nameR = $json["data"][0]["name"];
  // echo $nameR;

  for($i=0; $i<sizeof($json["data"]); $i++){
    $idR = $json["data"][$i]["id"];
    $nameR = $json["data"][$i]["name"];
    $list[$i] = new rest($nameR, $idR);
    echo $idR."  ".$nameR."<br></br>";
  }

  return $list;
}

function getListOfRestaurants($json){

$list = [];
$nameR = $json["data"][0]["name"];
// echo $nameR;

for($i=0; $i<sizeof($json["data"]); $i++){
  $idR = $json["data"][$i]["id"];
  $nameR = $json["data"][$i]["name"];
  $list[$i] = new rest($nameR, $idR);
  // echo $idR."  ".$nameR."<br></br>";
}

return $list;
}

  function getRestById($id, $json){
    $list = getListOfRestaurants($json);
    for($i=0; $i<sizeof($list); $i++){

        if ($list[$i]->id == $id) {
        // echo "Found";
         return true;
       }else if($list[$i]->id != $id && $i == sizeof($list)-1){
         echo "Not Found";
         return false;
       }

    }
  }

// GET Details of any rest by it's id
  function getRestByIdDetails($restid, $json){
    if (getRestById($restid, $json) == true) {
        // echo "Continue";
        $list = getListOfRestaurants($json);
        for ($i=0; $i < sizeof($list); $i++) {
            if ($list[$i]->id == $restid) {
              echo "Details";
              echo "<br></br>";
              echo $list[$i]->id."  ";
              echo $list[$i]->name;
              echo "<br></br>";

            // GET from json file and show if not null
            $currency_symbol = $json["data"][$i]["currency_symbol"];
            if ($currency_symbol != "") {
              echo "Currency_Symbol: ";
              echo $currency_symbol;
              echo "<br></br>";
            }
            $address = $json["data"][$i]["address"];
            if ($address != NULL) {
              echo "Address: ";
              echo print_r($address, true);
              echo "<br></br>";
            }
            $geolocation = $json["data"][$i]["geolocation"];
            if ($geolocation != NULL) {
              echo "Geolocation: ";
              echo "<br></br>";
              echo "Lat: ".$geolocation['latitude'];
              echo "   ";
              echo "Long: ".$geolocation['longitude'];
              echo "<br></br>";
            }
            $photo = $json["data"][$i]["photo"];
            if ($photo != NULL) {
               // Display img
                 echo "<br></br>";
            }
            $minimum_order = $json["data"][$i]["minimum_order"];
            if ($minimum_order != NULL) {
                 echo "Minimum_order: ";
                 echo $minimum_order;
                 echo "<br></br>";
            }
            $price_range = $json["data"][$i]["price_range"];
            if ($price_range != NULL) {
                 echo "Price_range: ";
                 echo $price_range;
                 echo "<br></br>";
            }
            $rating= $json["data"][$i]["rating"];
            if ($rating != NULL) {
                 echo "Rating: ";
                 echo $rating;
                 echo "<br></br>";
            }
            $available_for = $json["data"][$i]["available_for"];
            if ($available_for != NULL) {
              echo "Available_for: ";
              echo "<br></br>";
              if ($available_for['pickup'] == true) {
                echo "Pickup: "."Yes";
              }else if($available_for['pickup'] == false){
                echo "Pickup: "."No";
              }
              echo "   ";
              if ($available_for['delivery'] == true) {
                echo "Delivery: "."Yes";
              }elseif ($available_for['delivery'] == false) {
                echo "Delivery: "."No";
              }
              echo "<br></br>";
            }
            $menu = $json["data"][$i]["menu"];
            if ($menu != NULL) {
              echo "Menu: ";
              echo "<br></br>";
              for($m=0; $m<sizeof($json["data"][$i]["menu"]);  $m++){
                echo "Menu Item Name: ";
                echo $json["data"][$i]["menu"][$m]["name"];
                echo "<br></br>";
                for($it=0; $it<sizeof($json["data"][$i]["menu"][$m]["items"]); $it++){
                  echo "Item id:  ".$json["data"][$i]["menu"][$m]["items"][$it]["id"]. " ";
                  echo "Item name:  ".$json["data"][$i]["menu"][$m]["items"][$it]["name"]." ";
                  echo "Item description:  ".$json["data"][$i]["menu"][$m]["items"][$it]["description"];
                  echo "<br></br>";
                  echo "Additions:   ";
                  for($a=0; $a<sizeof($json["data"][$i]["menu"][$m]["items"][$it]["additions"]); $a++){
                    echo "Name: ".$json["data"][$i]["menu"][$m]["items"][$it]["additions"][$a]["name"]."  ";
                    echo "Price: ".$json["data"][$i]["menu"][$m]["items"][$it]["additions"][$a]["price"]." ".$currency_symbol."  ";
                  }
                  echo "Image: ".$json["data"][$i]["menu"][$m]["items"][$it]["image"]." ";
                  $img = $json["data"][$i]["menu"][$m]["items"][$it]["image"];
                  echo '<img  src="'.$img.'" alt="menu additions image"; width="48px"; height="48px";>';
                  if (is_array($json["data"][$i]["menu"][$m]["items"][$it]["price"])) {
                      echo "Small: ".$json["data"][$i]["menu"][$m]["items"][$it]["price"]["small"]."  ";
                      echo "Large: ".$json["data"][$i]["menu"][$m]["items"][$it]["price"]["large"]."  ";
                  }else {
                   echo "Price: ".$json["data"][$i]["menu"][$m]["items"][$it]["price"]." ";
                  }
                  echo "<br></br>";
                }
              }
            }

            $maintainers = $json["data"][$i]["maintainers"];
            if ($maintainers != NULL) {
              echo "Maintainers: ";
              if ($maintainers != NULL) {
                print_r($maintainers);
                echo "<br></br>";
              }

            }
            $categories = $json["data"][$i]["categories"];
            if ($categories != NULL) {
              echo "Categories:  ";
              if ($categories != NULL) {
                for($c=0; $c<sizeof($json["data"][$i]["categories"]); $c++){
                echo "Id: ".$json["data"][$i]["categories"][$c]["id"]."  ";
                echo "Name: ".$json["data"][$i]["categories"][$c]["name"]."  ";
                echo "Photo: ".$json["data"][$i]["categories"][$c]["photo"];
                echo '<img  src="'.$json["data"][$i]["categories"][$c]["photo"].'" alt="categories image"; width="48px"; height="48px";>';
                echo "<br></br>";
              }
              }

            }
            $opening_hours = $json["data"][$i]["opening_hours"];
            if ($opening_hours != NULL) {
              echo "Opening_hours: ";
              echo "<br></br>";
              if ($opening_hours != NULL) {
                  for($o=0; $o<sizeof($json["data"][$i]["opening_hours"]); $o++){
                      echo "Day: ".$json["data"][$i]["opening_hours"][$o]["day"]."  ";
                      if ($json["data"][$i]["opening_hours"][$o]["closed"]==false) {
                        echo "Closed: "."No"."  ";
                      }else if ($json["data"][$i]["opening_hours"][$o]["closed"]==true) {
                        echo "Closed: "."Yes"."  ";
                    }
                      echo "Open_at: ".$json["data"][$i]["opening_hours"][$o]["open_at"]."  ";
                      echo "Close_at: ".$json["data"][$i]["opening_hours"][$o]["close_at"]." ";
                      echo "<br></br>";
                  }
                      echo "<br></br>";
              }

            }


            }
        }

    }else{
      echo "Restaurant not in json file!";
    }
  }



 ?>
