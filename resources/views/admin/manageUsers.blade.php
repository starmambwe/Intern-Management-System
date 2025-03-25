<div class="container mt-4">
  <h2>Manage Users & Roles</h2>

  <!-- Tabs -->
  <ul class="nav nav-tabs" id="userRoleTabs">
    <li class="nav-item">
      <a class="nav-link active" id="usersTab" href="#">Users</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="rolesTab" href="#">Roles</a>
    </li>
  </ul>

  <!-- Users Section -->
  <div id="usersSection" class="mt-3">
    <h3>Manage Users</h3>
    <form id="userForm">
      <input type="hidden" id="userId">
      <div class="mb-3">
        <label for="userName" class="form-label">Name</label>
        <input type="text" class="form-control" id="userName" placeholder="Enter full name" required>
      </div>
      <div class="mb-3">
        <label for="userEmail" class="form-label">Email</label>
        <input type="email" class="form-control" id="userEmail" placeholder="Enter email" required>
      </div>
      <div class="mb-3">
        <label for="userRole" class="form-label">Role</label>
        <select class="form-select" id="userRole" required>
          <option value="">Select role</option>
          <option value="Admin">Admin</option>
          <option value="Supervisor">Supervisor</option>
          <option value="Intern">Intern</option>
        </select>
      </div>
      <button type="submit" class="btn btn-primary" id="saveUserBtn">Save User</button>
      <button type="reset" class="btn btn-secondary" id="cancelEditBtn" style="display:none;">Cancel Edit</button>
    </form>
  </div>

  <!-- Roles Section (Initially Hidden) -->
  <div id="rolesSection" class="mt-3" style="display: none;">
    <h3>Manage Roles</h3>

    <!-- Add Role Form -->
    <div class="mb-3">
      <label for="roleName" class="form-label">New Role</label>
      <input type="text" class="form-control" id="roleName" placeholder="Enter role name">
      <button class="btn btn-success mt-2" id="addRoleBtn">Add Role</button>
    </div>

    <!-- Roles List -->
    <h4>Existing Roles</h4>
    <ul id="rolesList" class="list-group">
      <!-- Roles will be dynamically added here -->
    </ul>
  </div>


<script>
  $(document).ready(function() {
    // Tab Switching
    $("#usersTab").click(function() {
      $("#usersSection").show();
      $("#rolesSection").hide();
      $("#usersTab").addClass("active");
      $("#rolesTab").removeClass("active");
    });

    $("#rolesTab").click(function() {
      $("#rolesSection").show();
      $("#usersSection").hide();
      $("#rolesTab").addClass("active");
      $("#usersTab").removeClass("active");
    });

    // Mock roles data
    let roles = ["Admin", "Supervisor", "Intern"];

    // Load roles into the list
    function loadRoles() {
      $("#rolesList").html("");
      roles.forEach((role, index) => {
        $("#rolesList").append(`
          <li class="list-group-item d-flex justify-content-between align-items-center">
            <span>${role}</span>
            <button class="btn btn-sm btn-warning renameRoleBtn" data-index="${index}">Rename</button>
          </li>
        `);
      });
    }

    loadRoles(); // Initial load

    // Add Role
    $("#addRoleBtn").click(function() {
      const newRole = $("#roleName").val().trim();
      if (newRole) {
        roles.push(newRole);
        loadRoles();
        $("#roleName").val(""); // Clear input
      } else {
        alert("Role name cannot be empty.");
      }
    });

    // Rename Role
    $(document).on("click", ".renameRoleBtn", function() {
      const index = $(this).data("index");
      const newName = prompt("Enter new role name:", roles[index]);
      if (newName) {
        roles[index] = newName;
        loadRoles();
      }
    });
  });
</script>


  <hr class="my-5">

  <!-- Users Table -->
  <h4>Existing Users</h4>
  <table class="table table-bordered" id="usersTable">
    <thead class="table-light">
      <tr>
        <th>#</th>
        <th>Name</th>
        <th>Email</th>
        <th>Role</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <!-- Users will be dynamically loaded here -->
    </tbody>
  </table>
