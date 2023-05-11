<script>
    function loadTasks() {
        $.ajax({
            type: "GET",
            url: "{{ route('mentee.tasks.index') }}",
            success: function(data) {
                loadCalendar(data.data)
            },
        })
    }

    function loadCalendar(data) {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            headerToolbar: {
                start: 'title',
                end: 'prev,next'
            },
            initialView: 'dayGridMonth',
            themeSystem: 'bootstrap5',
            events: data
        });
        calendar.render();
    }
</script>
