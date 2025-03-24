@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-center align-items-center vh-100">
    <div class="card p-4 shadow-lg">
        <h2 class="text-center mb-3">Login</h2>
        <div id="response-message"></div> <!-- Response message div -->

        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" id="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" id="password" class="form-control" required>
        </div>
        <button type="button" id="login-btn" class="btn btn-primary w-100">Login</button> <!-- Call function on click -->
    </div>
</div>

<!-- jQuery for AJAX -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#login-btn').click(function() {
            let email = $('#email').val();
            let password = $('#password').val();
            let _token = $('input[name="_token"]').val();

            // Clear previous messages
            $('#response-message').html('');

            if (email === "" || password === "") {
                $('#response-message').html('<div class="alert alert-warning">Please fill in all fields.</div>');
                return;
            }

            $.ajax({
                url: "{{ route('auth.login') }}", // Route to handle login
                type: "POST",
                data: {
                    email: email,
                    password: password,
                    _token: _token
                },
                success: function(response) {
                    if (response.status === 'success') {
                        $('#response-message').html('<div class="alert alert-success">' + response.message + '</div>');
                        setTimeout(function() {
                            window.location.href = response.redirect; // Redirect after 1 sec
                        }, 1000);
                    } else {
                        $('#response-message').html('<div class="alert alert-danger">' + response.message + '</div>');
                    }
                },
                error: function(xhr) {
                    let errors = xhr.responseJSON.errors;
                    let errorMessages = '';
                    $.each(errors, function(key, value) {
                        errorMessages += '<div class="alert alert-danger">' + value[0] + '</div>';
                    });
                    $('#response-message').html(errorMessages);
                }
            });
        });
    });
</script>

@endsection