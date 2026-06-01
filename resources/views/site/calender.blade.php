<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ __('site.availability_calendar') }}</title>
  <style>
    body {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }

    #calendar {
      width: 500px;
      height: 500px;
      border: 1px solid #ccc;
      text-align: center;
    }

    #calendar-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 10px;
      border-bottom: 1px solid #ccc;
    }

    #calendar-body {
      padding: 10px;
    }

    table {
      width: 100%;
    }

    table th,
    table td {
      padding: 5px;
    }

    .available {
      background-color: lightgreen;
    }

    .unavailable {
      background-color: lightcoral;
    }
  </style>
</head>
<body>

<div id="calendar">
  <div id="calendar-header">
    <button id="prev-month">{{ __('site.prev') }}</button>
    <h2 id="month-year">{{ __('site.month_year') }}</h2>
    <button id="next-month">{{ __('site.next') }}</button>
  </div>
  <div id="calendar-body"></div>
</div>

<script>
  // Data from the database
  const availabilityData = {!! $tour->available !!};
  console.log(availabilityData);
  // Get elements
  const calendarHeader = document.getElementById('calendar-header');
  const monthYearDisplay = document.getElementById('month-year');
  const calendarBody = document.getElementById('calendar-body');
  const prevMonthBtn = document.getElementById('prev-month');
  const nextMonthBtn = document.getElementById('next-month');

  let currentDate = new Date();
  let currentMonth = currentDate.getMonth() + 1;
  let currentYear = currentDate.getFullYear();

