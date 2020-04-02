<?php
/*
 * Template Name: Page - Home
 * description: >-
  Hom Page template
 */

function enqueue_fullcalendar() {
    wp_enqueue_style ( 'fullcalendar-main-style', get_stylesheet_directory_uri() . '/lib/fullcalendar-4.3.1/packages/core/main.css' );
    wp_enqueue_style ( 'fullcalendar-daygrid-style', get_stylesheet_directory_uri() . '/lib/fullcalendar-4.3.1/packages/daygrid/main.css' );
    wp_enqueue_style ( 'fullcalendar-timegrid-style', get_stylesheet_directory_uri() . '/lib/fullcalendar-4.3.1/packages/timegrid/main.css' );
    wp_enqueue_style ( 'fullcalendar-list-style', get_stylesheet_directory_uri() . '/lib/fullcalendar-4.3.1/packages/list/main.css' );

    wp_enqueue_script ( 'fullcalendar-main-script', get_stylesheet_directory_uri() . '/lib/fullcalendar-4.3.1/packages/core/main.js' );
    wp_enqueue_script ( 'fullcalendar-interaction-script', get_stylesheet_directory_uri() . '/lib/fullcalendar-4.3.1/packages/interaction/main.js' );
    wp_enqueue_script ( 'fullcalendar-daygrid-script', get_stylesheet_directory_uri() . '/lib/fullcalendar-4.3.1/packages/daygrid/main.js' );
    wp_enqueue_script ( 'fullcalendar-timegrid-script', get_stylesheet_directory_uri() . '/lib/fullcalendar-4.3.1/packages/timegrid/main.js' );
    wp_enqueue_script ( 'fullcalendar-list-script', get_stylesheet_directory_uri() . '/lib/fullcalendar-4.3.1/packages/list/main.js' );
}

add_action( 'wp_enqueue_scripts', 'enqueue_fullcalendar' );

get_header(); ?>

<div>
    <div id='calendar'></div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
      plugins: [ 'interaction', 'dayGrid' ],
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,dayGridDay'
      },
      defaultDate: '2020-02-12',
      navLinks: true, // can click day/week names to navigate views
      editable: true,
      eventLimit: true, // allow "more" link when too many events
      events: [
        {
          title: 'All Day Event',
          start: '2020-02-01'
        },
        {
          title: 'Long Event',
          start: '2020-02-07',
          end: '2020-02-10'
        },
        {
          groupId: 999,
          title: 'Repeating Event',
          start: '2020-02-09T16:00:00'
        },
        {
          groupId: 999,
          title: 'Repeating Event',
          start: '2020-02-16T16:00:00'
        },
        {
          title: 'Conference',
          start: '2020-02-11',
          end: '2020-02-13'
        },
        {
          title: 'Meeting',
          start: '2020-02-12T10:30:00',
          end: '2020-02-12T12:30:00'
        },
        {
          title: 'Lunch',
          start: '2020-02-12T12:00:00'
        },
        {
          title: 'Meeting',
          start: '2020-02-12T14:30:00'
        },
        {
          title: 'Happy Hour',
          start: '2020-02-12T17:30:00'
        },
        {
          title: 'Dinner',
          start: '2020-02-12T20:00:00'
        },
        {
          title: 'Birthday Party',
          start: '2020-02-13T07:00:00'
        },
        {
          title: 'Click for Google',
          url: 'http://google.com/',
          start: '2020-02-28'
        }
      ]
    });

    calendar.render();
  });

</script>
</script>

<?php get_footer(); ?>