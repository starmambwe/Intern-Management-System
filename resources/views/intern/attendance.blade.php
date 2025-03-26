<div class="container mt-4">
  <h3>Mark Daily Attendance</h3>

  <form id="attendanceForm" class="mt-4">
      <!-- Select Date -->
      <div class="mb-3">
          <label for="attendanceDate" class="form-label">Select Date</label>
          <input type="date" class="form-control" id="attendanceDate" required>
      </div>

      <!-- Attendance Status (Auto-generated based on login time) -->
      <div class="mb-3">
          <label for="attendanceStatus" class="form-label">Attendance Status</label>
          <input type="text" class="form-control" id="attendanceStatus" disabled required>
      </div>

      <!-- Reason for Absence (if applicable) -->
      <div class="mb-3" id="absenceReasonContainer" style="display: none;">
          <label for="absenceReason" class="form-label">Reason for Absence</label>
          <textarea class="form-control" id="absenceReason" rows="3" placeholder="Please provide a reason if you are absent"></textarea>
      </div>

      <!-- Proof of Absence (File Upload) -->
      <div class="mb-3" id="absenceProofContainer" style="display: none;">
          <label for="absenceProof" class="form-label">Proof of Absence (e.g., Sick Note)</label>
          <input type="file" class="form-control" id="absenceProof" accept=".pdf,.docx,.jpg,.png">
      </div>

      <!-- Submit Button -->
      <button type="submit" class="btn btn-primary">Submit Attendance</button>
  </form>

  <hr>

  <!-- Attendance Records Table -->
  <h4 class="mt-5">Your Attendance Records</h4>
  <table class="table mt-3" id="attendanceRecordsTable">
      <thead>
          <tr>
              <th>Date</th>
              <th>Status</th>
              <th>Reason (If Absent)</th>
              <th>Proof (If Absent)</th>
              <th>Time Difference (Early/Late)</th>
          </tr>
      </thead>
      <tbody>
          <!-- Records will be inserted here dynamically -->
      </tbody>
  </table>

  <!-- Export Buttons -->
  <button id="exportCsv" class="btn btn-success mt-3">Export to CSV</button>
  <button id="exportPdf" class="btn btn-danger mt-3">Export to PDF</button>
</div>

