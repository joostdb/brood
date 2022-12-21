<!-- Include the jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<h1>Calendar</h1>

<!-- Display the current date and time -->
<p>Current date: <span id="current_date"><?= $currentDateTime->format('Y-m-d') ?></span></p>

<!-- Display the current time -->
<p>Current time: <?= $currentDateTime->format('H:i:s') ?></p>

<!-- Create a form for selecting time slots -->
<form>
    <fieldset>
        <legend>Time slots</legend>
        <?php foreach ($timeSlots as $timeSlot): ?>
            <label>
                <input type="checkbox" name="time_slots[]" value="<?= $timeSlot ?>">
                <?= $timeSlot ?>
            </label><br>
        <?php endforeach; ?>
    </fieldset>
</form>

<!-- Create buttons for navigating through the days in the calendar -->
<button id="previous_day">Previous day</button>
<button id="next_day">Next day</button>

<!-- Include a script to handle the navigation buttons -->
<script>
    // When the document is ready
    $(document).ready(function() {
        // Handle the click event for the previous day button
        $('#previous_day').click(function() {
            // Send an AJAX request to the server to retrieve the previous day's time slots
            $.ajax({
                type: 'POST',
                url: '/calendar/gettimeslots',
                data: {
                    direction: 'previous'
                },
                success: function(response) {
                    // Update the current date in the view
                    $('#current_date').text(response.currentDate);

                    // Update the time slots in the form
                    $('input[name="time_slots[]"]').each(function(index) {
                        $(this).val(response.timeSlots[index]);
                    });
                }
            });
        });

        // Handle the click event for the next day button
        $('#next_day').click(function() {
            // Send an AJAX request to the server to retrieve the next day's time slots
            $.ajax({
                type: 'POST',
                url: '/calendar/gettimeslots',
                data: {
                    direction: 'next'
                },
                success: function(timeSlots) {
                    // Update the time slots in the form
                    $('input[name="time_slots[]"]').each(function(index) {
                        $(this).val(timeSlots[index]);
                    });
                }
            });
        });
    });
</script>
