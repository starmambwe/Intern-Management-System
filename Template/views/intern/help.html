<div class="container mt-4">
  <h3>Request Help Within a Project</h3>

  <form id="helpRequestForm" class="mt-4">
      <!-- Select Project -->
      <div class="mb-3">
          <label for="projectSelect" class="form-label">Select Project</label>
          <select class="form-control" id="projectSelect" required>
              <option value="" disabled selected>Select a project</option> <!-- Placeholder for project select -->
              <!-- Projects will be dynamically loaded here -->
          </select>
      </div>

      <!-- Select Task -->
      <div class="mb-3">
          <label for="taskSelect" class="form-label">Select Task</label>
          <select class="form-control" id="taskSelect" required>
              <option value="" disabled selected>Select a task</option> <!-- Placeholder for task select -->
              <!-- Tasks will be dynamically loaded here based on the selected project -->
          </select>
      </div>

      <!-- Request Description -->
      <div class="mb-3">
          <label for="helpDescription" class="form-label">Describe the Help Needed</label>
          <textarea class="form-control" id="helpDescription" rows="4" placeholder="Please describe the issue you're facing or the help you need" required></textarea>
      </div>

      <!-- Submit Button -->
      <button type="submit" class="btn btn-primary">Submit Help Request</button>
  </form>
</div>

<script>
  $(document).ready(function() {
      let useMockData = true; // Set to 'true' to use mock data or 'false' to use real backend data

      // Mock Data
      const mockProjects = [
          { id: 1, name: "Project Alpha" },
          { id: 2, name: "Project Beta" },
          { id: 3, name: "Project Gamma" }
      ];

      const mockTasks = {
          1: [
              { id: 101, name: "Task 1" },
              { id: 102, name: "Task 2" }
          ],
          2: [
              { id: 201, name: "Task 1" },
              { id: 202, name: "Task 2" }
          ],
          3: [
              { id: 301, name: "Task 1" },
              { id: 302, name: "Task 2" }
          ]
      };

      // Function to load projects dynamically (Mock Data or from API)
      function loadProjects() {
          let projectOptions = '<option value="" disabled selected>Select a project</option>'; // Placeholder for project select
          if (useMockData) {
              mockProjects.forEach(function(project) {
                  projectOptions += `<option value="${project.id}">${project.name}</option>`;
              });
              $('#projectSelect').html(projectOptions); // Populate project select dropdown
          } else {
              $.ajax({
                  url: '../api/getProjects.php', // Replace with your API endpoint
                  method: 'GET',
                  dataType: 'json',
                  success: function(response) {
                      if (response.success) {
                          response.projects.forEach(function(project) {
                              projectOptions += `<option value="${project.id}">${project.name}</option>`;
                          });
                          $('#projectSelect').html(projectOptions); // Populate project select dropdown
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

      // Function to load tasks dynamically based on the selected project (Mock Data or from API)
      function loadTasks(projectId) {
          let taskOptions = '<option value="" disabled selected>Select a task</option>'; // Placeholder for task select
          if (useMockData) {
              const tasks = mockTasks[projectId] || [];
              tasks.forEach(function(task) {
                  taskOptions += `<option value="${task.id}">${task.name}</option>`;
              });
              $('#taskSelect').html(taskOptions); // Populate task select dropdown
          } else {
              $.ajax({
                  url: '../api/getTasks.php', // Replace with your API endpoint
                  method: 'GET',
                  data: { projectId: projectId },
                  dataType: 'json',
                  success: function(response) {
                      if (response.success) {
                          response.tasks.forEach(function(task) {
                              taskOptions += `<option value="${task.id}">${task.name}</option>`;
                          });
                          $('#taskSelect').html(taskOptions); // Populate task select dropdown
                      } else {
                          alert('Error loading tasks: ' + response.message);
                      }
                  },
                  error: function() {
                      alert('An error occurred while loading tasks.');
                  }
              });
          }
      }

      // Trigger task loading when a project is selected
      $('#projectSelect').change(function() {
          const selectedProjectId = $(this).val();
          if (selectedProjectId) {
              loadTasks(selectedProjectId); // Load tasks for the selected project
          }
      });

      // Handle the help request form submission
      $('#helpRequestForm').submit(function(e) {
          e.preventDefault();

          const helpRequestData = {
              projectId: $('#projectSelect').val(),
              taskId: $('#taskSelect').val(),
              description: $('#helpDescription').val()
          };

          // Validate the form data
          if (!helpRequestData.projectId || !helpRequestData.taskId || !helpRequestData.description) {
              alert('Please fill in all required fields.');
              return;
          }

          // Submit the help request data
          $.ajax({
              url: '../api/submitHelpRequest.php', // Replace with your API endpoint
              method: 'POST',
              data: helpRequestData,
              dataType: 'json',
              success: function(response) {
                  if (response.success) {
                      alert('Your help request has been submitted!');
                      $('#helpRequestForm')[0].reset(); // Reset the form after submission
                  } else {
                      alert('Error submitting help request: ' + response.message);
                  }
              },
              error: function() {
                  alert('An error occurred while submitting your help request.');
              }
          });
      });

      // Load projects when the page loads
      loadProjects();
  });
</script>