</div>

<script>
  $(document).ready(function() {

    let userCount = 0;

    function resetForm() {
      $('#userId').val('');
      $('#userForm')[0].reset();
      $('#saveUserBtn').text('Save User');
      $('#cancelEditBtn').hide();
    }

    function loadUsers() {
      $('#usersTable tbody').empty();
      userCount = 0;

      // Active dummy data
      const dummyUsers = [
        { id: 1, name: 'Alice Johnson', email: 'alice@example.com', role: 'Admin' },
        { id: 2, name: 'Bob Smith', email: 'bob@example.com', role: 'Supervisor' },
        { id: 3, name: 'Charlie Davis', email: 'charlie@example.com', role: 'Intern' }
      ];

      $.each(dummyUsers, function(_, user) {
        userCount++;
        $('#usersTable tbody').append(`
          <tr data-id="${user.id}">
            <td>${userCount}</td>
            <td>${user.name}</td>
            <td>${user.email}</td>
            <td>${user.role}</td>
            <td>
              <button class="btn btn-sm btn-warning editBtn">Edit</button>
              <button class="btn btn-sm btn-danger deleteBtn">Delete</button>
            </td>
          </tr>
        `);
      });

      /*
      // Uncomment this block to switch back to real AJAX data
      $.ajax({
        url: 'ajax.manageUsers.php',
        method: 'GET',
        data: { action: 'read' },
        dataType: 'json',
        success: function(users) {
          $.each(users, function(_, user) {
            userCount++;
            $('#usersTable tbody').append(`
              <tr data-id="${user.id}">
                <td>${userCount}</td>
                <td>${user.name}</td>
                <td>${user.email}</td>
                <td>${user.role}</td>
                <td>
                  <button class="btn btn-sm btn-warning editBtn">Edit</button>
                  <button class="btn btn-sm btn-danger deleteBtn">Delete</button>
                </td>
              </tr>
            `);
          });
        }
      });
      */
    }

    loadUsers();

    $('#userForm').submit(function(e) {
      e.preventDefault();

      const id = $('#userId').val();
      const userData = {
        id: id,
        name: $('#userName').val(),
        email: $('#userEmail').val(),
        role: $('#userRole').val()
      };

      const ajaxUrl = id ? 'ajax.manageUsers.php?action=update' : 'ajax.manageUsers.php?action=create';

      $.ajax({
        url: ajaxUrl,
        method: 'POST',
        data: userData,
        dataType: 'json',
        success: function(response) {
          if (response.success) {
            loadUsers();
            resetForm();
          } else {
            alert('Error: ' + response.message);
          }
        }
      });
    });

    $('#usersTable').on('click', '.editBtn', function() {
      const row = $(this).closest('tr');
      const id = row.data('id');

      $.ajax({
        url: 'ajax.manageUsers.php',
        method: 'GET',
        data: { action: 'getUser', id: id },
        dataType: 'json',
        success: function(user) {
          $('#userId').val(user.id);
          $('#userName').val(user.name);
          $('#userEmail').val(user.email);
          $('#userRole').val(user.role);
          $('#saveUserBtn').text('Update User');
          $('#cancelEditBtn').show();
        }
      });
    });

    $('#usersTable').on('click', '.deleteBtn', function() {
      const row = $(this).closest('tr');
      const id = row.data('id');

      if (confirm('Are you sure you want to delete this user?')) {
        $.ajax({
          url: 'ajax.manageUsers.php?action=delete',
          method: 'POST',
          data: { id: id },
          dataType: 'json',
          success: function(response) {
            if (response.success) {
              row.remove();
              loadUsers();
            } else {
              alert('Error: ' + response.message);
            }
          }
        });
      }
    });

    $('#cancelEditBtn').click(function() {
      resetForm();
    });

  });
</script>