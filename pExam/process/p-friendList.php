<?php
// include "class/Database.php";
// include "class/Helper.php";

// // include "p-addFriendsPage.php";

// session_start();
// $h=new Helper;
// $userMail=$_SESSION['email'];

// $result1=$h->getUserFromDB($userMail);
// $user_id=$result1['friend_id'];


// $result=$h->getAllMembers($userMail);

// // $allMembersName=$result['profile_name'];

// echo "<table border=2>";
// foreach($result as $name){
//     echo "<tr>";
//     echo "<td>";
//     echo $name['profile_name'] ;
//         echo "</td>";
//         echo "<td>";
//         echo "<form method='post'>";
//         echo "<input type='hidden' name='friend_id' value='" . $name['friend_id'] . "'>";
//         echo "<input type='submit' value='AddFriend' name='addfriend'>";
//         echo "</form>";
//         echo "</td>";
//         echo "</tr>";
// }
// echo "</table>";

// if (isset($_POST['addfriend'])) {
//     $friendIdToDelete = $_POST['friend_id'];
//     $h->avoidDuplicateEntry($user_id, $friendIdToDelete);
// }

include "class/Database.php";
include "class/Helper.php";
session_start();
$h = new Helper;
$userMail = $_SESSION['email'];

$result1 = $h->getUserFromDB($userMail);
$user_id = $result1['friend_id'];

$usersPerPage = 5; // Set the number of users to display per page

$result = $h->getAllMembers($userMail);

// Determine the current page
if (isset($_GET['page'])) {
    $currentPage = $_GET['page'];
} else {
    $currentPage = 1;
}

$totalUsers = count($result);
$totalPages = ceil($totalUsers / $usersPerPage);

// Calculate the offset to fetch a subset of users
$offset = ($currentPage - 1) * $usersPerPage;

// Fetch a subset of users for the current page
$usersSubset = array_slice($result, $offset, $usersPerPage);

echo "<table border=2>";
foreach ($usersSubset as $user) {
    echo "<tr>";
    echo "<td>";
    echo $user['profile_name'];
    echo "</td>";
    echo "<td>";
    echo "<form method='post'>";
    echo "<input type='hidden' name='friend_id' value='" . $user['friend_id'] . "'>";
    echo "<input type='submit' value='Add Friend' name='addfriend'>";
    echo "</form>";
    echo "</td>";
    echo "</tr>";
}
echo "</table>";

if ($totalPages > 1) {
    echo "Page {$currentPage} of {$totalPages}<br>";
    if ($currentPage > 1) {
        echo "<a href='?page=" . ($currentPage - 1) . "'>Previous</a>";
    }
    if ($currentPage < $totalPages) {
        echo " | <a href='?page=" . ($currentPage + 1) . "'>Next</a>";
    }
}

if (isset($_POST['addfriend'])) {
    $friendIdToAdd = $_POST['friend_id'];
    $h->addFriend($user_id, $friendIdToAdd);
}

?>