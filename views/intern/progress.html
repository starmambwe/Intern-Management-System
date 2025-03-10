<div class="container mt-4">
  <h3>Track Personal Progress</h3>

  <!-- Personal Progress Table -->
  <div class="mt-4">
      <table class="table">
          <thead>
              <tr>
                  <th scope="col">Project</th>
                  <th scope="col">Task</th>
                  <th scope="col">Progress</th>
                  <th scope="col">Status</th>
              </tr>
          </thead>
          <tbody id="progressTableBody">
              <!-- Dynamic rows will be added here -->
          </tbody>
      </table>
  </div>
</div>

<script>
  $(document).ready(function() {
      let useMockData = true; // Set to 'true' to use mock data or 'false' to use real backend data

      // Mock Data
      const mockProgressData = [
          { projectName: "Project Alpha", taskName: "Task 1", progressPercentage: 70, status: "In Progress" },
          { projectName: "Project Alpha", taskName: "Task 2", progressPercentage: 50, status: "In Progress" },
          { projectName: "Project Beta", taskName: "Task 1", progressPercentage: 80, status: "Completed" },
          { projectName: "Project Gamma", taskName: "Task 1", progressPercentage: 30, status: "Not Started" }
      ];

      // Function to load personal progress data (Mock Data or from API)
      function loadProgress() {
          let progressRows = '';
          if (useMockData) {
              mockProgressData.forEach(function(progressItem) {
                  // Constructing a table row for each task's progress
                  progressRows += `
                      <tr>
                          <td>${progressItem.projectName}</td>
                          <td>${progressItem.taskName}</td>
                          <td>
                              <div class="progress">
                                  <div class="progress-bar" role="progressbar" style="width: ${progressItem.progressPercentage}%" aria-valuenow="${progressItem.progressPercentage}" aria-valuemin="0" aria-valuemax="100">${progressItem.progressPercentage}%</div>
                              </div>
                          </td>
                          <td>${progressItem.status}</td>
                      </tr>
                  `;
              });
              $('#progressTableBody').html(progressRows); // Populate the table with progress data
          } else {
              $.ajax({
                  url: '../api/getProgress.php', // Replace with your API endpoint
                  method: 'GET',
                  dataType: 'json',
                  success: function(response) {
                      if (response.success) {
                          response.progress.forEach(function(progressItem) {
                              // Constructing a table row for each task's progress
                              progressRows += `
                                  <tr>
                                      <td>${progressItem.projectName}</td>
                                      <td>${progressItem.taskName}</td>
                                      <td>
                                          <div class="progress">
                                              <div class="progress-bar" role="progressbar" style="width: ${progressItem.progressPercentage}%" aria-valuenow="${progressItem.progressPercentage}" aria-valuemin="0" aria-valuemax="100">${progressItem.progressPercentage}%</div>
                                          </div>
                                      </td>
                                      <td>${progressItem.status}</td>
                                  </tr>
                              `;
                          });
                          $('#progressTableBody').html(progressRows); // Populate the table with progress data
                      } else {
                          alert('Error loading progress: ' + response.message);
                      }
                  },
                  error: function() {
                      alert('An error occurred while loading progress.');
                  }
              });
          }
      }

      // Load personal progress data when the page loads
      loadProgress();
  });
</script>
