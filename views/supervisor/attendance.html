<div class="container mt-4">
  <h3>View Attendance of Interns</h3>

  <div class="mb-3">
      <label for="attendanceDate" class="form-label">Select Date</label>
      <input type="date" class="form-control" id="attendanceDate">
  </div>

  <button class="btn btn-primary mb-3" id="loadAttendanceBtn">Load Attendance</button>

  <table class="table table-bordered">
      <thead class="table-light">
          <tr>
              <th>#</th>
              <th>Intern Name</th>
              <th>Email</th>
              <th>Date</th>
              <th>Status</th>
              <th>Check-in Time</th>
              <th>Check-out Time</th>
              <th>Comment</th> <!-- New Comment Column -->
          </tr>
      </thead>
      <tbody id="attendanceTableBody">
          <!-- Attendance records will be loaded here -->
      </tbody>
  </table>
</div>

<script>
  $(document).ready(function() {

      // ---------- MOCK DATA ----------
      const mockMode = true; // Toggle this to false for real backend!

      const mockAttendance = [
          {
              name: 'Alice Johnson',
              email: 'alice.johnson@example.com',
              date: '2025-03-01',
              status: 'Present',
              check_in: '07:30 AM',
              check_out: '05:00 PM'
          },
          {
              name: 'Bob Smith',
              email: 'bob.smith@example.com',
              date: '2025-03-01',
              status: 'Absent',
              check_in: '-',
              check_out: '-'
          },
          {
              name: 'Charlie Brown',
              email: 'charlie.brown@example.com',
              date: '2025-03-01',
              status: 'Present',
              check_in: '09:15 AM',
              check_out: '04:30 PM'
          }
      ];

      // ---------------------------------

      function getComment(checkInTime) {
          const onTime = "08:00 AM"; // Standard time for "On Time"

          if (checkInTime === '-') return '-'; // Handle case for missing check-in

          const checkInDate = new Date(`2025-03-01T${checkInTime.split(' ')[0]}`);
          const standardTime = new Date(`2025-03-01T${onTime.split(' ')[0]}`);

          if (checkInDate < standardTime) {
              return 'Early';
          } else if (checkInDate.getTime() === standardTime.getTime()) {
              return 'On Time';
          } else {
              return 'Late';
          }
      }

      function loadAttendance(date = '') {
          $('#attendanceTableBody').html('<tr><td colspan="8">Loading...</td></tr>');

          if (mockMode) {
              // Filter mock data based on the selected date
              const filteredAttendance = date 
                  ? mockAttendance.filter(record => record.date === date) 
                  : mockAttendance;

              if (filteredAttendance.length === 0) {
                  $('#attendanceTableBody').html('<tr><td colspan="8">No attendance records found.</td></tr>');
                  return;
              }

              let rows = '';
              $.each(filteredAttendance, function(index, record) {
                  const comment = getComment(record.check_in);
                  rows += `
                      <tr>
                          <td>${index + 1}</td>
                          <td>${record.name}</td>
                          <td>${record.email}</td>
                          <td>${record.date}</td>
                          <td>${record.status}</td>
                          <td>${record.check_in || '-'}</td>
                          <td>${record.check_out || '-'}</td>
                          <td>${comment}</td> <!-- New Comment Cell -->
                      </tr>
                  `;
              });
              $('#attendanceTableBody').html(rows);
          } else {
              $.ajax({
                  url: '../api/attendance.php',
                  method: 'GET',
                  data: { date: date },
                  dataType: 'json',
                  success: function(records) {
                      if (records.length === 0) {
                          $('#attendanceTableBody').html('<tr><td colspan="8">No attendance records found.</td></tr>');
                          return;
                      }

                      let rows = '';
                      $.each(records, function(index, record) {
                          const comment = getComment(record.check_in);
                          rows += `
                              <tr>
                                  <td>${index + 1}</td>
                                  <td>${record.name}</td>
                                  <td>${record.email}</td>
                                  <td>${record.date}</td>
                                  <td>${record.status}</td>
                                  <td>${record.check_in || '-'}</td>
                                  <td>${record.check_out || '-'}</td>
                                  <td>${comment}</td> <!-- New Comment Cell -->
                              </tr>
                          `;
                      });
                      $('#attendanceTableBody').html(rows);
                  },
                  error: function() {
                      $('#attendanceTableBody').html('<tr><td colspan="8">Error loading attendance data.</td></tr>');
                  }
              });
          }
      }

      // Initial load (load today's attendance or all if date not required)
      loadAttendance();

      // Load attendance by selected date
      $('#loadAttendanceBtn').click(function() {
          const selectedDate = $('#attendanceDate').val();
          loadAttendance(selectedDate);
      });

  });
</script>