// Update calendar
function updateCalendar(month, year) {
  const currentDate = new Date();
  const currentDay = currentDate.getDate();
  const currentMonth = currentDate.getMonth() + 1; // Month is zero-based
  const currentYear = currentDate.getFullYear();

  const daysInMonth = new Date(year, month, 0).getDate();
  const daysAvailability = availabilityData.Days;
  const availableMonths = Object.keys(availabilityData.Month);
  const availableWeekDays = Object.keys(availabilityData.Week);
  const availableYears = Object.keys(availabilityData.Year);

  // Check if the current year is in the available years array
  if (!availableYears.includes(year.toString())) {
    // If the year is not available, mark all days as unavailable
    let calendarHTML = `<table>`;
    calendarHTML += `<tr><th>{{ __('site.sun') }}</th><th>{{ __('site.mon') }}</th><th>{{ __('site.tue') }}</th><th>{{ __('site.wed') }}</th><th>{{ __('site.thu') }}</th><th>{{ __('site.fri') }}</th><th>{{ __('site.sat') }}</th></tr>`;
    for (let i = 1; i <= daysInMonth; i++) {
      calendarHTML += `<tr>`;
      for (let j = 0; j < 7; j++) {
        const currentDayOfWeek = new Date(year, month - 1, i).getDay(); // 0 is Sunday, 6 is Saturday
        if (!availableWeekDays.includes(getDayName(currentDayOfWeek))) {
          calendarHTML += `<td class="unavailable">${i}</td>`;
        } else {
          calendarHTML += `<td class="unavailable">${i}</td>`;
        }
        i++;
        if (i > daysInMonth) break;
      }
      calendarHTML += `</tr>`;
    }
    calendarHTML += `</table>`;
    calendarBody.innerHTML = calendarHTML;
    monthYearDisplay.textContent = `${getMonthName(month)} ${year}`;
    return;
  }

  // Check if the current month is in the available months array
  if (!availableMonths.includes(getMonthName(month))) {
    // If the month is not available, mark all days as unavailable
    let calendarHTML = `<table>`;
    calendarHTML += `<tr><th>{{ __('site.sun') }}</th><th>{{ __('site.mon') }}</th><th>{{ __('site.tue') }}</th><th>{{ __('site.wed') }}</th><th>{{ __('site.thu') }}</th><th>{{ __('site.fri') }}</th><th>{{ __('site.sat') }}</th></tr>`;
    for (let i = 1; i <= daysInMonth; i++) {
      calendarHTML += `<tr>`;
      for (let j = 0; j < 7; j++) {
        const currentDayOfWeek = new Date(year, month - 1, i).getDay(); // 0 is Sunday, 6 is Saturday
        if (!availableWeekDays.includes(getDayName(currentDayOfWeek))) {
          calendarHTML += `<td class="unavailable">${i}</td>`;
        } else {
          calendarHTML += `<td class="unavailable">${i}</td>`;
        }
        i++;
        if (i > daysInMonth) break;
      }
      calendarHTML += `</tr>`;
    }
    calendarHTML += `</table>`;
    calendarBody.innerHTML = calendarHTML;
    monthYearDisplay.textContent = `${getMonthName(month)} ${year}`;
    return;
  }

  // If the month is available, generate the calendar normally
  let calendarHTML = `<table>`;
  calendarHTML += `<tr><th>{{ __('site.sun') }}</th><th>{{ __('site.mon') }}</th><th>{{ __('site.tue') }}</th><th>{{ __('site.wed') }}</th><th>{{ __('site.thu') }}</th><th>{{ __('site.fri') }}</th><th>{{ __('site.sat') }}</th></tr>`;
  let dayCounter = 1;
  for (let i = 0; i < 6; i++) {
    calendarHTML += `<tr>`;
    for (let j = 0; j < 7; j++) {
      if (dayCounter > daysInMonth) break;
      const currentDayOfWeek = new Date(year, month - 1, dayCounter).getDay(); // 0 is Sunday, 6 is Saturday
      const dayAvailability = daysAvailability[dayCounter.toString()];
      const availableClass = dayAvailability === 'on' && availableWeekDays.includes(getDayName(currentDayOfWeek)) ? 'available' : 'unavailable';
      // Check if the date is before the current date
      if ((year < currentYear) || (year === currentYear && month < currentMonth) || (year === currentYear && month === currentMonth && dayCounter < currentDay)) {
        calendarHTML += `<td class="unavailable">${dayCounter}</td>`;
      } else {
        calendarHTML += `<td class="${availableClass}">${dayCounter}</td>`;
      }
      dayCounter++;
    }
    calendarHTML += `</tr>`;
    if (dayCounter > daysInMonth) break;
  }
  calendarHTML += `</table>`;
  calendarBody.innerHTML = calendarHTML;
  monthYearDisplay.textContent = `${getMonthName(month)} ${year}`;
}


// Helper function to get day name
function getDayName(day) {
  const days = ['{{ __('site.sunday') }}', '{{ __('site.monday') }}', '{{ __('site.tuesday') }}', '{{ __('site.wednesday') }}', '{{ __('site.thursday') }}', '{{ __('site.friday') }}', '{{ __('site.saturday') }}'];
  return days[day];
}


  // Helper function to get month name
  function getMonthName(month) {
    const months = ['{{ __('site.january') }}', '{{ __('site.february') }}', '{{ __('site.march') }}', '{{ __('site.april') }}', '{{ __('site.may') }}', '{{ __('site.june') }}', '{{ __('site.july') }}', '{{ __('site.august') }}', '{{ __('site.september') }}', '{{ __('site.october') }}', '{{ __('site.november') }}', '{{ __('site.december') }}'];
    return months[month - 1];
  }

  // Event listeners for next and previous month buttons
  prevMonthBtn.addEventListener('click', () => {
    currentMonth--;
    if (currentMonth === 0) {
      currentMonth = 12;
      currentYear--;
    }
    updateCalendar(currentMonth, currentYear);
  });

  nextMonthBtn.addEventListener('click', () => {
    currentMonth++;
    if (currentMonth === 13) {
      currentMonth = 1;
      currentYear++;
    }
    updateCalendar(currentMonth, currentYear);
  });

  // Initial calendar render
  updateCalendar(currentMonth, currentYear);
</script>

</body>
</html>
