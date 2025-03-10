<div class="container mt-4">
  <h3>Log Time Spent on Tasks</h3>

  <form id="timeLogForm" class="mt-4">
      <!-- Select Project -->
      <div class="mb-3">
          <label for="projectSelect" class="form-label">Select Project</label>
          <select class="form-select" id="projectSelect" required>
              <option value="">Select Project</option>
              <!-- Options will be loaded dynamically -->
          </select>
      </div>

      <!-- Select Task -->
      <div class="mb-3">
          <label for="taskSelect" class="form-label">Select Task</label>
          <select class="form-select" id="taskSelect" required>
              <option value="">Select Task</option>
              <!-- Options will be loaded dynamically based on the selected project -->
          </select>
      </div>

      <!-- Start Date and Time Selection -->
      <div class="mb-3">
          <label for="startDate" class="form-label">Start Date</label>
          <input type="date" class="form-control" id="startDate" required>
      </div>
      <div class="mb-3">
          <label for="startTime" class="form-label">Start Time</label>
          <input type="time" class="form-control" id="startTime" required>
          <div id="startDateTimeDisplay" class="mt-2 text-muted"></div> <!-- Display start date and time -->
      </div>

      <!-- End Date and Time Selection -->
      <div class="mb-3">
          <label for="endDate" class="form-label">End Date</label>
          <input type="date" class="form-control" id="endDate" required>
      </div>
      <div class="mb-3">
          <label for="endTime" class="form-label">End Time</label>
          <input type="time" class="form-control" id="endTime" required>
          <div id="endDateTimeDisplay" class="mt-2 text-muted"></div> <!-- Display end date and time -->
      </div>

      <!-- Submit Button -->
      <button type="submit" class="btn btn-primary">Submit Time Log</button>
  </form>

  <h4 class="mt-4">Your Time Logs</h4>
  <button id="clearLogsBtn" class="btn btn-danger mb-3">Clear All Logs</button>
  <table class="table table-bordered mt-3" id="timeLogsTable">
      <thead>
          <tr>
              <th>Project</th>
              <th>Task</th>
              <th>Start Date</th>
              <th>Start Time</th>
              <th>End Date</th>
              <th>End Time</th>
              <th>Time Spent</th>
          </tr>
      </thead>
      <tbody>
          <!-- Time logs will be populated here -->
      </tbody>
  </table>
</div>

