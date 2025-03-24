<div class="container mt-4">
  <h3>Time Tracked on Tasks</h3>

  <div class="mb-3">
      <input type="text" id="taskSearch" class="form-control" placeholder="Search by Task or Intern...">
  </div>

  <table class="table table-bordered">
      <thead class="table-light">
          <tr>
              <th>Intern Name</th>
              <th>Task Title</th>
              <th>Project</th>
              <th>Hours Logged</th>
              <th>Last Updated</th>
          </tr>
      </thead>
      <tbody id="timeTrackTableBody">
          <!-- Time tracking data will load here -->
      </tbody>
  </table>

  <div class="text-center" id="loadingMessage">Loading time tracking data...</div>
</div>

<script>
  $(document).ready(function() {

      // Switch for mock data or backend data
      const useMockData = true; // Set to `false` when backend is ready

      // Mock data for testing
      const mockTimeTrackingData = [
          {
              intern_name: 'John Doe',
              task_title: 'Frontend Development',
              project_name: 'Website Redesign',
              hours_logged: 12,
              updated_at: '2025-03-06 10:30:00'
          },
          {
              intern_name: 'Jane Smith',
              task_title: 'Database Setup',
              project_name: 'Mobile App Launch',
              hours_logged: 8,
              updated_at: '2025-03-05 15:45:00'
          },
          {
              intern_name: 'Alice Johnson',
              task_title: 'API Development',
              project_name: 'E-commerce Platform',
              hours_logged: 20,
              updated_at: '2025-03-04 11:15:00'
          }
      ];

      // Function to load time tracking data and display it
      function loadTimeTrackingData(search = '') {
          $('#timeTrackTableBody').empty();
          $('#loadingMessage').text('Loading time tracking data...');

          if (useMockData) {
              const filteredData = mockTimeTrackingData.filter(record =>
                  record.task_title.toLowerCase().includes(search.toLowerCase()) ||
                  record.intern_name.toLowerCase().includes(search.toLowerCase())
              );
              displayTimeTrackingData(filteredData);
          } else {
              $.ajax({
                  url: '../api/timeTracking.php',
                  method: 'GET',
                  data: { search: search },
                  dataType: 'json',
                  success: function(data) {
                      if (data.length === 0) {
                          $('#loadingMessage').text('No time tracking records found.');
                          return;
                      }
                      displayTimeTrackingData(data);
                  },
                  error: function() {
                      $('#loadingMessage').text('Error loading time tracking data.');
                  }
              });
          }
      }

      // Function to display the time tracking data in the table
      function displayTimeTrackingData(data) {
          $('#loadingMessage').text('');
          $.each(data, function(_, record) {
              $('#timeTrackTableBody').append(`
                  <tr>
                      <td>${record.intern_name}</td>
                      <td>${record.task_title}</td>
                      <td>${record.project_name}</td>
                      <td>${record.hours_logged} hrs</td>
                      <td>${record.updated_at}</td>
                  </tr>
              `);
          });
      }

      // Initial load
      loadTimeTrackingData();

      // Search functionality
      $('#taskSearch').on('input', function() {
          const searchQuery = $(this).val();
          loadTimeTrackingData(searchQuery);
      });

  });
</script>
