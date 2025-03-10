<div class="container mt-4">
  <h3>Participate in Comment Threads</h3>

  <!-- Select Project -->
  <div class="mb-3">
    <label for="projectSelect" class="form-label">Select Project</label>
    <select class="form-select" id="projectSelect" required>
      <option value="">Select Project</option>
      <!-- Options will be dynamically loaded -->
    </select>
  </div>

  <!-- Select Task -->
  <div class="mb-3">
    <label for="taskSelect" class="form-label">Select Task</label>
    <select class="form-select" id="taskSelect" required>
      <option value="">Select Task</option>
      <!-- Options will be dynamically loaded based on the selected project -->
    </select>
  </div>

  <!-- Comment Thread -->
  <div id="commentThread" class="mt-4">
    <h4>Comments</h4>
    <div id="commentsContainer">
      <!-- Comments will be loaded here -->
    </div>
  </div>

  <!-- Add New Comment -->
  <div class="mt-4">
    <label for="newComment" class="form-label">Add a Comment</label>
    <textarea class="form-control" id="newComment" rows="3" placeholder="Write your comment here..." required></textarea>
    <button type="button" class="btn btn-primary mt-2" id="submitComment">Submit Comment</button>
  </div>
</div>

<script>
  $(document).ready(function() {
    const useMockData = true; // Set to 'true' for mock data, 'false' for backend data

    // Mock data for projects, tasks, and comments
    const mockData = {
      projects: [
        { id: 1, name: "Project 1" },
        { id: 2, name: "Project 2" }
      ],
      tasks: [
        { id: 1, projectId: 1, name: "Task 1" },
        { id: 2, projectId: 1, name: "Task 2" },
        { id: 3, projectId: 2, name: "Task 3" }
      ],
      comments: [
        { taskId: 1, userName: "John Doe", timestamp: "2025-03-06 12:00", content: "This is a mock comment for Task 1" },
        { taskId: 2, userName: "Jane Doe", timestamp: "2025-03-06 13:00", content: "This is a mock comment for Task 2" }
      ]
    };

    // Load projects from backend or mock data
    function loadProjects() {
      if (useMockData) {
        const options = '<option value="">Select Project</option>' + mockData.projects.map(project => 
          `<option value="${project.id}">${project.name}</option>`
        ).join('');
        $('#projectSelect').html(options);
      } else {
        $.ajax({
          url: '../api/getAssignedProjects.php',
          method: 'GET',
          dataType: 'json',
          success: function(response) {
            if (response.success) {
              const options = '<option value="">Select Project</option>' + response.projects.map(project => 
                `<option value="${project.id}">${project.name}</option>`
              ).join('');
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

    // Load tasks based on selected project from backend or mock data
    function loadTasks(projectId) {
      if (useMockData) {
        const tasks = mockData.tasks.filter(task => task.projectId == projectId);
        const options = '<option value="">Select Task</option>' + tasks.map(task => 
          `<option value="${task.id}">${task.name}</option>`
        ).join('');
        $('#taskSelect').html(options);
      } else {
        $.ajax({
          url: '../api/getTasksByProject.php',
          method: 'GET',
          data: { projectId: projectId },
          dataType: 'json',
          success: function(response) {
            if (response.success) {
              const options = '<option value="">Select Task</option>' + response.tasks.map(task => 
                `<option value="${task.id}">${task.name}</option>`
              ).join('');
              $('#taskSelect').html(options);
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

    // Load comments for the selected task from backend or mock data
    function loadComments(taskId) {
      if (useMockData) {
        const comments = mockData.comments.filter(comment => comment.taskId == taskId);
        const commentsHtml = comments.length ? comments.map(comment => 
          `<div class="comment"><p><strong>${comment.userName}</strong> <small>${comment.timestamp}</small></p><p>${comment.content}</p></div>`
        ).join('') : '<p>No comments yet. Be the first to comment!</p>';
        $('#commentsContainer').html(commentsHtml);
      } else {
        $.ajax({
          url: '../api/getComments.php',
          method: 'GET',
          data: { taskId: taskId },
          dataType: 'json',
          success: function(response) {
            if (response.success) {
              const commentsHtml = response.comments.length ? response.comments.map(comment => 
                `<div class="comment"><p><strong>${comment.userName}</strong> <small>${comment.timestamp}</small></p><p>${comment.content}</p></div>`
              ).join('') : '<p>No comments yet. Be the first to comment!</p>';
              $('#commentsContainer').html(commentsHtml);
            } else {
              $('#commentsContainer').html('<p>No comments yet. Be the first to comment!</p>');
            }
          },
          error: function() {
            alert('An error occurred while loading comments.');
          }
        });
      }
    }

    // Load projects on page load
    loadProjects();

    // Load tasks based on selected project
    $('#projectSelect').change(function() {
      const projectId = $(this).val();
      if (projectId) {
        loadTasks(projectId);
      } else {
        $('#taskSelect').html('<option value="">Select Task</option>'); // Reset task options
      }
    });

    // Load comments based on selected task
    $('#taskSelect').change(function() {
      const taskId = $(this).val();
      if (taskId) {
        loadComments(taskId);
      } else {
        $('#commentsContainer').html(''); // Clear comments container
      }
    });

    // Submit new comment
    $('#submitComment').click(function() {
      const taskId = $('#taskSelect').val();
      const commentContent = $('#newComment').val();

      if (!taskId || !commentContent) {
        alert('Please select a task and write a comment.');
        return;
      }

      // Submit comment to the server (for backend) or add to mock data
      if (useMockData) {
        mockData.comments.push({
          taskId: taskId,
          userName: "New User",
          timestamp: new Date().toISOString(),
          content: commentContent
        });
        loadComments(taskId); // Reload comments with the new comment
        $('#newComment').val(''); // Clear the comment field
        alert('Comment submitted successfully!');
      } else {
        $.ajax({
          url: '../api/submitComment.php',
          method: 'POST',
          data: { taskId: taskId, content: commentContent },
          dataType: 'json',
          success: function(response) {
            if (response.success) {
              alert('Comment submitted successfully!');
              $('#newComment').val(''); // Clear the comment field
              loadComments(taskId); // Reload comments
            } else {
              alert('Error submitting comment: ' + response.message);
            }
          },
          error: function() {
            alert('An error occurred while submitting your comment.');
          }
        });
      }
    });
  });
</script>
