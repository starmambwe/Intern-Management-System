<div class="container mt-4">
  <h3>Submit Task Report</h3>

  <form id="reportForm" class="mt-4">
      <!-- Select Project -->
      <div class="mb-3">
          <label for="projectSelect" class="form-label">Select Project</label>
          <select class="form-select" id="projectSelect" required>
              <option value="">Loading projects...</option>
              <!-- Options loaded dynamically -->
          </select>
      </div>

      <!-- Select Task -->
      <div class="mb-3">
          <label for="taskSelect" class="form-label">Select Task</label>
          <select class="form-select" id="taskSelect" required>
              <option value="">Select a task</option>
              <!-- Options loaded dynamically based on selected project -->
          </select>
      </div>

      <!-- Report Text Area -->
      <div class="mb-3">
          <label for="reportText" class="form-label">Report</label>
          <textarea class="form-control" id="reportText" rows="5" placeholder="Write your report here..." required></textarea>
      </div>

      <!-- Submit Button -->
      <button type="submit" class="btn btn-primary">Submit Report</button>
  </form>

  <hr>

  <!-- Submitted Reports Table -->
  <h3 class="mt-4">Submitted Reports</h3>
  <table class="table table-bordered mt-3" id="reportsTable">
      <thead>
          <tr>
              <th>Project</th>
              <th>Task</th>
              <th>Report</th>
              <th>Date Submitted</th>
          </tr>
      </thead>
      <tbody>
          <!-- Submitted reports will appear here -->
      </tbody>
  </table>

  <!-- Export Buttons -->
  <button id="exportCsv" class="btn btn-success mt-3">Export to CSV</button>
  <button id="exportPdf" class="btn btn-danger mt-3">Export to PDF</button>
</div>

<script>
  $(document).ready(function() {
      const useMockData = true;

      // Mock Data for Projects
      const mockProjects = [
          { id: 1, name: 'Website Redesign' },
          { id: 2, name: 'API Integration' },
          { id: 3, name: 'Database Optimization' }
      ];

      // Mock Data for Tasks
      const mockTasks = {
          1: [
              { id: 1, name: 'UI Design' },
              { id: 2, name: 'Backend Setup' }
          ],
          2: [
              { id: 3, name: 'REST API Integration' },
              { id: 4, name: 'OAuth Authentication' }
          ],
          3: [
              { id: 5, name: 'Schema Design' },
              { id: 6, name: 'Query Optimization' }
          ]
      };

      // Mock Data for Submitted Reports
      let submittedReports = [];

      // Load Projects (Mock or Real)
      function loadProjects() {
          let options = '<option value="">Select a project</option>';
          if (useMockData) {
              $.each(mockProjects, function(_, project) {
                  options += `<option value="${project.id}">${project.name}</option>`;
              });
              $('#projectSelect').html(options);
          } else {
              $.ajax({
                  url: '../api/projects.php', // Change this URL based on your API
                  method: 'GET',
                  dataType: 'json',
                  success: function(projects) {
                      $.each(projects, function(_, project) {
                          options += `<option value="${project.id}">${project.name}</option>`;
                      });
                      $('#projectSelect').html(options);
                  },
                  error: function() {
                      $('#projectSelect').html('<option value="">Error loading projects</option>');
                  }
              });
          }
      }

      // Load Tasks Based on Selected Project
      $('#projectSelect').change(function() {
          const projectId = $(this).val();
          $('#taskSelect').html('<option value="">Loading tasks...</option>');

          if (!projectId) {
              $('#taskSelect').html('<option value="">Select a project first</option>');
              return;
          }

          if (useMockData) {
              const tasks = mockTasks[projectId] || [];
              let options = '<option value="">Select a task</option>';
              $.each(tasks, function(_, task) {
                  options += `<option value="${task.id}">${task.name}</option>`;
              });
              $('#taskSelect').html(options);
          } else {
              $.ajax({
                  url: '../api/tasks.php', // Change this URL based on your API
                  method: 'GET',
                  data: { projectId: projectId },
                  dataType: 'json',
                  success: function(tasks) {
                      let options = '<option value="">Select a task</option>';
                      $.each(tasks, function(_, task) {
                          options += `<option value="${task.id}">${task.name}</option>`;
                      });
                      $('#taskSelect').html(options);
                  },
                  error: function() {
                      $('#taskSelect').html('<option value="">Error loading tasks</option>');
                  }
              });
          }
      });

      // Handle Report Submission
      $('#reportForm').submit(function(e) {
          e.preventDefault();

          const reportData = {
              projectId: $('#projectSelect').val(),
              taskId: $('#taskSelect').val(),
              report: $('#reportText').val(),
              dateSubmitted: new Date().toLocaleDateString()
          };

          // Validate form data
          if (!reportData.projectId || !reportData.taskId || !reportData.report) {
              alert('Please fill in all fields');
              return;
          }

          // Add to Submitted Reports (Mock Data or Real API)
          submittedReports.push(reportData);
          updateReportsTable();

          // Reset Form
          $('#reportForm')[0].reset();
      });

      // Update Submitted Reports Table
      function updateReportsTable() {
          const $tbody = $('#reportsTable tbody');
          $tbody.empty();

          $.each(submittedReports, function(_, report) {
              const row = `
                  <tr>
                      <td>${mockProjects.find(p => p.id == report.projectId)?.name}</td>
                      <td>${mockTasks[report.projectId]?.find(t => t.id == report.taskId)?.name}</td>
                      <td>${report.report}</td>
                      <td>${report.dateSubmitted}</td>
                  </tr>
              `;
              $tbody.append(row);
          });
      }

      // Export to CSV
      $('#exportCsv').click(function() {
          let csvContent = "Project,Task,Report,Date Submitted\n";
          $.each(submittedReports, function(_, report) {
              const row = [
                  mockProjects.find(p => p.id == report.projectId)?.name,
                  mockTasks[report.projectId]?.find(t => t.id == report.taskId)?.name,
                  report.report,
                  report.dateSubmitted
              ].join(",");
              csvContent += row + "\n";
          });

          const blob = new Blob([csvContent], { type: 'text/csv' });
          const link = document.createElement('a');
          link.href = URL.createObjectURL(blob);
          link.download = 'submitted_reports.csv';
          link.click();
      });

      // Export to PDF (Using jsPDF library)
      $('#exportPdf').click(function() {
          const doc = new jsPDF();
          let y = 10;
          doc.text("Submitted Reports", 10, y);
          y += 10;
          doc.text("Project | Task | Report | Date Submitted", 10, y);
          y += 10;

          $.each(submittedReports, function(_, report) {
              doc.text(
                  `${mockProjects.find(p => p.id == report.projectId)?.name} | ` +
                  `${mockTasks[report.projectId]?.find(t => t.id == report.taskId)?.name} | ` +
                  `${report.report} | ` +
                  `${report.dateSubmitted}`,
                  10, y
              );
              y += 10;
          });

          doc.save('submitted_reports.pdf');
      });

      // Initialize Projects on Page Load
      loadProjects();
  });
</script>

<!-- Include jsPDF Library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
