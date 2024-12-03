<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RIS</title>
    <!-- Link ke Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Navbar */
        .navbar {
            background-color: #56597C; /* Warna navbar */
        }

        .navbar-brand,
        .nav-link {
            color: white !important;
        }

        .nav-link:hover {
            color: #ffc107 !important; /* Kuning saat hover */
        }

        /* Background Body */
        body {
            background-color: #f8f9fa; /* Abu-abu lembut */
        }

        /* Button */
        .btn-primary {
            background-color: #F2E6C9; /* Warna untuk tombol */
            border-color: #F2E6C9;
            color: #38375C; /* Warna teks tombol */
        }

        .btn-primary:hover {
            background-color: #d1c7b7; /* Warna tombol lebih gelap saat hover */
            border-color: #b1a69b;
            color: #38375C; /* Warna teks tombol saat hover */
        }

        /* Form Heading */
        h3 {
            color: #38375C; /* Warna untuk judul (Owner Login, Member Register, Member Login) */
        }

        /* Alert Success */
        .alert-success {
            background-color: #d4edda; /* Hijau muda */
            border-color: #c3e6cb;
            color: #155724; /* Hijau teks */
        }

        /* Alert Danger */
        .alert-danger {
            background-color: #f8d7da; /* Merah muda */
            border-color: #f5c6cb;
            color: #721c24; /* Merah teks */
        }
    </style>
</head>

<body>
    <!-- Notifikasi -->
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <!-- Navbar Menu -->
    <nav class="navbar navbar-expand-lg">
        <a class="navbar-brand" href="#">RENTAL INFORMATION SYSTEM</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#ownerLogin" data-toggle="collapse">Owner Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#memberLogin" data-toggle="collapse">Member Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#memberRegister" data-toggle="collapse">Register</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Owner Login Section -->
    <div id="ownerLogin" class="collapse mt-3">
        <div class="container">
            <h3>Owner Login</h3>
            <form action="{{ route('owner.login') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="ownerPassword">Password</label>
                    <input type="password" class="form-control" name="password" id="ownerPassword" required>
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
            </form>
        </div>
    </div>

    <!-- Member Login Section -->
    <div id="memberLogin" class="collapse mt-3">
        <div class="container">
            <h3>Member Login</h3>
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" name="username" id="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" id="password" required>
                </div>
                <div class="form-group">
                    <label for="roles">Roles</label>
                    <select class="form-control" name="roles" id="roles" required>
                        <option value="admin">Admin</option>
                        <option value="member">Member</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
            </form>
        </div>
    </div>

    <!-- Member Register Section -->
    <div id="memberRegister" class="collapse mt-3">
        <div class="container">
            <h3>Member Register</h3>
            <form action="{{ route('register.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="registerUsername">Username</label>
                    <input type="text" class="form-control" name="username" id="registerUsername" required>
                </div>
                <div class="form-group">
                    <label for="registerPassword">Password</label>
                    <input type="password" class="form-control" name="password" id="registerPassword" required>
                </div>
                <div class="form-group">
                    <label for="password_confirmation">Confirm Password</label>
                    <input type="password" class="form-control" name="password_confirmation" id="password_confirmation"
                        required>
                </div>
                <div class="form-group">
                    <label for="registerEmail">Email</label>
                    <input type="email" class="form-control" name="email" id="registerEmail" required>
                </div>
                <div class="form-group">
                    <label for="registerRoles">Roles</label>
                    <select class="form-control" name="role" id="registerRoles" required>
                        <option value="member">Member</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Register</button>
            </form>
        </div>
    </div>

    <!-- Link ke Bootstrap JS dan jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