<script>
  $(document).ready(function() {
      const useMockData = true; // Change this to false for backend data

      // Mock Data for Projects
      const mockProjects = [
          { id: 1, name: 'Project A', hasTasks: true },
          { id: 2, name: 'Project B', hasTasks: true }
      ];

      // Mock Data for Tasks (only for Project A and Project B)
      const mockTasks = {
          1: [
              { id: 1, name: 'Task 1A', hasTimeLogs: true },
              { id: 2, name: 'Task 2A', hasTimeLogs: true }
          ],
          2: [
              { id: 1, name: 'Task 1B', hasTimeLogs: true },
              { id: 2, name: 'Task 2B', hasTimeLogs: true }
          ]
      };

      // Mock Data for Time Logs
      const mockTimeLogs = [
          { projectName: 'Project A', taskName: 'Task 1A', startDate: '2025-03-06', startTime: '09:00', endDate: '2025-03-06', endTime: '11:00', timeSpent: '2h 0m 0s' },
          { projectName: 'Project A', taskName: 'Task 1A', startDate: '2025-03-06', startTime: '11:30', endDate: '2025-03-06', endTime: '13:00', timeSpent: '1h 30m 0s' },
          { projectName: 'Project B', taskName: 'Task 2B', startDate: '2025-03-07', startTime: '14:00', endDate: '2025-03-07', endTime: '16:30', timeSpent: '2h 30m 0s' },
          { projectName: 'Project A', taskName: 'Task 2A', startDate: '2025-03-08', startTime: '10:00', endDate: '2025-03-08', endTime: '12:00', timeSpent: '2h 0m 0s' }
      ];

      // Function to load projects assigned to the intern (either mock or backend)
      function loadProjects() {
          if (useMockData) {
              let options = '<option value="">Select Project</option>';
              mockProjects.forEach(function(project) {
                  if (project.hasTasks) {
                      options += `<option value="${project.id}">${project.name}</option>`;
                  }
              });
              $('#projectSelect').html(options);
          } else {
              $.ajax({
                  url: '../api/getAssignedProjects.php', // Replace with the correct API endpoint
                  method: 'GET',
                  dataType: 'json',
                  success: function(response) {
                      if (response.success) {
                          let options = '<option value="">Select Project</option>';
                          response.projects.forEach(function(project) {
                              options += `<option value="${project.id}">${project.name}</option>`;
                          });
                          $('#projectSelect').html(options);
                      } else {
                          alert('Error loading projects: ' + response.message);
                      }
                  },
                  error: function() {
                      alert('An error occurred while loading projects.');
                  }
              });
          }
      }

      // Function to load tasks for the selected project (either mock or backend)
      function loadTasks(projectId) {
          if (useMockData && mockTasks[projectId]) {
              let options = '<option value="">Select Task</option>';
              mockTasks[projectId].forEach(function(task) {
                  if (task.hasTimeLogs) {
                      options += `<option value="${task.id}">${task.name}</option>`;
                  }
              });
              $('#taskSelect').html(options);
          } else if (!useMockData) {
              $.ajax({
                  url: '../api/getTasksByProject.php', // Replace with the correct API endpoint
                  method: 'GET',
                  data: { projectId: projectId },
                  dataType: 'json',
                  success: function(response) {
                      if (response.success) {
                          let options = '<option value="">Select Task</option>';
                          response.tasks.forEach(function(task) {
                              options += `<option value="${task.id}">${task.name}</option>`;
                          });
                          $('#taskSelect').html(options);
                      } else {
                          alert('Error loading tasks: ' + response.message);
                      }
                  },
                  error: function() {
                      alert('An error occurred while loading tasks.');
                  }
              });
          } else {
              $('#taskSelect').html('<option value="">Select Task</option>');
          }
      }

      // Load the projects when the page loads
      loadProjects();

      // When the project is selected, load the tasks for that project
      $('#projectSelect').change(function() {
          const projectId = $(this).val();
          if (projectId) {
              loadTasks(projectId);
          } else {
              $('#taskSelect').html('<option value="">Select Task</option>'); // Reset task options
          }
      });

      // Function to calculate the time difference
      function calculateTimeSpent(startDateTime, endDateTime) {
          const start = new Date(startDateTime);
          const end = new Date(endDateTime);
          const diff = end - start; // Difference in milliseconds
          const hours = Math.floor(diff / 3600000);
          const minutes = Math.floor((diff % 3600000) / 60000);
          const seconds = Math.floor((diff % 60000) / 1000);
          return `${hours}h ${minutes}m ${seconds}s`;
      }

      // Update the display of start date and time
      $('#startDate, #startTime').on('input', function() {
          const startDate = $('#startDate').val();
          const startTime = $('#startTime').val();
          if (startDate && startTime) {
              const formattedStartDateTime = `${startDate} ${startTime}`;
              const formattedStartDate = new Date(formattedStartDateTime).toLocaleString();
              $('#startDateTimeDisplay').text('Start: ' + formattedStartDate);
          }
      });

      // Update the display of end date and time
      $('#endDate, #endTime').on('input', function() {
          const endDate = $('#endDate').val();
          const endTime = $('#endTime').val();
          if (endDate && endTime) {
              const formattedEndDateTime = `${endDate} ${endTime}`;
              const formattedEndDate = new Date(formattedEndDateTime).toLocaleString();
              $('#endDateTimeDisplay').text('End: ' + formattedEndDate);
          }
      });

      // Handle form submission (either mock or backend)
      $('#timeLogForm').submit(function(e) {
          e.preventDefault();

          const projectId = $('#projectSelect').val();
          const taskId = $('#taskSelect').val();
          const startDate = $('#startDate').val();
          const startTime = $('#startTime').val();
          const endDate = $('#endDate').val();
          const endTime = $('#endTime').val();

          // Validate the form
          if (!projectId || !taskId || !startDate || !startTime || !endDate || !endTime) {
              alert('Please fill in all fields.');
              return;
          }

          const startDateTime = `${startDate} ${startTime}`;
          const endDateTime = `${endDate} ${endTime}`;
          const timeSpent = calculateTimeSpent(startDateTime, endDateTime);

          const timeLogData = {
              projectId: projectId,
              taskId: taskId,
              startDateTime: startDateTime,
              endDateTime: endDateTime,
              timeSpent: timeSpent
          };

          if (useMockData) {
              // Mock submission handling
              mockTimeLogs.push({
                  projectName: 'Project A', 
                  taskName: 'Task 1A', 
                  startDate: startDate, 
                  startTime: startTime, 
                  endDate: endDate, 
                  endTime: endTime, 
                  timeSpent: timeSpent
              });
              alert('Time log submitted successfully!');
              const newRow = `
                  <tr>
                      <td>Project A</td>
                      <td>Task 1A</td>
                      <td>${startDate}</td>
                      <td>${startTime}</td>
                      <td>${endDate}</td>
                      <td>${endTime}</td>
                      <td>${timeSpent}</td>
                  </tr>
              `;
              $('#timeLogsTable tbody').append(newRow);
          } else {
              // Submit to backend API (for non-mock data)
              $.ajax({
                  url: '../api/submitTimeLog.php', // Replace with the correct API endpoint
                  method: 'POST',
                  data: timeLogData,
                  dataType: 'json',
                  success: function(response) {
                      if (response.success) {
                          alert('Time log submitted successfully!');
                          // Reset the form
                          $('#timeLogForm')[0].reset();
                          // Add the new time log to the table
                          const newRow = `
                              <tr>
                                  <td>${response.projectName}</td>
                                  <td>${response.taskName}</td>
                                  <td>${startDate}</td>
                                  <td>${startTime}</td>
                                  <td>${endDate}</td>
                                  <td>${endTime}</td>
                                  <td>${timeSpent}</td>
                              </tr>
                          `;
                          $('#timeLogsTable tbody').append(newRow);
                      } else {
                          alert('Error: ' + response.message);
                      }
                  },
                  error: function() {
                      alert('An error occurred while submitting the time log.');
                  }
              });
          }
      });

      // Clear all time logs
      $('#clearLogsBtn').click(function() {
          if (useMockData) {
              mockTimeLogs.length = 0; // Clear mock time logs
              $('#timeLogsTable tbody').empty();
              alert('All logs have been cleared.');
          } else {
              // Backend logic to clear logs
              $.ajax({
                  url: '../api/clearTimeLogs.php', // Replace with the correct API endpoint
                  method: 'POST',
                  success: function(response) {
                      if (response.success) {
                          $('#timeLogsTable tbody').empty();
                          alert('All logs have been cleared.');
                      } else {
                          alert('Error clearing logs.');
                      }
                  },
                  error: function() {
                      alert('An error occurred while clearing logs.');
                  }
              });
          }
      });

      // Mock time logs on page load
      if (useMockData) {
          mockTimeLogs.forEach(function(log) {
              const newRow = `
                  <tr>
                      <td>${log.projectName}</td>
                      <td>${log.taskName}</td>
                      <td>${log.startDate}</td>
                      <td>${log.startTime}</td>
                      <td>${log.endDate}</td>
                      <td>${log.endTime}</td>
                      <td>${log.timeSpent}</td>
                  </tr>
              `;
              $('#timeLogsTable tbody').append(newRow);
          });
      }
  });
</script>