<script>
  $(document).ready(function() {
      let useMockData = true; // Set to 'true' to use mock data or 'false' to use real backend data

      // Function to determine the attendance status based on time
      function determineAttendanceStatus() {
          const workStartTime = '08:00'; // 9:00 AM
          const workEndTime = '17:00'; // 5:00 PM
          const currentTime = new Date();
          const currentTimeString = currentTime.toTimeString().substr(0, 5); // Get HH:MM format

          let status = "Absent"; // Default to absent
          let timeDifference = "N/A"; // Default to no time difference

          // Check if the intern logs in within working hours
          if (currentTimeString < workStartTime) {
              status = "Early"; // Logged in early
              timeDifference = calculateTimeDifference(workStartTime, currentTimeString);
          } else if (currentTimeString >= workStartTime && currentTimeString <= workEndTime) {
              status = "On Time"; // Logged in on time
          } else {
              status = "Late"; // Logged in late
              timeDifference = calculateTimeDifference(workStartTime, currentTimeString);
          }

          // Set the attendance status
          $('#attendanceStatus').val(status);
      }

      // Function to calculate the time difference in hours, minutes, seconds, and milliseconds
      function calculateTimeDifference(expectedTime, actualTime) {
          const workStart = new Date('1970-01-01T' + expectedTime + ':00'); // Create date object with expected time
          const current = new Date('1970-01-01T' + actualTime + ':00'); // Create date object with actual time
          const difference = current - workStart; // Time difference in milliseconds

          if (difference === 0) {
              return "On Time";
          }

          let diffSeconds = Math.abs(difference) / 1000;
          const hours = Math.floor(diffSeconds / 3600);
          diffSeconds %= 3600;
          const minutes = Math.floor(diffSeconds / 60);
          const seconds = Math.floor(diffSeconds % 60);
          const milliseconds = Math.abs(difference) % 1000;

          return `${hours} hrs ${minutes} min ${seconds} sec ${milliseconds} ms`;
      }

      // Automatically determine attendance status on page load
      determineAttendanceStatus();

      // Show reason and proof fields if the intern is absent
      $('#attendanceStatus').on('input', function() {
          const status = $(this).val();
          if (status === 'Absent') {
              $('#absenceReasonContainer').show();
              $('#absenceProofContainer').show();
          } else {
              $('#absenceReasonContainer').hide();
              $('#absenceProofContainer').hide();
          }
      });

      // Handle attendance form submission
      $('#attendanceForm').submit(function(e) {
          e.preventDefault();

          const attendanceData = {
              date: $('#attendanceDate').val(),
              status: $('#attendanceStatus').val(),
              reason: $('#absenceReason').val(), // Reason will be sent only if the status is "Absent"
              proof: $('#absenceProof')[0].files[0] // Send the proof file if available
          };

          // Validate the form data
          if (!attendanceData.date || !attendanceData.status) {
              alert('Please fill in all required fields');
              return;
          }

          // Handle file upload (if applicable)
          const formData = new FormData();
          formData.append('date', attendanceData.date);
          formData.append('status', attendanceData.status);
          formData.append('reason', attendanceData.reason);
          if (attendanceData.proof) {
              formData.append('proof', attendanceData.proof);
          }

          // Submit the attendance data
          $.ajax({
              url: '../api/attendance.php', // Replace with your API endpoint
              method: 'POST',
              data: formData,
              processData: false,
              contentType: false,
              dataType: 'json',
              success: function(response) {
                  if (response.success) {
                      alert('Attendance submitted successfully!');
                      $('#attendanceForm')[0].reset(); // Reset the form after submission
                      loadAttendanceRecords(); // Reload attendance records after submission
                  } else {
                      alert('Error: ' + response.message);
                  }
              },
              error: function() {
                  alert('An error occurred while submitting the attendance.');
              }
          });
      });

      // Mock data
      const mockData = [
          { date: '2025-03-01', status: 'On Time', reason: '', proof: '', timeDifference: 'N/A' },
          { date: '2025-03-02', status: 'Late', reason: 'Traffic', proof: 'proof2.pdf', timeDifference: '1 hr 15 min' },
          { date: '2025-03-03', status: 'Absent', reason: 'Sick', proof: 'proof3.pdf', timeDifference: 'N/A' }
      ];

      // Function to load the attendance records from the server or mock data
      function loadAttendanceRecords() {
          let recordsHtml = '';
          if (useMockData) {
              mockData.forEach(function(record) {
                  recordsHtml += `
                      <tr>
                          <td>${record.date}</td>
                          <td>${record.status}</td>
                          <td>${record.reason || 'N/A'}</td>
                          <td>${record.proof ? `<a href="${record.proof}" target="_blank">View Proof</a>` : 'N/A'}</td>
                          <td>${record.timeDifference}</td>
                      </tr>
                  `;
              });
          } else {
              $.ajax({
                  url: '../api/getAttendanceRecords.php', // Replace with your API endpoint
                  method: 'GET',
                  dataType: 'json',
                  success: function(response) {
                      if (response.success) {
                          response.data.forEach(function(record) {
                              recordsHtml += `
                                  <tr>
                                      <td>${record.date}</td>
                                      <td>${record.status}</td>
                                      <td>${record.reason || 'N/A'}</td>
                                      <td>${record.proof ? `<a href="${record.proof}" target="_blank">View Proof</a>` : 'N/A'}</td>
                                      <td>${record.timeDifference}</td>
                                  </tr>
                              `;
                          });
                      } else {
                          alert('Error: ' + response.message);
                      }
                  },
                  error: function() {
                      alert('An error occurred while fetching attendance records.');
                  }
              });
          }
          $('#attendanceRecordsTable tbody').html(recordsHtml); // Insert records into the table
      }

      // Initial load of attendance records
      loadAttendanceRecords();
  });
</script>
