<div class="container mt-4">
  <h3>Submit Feedback for Tasks/Projects</h3>

  <form id="feedbackForm" class="mt-4">
    <div class="mb-3">
      <label for="projectSelect" class="form-label">Select Project</label>
      <select class="form-select" id="projectSelect" required>
        <option value="">Select a project</option>
        <!-- Project options loaded dynamically -->
      </select>
    </div>

    <div class="mb-3">
      <label for="taskSelect" class="form-label">Select Task</label>
      <select class="form-select" id="taskSelect" required>
        <option value="">Select a task</option>
        <!-- Task options loaded dynamically based on project selection -->
      </select>
    </div>

    <div class="mb-3">
      <label for="feedbackContext" class="form-label">Feedback Context</label>
      <textarea class="form-control" id="feedbackContext" rows="5" placeholder="Comment or feedback from intern/admin..." disabled></textarea>
    </div>

    <div class="mb-3">
      <label for="feedbackText" class="form-label">Feedback</label>
      <textarea class="form-control" id="feedbackText" rows="5" placeholder="Write your feedback here..." required></textarea>
    </div>

    <button type="submit" class="btn btn-primary">Submit Feedback</button>
  </form>
</div>

<script>
$(document).ready(function() {

  // ---------- MOCK DATA ----------

  const mockMode = true; // Toggle this to false for real backend!

  const mockProjects = [
    { id: '1', name: 'Website Redesign' },
    { id: '2', name: 'Mobile App Development' }
  ];

  const mockTasks = {
    '1': [
      { id: '101', name: 'Homepage Design' },
      { id: '102', name: 'Contact Page Development' }
    ],
    '2': [
      { id: '201', name: 'API Integration' },
      { id: '202', name: 'Push Notifications Setup' }
    ]
  };

  const mockFeedbackContext = {
    '101': [
      { name: 'Alice Johnson', role: 'Intern', comment: 'Finished the initial homepage layout.' },
      { name: 'John Doe', role: 'Admin', comment: 'Looks good, please add the footer.' }
    ],
    '201': [
      { name: 'Bob Smith', role: 'Intern', comment: 'API integration is 50% complete.' },
      { name: 'Sarah Lee', role: 'Admin', comment: 'Great progress! Continue with the setup.' }
    ]
  };

  // ---------------------------------

  // Load projects (mock or real)
  function loadProjects() {
    if (mockMode) {
      let projectOptions = '<option value="">Select a project</option>';
      $.each(mockProjects, function(_, project) {
        projectOptions += `<option value="${project.id}">${project.name}</option>`;
      });
      $('#projectSelect').html(projectOptions);
    } else {
      $.ajax({
        url: '../api/projects.php', 
        method: 'GET',
        dataType: 'json',
        success: function(projects) {
          let projectOptions = '<option value="">Select a project</option>';
          $.each(projects, function(_, project) {
            projectOptions += `<option value="${project.id}">${project.name}</option>`;
          });
          $('#projectSelect').html(projectOptions);
        },
        error: function() {
          $('#projectSelect').html('<option value="">Error loading projects</option>');
        }
      });
    }
  }

  // Load tasks based on selected project
  $('#projectSelect').change(function() {
    const projectId = $(this).val();
    $('#taskSelect').html('<option value="">Loading tasks...</option>');
    $('#feedbackContext').val(''); 

    if (!projectId) {
      $('#taskSelect').html('<option value="">Select a project first</option>');
      return;
    }

    if (mockMode) {
      const tasks = mockTasks[projectId] || [];
      let taskOptions = '<option value="">Select a task</option>';
      $.each(tasks, function(_, task) {
        taskOptions += `<option value="${task.id}">${task.name}</option>`;
      });
      $('#taskSelect').html(taskOptions);
    } else {
      $.ajax({
        url: '../api/tasks.php',
        method: 'GET',
        data: { project_id: projectId },
        dataType: 'json',
        success: function(tasks) {
          let taskOptions = '<option value="">Select a task</option>';
          $.each(tasks, function(_, task) {
            taskOptions += `<option value="${task.id}">${task.name}</option>`;
          });
          $('#taskSelect').html(taskOptions);
        },
        error: function() {
          $('#taskSelect').html('<option value="">Error loading tasks</option>');
        }
      });
    }
  });

  // Display feedback context when a task is selected
  $('#taskSelect').change(function() {
    const taskId = $(this).val();

    if (!taskId) {
      $('#feedbackContext').val('');
      return;
    }

    if (mockMode) {
      const feedback = mockFeedbackContext[taskId] || [];
      let feedbackContext = '';
      $.each(feedback, function(_, comment) {
        const commenter = `${comment.name} (${comment.role})`;
        feedbackContext += `${commenter}: "${comment.comment}"\n\n`;
      });
      $('#feedbackContext').val(feedbackContext);
    } else {
      $.ajax({
        url: '../api/feedbackContext.php',
        method: 'GET',
        data: { task_id: taskId },
        dataType: 'json',
        success: function(feedback) {
          if (feedback.length === 0) {
            $('#feedbackContext').val('No previous feedback available.');
            return;
          }

          let feedbackContext = '';
          $.each(feedback, function(_, comment) {
            const commenter = `${comment.name} (${comment.role})`;
            feedbackContext += `${commenter}: "${comment.comment}"\n\n`;
          });
          $('#feedbackContext').val(feedbackContext);
        },
        error: function() {
          $('#feedbackContext').val('Error loading feedback context.');
        }
      });
    }
  });

  // Handle feedback form submission
  $('#feedbackForm').submit(function(e) {
    e.preventDefault();

    const feedbackData = {
      taskId: $('#taskSelect').val(),
      feedback: $('#feedbackText').val()
    };

    if (mockMode) {
      alert('Mock: Feedback submitted successfully!');
      $('#feedbackForm')[0].reset();
    } else {
      $.ajax({
        url: '../api/submitFeedback.php',
        method: 'POST',
        data: feedbackData,
        dataType: 'json',
        success: function(response) {
          if (response.success) {
            alert('Feedback submitted successfully!');
            $('#feedbackForm')[0].reset();
          } else {
            alert('Error: ' + response.message);
          }
        },
        error: function() {
          alert('An error occurred while submitting feedback.');
        }
      });
    }
  });

  // Initialize
  loadProjects();

});
</script>
