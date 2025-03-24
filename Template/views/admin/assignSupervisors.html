<div class="container mt-5">
  <h2>Assign Supervisors to Projects</h2>

  <!-- Assignment Form -->
  <form id="assignmentForm">
    <input type="hidden" id="assignmentId">

    <div class="mb-3">
      <label for="projectName" class="form-label">Project</label>
      <select class="form-select" id="projectName" required>
        <option value="">Select a project</option>
        <!-- Dynamically load projects via AJAX -->
      </select>
    </div>

    <div class="mb-3">
      <label for="supervisorName" class="form-label">Supervisor</label>
      <select class="form-select" id="supervisorName" required>
        <option value="">Select a supervisor</option>
        <!-- Dynamically load supervisors via AJAX -->
      </select>
    </div>

    <button type="submit" class="btn btn-primary" id="saveAssignmentBtn">Save Assignment</button>
    <button type="reset" class="btn btn-secondary" id="cancelEditBtn" style="display:none;">Cancel Edit</button>
  </form>

  <hr class="my-5">

  <!-- Assignments Table -->
  <h4>Existing Assignments</h4>
  <table class="table table-bordered" id="assignmentsTable">
    <thead class="table-light">
      <tr>
        <th>#</th>
        <th>Project</th>
        <th>Supervisor</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <!-- Assignments will be dynamically inserted here -->
    </tbody>
  </table>
</div>

<script>
  $(document).ready(function() {

    let assignmentCount = 0;

    function resetForm() {
      $('#assignmentId').val('');
      $('#assignmentForm')[0].reset();
      $('#saveAssignmentBtn').text('Save Assignment');
      $('#cancelEditBtn').hide();
    }

    function appendAssignmentToTable(assignment) {
      assignmentCount++;
      $('#assignmentsTable tbody').append(`
        <tr data-id="${assignment.id}">
          <td>${assignmentCount}</td>
          <td>${assignment.project_name}</td>
          <td>${assignment.supervisor_name}</td>
          <td>
            <button class="btn btn-sm btn-warning editBtn">Edit</button>
            <button class="btn btn-sm btn-danger deleteBtn">Delete</button>
          </td>
        </tr>
      `);
    }

    function loadProjects() {
      const dummyProjects = [
        { id: 1, name: 'Project Alpha' },
        { id: 2, name: 'Project Beta' },
        { id: 3, name: 'Project Gamma' }
      ];

      $('#projectName').empty().append('<option value="">Select a project</option>');

      // Comment/uncomment as needed
      // $.ajax({
      //   url: 'ajax.assignSupervisors.php',
      //   method: 'GET',
      //   data: { type: 'projects' },
      //   dataType: 'json',
      //   success: function(projects) {
      //     $.each(projects, function(_, project) {
      //       $('#projectName').append(`<option value="${project.id}">${project.name}</option>`);
      //     });
      //   }
      // });

      $.each(dummyProjects, function(_, project) {
        $('#projectName').append(`<option value="${project.id}">${project.name}</option>`);
      });
    }

    function loadSupervisors() {
      const dummySupervisors = [
        { id: 1, name: 'John Doe' },
        { id: 2, name: 'Jane Smith' },
        { id: 3, name: 'Michael Johnson' }
      ];

      $('#supervisorName').empty().append('<option value="">Select a supervisor</option>');

      // Comment/uncomment as needed
      // $.ajax({
      //   url: 'ajax.assignSupervisors.php',
      //   method: 'GET',
      //   data: { type: 'supervisors' },
      //   dataType: 'json',
      //   success: function(supervisors) {
      //     $.each(supervisors, function(_, supervisor) {
      //       $('#supervisorName').append(`<option value="${supervisor.id}">${supervisor.name}</option>`);
      //     });
      //   }
      // });

      $.each(dummySupervisors, function(_, supervisor) {
        $('#supervisorName').append(`<option value="${supervisor.id}">${supervisor.name}</option>`);
      });
    }

    function loadAssignments() {
      const dummyAssignments = [
        { id: 1, project_name: 'Project Alpha', supervisor_name: 'John Doe', project_id: 1, supervisor_id: 1 },
        { id: 2, project_name: 'Project Beta', supervisor_name: 'Jane Smith', project_id: 2, supervisor_id: 2 },
        { id: 3, project_name: 'Project Gamma', supervisor_name: 'Michael Johnson', project_id: 3, supervisor_id: 3 }
      ];

      $('#assignmentsTable tbody').empty();
      assignmentCount = 0;

      // Comment/uncomment as needed
      // $.ajax({
      //   url: 'ajax.assignSupervisors.php',
      //   method: 'GET',
      //   data: { type: 'assignments' },
      //   dataType: 'json',
      //   success: function(assignments) {
      //     $.each(assignments, function(_, assignment) {
      //       appendAssignmentToTable(assignment);
      //     });
      //   }
      // });

      $.each(dummyAssignments, function(_, assignment) {
        appendAssignmentToTable(assignment);
      });
    }

    loadProjects();
    loadSupervisors();
    loadAssignments();

    $('#assignmentForm').submit(function(e) {
      e.preventDefault();

      const id = $('#assignmentId').val();
      const assignmentData = {
        id: id,
        project_id: $('#projectName').val(),
        supervisor_id: $('#supervisorName').val()
      };

      const ajaxUrl = id ? 'ajax.assignSupervisors.php?action=update' : 'ajax.assignSupervisors.php?action=create';

      $.ajax({
        url: ajaxUrl,
        method: 'POST',
        data: assignmentData,
        dataType: 'json',
        success: function(response) {
          if (response.success) {
            loadAssignments();
            resetForm();
          } else {
            alert('Error: ' + response.message);
          }
        }
      });
    });

    $('#assignmentsTable').on('click', '.editBtn', function() {
      const row = $(this).closest('tr');
      const id = row.data('id');

      // For dummy data testing, manually fill values (since no AJAX fetch)
      const assignment = {
        id: id,
        project_id: row.find('td:nth-child(2)').text() === 'Project Alpha' ? 1 :
                    row.find('td:nth-child(2)').text() === 'Project Beta' ? 2 : 3,
        supervisor_id: row.find('td:nth-child(3)').text() === 'John Doe' ? 1 :
                       row.find('td:nth-child(3)').text() === 'Jane Smith' ? 2 : 3
      };

      // Comment/uncomment as needed
      // $.ajax({
      //   url: 'ajax.assignSupervisors.php',
      //   method: 'GET',
      //   data: { type: 'assignment', id: id },
      //   dataType: 'json',
      //   success: function(assignment) {
      //     $('#assignmentId').val(assignment.id);
      //     $('#projectName').val(assignment.project_id);
      //     $('#supervisorName').val(assignment.supervisor_id);
      //     $('#saveAssignmentBtn').text('Update Assignment');
      //     $('#cancelEditBtn').show();
      //   }
      // });

      $('#assignmentId').val(assignment.id);
      $('#projectName').val(assignment.project_id);
      $('#supervisorName').val(assignment.supervisor_id);
      $('#saveAssignmentBtn').text('Update Assignment');
      $('#cancelEditBtn').show();
    });

    $('#assignmentsTable').on('click', '.deleteBtn', function() {
      const row = $(this).closest('tr');
      const id = row.data('id');

      if (confirm('Are you sure you want to delete this assignment?')) {
        $.ajax({
          url: 'ajax.assignSupervisors.php?action=delete',
          method: 'POST',
          data: { id: id },
          dataType: 'json',
          success: function(response) {
            if (response.success) {
              row.remove();
              loadAssignments();
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
