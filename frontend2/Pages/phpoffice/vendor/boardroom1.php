<form method="post" action="boardroom2.php">
    <label for="user_name">Name:</label>
    <input type="text" name="user_name" required><br>

    <label for="date">Date:</label>
    <input type="date" name="date" required><br>

    <label for="start_time">Start Time:</label>
    <select name="start_time" id="start_time" required></select><br>

    <label for="end_time">End Time:</label>
    <select name="end_time" id="end_time" required></select><br>

    <input type="submit" value="Book">
</form>
<script>
    const startTimeSelect = document.getElementById('start_time');
    const endTimeSelect = document.getElementById('end_time');

    for (let i = 8; i <= 17; i++) {
        const startOption = document.createElement('option');
        startOption.value = i + ':00';
        startOption.textContent = i + ':00';
        startTimeSelect.appendChild(startOption);

        const endOption = document.createElement('option');
        endOption.value = (i + 1) + ':00';
        endOption.textContent = (i + 1) + ':00';
        endTimeSelect.appendChild(endOption);
    }
</script>