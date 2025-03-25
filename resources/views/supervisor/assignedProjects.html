<div class="container mt-4">
  <h3>Manage Assigned Projects</h3>

  <!-- Projects Table -->
  <table class="table table-bordered mt-3" id="assignedProjectsTable">
    <thead class="table-light">
      <tr>
        <th>#</th>
        <th>Project Name</th>
        <th>Description</th>
        <th>Status</th>
        <th>Progress (%)</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <!-- Project rows will be loaded dynamically -->
    </tbody>
  </table>
</div>

<script>
$(document).ready(function() {

  function loadAssignedProjects() {
    // Uncomment this block for real AJAX data
    /*
    $.ajax({
      url: '../api/assignedProjects.php',
      method: 'GET',
      dataType: 'json',
      success: function(projects) {
        $('#assignedProjectsTable tbody').empty();

        if (projects.length === 0) {
          $('#assignedProjectsTable tbody').append('<tr><td colspan="6" class="text-center">No assigned projects found.</td></tr>');
        } else {
          $.each(projects, function(index, project) {
            $('#assignedProjectsTable tbody').append(`
              <tr data-id="${project.id}">
                <td>${index + 1}</td>
                <td>${project.name}</td>
                <td>${project.description}</td>
                <td>${project.status}</td>
                <td>${project.progress}</td>
                <td>
                  <button class="btn btn-sm btn-primary viewBtn">View</button>
                  <button class="btn btn-sm btn-warning editBtn">Edit</button>
                  <button class="btn btn-sm btn-danger deleteBtn">Delete</button>
                </td>
              </tr>
            `);
          });
        }
      },
      error: function() {
        alert('Failed to load assigned projects.');
      }
    });
    */

    // Dummy data for demonstration purposes
    const dummyProjects = [
      { id: 1, name: 'Project Alpha', description: 'This is a description of Project Alpha.', status: 'In Progress', progress: 45 },
      { id: 2, name: 'Project Beta', description: 'This is a description of Project Beta.', status: 'Completed', progress: 100 },
      { id: 3, name: 'Project Gamma', description: 'This is a description of Project Gamma.', status: 'Pending', progress: 10 },
      { id: 4, name: 'Project Delta', description: 'This is a description of Project Delta.', status: 'In Progress', progress: 65 }
    ];

    $('#assignedProjectsTable tbody').empty();
    if (dummyProjects.length === 0) {
      $('#assignedProjectsTable tbody').append('<tr><td colspan="6" class="text-center">No assigned projects found.</td></tr>');
    } else {
      $.each(dummyProjects, function(index, project) {
        // Color coding for progress bar
        let progressClass = 'bg-danger'; // Default color (red)
        if (project.progress >= 50 && project.progress <= 67) {
          progressClass = 'bg-warning'; // Yellow
        } else if (project.progress >= 68) {
          progressClass = 'bg-success'; // Green
        }

        $('#assignedProjectsTable tbody').append(`
          <tr data-id="${project.id}">
            <td>${index + 1}</td>
            <td>${project.name}</td>
            <td>${project.description}</td>
            <td>${project.status}</td>
            <td>
              <div class="progress">
                <div class="progress-bar ${progressClass}" role="progressbar" style="width: ${project.progress}%;">
                  ${project.progress}%
                </div>
              </div>
            </td>
            <td>
              <button class="btn btn-sm btn-primary viewBtn">View</button>
              <button class="btn btn-sm btn-warning editBtn">Edit</button>
              <button class="btn btn-sm btn-danger deleteBtn">Delete</button>
            </td>
          </tr>
        `);
      });
    }
  }

  loadAssignedProjects();

  $('#assignedProjectsTable').on('click', '.viewBtn', function() {
    const projectId = $(this).closest('tr').data('id');
    alert('Viewing details for project ID: ' + projectId);
    // Optionally load project details here
  });

  $('#assignedProjectsTable').on('click', '.editBtn', function() {
    const projectId = $(this).closest('tr').data('id');
    alert('Editing project ID: ' + projectId);
    // Optionally open edit form here
  });

  $('#assignedProjectsTable').on('click', '.deleteBtn', function() {
    const row = $(this).closest('tr');
    const projectId = row.data('id');

    if (confirm('Are you sure you want to delete this project?')) {
      $.ajax({
        url: '../api/assignedProjects.php',
        method: 'POST',
        data: { action: 'delete', id: projectId },
        dataType: 'json',
        success: function(response) {
          if (response.success) {
            row.remove();
          } else {
            alert('Error deleting project: ' + response.message);
          }
        },
        error: function() {
          alert('Failed to delete the project.');
        }
      });
    }
  });

});
</script>
