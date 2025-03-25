<div class="container mt-4">
  <h3>Assigned Projects and Tasks</h3>

  <form id="projectsTasksForm" class="mt-4">
      <!-- Select Project -->
      <div class="mb-3">
          <label for="projectSelect" class="form-label">Select Project</label>
          <select class="form-select" id="projectSelect" required>
              <option value="">Loading projects...</option>
              <!-- Options loaded dynamically -->
          </select>
      </div>

      <!-- Task List in a Table -->
      <div class="mb-3" id="taskListContainer">
          <h4>Tasks</h4>
          <table id="taskTable" class="table table-striped">
              <thead>
                  <tr>
                      <th>Project</th>
                      <th>Task</th>
                      <th>Description</th>
                      <th>Start Date</th>
                      <th>Due Date</th>
                  </tr>
              </thead>
              <tbody id="taskList">
                  <!-- Tasks will be dynamically listed here -->
              </tbody>
          </table>
      </div>
  </form>
</div>

<script>
  $(document).ready(function() {
      // Switch for mock data or backend data
      const useMockData = true; // Set to `false` when backend is ready

      // Mock Data for Projects
      const mockProjects = [
          { id: 1, name: 'Website Redesign' },
          { id: 2, name: 'API Integration' },
          { id: 3, name: 'Database Optimization' }
      ];

      // Mock Data for Tasks
      const mockTasks = {
          1: [
              { id: 1, name: 'UI Design', description: 'Design the main page UI for the website.', start_date: '2025-03-01', due_date: '2025-03-10' },
              { id: 2, name: 'Backend Setup', description: 'Set up the backend environment for the website.', start_date: '2025-03-05', due_date: '2025-03-15' }
          ],
          2: [
              { id: 3, name: 'REST API Integration', description: 'Integrate the RESTful API with the frontend.', start_date: '2025-03-01', due_date: '2025-03-12' },
              { id: 4, name: 'OAuth Authentication', description: 'Implement OAuth authentication for the API.', start_date: '2025-03-02', due_date: '2025-03-14' }
          ],
          3: [
              { id: 5, name: 'Schema Design', description: 'Redesign the database schema for performance improvement.', start_date: '2025-03-01', due_date: '2025-03-08' },
              { id: 6, name: 'Query Optimization', description: 'Optimize the slow queries in the current database.', start_date: '2025-03-02', due_date: '2025-03-10' }
          ]
      };

      // Load assigned projects for the intern (mock data version)
      function loadProjects() {
          let options = '<option value="">Select a project</option>';
          $.each(mockProjects, function(_, project) {
              options += `<option value="${project.id}">${project.name}</option>`;
          });
          $('#projectSelect').html(options);
      }

      // Load tasks when a project is selected (mock data version)
      $('#projectSelect').change(function() {
          const projectId = $(this).val();
          $('#taskList').html('<tr><td colspan="5" class="text-center">Loading tasks...</td></tr>');

          if (!projectId) {
              $('#taskList').html('<tr><td colspan="5" class="text-center">Please select a project first</td></tr>');
              return;
          }

          if (useMockData) {
              const tasks = mockTasks[projectId] || [];
              if (tasks.length === 0) {
                  $('#taskList').html('<tr><td colspan="5" class="text-center">No tasks found for this project</td></tr>');
                  return;
              }

              let taskList = '';
              $.each(tasks, function(_, task) {
                  // Ensure that project exists before trying to access it
                  const projectName = mockProjects.find(project => project.id === parseInt(projectId))?.name || 'Unknown Project';
                  taskList += `
                      <tr>
                          <td>${projectName}</td>
                          <td><strong>${task.name}</strong></td>
                          <td>${task.description}</td>
                          <td>${task.start_date}</td>
                          <td>${task.due_date}</td>
                      </tr>
                  `;
              });
              $('#taskList').html(taskList);
          } else {
              // Real backend code here
              $.ajax({
                  url: '../api/tasks.php', // Change to your actual API URL
                  method: 'GET',
                  data: { projectId: projectId },
                  dataType: 'json',
                  success: function(tasks) {
                      if (tasks.length === 0) {
                          $('#taskList').html('<tr><td colspan="5" class="text-center">No tasks found for this project</td></tr>');
                          return;
                      }

                      let taskList = '';
                      $.each(tasks, function(_, task) {
                          taskList += `
                              <tr>
                                  <td>${task.project_name}</td>
                                  <td><strong>${task.name}</strong></td>
                                  <td>${task.description}</td>
                                  <td>${task.start_date}</td>
                                  <td>${task.due_date}</td>
                              </tr>
                          `;
                      });
                      $('#taskList').html(taskList);
                  },
                  error: function() {
                      $('#taskList').html('<tr><td colspan="5" class="text-center">Error loading tasks</td></tr>');
                  }
              });
          }
      });

      // Initialize projects on page load
      loadProjects();
  });
</script>
