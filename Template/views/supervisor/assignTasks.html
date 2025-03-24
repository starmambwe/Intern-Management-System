<div class="container mt-4">
  <h3>Assign Tasks to Interns</h3>

  <!-- Assign Task Form -->
  <form id="assignTaskForm" class="mt-4">

    <div class="mb-3">
      <label for="projectSelect" class="form-label">Select Project</label>
      <select class="form-select" id="projectSelect" required>
        <option value="">Loading projects...</option>
      </select>
    </div>

    <div class="mb-3">
      <label for="taskSelect" class="form-label">Select Task</label>
      <select class="form-select" id="taskSelect" required>
        <option value="">Please select a project first</option>
      </select>
    </div>

    <div class="mb-3">
      <label for="internSelect" class="form-label">Select Intern</label>
      <select class="form-select" id="internSelect" required>
        <option value="">Loading interns...</option>
      </select>
    </div>

    <button type="submit" class="btn btn-primary">Assign Task</button>
  </form>

  <!-- Assignment Table -->
  <div class="mt-5">
    <h4>Task Assignments</h4>
    <table class="table table-bordered" id="assignmentsTable">
      <thead class="table-light">
        <tr>
          <th>#</th>
          <th>Project</th>
          <th>Task</th>
          <th>Due Date</th>
          <th>Intern</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <!-- Assignments will appear here -->
      </tbody>
    </table>
  </div>
</div>

<script>
$(document).ready(function() {

  let useMockData = true; // Set to false to switch to backend

  const assignments = [];

  // Mock data (comment this when backend is ready)
  const mockProjects = [
    { id: 1, name: "Website Redesign" },
    { id: 2, name: "Mobile App Development" }
  ];

  const mockInterns = [
    { id: 1, name: "Alice Johnson" },
    { id: 2, name: "Bob Smith" }
  ];

  const mockTasks = {
    1: [
      { id: 1, title: "Create Wireframes", due_date: "2025-03-10" },
      { id: 2, title: "Develop Landing Page", due_date: "2025-03-15" }
    ],
    2: [
      { id: 3, title: "Setup Backend", due_date: "2025-03-20" },
      { id: 4, title: "Implement Login", due_date: "2025-03-25" }
    ]
  };

  function loadProjects() {
    $('#projectSelect').empty().append('<option value="">Select a project</option>');

    if (useMockData) {
      $.each(mockProjects, function(_, project) {
        $('#projectSelect').append(`<option value="${project.id}">${project.name}</option>`);
      });
    } else {
      // Uncomment for backend
      /*
      $.ajax({
        url: '../api/projects.php',
        method: 'GET',
        dataType: 'json',
        success: function(projects) {
          $.each(projects, function(_, project) {
            $('#projectSelect').append(`<option value="${project.id}">${project.name}</option>`);
          });
        },
        error: function() {
          $('#projectSelect').append('<option value="">Failed to load projects</option>');
        }
      });
      */
    }
  }

  function loadInterns() {
    $('#internSelect').empty().append('<option value="">Select an intern</option>');

    if (useMockData) {
      $.each(mockInterns, function(_, intern) {
        $('#internSelect').append(`<option value="${intern.id}">${intern.name}</option>`);
      });
    } else {
      // Uncomment for backend
      /*
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
          $('#internSelect').append('<option value="">Failed to load interns</option>');
        }
      });
      */
    }
  }

  $('#projectSelect').change(function() {
    const projectId = $(this).val();
    $('#taskSelect').empty().append('<option value="">Select a task</option>');

    if (projectId && useMockData) {
      $.each(mockTasks[projectId] || [], function(_, task) {
        $('#taskSelect').append(`<option value="${task.id}" data-due="${task.due_date}">${task.title}</option>`);
      });
    } else if (projectId) {
      // Uncomment for backend
      /*
      $.ajax({
        url: '../api/tasks.php',
        method: 'GET',
        data: { project_id: projectId },
        dataType: 'json',
        success: function(tasks) {
          $.each(tasks, function(_, task) {
            $('#taskSelect').append(`<option value="${task.id}" data-due="${task.due_date}">${task.title}</option>`);
          });
        },
        error: function() {
          $('#taskSelect').append('<option value="">Failed to load tasks</option>');
        }
      });
      */
    }
  });

  function refreshAssignmentsTable() {
    $('#assignmentsTable tbody').empty();
    $.each(assignments, function(index, assignment) {
      $('#assignmentsTable tbody').append(`
        <tr data-index="${index}">
          <td>${index + 1}</td>
          <td>${assignment.projectName}</td>
          <td>${assignment.taskTitle}</td>
          <td>${assignment.dueDate}</td>
          <td>${assignment.internName}</td>
          <td>
            <button class="btn btn-sm btn-warning editBtn">Edit</button>
            <button class="btn btn-sm btn-danger deleteBtn">Delete</button>
          </td>
        </tr>
      `);
    });
  }

  $('#assignTaskForm').submit(function(e) {
    e.preventDefault();

    const projectName = $('#projectSelect option:selected').text();
    const taskTitle = $('#taskSelect option:selected').text();
    const dueDate = $('#taskSelect option:selected').data('due');
    const internName = $('#internSelect option:selected').text();

    const assignment = { projectName, taskTitle, dueDate, internName };
    assignments.push(assignment);
    refreshAssignmentsTable();
    alert('Task assigned successfully!');
    $('#assignTaskForm')[0].reset();
    $('#taskSelect').empty().append('<option value="">Please select a project first</option>');
  });

  $('#assignmentsTable').on('click', '.deleteBtn', function() {
    const index = $(this).closest('tr').data('index');
    if (confirm('Delete this assignment?')) {
      assignments.splice(index, 1);
      refreshAssignmentsTable();
    }
  });

  $('#assignmentsTable').on('click', '.editBtn', function() {
    alert('Edit feature not implemented in mock mode.');
  });

  loadProjects();
  loadInterns();

});
</script>
