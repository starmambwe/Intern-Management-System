<div class="container mt-4">
  <h3>Participate in Comment Threads for Tasks</h3>

  <div class="mb-3">
    <input type="text" id="commentSearch" class="form-control" placeholder="Search tasks...">
  </div>

  <div class="mb-3">
    <label for="taskSelect">Select a Task</label>
    <select id="taskSelect" class="form-control">
      <option value="">--Select a Task--</option>
      <!-- Task options will be populated here -->
    </select>
  </div>

  <div id="commentThreadContainer">
    <!-- Comment thread will load here -->
    <div class="alert alert-info" id="noCommentsMessage">
      Select a task to view and participate in the comment thread.
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {

      // Switch for mock data or backend data
      const useMockData = true; // Set to `false` when backend is ready

      // Mock data for tasks
      const mockTasks = [
          { id: 1, title: 'Frontend Development' },
          { id: 2, title: 'API Integration' },
          { id: 3, title: 'Database Design' }
      ];

      // Mock data for comments for a specific task
      const mockComments = {
          1: [
              { author: 'John Doe', timestamp: '2025-03-06 10:30:00', text: 'Started working on the UI.' },
              { author: 'Jane Smith', timestamp: '2025-03-06 11:00:00', text: 'Reviewed the design. Looks good.' }
          ],
          2: [
              { author: 'Alice Johnson', timestamp: '2025-03-05 15:45:00', text: 'API integration in progress.' }
          ],
          3: []
      };

      // Function to populate the task dropdown
      function populateTaskDropdown(tasks) {
          let options = '<option value="">--Select a Task--</option>';
          $.each(tasks, function(_, task) {
              options += `<option value="${task.id}">${task.title}</option>`;
          });
          $('#taskSelect').html(options);
      }

      // Function to load comment thread for a selected task
      function loadComments(taskId) {
          $('#commentThreadContainer').empty();
          $('#noCommentsMessage').hide();

          if (useMockData) {
              const comments = mockComments[taskId] || [];
              if (comments.length === 0) {
                  $('#commentThreadContainer').html(`
                      <div class="alert alert-warning">
                          No comments yet. Be the first to comment!
                      </div>
                  `);
              } else {
                  $.each(comments, function(_, comment) {
                      $('#commentThreadContainer').append(`
                          <div class="border-bottom mb-3">
                              <p><strong>${comment.author}</strong> <small>${comment.timestamp}</small></p>
                              <p>${comment.text}</p>
                          </div>
                      `);
                  });
              }

              // Add a new comment form
              $('#commentThreadContainer').append(`
                  <div>
                      <textarea id="newComment" class="form-control" placeholder="Add a comment..." rows="3"></textarea>
                      <button class="btn btn-primary mt-2" id="submitCommentBtn">Submit Comment</button>
                  </div>
              `);
          } else {
              // Here we would call the real backend
              $.ajax({
                  url: '../api/comments.php',
                  method: 'GET',
                  data: { task_id: taskId },
                  dataType: 'json',
                  success: function(data) {
                      if (data.length === 0) {
                          $('#commentThreadContainer').html(`
                              <div class="alert alert-warning">
                                  No comments yet. Be the first to comment!
                              </div>
                          `);
                      } else {
                          $.each(data, function(_, comment) {
                              $('#commentThreadContainer').append(`
                                  <div class="border-bottom mb-3">
                                      <p><strong>${comment.author}</strong> <small>${comment.timestamp}</small></p>
                                      <p>${comment.text}</p>
                                  </div>
                              `);
                          });
                      }

                      // Add a new comment form
                      $('#commentThreadContainer').append(`
                          <div>
                              <textarea id="newComment" class="form-control" placeholder="Add a comment..." rows="3"></textarea>
                              <button class="btn btn-primary mt-2" id="submitCommentBtn">Submit Comment</button>
                          </div>
                      `);
                  },
                  error: function() {
                      $('#commentThreadContainer').html(`
                          <div class="alert alert-danger">
                              Error loading comments. Please try again.
                          </div>
                      `);
                  }
              });
          }
      }

      // Search functionality for tasks
      $('#commentSearch').on('input', function() {
          const searchQuery = $(this).val();

          if (searchQuery.length > 2) {
              if (useMockData) {
                  // Simulate task search from mock data
                  const filteredTasks = mockTasks.filter(task =>
                      task.title.toLowerCase().includes(searchQuery.toLowerCase())
                  );
                  populateTaskDropdown(filteredTasks);
              } else {
                  // Real backend search call
                  $.ajax({
                      url: '../api/searchTasks.php',
                      method: 'GET',
                      data: { query: searchQuery },
                      dataType: 'json',
                      success: function(tasks) {
                          populateTaskDropdown(tasks);
                      }
                  });
              }
          }
      });

      // Event handler for task selection
      $('#taskSelect').change(function() {
          const taskId = $(this).val();
          if (taskId) {
              loadComments(taskId);
          } else {
              $('#commentThreadContainer').empty();
              $('#noCommentsMessage').show();
          }
      });

      // Initialize the task dropdown on page load
      populateTaskDropdown(mockTasks);

      // Submit new comment
      $('#commentThreadContainer').on('click', '#submitCommentBtn', function() {
          const commentText = $('#newComment').val();
          if (commentText) {
              const taskId = $('#taskSelect').val();

              if (useMockData) {
                  mockComments[taskId].push({
                      author: 'Current User', // Replace with actual user data
                      timestamp: new Date().toISOString(),
                      text: commentText
                  });
                  loadComments(taskId);
              } else {
                  $.ajax({
                      url: '../api/submitComment.php',
                      method: 'POST',
                      data: { task_id: taskId, text: commentText },
                      dataType: 'json',
                      success: function(response) {
                          if (response.success) {
                              loadComments(taskId);
                          } else {
                              alert('Failed to submit comment. Please try again.');
                          }
                      }
                  });
              }
          } else {
              alert('Please enter a comment before submitting.');
          }
      });

  });
</script>
