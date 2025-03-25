<div class="container mt-4">
  <h3>Track Intern Progress</h3>

  <div class="mb-3">
    <label for="internSelect" class="form-label">Select Intern</label>
    <select class="form-select" id="internSelect">
      <option value="">Loading interns...</option>
    </select>
  </div>

  <div id="progressContainer" class="mt-4">
    <!-- Intern progress will load here -->
  </div>
</div>

<script>
  $(document).ready(function() {

    /** ---------- MOCK DATA ---------- **/
    const mockMode = true; // 🔄 Toggle this to false when ready for backend!

    const mockInterns = [
      { id: '1', name: 'Alice Johnson' },
      { id: '2', name: 'Bob Smith' },
      { id: '3', name: 'Charlie Brown' }
    ];

    const mockProgress = {
      '1': [
        {
          project_name: 'Website Redesign',
          completion: 80,
          tasks: [
            { title: 'Create wireframes', status: 'Completed' },
            { title: 'Develop landing page', status: 'In Progress' },
            { title: 'Test user flows', status: 'Pending' }
          ]
        },
        {
          project_name: 'Marketing Campaign',
          completion: 50,
          tasks: [
            { title: 'Design posters', status: 'Completed' },
            { title: 'Social media ads', status: 'In Progress' }
          ]
        }
      ],
      '2': [
        {
          project_name: 'Mobile App',
          completion: 60,
          tasks: [
            { title: 'Build login screen', status: 'Completed' },
            { title: 'API integration', status: 'In Progress' },
            { title: 'Push notifications', status: 'Pending' }
          ]
        }
      ],
      '3': [] // No projects
    };
    /** -------------------------------- **/

    function loadInterns() {
      $('#internSelect').empty().append('<option value="">Select an intern</option>');

      if (mockMode) {
        // ✅ MOCK DATA
        setTimeout(() => {
          $.each(mockInterns, function(_, intern) {
            $('#internSelect').append(`<option value="${intern.id}">${intern.name}</option>`);
          });
        }, 500);

      } else {
        // ✅ REAL BACKEND
        $.ajax({
          url: '../api/interns.php',
          method: 'GET',
          dataType: 'json',
          success: function(interns) {
            $.each(interns, function(_, intern) {
              $('#internSelect').append(`<option value="${intern.id}">${intern.name}</option>`);
            });
          },
          error: function() {
            $('#internSelect').empty().append('<option value="">Failed to load interns</option>');
          }
        });
      }
    }

    function loadProgress(internId) {
      $('#progressContainer').html('<p>Loading progress...</p>');

      if (mockMode) {
        // ✅ MOCK DATA
        setTimeout(() => {
          const progressData = mockProgress[internId] || [];
          renderProgress(progressData);
        }, 800);

      } else {
        // ✅ REAL BACKEND
        $.ajax({
          url: '../api/progress.php',
          method: 'GET',
          data: { intern_id: internId },
          dataType: 'json',
          success: function(progressData) {
            renderProgress(progressData);
          },
          error: function() {
            $('#progressContainer').html('<p>Failed to load progress data.</p>');
          }
        });
      }
    }

    function renderProgress(progressData) {
      if (progressData.length === 0) {
        $('#progressContainer').html('<p>No progress data found for this intern.</p>');
        return;
      }

      let html = '<div class="accordion" id="progressAccordion">';
      $.each(progressData, function(index, project) {
        html += `
          <div class="accordion-item">
            <h2 class="accordion-header" id="heading${index}">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse${index}">
                ${project.project_name} - ${project.completion}% Complete
              </button>
            </h2>
            <div id="collapse${index}" class="accordion-collapse collapse" data-bs-parent="#progressAccordion">
              <div class="accordion-body">
                <ul class="list-group">
        `;
        $.each(project.tasks, function(_, task) {
          html += `
            <li class="list-group-item d-flex justify-content-between align-items-center">
              ${task.title}
              <span class="badge bg-${task.status === 'Completed' ? 'success' : task.status === 'In Progress' ? 'warning' : 'secondary'}">${task.status}</span>
            </li>
          `;
        });
        html += `
                </ul>
              </div>
            </div>
          </div>
        `;
      });
      html += '</div>';

      $('#progressContainer').html(html);
    }

    // Event handlers
    $('#internSelect').change(function() {
      const internId = $(this).val();
      if (internId) {
        loadProgress(internId);
      } else {
        $('#progressContainer').empty();
      }
    });

    // Initialize on page load
    loadInterns();

  });
</script>
