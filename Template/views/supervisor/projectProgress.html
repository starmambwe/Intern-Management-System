<div class="container mt-4">
  <h3>Monitor Project Progress</h3>

  <div class="mb-3">
      <label for="projectSearch" class="form-label">Search Projects</label>
      <input type="text" class="form-control" id="projectSearch" placeholder="Enter project name">
  </div>

  <table class="table table-bordered">
      <thead class="table-light">
          <tr>
              <th>#</th>
              <th>Project Name</th>
              <th>Description</th>
              <th>Start Date</th>
              <th>End Date</th>
              <th>Progress (%)</th>
              <th>Status</th>
              <th>Comment</th> <!-- New Comment Column -->
          </tr>
      </thead>
      <tbody id="projectProgressTable">
          <!-- Project progress data will be loaded here -->
      </tbody>
  </table>
</div>

<script>
  $(document).ready(function() {

      // Switch for mock data or backend data
      const useMockData = true; // Change this to `false` when your backend is ready

      // Function to evaluate project status based on progress
      function getProjectComment(progress, endDate) {
          const today = new Date();
          const projectEndDate = new Date(endDate);

          if (progress === 100) {
              return 'Completed';
          }

          const timeRemaining = projectEndDate - today;
          const daysRemaining = Math.floor(timeRemaining / (1000 * 3600 * 24)); // Convert milliseconds to days

          if (progress >= 80 && daysRemaining > 7) {
              return 'On Track';
          } else if (progress >= 50 && daysRemaining <= 7) {
              return 'At Risk';
          } else if (progress < 50) {
              return 'Delayed';
          }

          return 'In Progress';
      }

      // Mock data for testing
      const mockProjects = [
          {
              id: 1,
              name: 'Project Alpha',
              description: 'A project focused on software development.',
              start_date: '2025-01-01',
              end_date: '2025-12-31',
              progress: 45,
              status: 'In Progress'
          },
          {
              id: 2,
              name: 'Project Beta',
              description: 'A construction project in the city.',
              start_date: '2025-03-01',
              end_date: '2025-10-31',
              progress: 75,
              status: 'In Progress'
          },
          {
              id: 3,
              name: 'Project Gamma',
              description: 'Research project for AI algorithms.',
              start_date: '2024-11-01',
              end_date: '2025-06-30',
              progress: 100,
              status: 'Completed'
          }
      ];

      // Function to load projects and display them with progress bars
      function loadProjects(search = '') {
          $('#projectProgressTable').html('<tr><td colspan="8">Loading...</td></tr>');

          if (useMockData) {
              const filteredProjects = mockProjects.filter(project =>
                  project.name.toLowerCase().includes(search.toLowerCase())
              );
              displayProjects(filteredProjects);
          } else {
              $.ajax({
                  url: '../api/projectProgress.php',
                  method: 'GET',
                  data: { search: search },
                  dataType: 'json',
                  success: function(projects) {
                      if (projects.length === 0) {
                          $('#projectProgressTable').html('<tr><td colspan="8">No projects found.</td></tr>');
                          return;
                      }
                      displayProjects(projects);
                  },
                  error: function() {
                      $('#projectProgressTable').html('<tr><td colspan="8">Error loading project progress.</td></tr>');
                  }
              });
          }
      }

      // Function to display project data
      function displayProjects(projects) {
          let rows = '';
          $.each(projects, function(index, project) {
              const comment = getProjectComment(project.progress, project.end_date);
              rows += `
                  <tr>
                      <td>${index + 1}</td>
                      <td>${project.name}</td>
                      <td>${project.description}</td>
                      <td>${project.start_date}</td>
                      <td>${project.end_date}</td>
                      <td>
                          <div class="progress">
                              <div class="progress-bar" role="progressbar" style="width: ${project.progress}%;">
                                  ${project.progress}%
                              </div>
                          </div>
                      </td>
                      <td>${project.status}</td>
                      <td>${comment}</td> <!-- New Comment Cell -->
                  </tr>
              `;
          });
          $('#projectProgressTable').html(rows);
      }

      // Initial load
      loadProjects();

      // Search projects
      $('#projectSearch').on('input', function() {
          const searchQuery = $(this).val();
          loadProjects(searchQuery);
      });

  });
</script>
