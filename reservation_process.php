<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Leasing Reservation System</title>
    <style>
        /* Styling for header image */
        .header img {
            width: 100%;
            max-height: 150px; /* Adjust the height to your preference */
            object-fit: cover; /* Optional: ensures the image fills the header without distortion */
        }
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            width: 50%;
            margin: auto;
            background: #fff;
            padding: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }
        h1, h2 {
            color: #333;
        }
        label {
            font-weight: bold;
        }
        input[type="text"], input[type="date"], textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"] {
            background-color: #333;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 4px;
        }
        input[type="submit"]:hover {
            background-color: #555;
        }
    </style>
</head>
<body>
    <header class="header">
        <img src="Header.png" alt="Header Image">
    </header>
    <div class="container">
        <h1>Car Leasing Reservation System</h1>
        <form action="car_reservation_system.php" method="POST">
            <h2>Choose a car type:</h2>
            <input type="radio" id="small_car" name="car_type" value="Small Car" required>
            <label for="small_car">Small Car</label><br>
            <input type="radio" id="minivan" name="car_type" value="Minivan" required>
            <label for="minivan">Minivan</label><br><br>

            <label for="start_date">Start Date:</label>
            <input type="date" id="start_date" name="start_date" required><br>

            <label for="end_date">End Date:</label>
            <input type="date" id="end_date" name="end_date" required><br>

            <label for="special_needs">Special Requests or Needs:</label>
            <textarea id="special_needs" name="special_needs"></textarea><br><br>

            <input type="submit" value="Submit Reservation">
        </form>
    </div>
</body>
</html>

<?php

class CarReservationSystem {
    private $carType;
    private $reservations = array();

    public function selectCar() {
        if (isset($_POST['car_type'])) {
            $this->carType = $_POST['car_type'];
        } else {
            echo "Car type is not selected. Please go back and choose a car type.";
            exit();
        }
    }

    public function makeReservation() {
        if ($this->carType == null) {
            echo "Please select a car type first.";
            return;
        }

        $startDate = $_POST['start_date'];
        $endDate = $_POST['end_date'];
        $specialNeeds = $_POST['special_needs'];

        $startDateObj = date_create_from_format('Y-m-d', $startDate);
        $endDateObj = date_create_from_format('Y-m-d', $endDate);

        if (!$startDateObj || !$endDateObj) {
            echo "Invalid date format. Please enter the date in YYYY-MM-DD format.";
            return;
        }

        if ($startDateObj >= $endDateObj) {
            echo "End date must be after the start date. Please go back and try again.";
            return;
        }

        $reservation = array(
            'car_type' => $this->carType,
            'start_date' => $startDate,
            'end_date' => $endDate,
            'special_needs' => $specialNeeds
        );

        array_push($this->reservations, $reservation);
        echo "<h1>Reservation successfully made!</h1>";
        echo "<p>Car Type: " . htmlspecialchars($this->carType) . "</p>";
        echo "<p>Start Date: " . htmlspecialchars($startDate) . "</p>";
        echo "<p>End Date: " . htmlspecialchars($endDate) . "</p>";
        if (!empty($specialNeeds)) {
            echo "<p>Special Needs: " . htmlspecialchars($specialNeeds) . "</p>";
        }
    }

    public function run() {
        $this->selectCar();
        $this->makeReservation();
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $reservationSystem = new CarReservationSystem();
    $reservationSystem->run();
} else {
    echo "Invalid request method.";
}
?>
