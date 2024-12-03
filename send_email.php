<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $car_type = $_POST['car_type'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $special_needs = $_POST['special_needs'];

    // Email details
    $to = "skminer0730@gmail.com";
    $subject = "Car Reservation Request";
    $headers = "From: " . $email . "\r\n";
    $headers .= "Reply-To: " . $email . "\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    // Email message
    $message = "New car reservation request:\n";
    $message .= "Name: $name\n";
    $message .= "Email: $email\n";
    $message .= "Mobile: $mobile\n";
    $message .= "Car Type: $car_type\n";
    $message .= "Start Date: $start_date\n";
    $message .= "End Date: $end_date\n";
    $message .= "Special Needs: $special_needs\n";

    // Send email
    if (mail($to, $subject, $message, $headers)) {
        echo "Thank you for your reservation. Your details have been sent successfully.";
    } else {
        echo "Sorry, there was an error sending your reservation. Please try again.";
    }
}
?>
