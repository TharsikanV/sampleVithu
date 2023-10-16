 <?php
// include "class/Database.php";
// include "class/Helper.php";
// session_start();
// $email=$_SESSION['email'];
// $h=new Helper;

// $result1=$h->getUserFromDB($email);
// $userName=$result1['profile_name'];

// echo strtoupper($userName);
// echo "'s Add Friend Page <br>";


// $user_id=$result1['friend_id'];


// $friendsIDList=$h->getFriendsIDFromDB($user_id);

// $totalFrnds=0;

// echo "<table border=2>";
// foreach ($friendsIDList as $friendsID) {
//     $result2 = $h->getFriendsNameFromDB($friendsID['friend_id2']);
//     $friendsName = $result2['profile_name'];
//     $totalFrnds++;
//     echo "<tr>";
//     echo "<td>";
//     echo $friendsName;
//     echo "</td>";
//     echo "<td>";
//     echo "<form class='unfriend-form' method='post'>";
//     echo "<input type='hidden' name='friend_id' value='" . $friendsID['friend_id2'] . "'>";
//     echo "<input type='submit' value='Unfriend' name='unfriend'>";
//     echo "</form>";
//     echo "</td>";
//     echo "</tr>";
// }
// echo "</table>";

// echo "<div class='total-friends'>Total number of friends is {$totalFrnds}</div>" . "<br>";

// if (isset($_POST['unfriend'])) {
//     $friendIdToDelete = $_POST['friend_id'];
//     $h->unFriend($user_id, $friendIdToDelete);
//     $totalFrnds--; // Update the total number of friends
// }
        
include "class/Database.php";
include "class/Helper.php";
session_start();
$email = $_SESSION['email'];
$h = new Helper;

$result1 = $h->getUserFromDB($email);
$userName = $result1['profile_name'];

echo strtoupper($userName);
echo "'s Add Friend Page <br>";


$user_id = $result1['friend_id'];

$friendsIDList = $h->getFriendsIDFromDB($user_id);

// Determine how many friends are displayed per page
$friendsPerPage = 5;

// Determine the current page
if (isset($_GET['page'])) {
    $currentPage = $_GET['page'];
} else {
    $currentPage = 1;
}

// Calculate the offset for fetching friends from the list
$offset = ($currentPage - 1) * $friendsPerPage;

// Fetch a subset of friends based on the current page
$friendsSubset = array_slice($friendsIDList, $offset, $friendsPerPage);

$totalFrnds = count($friendsIDList);
echo "Total number of friends is {$totalFrnds}" . "<br> <br>";

echo "<table border=2>";
foreach ($friendsSubset as $friendsID) {
    $result2 = $h->getFriendsNameFromDB($friendsID['friend_id2']);
    $friendsName = $result2['profile_name'];
    echo "<tr>";
    echo "<td>";
    echo $friendsName;
    echo "</td>";
    echo "<td>";
    echo "<form class='unfriend-form' method='post'>";
    echo "<input type='hidden' name='friend_id' value='" . $friendsID['friend_id2'] . "'>";
    echo "<input type='submit' value='Unfriend' name='unfriend'>";
    echo "</form>";
    echo "</td>";
    echo "</tr>";
}
echo "</table>";



// Calculate the number of pages based on friends per page
$totalPages = ceil($totalFrnds / $friendsPerPage);

// Display previous and next links
if ($totalPages > 1) {
    echo "Page {$currentPage} of {$totalPages}<br>";
    if ($currentPage > 1) {
        echo "<a href='?page=" . ($currentPage - 1) . "'>Previous</a>";
    }
    if ($currentPage < $totalPages) {
        echo " | <a href='?page=" . ($currentPage + 1) . "'>Next</a>";
    }
}

if (isset($_POST['unfriend'])) {
    $friendIdToDelete = $_POST['friend_id'];
    $h->unFriend($user_id, $friendIdToDelete);
    // Redirect back to the same page after unfriending
    header("Location: {$_SERVER['PHP_SELF']}");
    exit;
}
?>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $(".unfriend-form").submit(function(event) {
        event.preventDefault(); // Prevent the default form submission

        var form = $(this);
        var friendIdToDelete = form.find("input[name='friend_id']").val();

        $.post("", { unfriend: true, friend_id: friendIdToDelete }, function(data) {
            // Update the UI to reflect the unfriending action (e.g., remove the friend from the table)
            form.closest("tr").remove();

            var totalFriendsElement = $(".total-friends");
            var currentTotalFriends = parseInt(totalFriendsElement.text().match(/\d+/));
            totalFriendsElement.text("Total number of friends is " + (currentTotalFriends - 1));
        });
    });
});
</script> 