<!DOCTYPE html>
<html>
<head>
    <title>Apply Filters</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<?php
require_once "config.php";

$result = '';
if(isset($_POST['submit'])) {
    $employee_name = filter_var(($_POST['employee_name']), FILTER_SANITIZE_STRING);
    $event_name = filter_var($_POST['event_name'], FILTER_SANITIZE_STRING);
    $event_date = filter_var($_POST['event_date'], FILTER_SANITIZE_STRING);

    $sql = "SELECT * from participations WHERE employee_name LIKE '$employee_name'
                                OR event_name LIKE '$event_name' OR event_date = '$event_date'";

    $result = mysqli_query($conn, $sql);
    $totalRows = mysqli_num_rows($result);
}
?>


<div class="container">

    <h2>Filter Results</h2>

    <form action="view.php" method="post">

        <div class="row">
            <label>Employee name</label>
            <div class="col-md-3">
                <input type="text" class="form-control" placeholder="John" name="employee_name" value="<?php if (isset($employee_name)) echo $employee_name; ?>" >
            </div>
            <label>Event name</label>
            <div class="col-md-3">
                <input type="text" class="form-control" placeholder="XYZ" name="event_name" value="<?php if (isset($event_name)) echo $event_name; ?>">
            </div>
            <label>Date</label>
            <div class="col-md-3">
                <input type="date" class="form-control" placeholder="Event Date" name="event_date" value="<?php if (isset($event_date)) echo $event_date; ?>">
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
            </div>

        </div>

</form>

<?php

if($result) {
if($totalRows > 0)
{
    ?>
<br>
    <table class="table table-striped">
        <tr>
            <th>Participation ID</th>
            <th>Employee name</th>
            <th>Employee mail</th>
            <th>Event ID</th>
            <th>Event name</th>
            <th>Participation fee</th>
            <th>Event date</th>
        </tr>

        <?php
        $totalPrice = 0;
        while($row = mysqli_fetch_array($result))
        {
            $totalPrice = $totalPrice + $row['participation_fee'];
            ?>

            <tr>
                <td> <?php echo $row['participation_id']; ?> </td>
                <td> <?php echo $row['employee_name']; ?> </td>
                <td> <?php echo $row['employee_mail']; ?> </td>
                <td> <?php echo $row['event_id']; ?> </td>
                <td> <?php echo $row['event_name']; ?> </td>
                <td> <?php echo $row['participation_fee']; ?> </td>
                <td> <?php echo $row['event_date']; ?> </td>

            </tr>


            <?php
        }
         "<tr>";
        echo "<td colspan='7'>".  'Total Participation Price = '.$totalPrice; "</td>";
        "</tr>";
        }

        else
        {
            echo 'No records found!';
        }
        }
else
{
    echo mysqli_error($conn);
}

        ?>
    </table>
</div>
</body>
</html>