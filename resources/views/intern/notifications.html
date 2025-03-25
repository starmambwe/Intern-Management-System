<div class="container mt-4">
  <h3>Notifications</h3>

  <!-- Clear All Notifications Button -->
  <button id="clearAllBtn" class="btn btn-danger mb-3">Clear All Notifications</button>

  <!-- Notifications List -->
  <div class="mt-4" id="notificationsList">
      <!-- Dynamic notifications will be inserted here -->
      <ul class="list-group">
          <!-- Example notification -->
          <li class="list-group-item">New Task Assigned: Task Name</li>
      </ul>
  </div>
</div>

<script>
  $(document).ready(function() {
      let useMockData = true; // Set to 'true' to use mock data or 'false' to use real backend data

      // Mock Data
      const mockNotifications = [
          { id: 1, title: "New Task Assigned", message: "Task Name", date: "2025-03-06 10:00 AM" },
          { id: 2, title: "Project Update", message: "Project Alpha has been updated.", date: "2025-03-06 09:30 AM" },
          { id: 3, title: "Reminder", message: "Please submit your progress report.", date: "2025-03-05 03:15 PM" },
          { id: 4, title: "Task Deadline Approaching", message: "Task 2 in Project Beta is due tomorrow.", date: "2025-03-05 01:00 PM" }
      ];

      // Function to load notifications (Mock Data or from API)
      function loadNotifications() {
          let notificationsList = '';
          if (useMockData) {
              mockNotifications.forEach(function(notification) {
                  // Constructing a list item for each notification with a delete button
                  notificationsList += `
                      <li class="list-group-item d-flex justify-content-between align-items-center">
                          <div>
                              <strong>${notification.title}</strong> - ${notification.message}
                              <br>
                              <small><em>${notification.date}</em></small>
                          </div>
                          <button class="btn btn-danger btn-sm deleteBtn" data-id="${notification.id}">Delete</button>
                      </li>
                  `;
              });
              $('#notificationsList').html(`<ul class="list-group">${notificationsList}</ul>`); // Populate the notifications list
          } else {
              $.ajax({
                  url: '../api/getNotifications.php', // Replace with your API endpoint
                  method: 'GET',
                  dataType: 'json',
                  success: function(response) {
                      if (response.success) {
                          response.notifications.forEach(function(notification) {
                              // Constructing a list item for each notification with a delete button
                              notificationsList += `
                                  <li class="list-group-item d-flex justify-content-between align-items-center">
                                      <div>
                                          <strong>${notification.title}</strong> - ${notification.message}
                                          <br>
                                          <small><em>${notification.date}</em></small>
                                      </div>
                                      <button class="btn btn-danger btn-sm deleteBtn" data-id="${notification.id}">Delete</button>
                                  </li>
                              `;
                          });
                          $('#notificationsList').html(`<ul class="list-group">${notificationsList}</ul>`); // Populate the notifications list
                      } else {
                          alert('Error loading notifications: ' + response.message);
                      }
                  },
                  error: function() {
                      alert('An error occurred while loading notifications.');
                  }
              });
          }
      }

      // Delete a specific notification when the 'Delete' button is clicked
      $(document).on('click', '.deleteBtn', function() {
          const notificationId = $(this).data('id');
          // Remove the notification from the list (mock deletion)
          mockNotifications = mockNotifications.filter(notification => notification.id !== notificationId);
          loadNotifications(); // Reload the notifications list after deletion
      });

      // Clear all notifications when the 'Clear All Notifications' button is clicked
      $('#clearAllBtn').click(function() {
          mockNotifications.length = 0; // Clear all notifications from the mock data
          loadNotifications(); // Reload the notifications list after clearing
      });

      // Load notifications when the page loads
      loadNotifications();
  });
</script>

