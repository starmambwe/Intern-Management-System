<div class="container mt-4">
  <h3>Notifications</h3>

  <div class="mb-3">
      <input type="text" id="notificationSearch" class="form-control" placeholder="Search notifications...">
  </div>

  <button class="btn btn-danger mb-3" id="clearNotificationsBtn">Clear All Notifications</button>

  <ul class="list-group" id="notificationsList">
      <!-- Notifications will load here -->
  </ul>

  <div class="text-center mt-3" id="loadingMessage">Loading notifications...</div>
</div>

<script>
  $(document).ready(function() {

      // Switch for mock data or backend data
      const useMockData = true; // Change this to `false` when your backend is ready

      // Mock data for testing
      const mockNotifications = [
          {
              id: 1,
              title: 'Project Alpha Deadline Approaching',
              type: 'Deadline',
              message: 'The deadline for Project Alpha is approaching in 3 days. Please ensure all tasks are completed.',
              received_at: '2025-03-06 10:00:00'
          },
          {
              id: 2,
              title: 'Task Submission Reminder',
              type: 'Task Submission',
              message: 'You have pending task submissions for Project Beta. Please submit your tasks by the end of the day.',
              received_at: '2025-03-05 09:00:00'
          },
          {
              id: 3,
              title: 'New Task Assigned to You',
              type: 'Task Submission',
              message: 'You have been assigned a new task in Project Gamma. Check it out!',
              received_at: '2025-03-04 14:30:00'
          }
      ];

      // Function to load notifications and display them
      function loadNotifications(search = '') {
          $('#notificationsList').empty();
          $('#loadingMessage').text('Loading notifications...');

          if (useMockData) {
              const filteredNotifications = mockNotifications.filter(notification =>
                  notification.title.toLowerCase().includes(search.toLowerCase()) ||
                  notification.message.toLowerCase().includes(search.toLowerCase())
              );
              displayNotifications(filteredNotifications);
          } else {
              $.ajax({
                  url: '../api/notifications.php',
                  method: 'GET',
                  data: { search: search },
                  dataType: 'json',
                  success: function(notifications) {
                      if (notifications.length === 0) {
                          $('#loadingMessage').text('No notifications found.');
                          return;
                      }
                      displayNotifications(notifications);
                  },
                  error: function() {
                      $('#loadingMessage').text('Error loading notifications.');
                  }
              });
          }
      }

      // Function to display notifications
      function displayNotifications(notifications) {
          $('#loadingMessage').text('');
          $.each(notifications, function(_, notification) {
              const typeBadge = notification.type === 'Deadline'
                  ? '<span class="badge bg-danger ms-2">Deadline</span>'
                  : '<span class="badge bg-info ms-2">Task Submission</span>';

              $('#notificationsList').append(`
                  <li class="list-group-item d-flex justify-content-between align-items-start">
                      <div>
                          <strong>${notification.title}</strong>
                          ${typeBadge}
                          <div class="text-muted small">${notification.message}</div>
                          <div class="text-muted small">Received: ${notification.received_at}</div>
                      </div>
                      <button class="btn btn-danger btn-sm ms-3 deleteNotificationBtn" data-id="${notification.id}">Delete</button>
                  </li>
              `);
          });

          // Attach delete button event listeners after notifications are loaded
          $('.deleteNotificationBtn').click(function() {
              const notificationId = $(this).data('id');
              deleteNotification(notificationId);
          });
      }

      // Function to delete a specific notification
      function deleteNotification(notificationId) {
          // Simulating deletion from mock data (in real case, delete from the database)
          if (useMockData) {
              const index = mockNotifications.findIndex(notification => notification.id === notificationId);
              if (index !== -1) {
                  mockNotifications.splice(index, 1);
                  loadNotifications(); // Reload notifications after deletion
              }
          } else {
              // Send a DELETE request to the backend to remove the notification
              $.ajax({
                  url: '../api/deleteNotification.php', // Assuming this API handles deletion
                  method: 'POST',
                  data: { id: notificationId },
                  success: function(response) {
                      if (response.success) {
                          loadNotifications(); // Reload notifications after deletion
                      } else {
                          alert('Error deleting notification.');
                      }
                  },
                  error: function() {
                      alert('Error deleting notification.');
                  }
              });
          }
      }

      // Clear all notifications
      $('#clearNotificationsBtn').click(function() {
          $('#notificationsList').empty(); // Clear the notifications list
          $('#loadingMessage').text('Notifications cleared.');
      });

      // Initial load
      loadNotifications();

      // Search notifications
      $('#notificationSearch').on('input', function() {
          const searchQuery = $(this).val();
          loadNotifications(searchQuery);
      });

  });
</script>
